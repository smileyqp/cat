<!DOCTYPE html>
<html>

<head>
    <title>喵了个咪后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
    <!--[if lt IE 9]>
	<script src="<?php echo $this->getWebViewPath()."javascript/html5shiv.min.js";?>"></script>
	<script src="<?php echo $this->getWebViewPath()."javascript/respond.min.js";?>"></script>
	<![endif]-->
    <meta name="robots" content="noindex,nofollow">
    <link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
    <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script> <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/artdialog/skins/aero.css" /> <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/form/form.js"></script> <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/autovalidate/style.css" /> <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
    <script type='text/javascript' src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="//cdn.bootcss.com/admin-lte/2.4.3/js/adminlte.min.js"></script>
    <script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>

<body class="skin-blue fixed sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <header class="main-header">
            <div class="logo">
                <span class="logo-mini"><b>喵了个咪</b></span>
                <span class="logo-lg"><b>喵了个咪</b>后台管理</span>
            </div>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only"></span>
                </a>

                <!--顶部菜单 开始-->
                <div id="menu" class="navbar-custom-menu">
                    <ul class="nav navbar-nav" name="topMenu">
                        <?php $menuData=menu::init($this->admin['role_id']);?>
                        <?php foreach($items=menu::getTopMenu($menuData) as $key => $item){?>
                        <li><a hidefocus="true" href="<?php echo IUrl::creatUrl("".$item."");?>"><?php echo isset($key)?$key:"";?></a></li>
                        <?php }?>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
                 <!--顶部菜单 结束-->
            </nav>
        </header>

		<!--左侧菜单 开始-->
        <aside id="admin_left" class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <div class="user-panel">
                    <div class="pull-left image">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></p>
                        <a href="#"><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></a>
                    </div>
                </div>

                <?php $leftMenu=menu::get($menuData,IWeb::$app->getController()->getId().'/'.IWeb::$app->getController()->getAction()->getId());$modelName = key($leftMenu);$modelValue = current($leftMenu);?>
                <ul class="sidebar-menu tree" data-widget="tree">
                    <li class="header"><?php echo isset($modelName)?$modelName:"";?>模块菜单</li>
                    <?php foreach($items=$modelValue as $key => $item){?>
                    <li class="treeview">
                        <a href="#">
                        	<i class="fa" name="ico" menu="<?php echo isset($key)?$key:"";?>"></i>
                            <span><?php echo isset($key)?$key:"";?></span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu" name="leftMenu">
                            <?php foreach($items=$item as $leftKey => $leftValue){?>
                            <li><a href="<?php echo IUrl::creatUrl("".$leftKey."");?>"><i class="fa fa-circle-o"></i><?php echo isset($leftValue)?$leftValue:"";?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php }?>

                    <?php foreach($items=Api::run('getQuickNavigaAll') as $key => $item){?>
                    <li class="header">快速导航</li>
                    <li><a href="<?php echo isset($item['url'])?$item['url']:"";?>"><i class="fa fa-star-o"></i> <span><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></span></a></li>
                    <?php }?>
                </ul>
            </section>
        </aside>
        <!--左侧菜单 结束-->

		<!--右侧内容 开始-->
        <div id="admin_right" class="content-wrapper">
            <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/areaSelect/areaSelect.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">订单</a>
		</li>
		<li>
			<a href="#">订单管理</a>
		</li>
		<li class="active">订单编辑</li>
	</ul>
</div>

<div class="content">
	<form name="ModelForm" action="<?php echo IUrl::creatUrl("/order/order_update");?>" method="post">
	<input type='hidden' name='id' value='' />
	<input type='hidden' name='takeself' value='' />

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#tab1" data-toggle="tab">商品信息</a>
			</li>
			<li>
				<a href="#tab2" data-toggle="tab">订单配置</a>
			</li>
			<li>
				<a href="#tab3" data-toggle="tab">收货人信息</a>
			</li>
		</ul>
	</div>

	<div class="tab-content">

		<!--商品信息-->
		<div class="tab-pane active" id="tab1">
			<table class="table list-table">
				<colgroup>
					<col />
					<col width="120px" />
					<col width="100px" />
					<col width="120px" />
				</colgroup>

				<thead>
					<tr>
						<th>商品名称</th>
						<th>商品价格</th>
						<th>商品数量</th>
						<th>操作</th>
					</tr>
				</thead>

				<tbody id="goodsBox"></tbody>
				<tfoot>
					<tr>
						<td colspan="4">
							<a class="btn btn-default" href='javascript:searchGoods({"callback":searchGoodsCallback,"type":"checkbox","is_products":1});'>
								<i class='fa fa-plus'></i>添加商品
							</a>
						</td>
					</tr>
				</tfoot>

				<!--商品模板-->
				<script type='text/html' id='goodsTrTemplate'>
				<tr>
					<input type='hidden' name='goods_id[]' value='<%=item.id%>' />
					<input type='hidden' name='product_id[]' value='<%=item.product_id%>' />
					<td>
						<%=item.name?item.name:"商品不存在"%>
						<%if(item.spec_array){%>
							<span class="text-orange">
							<%var spec_array = typeof item.spec_array == 'string' ? JSON().parse(item.spec_array) : item.spec_array;%>
							<%for(var index in spec_array){%>
								<%var value = spec_array[index]%>
								<%=value['name']%>:
								<%if(value['type'] == 1){%>
									<%=value['value']%>
								<%}else{%>
									<img src="<?php echo IUrl::creatUrl();?><%=value['value']%>" width="35px" height="35px" />
								<%}%>
							<%}%>
							</span>
						<%}%>
						<%if(item.products_no){%>
							【<%=item.products_no%>】
						<%}%>

						<%if(item.goods_no){%>
							【<%=item.goods_no%>】
						<%}%>
					</td>
					<td><%=item.real_price%></td>
					<td><input class="form-control" name="goods_nums[]" value="<%=item.goods_nums ? item.goods_nums : 1%>" /></td>
					<td>
						<a onclick="$(this).parent().parent().remove();">
							<i class='operator fa fa-close'></i>
						</a>
					</td>
				</tr>
				</script>
			</table>
		</div>

		<!--订单配置-->
		<div class="tab-pane" id="tab2">
			<table class="table form-table">
				<colgroup>
					<col width="130px" />
					<col />
				</colgroup>

				<tbody>
					<tr>
						<th>配送方式：</th>
						<td>
							<select name="distribution" alt="请选择配送方式" class="form-control" onchange="selectTakeself(this);">
								<?php foreach($items=Api::run('getDelivery') as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>" datatype="<?php echo isset($item['type'])?$item['type']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<p id="takeself"></p>

							<!--自提点模板-->
							<script type='text/html' id='takeselfTemplate'>
								<%=item['province_str']%> <%=item['city_str']%> <%=item['area_str']%> <%=item['address']%> <%=item['name']%> <%=item['phone']%> <%=item['mobile']%>
							</script>
						</td>
					</tr>
					<tr>
						<th>配送运费：</th>
						<td>
							<input class="form-control" type="text" name="real_freight" value="" pattern="float" empty />
							<p class="help-block">不填写运费则系统自动计算</p>
						</td>
					</tr>
					<tr>
						<th>支付方式：</th>
						<td>
							<select name="pay_type" pattern="required" alt="请选择配送方式" class="form-control">
								<option value="">请选择支付</option>
                                <?php foreach($items=Api::run('getPayment') as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>是否要发票：</th>
						<td>
							<label class='checkbox-inline'>
								<input type="checkbox" name="invoice" value="1" onchange="$('#taxArea').toggle();" />发票
							</label>
						</td>
					</tr>
					<tr id="taxArea" style="display:none;">
						<th>发票信息：</th>
						<td>
							<table class="table">
								<tr>
									<td>公司名称：<input class="form-control" type="text" name="invoice_company_name" value="" /></td>
									<td>纳税人识别码：<input class="form-control" type="text" name="invoice_taxcode" value="" /></td>
								</tr>

								<tr>
									<td>注册地址：<input class="form-control" type="text" name="invoice_address" value="" /></td>
									<td>注册电话：<input class="form-control" type="text" name="invoice_telphone" value="" /></td>
								</tr>

								<tr>
									<td>开户银行：<input class="form-control" type="text" name="invoice_bankname" value="" /></td>
									<td>银行账号：<input class="form-control" type="text" name="invoice_bankno" value="" /></td>
								</tr>

								<tr>
									<td>
										发票类型：
										<select name="invoice_type" class="form-control">
											<option value="1">普通发票</option>
											<option value="2">增值税专用票</option>
										</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th>订单备注：</th>
						<td>
							<input class="form-control" type="text" name="note" value="" />
						</td>
					</tr>
					<tr>
						<th>指定送货时间：</th>
						<td>
							<label class='radio-inline'>
								<input type='radio' name='accept_time' checked="checked" value='任意' />任意
							</label>
							<label class='radio-inline'>
								<input type='radio' name='accept_time' value='周一到周五' />周一到周五
							</label>
							<label class='radio-inline'>
								<input type='radio' name='accept_time' value='周末' />周末
							</label>
						</td>
					</tr>
					<?php if(isset($this->orderRow)){?>
					<tr>
						<th>减价或涨价：</th>
						<td>
							<input class="form-control" type="text" name="discount" value="" />
							<p class="help-block">折扣用" - ",涨价用" + "，单位:元</p>
						</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>

		<!--收货人信息-->
		<div class="tab-pane" id="tab3">
			<table class="table form-table">
				<colgroup>
					<col width="130px" />
					<col />
				</colgroup>

				<tbody>
					<tr>
						<th>所属用户名:</th>
						<td>
							<input type='text' name='username' value='<?php echo $this->username;?>' class='form-control' placeholder="用户注册名" />
							<p class="help-block">订单所属于的用户，直接填写用户名，订单创建后与该用户绑定在一起，如果为空则为游客订单或者线下订单</p>
						</td>
					</tr>
					<tr>
						<th>收货人姓名:</th>
						<td>
							<input class="form-control" type="text" name="accept_name" value="" pattern="required" placeholder="请填写收货人姓名" />
						</td>
					</tr>
					<tr>
						<th>收货地区:</th>
						<td>
                            <div class="row">
                                <div class="col-xs-3">
                                    <select name="province" child="city,area" class="form-control"></select>
                                </div>
                                <div class="col-xs-3">
                                    <select name="city" child="area" class="form-control"></select>
                                </div>
                                <div class="col-xs-3">
                                    <select name="area" pattern="required" class="form-control"></select>
                                </div>
                            </div>
						</td>
					</tr>
					<tr>
						<th>收货地址:</th>
						<td>
							<input class="form-control" type="text" name="address" pattern="required" value="" placeholder="请填写收货地址" />
						</td>
					</tr>
					<tr>
						<th>联系手机:</th>
						<td>
							<input class="form-control" type="text" name="mobile" value="" pattern="mobi" placeholder="填写手机号码" />
						</td>
					</tr>
					<tr>
						<th>联系电话:</th>
						<td>
							<input class="form-control" type="text" name="telphone" value="" empty pattern="phone" placeholder="请输入正确的固定电话" />
						</td>
					</tr>
					<tr>
						<th>邮编:</th>
						<td>
							<input class="form-control" type="text" name="postcode" value="" empty pattern="zip" placeholder="请输入正确的邮编" />
						</td>
					</tr>
					<tr>
						<th>用户附言:</th>
						<td>
							<textarea class="form-control" rows="5" cols="15" name="postscript" placeholder="填写用户的附言"></textarea>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="text-center">
			<button class='btn btn-primary' type="submit">保 存</button>
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
//DOM加载完毕
$(function(){
	//完整订单数据JSON
	var orderRow = <?php echo JSON::encode($this->orderRow);?>;

	//表单回填
	var formInstance = new Form();
	formInstance.init(orderRow);

	//动态数据回填
	if(orderRow)
	{
		var goodsList = <?php echo JSON::encode($this->orderGoods);?>;
		for(var index in goodsList)
		{
			insertGoods(goodsList[index]);
		}

		//自提数据回填
		<?php if($this->takeself){?>
		var takeselfJSON = <?php echo JSON::encode($this->takeself);?>;
		$('#takeself').html(template.render('takeselfTemplate',{"item":takeselfJSON}));
		<?php }?>

		//发票数据回填
		if($('input[type="checkbox"][name="invoice"]:checked').val() == 1)
		{
			$('#taxArea').show();
			if(orderRow.invoice_info)
			{
				var invoiceObj = JSON.parse(orderRow.invoice_info);
				for(var i in invoiceObj)
				{
					formInstance.setValue("invoice_"+i,invoiceObj[i]);
				}
			}
		}
	}

	//地区联动插件
	var areaInstance = new areaSelect('province');
	areaInstance.init(<?php echo JSON::encode($this->orderRow);?>);

	//提交按钮解锁
	$('button[type="submit"]').removeAttr('disabled');
});

/**
 * 筛选商品回调
 * @param goodsList JQ选中的商品列表节点
 */
function searchGoodsCallback(goodsList)
{
	//循环插入DOM节点
	goodsList.each(function()
	{
		var temp = $.parseJSON($(this).attr('data'));
		var insertObject = {"id":temp.goods_id,"name":temp.name,"real_price":temp.sell_price,"product_id":temp.product_id,"spec_array":temp.spec_array ? $.parseJSON(temp.spec_array) : "","goods_no":temp.goods_no};
		insertGoods(insertObject);
	});
}

/**
 * 生成商品信息
 */
function insertGoods(goodsRow)
{
	var goodsRow = goodsRow ? goodsRow : {};
	var goodsTrHtml = template.render('goodsTrTemplate',{item:goodsRow});
	$('#goodsBox').append(goodsTrHtml,goodsRow);
}

//选择自提点
function selectTakeself(obj)
{
	var type = $(obj).find("option:selected").attr("datatype");
	if(type != 2)
	{
		$('[name="takeself"]').val(0);
		$('#takeself').empty();
		return;
	}

	art.dialog.open("<?php echo IUrl::creatUrl("/block/takeself");?>",{
		title:'选择自提点',
		okVal:'选择',
		ok:function(iframeWin, topWin)
		{
			var takeselfJson = $(iframeWin.document).find('[name="takeselfItem"]:checked').val();

			if(!takeselfJson)
			{
				alert('请选择自提点');
				return false;
			}
			var json = $.parseJSON(takeselfJson);
			$('#takeself').empty();
			$('[name="takeself"]').val(json.id);
			$('#takeself').html(template.render('takeselfTemplate',{"item":json}));
			return true;
		}
	});
}
</script>
        </div>
        <!--右侧内容 结束-->

		<!--顶部弹出菜单 开始-->
	    <aside class="control-sidebar control-sidebar-dark">
	        <ul class="control-sidebar-menu">
	            <li><a href="<?php echo IUrl::creatUrl("/admin/logout");?>"><i class="fa fa-circle-o text-red"></i> <span>退出管理</span></a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>"><i class="fa fa-circle-o text-yellow"></i> <span>修改密码</span></a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/default");?>"><i class="fa fa-circle-o text-green"></i> <span>后台首页</span></a></li>
	            <li><a href="<?php echo IUrl::creatUrl("");?>" target='_blank'><i class="fa fa-circle-o text-aqua"></i> <span>商城首页</span></a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/navigation");?>"><i class="fa fa-circle-o"></i> <span>快速导航</span></a></li>
	        </ul>
	    </aside>
	    <!--顶部弹出菜单 结束-->
    </div>
</body>
<script type='text/javascript'>
//图标配置
var icoConfig = {"商品管理":"fa-inbox","商品分类":"fa-list","品牌":"fa-registered","模型":"fa-cubes","搜索":"fa-search","会员管理":"fa-user-o","商户管理":"fa-group","信息处理":"fa-comment-o","订单管理":"fa-file-text","单据管理":"fa-files-o","发货地址":"fa-address-card-o","促销活动":"fa-bullhorn","营销活动":"fa-bell-o","代金券管理":"fa-ticket","基础数据统计":"fa-bar-chart-o","后台首页":"fa-home","日志操作记录":"fa-file-code-o","商户数据统计":"fa-pie-chart","支付管理":"fa-credit-card","第三方平台":"fa-share-alt","配送管理":"fa-truck","地域管理":"fa-street-view","权限管理":"fa-unlock-alt","数据库管理":"fa-database","文章管理":"fa-file-o","帮助管理":"fa-question-circle-o","广告管理":"fa-flag","公告管理":"fa-bookmark-o","网站地图":"fa-sitemap","插件管理":"fa-cogs","网站管理":"fa-wrench"};
$('i[name="ico"]').each(function()
{
	var menuName = $(this).attr('menu');
	if(menuName && icoConfig[menuName])
	{
		$(this).addClass(icoConfig[menuName]);
	}
	else
	{
		//默认图标
		$(this).addClass("fa-circle");
	}
});

//兼容IE系列
$("[name='leftMenu'] [href^='javascript:']").each(function(i)
{
	var fun = $(this).attr('href').replace("javascript:","");
	$(this).attr('href','javascript:void(0)');
	$(this).on("click",function(){eval(fun)});
});

//按钮高亮
var topItem = "<?php echo $modelName;?>";
$("[name='topMenu']>li:contains('"+topItem+"')").addClass("active");

//左边栏菜单高亮
var leftItem = "<?php echo IUrl::getUri();?>";
for(j=0; j<3; j++)
{
	var isMatch = false;
	$("[name='leftMenu']>li a").each(function(i)
	{
		var tempHref = $(this).attr('href');
		var indexVal = tempHref.length >= leftItem.length ? tempHref.indexOf(leftItem) : leftItem.indexOf(tempHref);

		if(isMatch == false && indexVal == 0)
		{
			isMatch = true;
			$(this).parent().addClass("active").parent('ul').show().parent('.treeview').addClass('menu-open');
		}
	});

	if(isMatch == true)
	{
		break;
	}
	//缩减目标字符串为了可以匹配
	leftItem = leftItem.slice(0,-5);
}
</script>
</html>