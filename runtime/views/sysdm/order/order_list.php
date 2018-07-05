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
            <div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">订单</a>
		</li>
		<li>
			<a href="#">订单管理</a>
		</li>
		<li class="active">订单列表</li>
	</ul>
</div>

<div class="content">
	<table class="table list-table">
		<colgroup>
			<col width="35px" />
			<col width="180px" />
			<col width="80px" />
			<col width="70px" />
			<col width="70px" />
			<col width="90px" />
			<col width="80px" />
			<col width="90px" />
			<col />
			<col width="90px" />
			<col width="120px" />
		</colgroup>
		<caption>

			<a href="<?php echo IUrl::creatUrl("/order/order_edit");?>" class="btn btn-default">
				<i class='fa fa-plus'></i>添加订单
			</a>

			<a href="javascript:selectAll('id[]')" class="btn btn-default">
				<i class='fa fa-check'></i>全选
			</a>

			<div class="btn-group">
				<button type="button" class="btn btn-default">批量操作</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="javascript:void(0);" onclick="delModel({'form':'orderForm',name:'id[]'})">批量删除</a></li>
					<li><a href="javascript:void(0);" onclick="$('#orderForm').attr('action','<?php echo IUrl::creatUrl("/order/expresswaybill_template");?>');$('#orderForm').submit();">批量打印快递单</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo IUrl::creatUrl("/order/order_report/?".$search."");?>" target="_blank">导出Excel</a></li>
				</ul>
			</div>

			<a href="<?php echo IUrl::creatUrl("/order/print_template");?>" class="btn btn-default">
				<i class='fa fa-file-archive-o'></i>单据模板
			</a>

			<a href="<?php echo IUrl::creatUrl("/order/order_recycle_list");?>" class="btn btn-default">
				<i class='fa fa-trash'></i>回收站
			</a>

			<a href="javascript:searchOrder({'submit':filterResult,'data':'<?php echo isset($search)?$search:"";?>'});" class="btn btn-default">
				<i class='fa fa-search'></i>检索
			</a>
		</caption>
		<thead>
			<tr>
				<th></th>
				<th>订单号</th>
				<th>收货人</th>
				<th>支付状态</th>
				<th>发货状态</th>
				<th>配送方式</th>
				<th>打印</th>
				<th>支付方式</th>
				<th>用户名</th>
				<th>下单时间</th>
				<th>操作</th>
			</tr>
		</thead>
        <form name="orderForm" id="orderForm" action="<?php echo IUrl::creatUrl("/order/order_del");?>" method="post">
		<tbody>
			<?php foreach($items=$this->orderHandle->find() as $key => $item){?>
			<tr>
				<td><input name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
				<td title="<?php echo isset($item['order_no'])?$item['order_no']:"";?>" name="orderStatusColor<?php echo isset($item['status'])?$item['status']:"";?>"><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td title="<?php echo isset($item['accept_name'])?$item['accept_name']:"";?>"><?php echo isset($item['accept_name'])?$item['accept_name']:"";?></td>
				<td name="payStatusColor<?php echo isset($item['pay_status'])?$item['pay_status']:"";?>"><?php echo Order_Class::getOrderPayStatusText($item);?></td>
				<td name="disStatusColor<?php echo isset($item['distribution_status'])?$item['distribution_status']:"";?>"><?php echo Order_Class::getOrderDistributionStatusText($item);?></td>
				<td title="<?php echo isset($item['distribute_name'])?$item['distribute_name']:"";?>"><?php echo isset($item['distribute_name'])?$item['distribute_name']:"";?></td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/order/shop_template/id/".$item['id']."");?>" target="_blank"><span class="badge bg-red" title="购物清单打印">购</span></a>
					<a href="<?php echo IUrl::creatUrl("/order/pick_template/id/".$item['id']."");?>" target="_blank"><span class="badge bg-green" title="配货单打印">配</span></a>
					<a href="<?php echo IUrl::creatUrl("/order/merge_template/id/".$item['id']."");?>" target="_blank"><span class="badge bg-yellow" title="联合打印">合</span></a>
					<a href="<?php echo IUrl::creatUrl("/order/expresswaybill_template/id/".$item['id']."");?>" target="_blank"><span class="badge bg-blue" title="快递单打印">递</span></a>
				</td>
				<td><?php echo isset($item['payment_name'])?$item['payment_name']:"";?></td>
				<td>
					<?php if($item['user_id'] == 0){?>
					游客
					<?php }else{?>
                    <?php $user = Api::run('getMemberInfo',$item["user_id"])?>
					<?php echo isset($user['username'])?$user['username']:"";?>
					<?php }?>
				</td>
				<td title="<?php echo isset($item['create_time'])?$item['create_time']:"";?>"><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/order/order_show/id/".$item['id']."");?>"><i class='operator fa fa-eye' title="查看订单"></i></a>
					<?php if(Order_class::getOrderStatus($item) < 3){?>
					<a href="<?php echo IUrl::creatUrl("/order/order_edit/id/".$item['id']."");?>"><i class='operator fa fa-edit'></i></a>
					<?php }?>
					<a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/order/order_del/id/".$item['id']."");?>'})"><i class='operator fa fa-close'></i></a>

					<?php if($item['seller_id']){?>
					<a href="<?php echo IUrl::creatUrl("/site/home/id/".$item['seller_id']."");?>" target="_blank"><i class='operator fa fa-user' title='商家订单'></i></a>
					<?php }?>
				</td>
			</tr>
			<?php }?>
		</tbody>
		</form>
	</table>
</div>
<?php echo $this->orderHandle->getPageBar();?>


<script type='text/javascript'>
//检索商品
function filterResult(iframeWin)
{
	var searchForm   = iframeWin.document.body;
	var searchString = $(searchForm).find("form").serialize();
	var jumpUrl      = creatUrl("/order/order_list/"+searchString);
	window.location.href = jumpUrl;
}

//DOM加载结束
$(function(){
	//高亮色彩
	$('[name="payStatusColor1"]').addClass('text-green');
	$('[name="disStatusColor1"]').addClass('text-green');
	$('[name="orderStatusColor3"]').addClass('text-red');
	$('[name="orderStatusColor4"]').addClass('text-red');
	$('[name="orderStatusColor5"]').addClass('text-green');
});
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