<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单检索</title>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/artdialog/skins/aero.css" />
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/my97date/wdatepicker.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type='text/javascript' src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="min-width:420px;margin-top:10px;">
		<form action='#' method='post' name='searchForm'>
			<input type='hidden' name='search[type]' value='order_no' />

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="searchTypeText">订单号</span> <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="javascript:changeSearch('order_no');">订单号</a></li>
							<li><a href="javascript:changeSearch('accept_name');">收件人姓名</a></li>
							<?php if(!$seller_id){?>
							<li><a href="javascript:changeSearch('true_name');">商户真实名称</a></li>
							<?php }?>
						</ul>
					</div>
					<input type='text' class='form-control' name='search[content]' placeholder="输入查询信息" />
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<select class="form-control" name="search[pay_status]">
							<option value="">选择支付状态</option>
							<option value="0">未支付</option>
							<option value="1">已支付</option>
						</select>
					</div>

					<div class="col-xs-6">
						<select class="form-control" name="search[distribution_status]">
							<option value="">选择发货状态</option>
							<option value="0">未发货</option>
							<option value="1">已发货</option>
							<option value="2">部分发货</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<?php if(!$seller_id){?>
					<div class="col-xs-6">
						<select class='form-control' name="search[is_seller]">
							<option value="">选择订单归属</option>
							<option value="no">平台订单</option>
							<option value="yes">商户订单</option>
						</select>
					</div>
					<?php }?>

					<div class="col-xs-6">
						<select class="form-control" name="search[status]">
							<option value="">选择订单状态</option>
							<option value="1">新订单</option>
							<option value="2">确认订单</option>
							<option value="3">取消订单</option>
							<option value="4">作废订单</option>
							<option value="5">完成订单</option>
							<option value="6">退款</option>
							<option value="7">部分退款</option>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-yen"></span></span>
							<input type="text" class="form-control" name="search[order_amount_down]" pattern="float" value="" placeholder="订单总额下限" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-yen"></span></span>
							<input type="text" class="form-control" name="search[order_amount_up]" pattern="float" value="" placeholder="订单总额上限" />
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[create_time_start]" onfocus="WdatePicker()" value="" placeholder="订单生成起始时间" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[create_time_end]" onfocus="WdatePicker()" value="" placeholder="订单生成结束时间" />
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[send_time_start]" onfocus="WdatePicker()" value="" placeholder="订单发货起始时间" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[send_time_end]" onfocus="WdatePicker()" value="" placeholder="订单发货结束时间" />
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[completion_time_start]" onfocus="WdatePicker()" value="" placeholder="订单完成起始时间" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[completion_time_end]" onfocus="WdatePicker()" value="" placeholder="订单完成结束时间" />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>

<script type="text/javascript">
//切换搜索条件
function changeSearch(val)
{
	$('input[name="search[type]"]').val(val);
	$('#searchTypeText').text(typeConfig[val]);
}

//检索方式配置
var typeConfig = {"order_no":"订单号","accept_name":"收件人姓名","true_name":"商户真实名称"};

//表单回填
<?php if(isset($search)){?>
var filterPost = <?php echo JSON::encode($search);?>;
var formObj = new Form('searchForm');
for(var index in filterPost)
{
	formObj.setValue("search["+index+"]",filterPost[index]);
}
<?php }?>

$('#searchTypeText').text(typeConfig[$('input[name="search[type]"]').val()]);
</script>
</html>
