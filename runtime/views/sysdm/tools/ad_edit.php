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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/my97date/wdatepicker.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">工具</a>
		</li>
		<li>
			<a href="#">广告管理</a>
		</li>
		<li class="active">更新广告</li>
	</ul>
</div>

<div class="content">
	<form action='<?php echo IUrl::creatUrl("/tools/ad_edit_act");?>' method='post' name='ad' enctype='multipart/form-data'>
		<input type='hidden' name='id' value='' />
		<table class="table form-table">
			<colgroup>
				<col width="130px" />
				<col />
			</colgroup>
			<tr>
				<th>说明：</th>
				<td>(1)先添加 <广告位> 数据；(2)再添加 <广告> 并且绑定之前添加的 <广告位>，广告数据才可以正常显示 </td>
			</tr>
			<tr>
				<th>广告名称：</th>
				<td>
					<input type='text' class='form-control' name='name' pattern='required' placeholder="填写广告名称" />
				</td>
			</tr>
			<tr>
				<th>广告展示类型：</th>
				<td>
					<label class='radio-inline'><input type='radio' name='type' value='1' checked='checked' onclick='changeType(1);' />图片</label>
					<label class='radio-inline'><input type='radio' name='type' value='2' onclick='changeType(2);' />flash</label>
					<label class='radio-inline'><input type='radio' name='type' value='3' onclick='changeType(3);' />文字</label>
					<label class='radio-inline'><input type='radio' name='type' value='4' onclick='changeType(4);' />代码</label>

					<div id='ad_box' style='margin-top:10px'></div>
				</td>
			</tr>
			<tr>
				<th>广告位：</th>
				<td>
					<select name='position_id' class='form-control' pattern='required'>
						<option value=''>请选择</option>
						<?php foreach($items=Api::run('getAdPositionAll') as $key => $item){?>
						<option value='<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></option>
						<?php }?>
					</select>
					<p class='help-block'>*在选择的广告位置内进行展示（必选）</p>
				</td>
			</tr>
			<tr>
				<th>链接地址：</th>
				<td>
					<input type='text' class='form-control' name='link' empty pattern='url'  />
					<p class='help-block'>点击广告后页面链接的URL地址，为空则不跳转</p>
				</td>
			</tr>
			<tr>
				<th>排序：</th>
				<td>
					<input type='text' class='form-control' name='order' pattern='int'  />
					<p class='help-block'>数字越小，排列越靠前</p>
				</td>
			</tr>

			<tr>
				<th>开始结束时间：</th>
				<td>
					<div class="row">
						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input class="form-control" type="text" name="start_time" onfocus="WdatePicker()" value="" placeholder="开始时间" />
							</div>
						</div>

						<div class="col-xs-3">
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
								<input class="form-control" type="text" name="end_time" onfocus="WdatePicker()" value="" placeholder="结束时间" />
							</div>
						</div>
					</div>
					<p class='help-block'>*广告展示的开始时间和结束时间（必选）</p>
				</td>
			</tr>
			<tr>
				<th>描述：</th>
				<td><textarea class="form-control" rows="3" name='description' alt='请填写文章内容'></textarea></td>
			</tr>
			<tr>
				<th>绑定商品分类：</th>
				<td>
					<!--分类数据显示-->
					<span id="__categoryBox"></span>
					<button class="btn btn-default" type="button" name="_goodsCategoryButton">设置分类</button>
					<?php plugin::trigger('goodsCategoryWidget',array("name" => "goods_cat_id","value" => isset($this->adRow['goods_cat_id']) ? $this->adRow['goods_cat_id'] : ""))?>
					<p class='help-block'> 可选项，与商品分类做关联，与商品分类绑定在一起，动态的展示 </p>
				</td>
			</tr>

			<?php if($this->adRow && $this->adRow['position_id']){?>
			<?php $positionRow = Api::run('getAdPositionRowById',array('id'=>$this->adRow['position_id']))?>
			<tr>
				<th>代码：</th>
				<td style="font-weight:bold;color:#000;font-size:14px;">
					将以下代码Copy到你想要放置广告的任何模板中。 <a href="http://www.aircheng.com/movie" target="_blank">如何添加广告？</a><br />
					<code style="font-weight:normal;font-family:'Courier New';font-size:16px;display:block;background:#333;color:#fff;padding:10px;">
						<?php if(isset($this->adRow['goods_cat_id']) && $this->adRow['goods_cat_id']){?>
						<?php echo chr(123);?>echo:Ad::show("<?php echo isset($positionRow['name'])?$positionRow['name']:"";?>",绑定的商品分类ID)<?php echo chr(125);?>
						<?php }else{?>
						<?php echo chr(123);?>echo:Ad::show("<?php echo isset($positionRow['name'])?$positionRow['name']:"";?>")<?php echo chr(125);?>
						<?php }?>
					</code>
				</td>
			</tr>
			<?php }?>

			<tr>
				<th></th><td><button class='btn btn-primary' type='submit'>确定</button></td>
			</tr>
		</table>
	</form>
</div>

<!--广告内容模板-->
<script id="adTemplate" type="text/html">
<%if(newType == "1"){%>
	<input type="file" name="img" class="file" />
	<%if(newType == defaultType){%>
		<p><img src="<%=webroot(content)%>" width="150px" /></p>
		<input type="hidden" name="content" value="<%=content%>" />
	<%}%>
<%}else if(newType == "2"){%>
	<input type="file" name="flash" class="file" />
	<%if(newType == defaultType){%>
		<embed src="<%=webroot(content)%>" width="150px" type="application/x-shockwave-flash"></embed>
		<input type="hidden" name="content" value="<%=content%>" />
	<%}%>
<%}else if(newType == "3"){%>
	<input type="text" class="form-control" name="content" value="<%=content%>" />
<%}else{%>
	<textarea class="form-control" rows="3" name='content'><%=content%></textarea>
<%}%>
</script>

<script type='text/javascript'>
//广告数据
defaultAdRow = <?php echo JSON::encode($this->adRow);?>;

//切换广告类型 1:图片; 2:flash; 3:文字; 4:代码;
function changeType(typeVal)
{
	var content = (defaultAdRow && typeVal == defaultAdRow['type']) ? defaultAdRow['content'] : "";
	var defaultType = (defaultAdRow && defaultAdRow['type']) ? defaultAdRow['type'] : "";
	var adHtml = template.render('adTemplate',{'newType':typeVal,'defaultType':defaultType,'content':content});
	$('#ad_box').html(adHtml);
}

//表单回显
var FromObj = new Form('ad');
FromObj.init(defaultAdRow);

jQuery(function()
{
	changeType($("[name='type']:checked").val());
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