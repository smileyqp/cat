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
		<h3 class="tabs_involved">共享商品列表</h3>
		<ul class="tabs">
			<li><input type="button" class="alt_btn" onclick="filterResult();" value="检索" /></li>
			<li><input type="button" class="alt_btn" onclick="selectAll('id[]');" value="全选" /></li>
			<li><input type="button" class="alt_btn" onclick="copyGoods();" value="复制商品" title="复制后可以销售此商品" /></li>
		</ul>
	</header>

	<form action="<?php echo IUrl::creatUrl("/seller/goods_copy");?>" method="post" name="goodsForm">
		<table class="tablesorter" cellspacing="0">
			<colgroup>
				<col width="25px" />
				<col />
				<col width="250px" />
				<col width="90px" />
				<col width="90px" />
				<col width="90px" />
			</colgroup>

			<thead>
				<tr>
					<th class="header"></th>
					<th class="header">商品名字</th>
					<th class="header">分类</th>
					<th class="header">销售价</th>
					<th class="header">库存</th>
					<th class="header">操作</th>
				</tr>
			</thead>

			<tbody>
                <?php foreach($items=$this->query->find() as $key => $item){?>
				<tr>
					<td><input name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
					<td><img src='<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/100/h/100");?>' class="ico" /><a href="javascript:jumpUrl('<?php echo isset($item['is_del'])?$item['is_del']:"";?>','<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>')" title="<?php echo isset($item['name'])?$item['name']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></a></td>
					<td>
						<?php $catName = array()?>
                        <?php foreach($items=Api::run('getCategoryExtendNameByCategoryid',array('id'=>$item["id"])) as $key => $catData){?>
                        <?php $catName[] = $catData['name']?>
                        <?php }?>
                        <?php echo join(',',$catName);?>
					</td>
					<td><?php echo isset($item['sell_price'])?$item['sell_price']:"";?></td>
					<td><?php echo isset($item['store_nums'])?$item['store_nums']:"";?></td>
					<td>
						<a href="javascript:copyGoods(<?php echo isset($item['id'])?$item['id']:"";?>);"><img src="<?php echo $this->getWebSkinPath()."images/main/icn_new_article.png";?>" title="复制商品" /></a>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</form>
	<?php echo $this->query->getPageBar();?>
</article>

<script type="text/html" id="filterTemplate">
<form action="<?php echo IUrl::creatUrl("/");?>" method="get" name="filterForm">
	<input type='hidden' name='controller' value='seller' />
	<input type='hidden' name='action' value='share_list' />

	<div class="module_content">
		<fieldset>
			<label>商品名称</label>
			<input name="search[go.name=]" value="" type="text" />
		</fieldset>

		<fieldset>
			<label>商品货号</label>
			<input name="search[go.goods_no=]" value="" type="text" />
		</fieldset>

		<fieldset>
			<label>商品分类</label>
			<div class="box">
				<span id="__categoryBox" style="margin-bottom:8px"></span>
				<input type="button" class="alt_btn" name="_goodsCategoryButton" value="设置分类" />
			</div>
		</fieldset>
	</div>
</form>
</script>
<?php plugin::trigger('goodsCategoryWidget',array("name" => "search[ce.category_id=]"))?>

<script type="text/javascript">
//检索商品
function filterResult()
{
	var goodsHeadHtml = template.render('filterTemplate');
	art.dialog(
	{
		"init":function()
		{
			var filterPost = <?php echo JSON::encode(IReq::get('search'));?>;
			var formObj = new Form('filterForm');
			for(var index in filterPost)
			{
				formObj.setValue("search["+index+"]",filterPost[index]);
			}
		},
		"title":"检索条件",
		"content":goodsHeadHtml,
		"okVal":"立即检索",
		"ok":function(iframeWin, topWin)
		{
			iframeWin.document.forms[0].submit();
		}
	});
}

//商品详情的跳转连接
function copyGoods(idVal)
{
	if(!idVal)
	{
		var idString = [];
		$('input:checkbox[name="id[]"]:checked').each(function(i)
		{
			idString.push(this.value);
		});
		idVal = idString.join(',');
	}

	if(idVal)
	{
		$.get("<?php echo IUrl::creatUrl("/seller/goods_copy");?>",{"id":idVal},function(content)
		{
			if(content == 'success')
			{
				window.location.href = "<?php echo IUrl::creatUrl("/seller/goods_list");?>";
			}
			else
			{
				alert(content);
			}
		});
	}
	else
	{
		alert("请选择您要操作的商品");
	}
}

//商品详情的跳转连接
function jumpUrl(is_del,url)
{
	is_del == 0 ? window.open(url) : alert("该商品没有上架无法查看");
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