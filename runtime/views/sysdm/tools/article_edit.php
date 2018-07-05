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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/php/newshop04/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/php/newshop04/index.php?controller=pic&action=file_manager_json";</script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">工具</a>
		</li>
		<li>
			<a href="#">文章管理</a>
		</li>
		<li class="active">编辑文章</li>
	</ul>
</div>

<div class="content">
	<form action='<?php echo IUrl::creatUrl("/tools/article_edit_act");?>' method='post' name='article'>
		<input type='hidden' name='id' value="" />
		<table class="table form-table">
			<colgroup>
				<col width="130px" />
				<col />
			</colgroup>
			<tr>
				<th>分类：</th>
				<td>
					<select class="form-control w-auto" name="category_id" pattern="required" alt="请选择分类值">
						<option value=''>选择文章分类</option>
						<?php foreach($items=Api::run('getArticleCategoryListAll') as $key => $item){?>
						<option value='<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo str_repeat('&nbsp;&nbsp;&nbsp;',substr_count($item['path'],',')-2);?><?php echo isset($item['name'])?$item['name']:"";?></option>
						<?php }?>
					</select>
					<a href="<?php echo IUrl::creatUrl("/tools/article_cat_edit");?>">添加文章分类</a>
					<p class="help-block">*选择文章所属分类（必填）</p>
				</td>
			</tr>
			<tr>
				<th>标题：</th>
				<td><input type='text' name='title' class='form-control' value='' pattern='required' placeholder='标题不能为空' /></td>
			</tr>
			<tr>
				<th>是否发布：</th>
				<td>
					<label class='radio-inline'><input type='radio' name='visibility' value='1' checked=checked />是</label>
					<label class='radio-inline'><input type='radio' name='visibility' value='0' />否</label>
				</td>
			</tr>
			<tr>
				<th>首页推荐：</th>
				<td>
					<label class='radio-inline'><input type='radio' name='top' value='1' checked=checked />是</label>
					<label class='radio-inline'><input type='radio' name='top' value='0' />否</label>
				</td>
			</tr>
			<tr>
				<th>标题字体：</th>
				<td>
					<label class='radio-inline'><input type='radio' name='style' value='0' checked=checked />正常</label>
					<label class='radio-inline'><input type='radio' name='style' value='1' /><b>粗体</b></label>
					<label class='radio-inline'><input type='radio' name='style' value='2' /><span style="font-style:oblique;">斜体</span></label>
				</td>
			</tr>
			<tr>
				<th>标题颜色：</th>
				<td>
					<?php $color = ($this->articleRow['color']) ? $this->articleRow['color'] : '#000000'?>
					<input type='hidden' name='color' value='' />
					<a style='color:<?php echo isset($color)?$color:"";?>;background-color:<?php echo isset($color)?$color:"";?>;' href='javascript:showColorBox();' id='titleColor'><?php echo isset($color)?$color:"";?></a>
					<div id='colorBox' style='display:none'></div>
				</td>
			</tr>
			<tr>
				<th>排序：</th>
				<td><input type='text' class='form-control' name='sort' value='' /></td>
			</tr>
			<tr>
				<th>关联相关商品：</th>
				<td>
					<table class='table list-table table-bordered text-center' style='width:650px'>
						<colgroup>
							<col />
							<col width="120px" />
						</colgroup>
						<thead>
							<tr><td>商品名称</td><td>操作</td></tr>
						</thead>
						<tbody id="goodsListBox"></tbody>
					</table>
					<button class='btn btn-default' type='button' onclick='searchGoods({"type":"checkbox","callback":searchGoodsCallback});'>选择商品</button>
					<p class="help-block">文章所要关联的商品（可选）</p>
				</td>
			</tr>

			<tr>
				<th>内容：</th><td><textarea id="content" name='content' style='width:100%;height:350px' pattern='required' alt='内容不能为空'><?php echo htmlspecialchars($this->articleRow['content']);?></textarea></td>
			</tr>
			<tr>
				<th>关键词(SEO)：</th><td><input type='text' class='form-control' name='keywords' value='' /></td>
			</tr>
			<tr>
				<th>描述简要(SEO)：</th><td><input type='text' class='form-control' name='description' value='' /></td>
			</tr>
			<tr>
				<th></th><td><button class='btn btn-primary' type='submit'>确定</button></td>
			</tr>
		</table>
	</form>
</div>

<!--商品模板-->
<script type="text/html" id="goodsItemTemplate">
<tr>
	<td>
		<input type='hidden' name='goods_id[]' value='<%=templateData['goods_id']%>' />
		<img src="<%=webroot(templateData['img'])%>" style="width:80px;" />
		<%=templateData['name']%>
	</td>
	<td><a href="javascript:void(0)" onclick="$(this).parent().parent().remove();"><i class='operator fa fa-close'></i></a></td>
</tr>
</script>

<script type='text/javascript'>
jQuery(function(){
	//调色板颜色
	var colorBox = new Array('#000','#930','#330','#030','#036','#930','#000080','#339','#333','#800000','#f60','#808000','#808080','#008080','#00f','#669','#f00','#f90','#9c0','#396','#3cc','#36f','#800080','#999','#f0f','#fc0','#ff0','#0f0','#0ff','#0cf','#936','#c0c0c0','#f9c','#fc9','#ff9','#cfc','#cff','#9cf','#c9f','#fff');
	for(color in colorBox)
	{
		var aHTML = '<a href="javascript:void(0)" onclick="changeColor(this);" style="display:inline-block;width:60px;background-color:'+colorBox[color]+';color:'+colorBox[color]+'">'+colorBox[color]+'</a> ';
		$('#colorBox').html($('#colorBox').html() + aHTML);
	}

	var FromObj = new Form('article');
	FromObj.init(<?php echo JSON::encode($this->articleRow);?>);

	KindEditor.ready(function(K){
		K.create('#content');
	});

	<?php if($this->articleRow){?>
	<?php $goodsList = Api::run("getArticleGoods",array("#article_id#",$this->articleRow['id']))?>
	createGoodsList(<?php echo JSON::encode($goodsList);?>);
	<?php }?>
});

//弹出调色板
function showColorBox()
{
	var layer = document.createElement('div');
	layer.className = "poplayer";
	$(document.body).append(layer);
	var poplay = $('#colorBox');
	$('.poplayer').bind("click",function(){if(poplay.css('display')=='block') poplay.fadeOut();$("div").remove('.poplayer');})
	poplay.fadeIn();
}

//选择颜色
function changeColor(obj)
{
	var color = $(obj).html();
	$('#titleColor').css({color:color,'background-color':color});
	$('input[type=hidden][name="color"]').val(color);
	$('#colorBox').fadeOut();
	$("div").remove('.poplayer');
}

//输入筛选商品的条件
function searchGoodsCallback(goodsList)
{
	var result = [];
	goodsList.each(function()
	{
		var temp = $.parseJSON($(this).attr('data'));
		result.push(temp);
	});
	createGoodsList(result);
}

//创建商品数据
function createGoodsList(goodsList)
{
	for(var i in goodsList)
	{
		var templateHTML = template.render('goodsItemTemplate',{"templateData":goodsList[i]});
		$('#goodsListBox').append(templateHTML);
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