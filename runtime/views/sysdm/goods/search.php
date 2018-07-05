<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品检索</title>
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
		<form action='<?php echo IUrl::creatUrl("/goods/search_result/type/".$type."");?>' method='post' name='searchForm'>
			<input type='hidden' name='is_products' value='<?php echo isset($is_products)?$is_products:"";?>' />
			<input type='hidden' name='search[type]' value='name' />

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="searchTypeText">商品名称</span> <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="javascript:changeSearch('name');">商品名称</a></li>
							<li><a href="javascript:changeSearch('goods_no');">商品货号</a></li>
							<?php if(!$seller_id){?>
							<li><a href="javascript:changeSearch('true_name');">商户真实名称</a></li>
							<?php }?>
						</ul>
					</div>
					<input type='text' class='form-control' name='search[content]' placeholder="输入查询信息" />
				</div>
			</div>

			<?php if($mode == 'normal'){?>
			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<select class="form-control" name="search[store_nums]">
							<option value="">选择商品库存量</option>
							<option value="0">无货</option>
							<option value="9">低于10</option>
							<option value="10-100">10-100</option>
							<option value="100+">100以上</option>
						</select>
					</div>

					<div class="col-xs-6">
						<select class="form-control" name="search[is_del]">
							<option value="">选择商品状态</option>
							<option value="0">上架</option>
							<option value="2">下架</option>
							<option value="3">待审</option>
						</select>
					</div>
				</div>
			</div>

			<?php if(!$seller_id){?>
			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<select class='form-control' name="search[is_seller]">
							<option value="">选择商品归属</option>
							<option value="no">平台商品</option>
							<option value="yes">商户商品</option>
						</select>
					</div>

					<div class="col-xs-6">
						<select class="form-control" name="search[commend_id]">
							<option value="">选择商品标签</option>
							<option value="1">最新商品</option>
							<option value="2">特价商品</option>
							<option value="3">热卖商品</option>
							<option value="4">推荐商品</option>
						</select>
					</div>
				</div>
			</div>
			<?php }?>

			<?php }else{?>
			<input type='hidden' name='search[is_del]' value='0' />
			<?php }?>

			<div class="form-group">
				<span id="__categoryBox"></span>
				<button class="btn btn-default" type="button" name="_goodsCategoryButton"><span class="glyphicon glyphicon-th-list"></span> 选择商品分类</button>
				<?php plugin::trigger('goodsCategoryWidget',array("name" => "search[category_id]","value" => isset($search['category_id']) ? $search['category_id'] : ""))?>
			</div>

			<div class="form-group">
				<select class="form-control" name="search[brand_id]">
					<option value="">选择商品品牌</option>
					<?php foreach($items=Api::run('getBrandListAllOnce') as $key => $item){?>
					<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
					<?php }?>
				</select>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-yen"></span></span>
							<input type="text" class="form-control" name="search[seller_price_down]" pattern="float" value="" placeholder="价格下限" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-yen"></span></span>
							<input type="text" class="form-control" name="search[seller_price_up]" pattern="float" value="" placeholder="价格上限" />
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[create_time_start]" onfocus="WdatePicker()" value="" placeholder="创建起始时间" />
						</div>
					</div>
					<div class="col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							<input class="form-control" type="text" name="search[create_time_end]" onfocus="WdatePicker()" value="" placeholder="创建结束时间" />
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
var typeConfig = {"name":"商品名称","goods_no":"商品货号","true_name":"商户真实名称"};

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
