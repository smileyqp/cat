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
            <div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">工具</a>
		</li>
		<li>
			<a href="#">关键词管理</a>
		</li>
		<li class="active">关键词列表</li>
	</ul>
</div>
<div class="content">
	<form action="#" method="post" name="searchForm">
		<table class="table list-table">
			<colgroup>
				<col width="35px" />
				<col  />
				<col width="120px" />
				<col width="100px" />
				<col width="150px" />
			</colgroup>
			<caption>
                <a class="btn btn-default" href='<?php echo IUrl::creatUrl("/tools/keyword_edit");?>'>
                    <i class="fa fa-plus"></i>添加关键词
                </a>
                <a class="btn btn-default" onclick="selectAll('id[]')">
                    <i class="fa fa-check"></i>全选
                </a>
                <a class="btn btn-default" onclick="delModel({'link':'<?php echo IUrl::creatUrl("/tools/keyword_del");?>','form':'searchForm'})">
                    <i class="fa fa-close"></i>批量删除
                </a>
                <a class="btn btn-default" onclick="delModel({msg:'是否批量同步？','link':'<?php echo IUrl::creatUrl("/tools/keyword_account");?>','form':'searchForm'});">
                    <i class="fa fa-refresh"></i>批量同步
                </a>
			</caption>
			<thead>
				<tr>
					<th></th>
					<th>关键词</th>
					<th>关联商品数量</th>
					<th>是否热门</th>
					<th>排序</th>
				</tr>
			</thead>

			<tbody>
                <?php $queryObj=Api::run('getListByKeywordList');$resultData=$queryObj->find()?>
                <?php foreach($items=$resultData as $key => $item){?>
				<tr>
					<td><input type="checkbox" name="id[]" value="<?php echo isset($item['word'])?$item['word']:"";?>" /></td>
					<td><?php echo isset($item['word'])?$item['word']:"";?></td>
					<td><?php echo isset($item['goods_nums'])?$item['goods_nums']:"";?></td>
					<td>
						<?php if($item['hot']==1){?>
						<a class='text-red' href='javascript:void(0);' onclick='set_hot("<?php echo isset($item['word'])?$item['word']:"";?>",this);'>是</a>
						<?php }else{?>
						<a href='javascript:void(0);' onclick='set_hot("<?php echo isset($item['word'])?$item['word']:"";?>",this);'>否</a>
						<?php }?>
					</td>
					<td>
						<input type='text' onblur='set_order("<?php echo isset($item['word'])?$item['word']:"";?>",this,"<?php echo isset($item['order'])?$item['order']:"";?>");' class='form-control' value='<?php echo isset($item['order'])?$item['order']:"";?>' />
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>
<?php echo $queryObj->getPageBar();?>

<script type='text/javascript'>
//设置热门关键词
function set_hot(word,obj)
{
	var rd = Math.random();
	$.getJSON('<?php echo IUrl::creatUrl("/tools/keyword_hot/hot/1");?>',{id:word,rd:rd},function(content){
		if(content.isError ==  false)
		{
			if(content.hot == 1)
			{
				obj.innerHTML = '是';
				$(obj).removeClass('blue');
				$(obj).addClass('red2');
			}
			else
			{
				obj.innerHTML = '否';
				$(obj).removeClass('red2');
				$(obj).addClass('blue');
			}
		}
		else
		{
			alert(content.message);
		}
	});
}

//设置排序
function set_order(word,obj,default_val)
{
	var order = $(obj).val();
	if(isNaN(order))
	{
		alert('排序必须是一个数字');
		$(obj).val(default_val);
	}
	else
	{
		$.getJSON('<?php echo IUrl::creatUrl("/tools/keyword_order");?>',{id:word,order:order},function(content){
			if(content.isError == true)
			{
				alert(content.message);
			}
		});
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