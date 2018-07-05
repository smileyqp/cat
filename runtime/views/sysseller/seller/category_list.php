<?php $seller_id = $this->seller['seller_id'];$seller_name = $this->seller['seller_name'];?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>商家管理后台</title>
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/autovalidate/style.css" />
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/html5.js";?>"></script>
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/ie.css";?>" type="text/css" media="screen" />
	<![endif]-->
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" type="text/css" media="screen" />
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>

<body>
	<!--头部 开始-->
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="<?php echo IUrl::creatUrl("/seller/index");?>"><img src="<?php echo $this->getWebSkinPath()."images/main/logo.png";?>" /></a></h1>
			<h2 class="section_title"></h2>
			<div class="btn_view_site"><a href="<?php echo IUrl::creatUrl("");?>" target="_blank">网站首页</a></div>
			<div class="btn_view_site"><a href="<?php echo IUrl::creatUrl("/site/home/id/".$seller_id."");?>" target="_blank">商家主页</a></div>
			<div class="btn_view_site"><a href="<?php echo IUrl::creatUrl("/systemseller/logout");?>">退出登录</a></div>
		</hgroup>
	</header>
	<!--头部 结束-->

	<!--面包屑导航 开始-->
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo isset($seller_name)?$seller_name:"";?></p>
		</div>
	</section>
	<!--面包屑导航 结束-->

	<!--侧边栏菜单 开始-->
	<aside id="sidebar" class="column">
		<?php foreach($items=menuSeller::init() as $key => $item){?>
		<h3><?php echo isset($key)?$key:"";?></h3>
		<ul class="toggle">
			<?php foreach($items=$item as $moreKey => $moreValue){?>
			<li><a href="javascript:void(0)" onclick="<?php if(stripos($moreKey,'/') === 0){?>window.location.href='<?php echo IUrl::creatUrl("".$moreKey."");?>'<?php }else{?><?php echo isset($moreKey)?$moreKey:"";?><?php }?>"><?php echo isset($moreValue)?$moreValue:"";?></a></li>
			<?php }?>
		</ul>
		<?php }?>

		<footer>
			<hr />
			<p><strong>Copyright &copy; 2010-2015 iWebShop</strong></p>
			<p>Powered by <a href="http://www.aircheng.com">iWebShop</a></p>
		</footer>
	</aside>
	<!--侧边栏菜单 结束-->

	<!--主体内容 开始-->
	<section id="main" class="column">
		<article class="module width_full">
	<header>
		<h3 class="tabs_involved">店内分类列表</h3>
		<ul class="tabs">
			<li><input type="button" class="alt_btn" onclick="window.location.href='<?php echo IUrl::creatUrl("/seller/category_edit");?>';" value="添加店内分类" /></li>
			<li><input type="button" class="alt_btn" onclick="selectAll('id[]');" value="全选" /></li>
			<li><input type="button" class="alt_btn" onclick="category_del();" name="_goodsCategoryButton" value="批量移动" /><?php plugin::trigger('goodsCategoryWidget',array("table" => "category_seller","name" => "parent_id","callback" => "setCat"))?></li>
		</ul>
	</header>

	<form action="<?php echo IUrl::creatUrl("/seller/category_sort");?>" method="post" name="goodsForm">
		<table class="tablesorter" cellspacing="0" id="list_table">
			<colgroup>
				<col width="60px" />
				<col width="300px" />
				<col width="100px" />
				<col width="220px" />
			</colgroup>

			<thead>
				<tr>
					<th>选择</th>
					<th>分类名称</th>
					<th>排序</th>
					<th>操作</th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($items=$category as $key => $item){?>
				<tr id="<?php echo isset($item['id'])?$item['id']:"";?>" parent=<?php echo isset($item['parent_id'])?$item['parent_id']:"";?>>
					<td><input type='checkbox' name='cat_id[]' value='<?php echo isset($item['id'])?$item['id']:"";?>' /></td>
					<td><i class="fa fa-folder-open-o" style='margin-left:<?php echo $item['floor']*20;?>px;' onclick="displayData(this);" alt="关闭"></i> <?php echo isset($item['name'])?$item['name']:"";?></td>
					<td><input class="tiny" id="s<?php echo isset($item['id'])?$item['id']:"";?>" size="2" type="text" onblur="toSort(<?php echo isset($item['id'])?$item['id']:"";?>);" value="<?php echo isset($item['sort'])?$item['sort']:"";?>" /></td>
					<td>
						<a href="<?php echo IUrl::creatUrl("/seller/category_edit/pid/".$item['id']."");?>"><i class="fa fa-plus" alt="添加下级分类" title="添加下级分类"></i></a>
						<a href="<?php echo IUrl::creatUrl("/seller/category_edit/cid/".$item['id']."");?>"><i class="fa fa-edit" alt="修改" title="修改"></i></a>
						<a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/seller/category_del/cid/".$item['id']."");?>'})"><i class="fa fa-times" alt="删除" title="删除"></i></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</article>

<script language="javascript">
//折叠展示
function displayData(_self)
{
	if($(_self).attr('alt') == "关闭")
	{
		jqshow($(_self).parent().parent().attr('id'), 'hide');
		$(_self).attr("class","fa fa-folder-o");
		$(_self).attr('alt','打开');
	}
	else
	{
		jqshow($(_self).parent().parent().attr('id'), 'show');
		$(_self).attr("class","fa fa-folder-open-o");
		$(_self).attr('alt','关闭');
	}
}

function jqshow(id,isshow)
{
	var obj = $("#list_table tr[parent='"+id+"']");
	if (obj.length>0)
	{
		obj.each(function(i) {
			jqshow($(this).attr('id'), isshow);
		});
		if (isshow=='hide')
		{
			obj.hide();
		}
		else
		{
			obj.show();
		}
	}
}
//排序
function toSort(id)
{
	if(id!='')
	{
		var va = $('#s'+id).val();
		var part = /^\d+$/i;
		if(va!='' && va!=undefined && part.test(va))
		{
			$.get("<?php echo IUrl::creatUrl("/seller/category_sort");?>",{'id':id,'sort':va}, function(data)
			{
				if(data=='1')
				{
					tips('修改成功');
				}
			});
		}
	}
}
//设置分类
function setCat(catData)
{
	var parent_id = catData == "" ? 0 : catData[0]['id'];
	var cat_id    = [];
	$('[name="cat_id[]"]:checked').each(function(i){
		cat_id.push($(this).val());
	});

	if(cat_id && cat_id.length == 0)
	{
		alert("请选择分类");
		return;
	}

	$.getJSON("<?php echo IUrl::creatUrl("/seller/categoryAjax");?>",{"id":cat_id,"parent_id":parent_id},function(json)
	{
		if(json.result == 'success')
		{
			window.location.reload();
		}
		else
		{
			alert('更新失败，当前分类不能设置到其子分类下');
		}
	});
}
</script>
	</section>
	<!--主题内容 结束-->

	<script type="text/javascript">
	//菜单图片ICO配置
	function menuIco(val)
	{
		var icoConfig = {
			"管理首页" : "icn_tags",
			"销售额统计" : "icn_settings",
			"货款明细列表" : "icn_categories",
			"货款结算申请" : "icn_photo",
			"商品列表" : "icn_categories",
			"添加商品" : "icn_new_article",
			"平台共享商品" : "icn_photo",
			"商品咨询" : "icn_audio",
			"商品评价" : "icn_audio",
			"商品退款" : "icn_audio",
			"规格列表" : "icn_categories",
			"订单列表" : "icn_categories",
			"团购" : "icn_view_users",
			"促销活动列表" : "icn_categories",
			"物流配送" : "icn_folder",
			"发货地址" : "icn_jump_back",
			"资料修改" : "icn_profile",
		};
		return icoConfig[val] ? icoConfig[val] : "icn_categories";
	}

	$(".toggle>li").each(function()
	{
		$(this).addClass(menuIco($(this).text()));
	});
	</script>
</body>
</html>