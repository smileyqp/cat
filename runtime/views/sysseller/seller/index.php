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
		<?php $countData = statistics::sellerAmount($this->seller['seller_id']);?>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/echarts/echarts.simple.min.js"></script>

<article class="module width_full">
	<header><h3>概要信息</h3></header>
	<div class="module_content">
		<table class="tablesorter" cellspacing="0">
			<thead></thead>
			<tbody>
				<tr>
					<td>商品总数量：<a href="<?php echo IUrl::creatUrl("/seller/goods_list");?>"><?php echo Api::run('goodsCount');?> 件</a></td>
					<td>待回复咨询：<a href="<?php echo IUrl::creatUrl("/seller/refer_list");?>"><?php echo Api::run('referWaitCount');?> 条</a></td>
					<td>商品评论数：<a href="<?php echo IUrl::creatUrl("/seller/comment_list");?>"><?php echo Api::run('commentCount');?> 条</a></td>
					<td>退款申请：<a href="<?php echo IUrl::creatUrl("/seller/refundment_list");?>"><?php echo Api::run('refundsCount');?> 条</a></td>
					<td>总销售量：<?php echo statistics::sellCountSeller($this->seller['seller_id']);?> 件</td>
					<td>信用评分：<?php echo statistics::gradeSeller($this->seller['seller_id']);?> 分</td>
				</tr>
			</tbody>
		</table>
	</div>
</article>

<article class="module width_full">
	<header><h3>销售统计</h3></header>
	<div class="module_content">
		<div id="myChart" style="width:100%;min-height:320px;"></div>
	</div>
</article>

<script type='text/javascript'>
//图表生成
$(function()
{
	//图标模板
	var option = {
		title:
		{
			text:'销售统计'
		},
		xAxis:
		{
			name:'时间',
			data:<?php echo JSON::encode(array_keys($countData));?>,
		},
		yAxis:
		{
			name:'销售额(元)'
		},
		series:
		[
			{
				name:'销售额',
				type: 'line',
				data:<?php echo JSON::encode(array_values($countData));?>
			}
		],
		tooltip:
		{
			show:true
		}
	};
	echarts.init(document.getElementById('myChart')).setOption(option);
})
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