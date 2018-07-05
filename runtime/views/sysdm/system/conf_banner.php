<!DOCTYPE html>
<html>

<head>
    <title>后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
    <!--[if lt IE 9]>
	<script src="<?php echo $this->getWebViewPath()."javascript/html5shiv.min.js";?>"></script>
	<script src="<?php echo $this->getWebViewPath()."javascript/respond.min.js";?>"></script>
	<![endif]-->
    <meta name="robots" content="noindex,nofollow">
    <link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
    <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script> <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop03/runtime/_systemjs/artdialog/skins/aero.css" /> <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/form/form.js"></script> <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/php/newshop03/runtime/_systemjs/autovalidate/style.css" /> <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
    <script type='text/javascript' src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="//cdn.bootcss.com/admin-lte/2.4.3/js/adminlte.min.js"></script>
    <script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>

<body class="skin-blue fixed sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <header class="main-header">
            <div class="logo">
                <span class="logo-mini"><b>iWeb</b></span>
                <span class="logo-lg"><b>iWebShop</b>后台管理</span>
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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">系统</a>
		</li>
		<li>
			<a href="#">网站管理</a>
		</li>
		<li class="active">首页幻灯片</li>
	</ul>
</div>

<div class="content">
	<form action='<?php echo IUrl::creatUrl("/system/banner_update");?>' method='post' enctype="multipart/form-data">
    	<table class="table list-table" id='slide_box'>
    		<colgroup>
                <col width="280px" />
                <col width="280px" />
                <col width="280px" />
                <col width="150px" />
            </colgroup>

    	    <thead>
	            <tr>
					<th>名称</th>
					<th>链接地址</th>
					<th>图片文件</th>
					<th>操作</th>
	            </tr>
            </thead>

            <tbody></tbody>

            <tfoot>
            	<tr>
            		<td colspan="4">
            			<button type="button" class="btn btn-primary" onclick="add_slide();">新加一个</button>
            			<button type="submit" class="btn btn-primary">保存数据</button>
            		</td>
            </tfoot>

			<!--导航行模板-->
			<script type='text/html' id='slideTrTemplate'>
			<tr>
				<td>
					<input type='text' name='banner_name[]' class='form-control' value='<%=name%>' pattern='required' />
				</td>
				<td>
					<input type='text' name='banner_url[]' class='form-control' value='<%=url%>' pattern='required' />
				</td>
				<td>
					<%if(img){%><img src="<?php echo IUrl::creatUrl("");?><%=img%>" width="150px" /><br /><%}%>
					<input type='file' name='banner_pic[]' class='form-control' />
					<input type="hidden" value="<%=img%>" name="banner_img[]" />
				</td>
				<td>
					<a href="javascript:;"><i class='operator fa fa-arrow-up' alt='向上' title='向上' ></i></a>
					<a href="javascript:;"><i class='operator fa fa-arrow-down' alt='向下' title='向下'></i></a>
					<a href="javascript:;"><i class='operator fa fa-close' alt='删除' title='删除'></i></a>
				</td>
			</tr>
			</script>
        </table>
    </form>
</div>

<script type='text/javascript'>
//DOM加载完毕
$(function(){
	//生成幻灯片
	<?php if($bannerData = Api::run('getBannerConf')){?>
	var slideList = <?php echo JSON::encode($bannerData);?>;
	for(var index in slideList)
	{
		add_slide(slideList[index]);
	}
	<?php }else{?>
		add_slide();
	<?php }?>
});

//增加幻灯片
function add_slide(data)
{
    var data = data ? data : {};
	var slideTrHtml = template.render('slideTrTemplate',data);
	$('#slide_box tbody').append(slideTrHtml);
	var last_index = $('#slide_box tbody tr').size()-1;
	buttonInit(last_index,'#slide_box');
}

//操作按钮绑定
function buttonInit(indexValue,ele)
{
	ele = ele || "#guide_box";
	if(indexValue == undefined || indexValue === '')
	{
		var button_times = $(ele+' tbody tr').length;

		for(var item=0;item < button_times;item++)
		{
			buttonInit(item,ele);
		}
	}
	else
	{
		var obj = $(ele+' tbody tr:eq('+indexValue+') .operator')

		//功能操作按钮
		obj.each(
			function(i)
			{
				switch(i)
				{
					//向上排序
					case 0:
					{
						$(this).click(
							function()
							{
								var insertIndex = $(this).parent().parent().parent().prev().index();
								if(insertIndex >= 0)
								{
									$(ele+' tbody tr:eq('+insertIndex+')').before($(this).parent().parent().parent());
								}
							}
						)
					}
					break;

					//向上排序
					case 1:
					{
						$(this).click(
							function()
							{
								var insertIndex = $(this).parent().parent().parent().next().index();
								$(ele+' tbody tr:eq('+insertIndex+')').after($(this).parent().parent().parent());
							}
						)
					}
					break;

					//删除排序
					case 2:
					{
						$(this).click(
							function()
							{
								var obj = $(this);
								art.dialog.confirm('确定要删除么？',function(){obj.parent().parent().parent().remove()});
							}
						)
					}
					break;
				}
			}
		)
	}
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