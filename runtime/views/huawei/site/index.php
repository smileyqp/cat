<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->_siteConfig->name;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/php/newshop03/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop03/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<!--[if IE]><script src="<?php echo $this->getWebViewPath()."javascript/html5.js";?>"></script><![endif]-->
	<script src='<?php echo $this->getWebViewPath()."javascript/site.js";?>'></script>
	<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>'></script>
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."style/style.css";?>">
</head>
<body>
<!--

模版使用字体图标为优化过的 awesome 3.0 图标字体库

使用帮助见:http://www.bootcss.com/p/font-awesome/

 -->
<!-- 顶部工具栏 -->
<div class="header_top">
	<div class="web">
		<div class="welcome">
			欢迎您来到 <?php echo $this->_siteConfig->name;?>！
		</div>
		<ul class="top_tool">
			<li><?php plugin::trigger('siteTopMenu')?></li>
			<li><a href="<?php echo IUrl::creatUrl("ucenter/index");?>">个人中心</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/simple/seller");?>">申请开店</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/seller/index");?>">商家管理</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
		</ul>
	</div>
</div>
<!-- 顶部工具栏 -->
<header class="header">
	<!-- logo与搜索 -->
	<div class="body_wrapper">
		<div class="web">
			<!-- logo -->
			<div class="logo_layer">
				<a title="<?php echo $this->_siteConfig->name;?>" href="<?php echo IUrl::creatUrl("");?>" class="logo">
					<img src="<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."image/logo.png";?><?php }?>">
				</a>
			</div>
			<!-- 注册与登录 -->
			<div class="body_toolbar">
				<?php if($this->user){?>
					<div class="body_toolbar_btn userinfo">
						<a href="<?php echo IUrl::creatUrl("/ucenter/index");?>"><?php echo isset($this->user['username'])?$this->user['username']:"";?></a>
						<i></i>
					</div>
					<div class="body_toolbar_layer">
						<div class="toolbar_layer_info">
							<a class="info_photo" href="<?php echo IUrl::creatUrl("/ucenter/index");?>">
								<img id="user_ico_img" src="<?php echo IUrl::creatUrl("".$this->user['head_ico']."");?>" onerror="this.src='<?php echo $this->getWebSkinPath()."image/user_ico.gif";?>'">
							</a>
							<div>
								<a href="<?php echo IUrl::creatUrl("/ucenter/index");?>"><?php echo isset($this->user['username'])?$this->user['username']:"";?> <i class="fa fa-user-md"></i></a>
								<span><?php echo ISafe::get('last_login');?></span>
							</div>
						</div>
						<div class="myorder">
							<dl class="clearfix">
								<dt>
									<span class="fl">我的订单</span>
									<a class="fr" href="<?php echo IUrl::creatUrl("/ucenter/index");?>">更多&gt;</a>
								</dt>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/integral");?>">我的积分</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/account_log");?>">账户余额</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/evaluation");?>">待评价</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/refunds");?>">退换货</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/consult");?>">商品咨询</a></dd>
							</dl>
						</div>
						<div class="myshop"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的商城</a></div>
						<div class="logout"><a href="<?php echo IUrl::creatUrl("/simple/logout");?>">退出登录</a></div>
					</div>
				<?php }else{?>
					<div class="body_toolbar_btn login_reg">
						<a href="<?php echo IUrl::creatUrl("/simple/login");?>">登录</a>
						<em> | </em>
						<a class="reg" href="<?php echo IUrl::creatUrl("/simple/reg");?>">注册</a>
					</div>
				<?php }?>
			</div>
			<!-- 注册与登录 -->
			<!--购物车模板 开始-->
			<div class="header_cart" name="mycart">
				<a href="<?php echo IUrl::creatUrl("/simple/cart");?>" class="go_cart">
					<i class="fa fa-shopping-cart"></i>
					<em class="sign_total" name="mycart_count"]>0</em>
				</a>
				<div class="cart_simple" id="div_mycart"></div>
			</div>
			<script type='text/html' id='cartTemplete'>
			<div class='cart_panel'>
				<%if(goodsCount){%>
					<!-- 购物车物品列表 -->
					<ul class='cart_list'>
						<%for(var item in goodsData){%>
						<%var data = goodsData[item]%>
						<li id="site_cart_dd_<%=item%>">
							<em><%=(window().parseInt(item)+1)%></em>
							<a target="_blank" href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>">
								<img src="<%=webroot(data['img'])%>">
							</a>
							<a class="shop_name" target="_blank" href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>"><%=data['name']%></a>
							<!-- <p class="shop_class"></p> -->
							<div class="shop_price"><p>￥ <%=data['sell_price']%> <span>x <%=data['count']%></span></p></div>
							<i class="fa fa-remove" onclick="removeCart('<%=data['id']%>','<%=data['type']%>');$('#site_cart_dd_<%=item%>').hide('slow');"></i>
						</li>
						<%}%>
					</ul>
					<!-- 购物车物品列表 -->
					<!-- 购物车物品统计 -->
					<div class="cart_total">
						<p>
							共<span name="mycart_count"><%=goodsCount%></span>件
							总额：<em name="mycart_sum">￥<%=goodsSum%></em>
						</p>
						<a href="<?php echo IUrl::creatUrl("simple/cart");?>">结算</a>
					</div>
					<!-- 购物车物品统计 -->
				<%}else{%>
					<!-- 购物车无内容 -->
					<div class='cart_no'>购物车空空如也~</div>
				<%}%>
			</div>
			</script>
			<!--购物车模板 结束-->
			<!-- 搜索框 -->
			<div class="search_box">
					<!-- 搜索内容 -->
				<form method='get' action='<?php echo IUrl::creatUrl("/");?>'>
					<input type='hidden' name='controller' value='site'>
					<input type='hidden' name='action' value='search_list'>
					<div class="search">
						<input type="text" name='word' class="search_keyword" autocomplete="off">
						<button class="search_submit" type="submit">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				<!-- 热门搜索 -->
				<div class="search_hotwords">
					<?php foreach($items=Api::run('getKeywordList',2) as $key => $item){?>
					<?php $tmpWord = urlencode($item['word']);?>
					<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>"><?php echo isset($item['word'])?$item['word']:"";?></a>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
		<!-- logo与搜索 -->

	<div class="nav_bar">
		<div class="home_nav_bar user_center">
		<!-- 导航栏 -->
		<div class="web">
			<!-- 分类列表 -->
			<div class="category_list">
				<!-- 全部商品 -->
				<a class="all_goods_sort" href="" target="_blank">
					<h3 class="all">全部商品</h3>
				</a>
				<!-- 全部商品 -->
				<!-- 分类列表-详情 -->
				<ul class="cat_list none">
					<?php foreach($items=Api::run('getCategoryListTop', 6) as $key => $first){?>
					<li>
						<!-- 分类列表-导航模块 -->
						<div class="cat_nav">
							<h3><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>"><?php echo isset($first['name'])?$first['name']:"";?></a></h3>
							<?php foreach($items=Api::run('getCategoryByParentid',array('#parent_id#',$first['id']), 3) as $key => $second){?>
							<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a>
							<?php }?>
							<i class="fa fa-angle-right"></i>
						</div>
						<!-- 分类列表-导航模块 -->
						<!-- 分类列表-导航内容模块 -->
						<div class="cat_more">
							<h3>
								<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>">
									<span><?php echo isset($first['name'])?$first['name']:"";?></span>
									<i class="fa fa-angle-right"></i>
								</a>
							</h3>
							<ul class="cat_nav_list">
								<?php foreach($items=Api::run('getCategoryByParentid',array('#parent_id#',$first['id']), 6) as $key => $second){?>
								<li><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a></li>
								<?php }?>
							</ul>
							<ul class="cat_content_list">
								<?php foreach($items=Api::run('getCategoryExtendList',array('#categroy_id#',$first['id']),4) as $key => $item){?>
								<li>
									<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank" title="<?php echo isset($item['name'])?$item['name']:"";?>">
										<img class="img-lazyload" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/118/h/118");?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>">
										<h3><?php echo isset($item['name'])?$item['name']:"";?></h3>
										<p class="price">￥ <?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
									</a>
								</li>
								<?php }?>
							</ul>
						</div>
						<!-- 分类列表-导航内容模块 -->
					</li>
					<?php }?>
				</ul>
				<!-- 分类列表-详情 -->
			</div>
			<!-- 分类列表 -->
			<!-- 导航索引 -->
			<div class="nav_index">
				<ul class="nav">
					<li class="user_nav_index home_nav_index"><a href="<?php echo IUrl::creatUrl("/site/index");?>"><span>首 页</span></a></li>
					<?php foreach($items=Api::run('getGuideList') as $key => $item){?>
					<li class="user_nav_index home_nav_index"><a href="<?php echo IUrl::creatUrl("".$item['link']."");?>"><span><?php echo isset($item['name'])?$item['name']:"";?></span></a></li>
					<?php }?>
				</ul>
			</div>
		</div>
		</div>
	</div>
</header>

<!--主要模板内容 开始-->
<div class="home_content">
<!-- 焦点图和选项卡插件 -->
<script src="<?php echo $this->getWebViewPath()."javascript/FengFocus.js";?>"></script>
<script src="<?php echo $this->getWebViewPath()."javascript/FengTab.js";?>"></script>
<script src="<?php echo $this->getWebViewPath()."javascript/jquery.marquee.js";?>"></script>

<!-- banner -->
<section id="home_fouse" class="home_fouse">
	<?php if($this->index_slide){?>
	<ul>
		<?php foreach($items=$this->index_slide as $key => $item){?>
		<li><a href="<?php echo IUrl::creatUrl("".$item['url']."");?>"><img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."");?>" /></a></li>
		<?php }?>
	</ul>
	<?php }?>
</section>
<!-- banner -->

<!-- 商城公告和新闻动态 -->
<div class="home_feature">
	<div class="feature_content">
		<h4>
			<a href="<?php echo IUrl::creatUrl("/site/notice");?>">公 告</a>
		</h4>
		<div class="feature_title">
			<?php foreach($items=Api::run('getAnnouncementList', 3) as $key => $item){?>
			<a href="<?php echo IUrl::creatUrl("/site/notice_detail/id/".$item['id']."");?>"><?php echo isset($item['title'])?$item['title']:"";?></a>
			<?php }?>
		</div>
	</div>
	<!--自定义您的首页快速连接菜单-->
	<ul class="feature_list">
		<li><a href="<?php echo IUrl::creatUrl("/site/sitemap");?>"><i class="fa fa-sitemap"></i></a></li>
		<li><a href="<?php echo IUrl::creatUrl("/site/seller");?>"><i class="fa fa-users"></i></a></li>
		<li><a href="<?php echo IUrl::creatUrl("/site/brand");?>"><i class="fa fa-star"></i></a></li>
		<li><a href="<?php echo IUrl::creatUrl("/site/sale");?>"><i class="fa fa-clock-o"></i></a></li>
		<li><a href="<?php echo IUrl::creatUrl("/site/help_list");?>"><i class="fa fa-question-circle"></i></a></li>
		<li><a href="<?php echo IUrl::creatUrl("/site/tags");?>"><i class="fa fa-tags"></i></a></li>
	</ul>
	<div class="feature_content">
		<h4>
			<a href="<?php echo IUrl::creatUrl("/site/article");?>">资 讯</a>
		</h4>
		<div class="feature_title">
			<?php foreach($items=Api::run('getArtList', 3) as $key => $item){?>
			<a href="<?php echo IUrl::creatUrl("/site/article_detail/id/".$item['id']."");?>"><?php echo isset($item['title'])?$item['title']:"";?></a>
			<?php }?>
		</div>
	</div>
</div>
<!-- 商城公告和新闻动态 -->

<!-- 广告位 -->
<section class="home_focus_show">
	<div class="show_list"><?php echo Ad::show("首页焦点图下广告0_291*160(huawei)");?></div>
	<div class="show_list"><?php echo Ad::show("首页焦点图下广告1_291*160(huawei)");?></div>
	<div class="show_list"><?php echo Ad::show("首页焦点图下广告2_291*160(huawei)");?></div>
	<div class="show_list"><?php echo Ad::show("首页焦点图下广告3_291*160(huawei)");?></div>
</section>
<!-- 广告位 -->

<!--热卖商品-->
<section class="hotsale">
	<header class="home_layer_title">
		<h3>热销单品</h3>
	</header>
	<div class="container">
		<div class="hot_banner"><?php echo Ad::show("热销单品广告1_232*590(huawei)");?></div>
		<div class="index_card_container">
			<?php foreach($items=Api::run('getCommendHot',8) as $key => $item){?>
				<a class="home_pul_box_shadow" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>">
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/134/h/134");?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>" />
					<h3 class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></h3>
					<del>￥<?php echo isset($item['market_price'])?$item['market_price']:"";?></del>
					<p class="pro_price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
				</a>
			<?php }?>
		</div>
	</div>
</section>
<!--热卖商品-->

<!-- 主页活动section：recommend-推荐商品、group_buy-团购商品、panic_buy限时抢购 -->

<!-- 推荐商品 -->
<section class="home_activity recommend">
	<header class="home_layer_title">
		<h3>推荐商品</h3>
	</header>
	<!-- 推荐商品的前进和后退，这里只有需要滚动的有 -->
	<div class="control">
		<i id="home_rec_left" class="fa fa-angle-left"></i>
		<i id="home_rec_right" class="fa fa-angle-right"></i>
	</div>
	<!-- 推荐商品的前进和后退，这里只有需要滚动的有 -->
	<div id="home_rec" class="act_content">
		<ul>
			<?php foreach($items=Api::run('getCommendRecom',10) as $key => $item){?>
			<li>
				<a class="home_pul_box_shadow" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>">
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
					<h3 class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></h3>
					<del>￥<?php echo isset($item['market_price'])?$item['market_price']:"";?></del>
					<p class="pro_price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</section>
<!-- 推荐商品 -->
<!-- 主页活动section：recommend-推荐商品、group_buy-团购商品、panic_buy限时抢购 -->

<!-- 主页活动section：recommend-推荐商品、group_buy-团购商品、panic_buy限时抢购 -->
<!-- 团购商品 -->
<?php $tuanitems=Api::run('getRegimentList',5)?>
<?php if($tuanitems){?>
<section class="home_activity group_buy">
	<header class="home_layer_title">
		<h3>团购商品</h3>
		<nav class="floor_nav">
		</nav>
		<a class="more" href="<?php echo IUrl::creatUrl("/site/groupon");?>">更多></a>
	</header>
	<div class="act_content">
		<ul>
			<?php foreach($items=$tuanitems as $key => $item){?>
			<?php $tmpPId=$item['id'];?>
			<?php $tmpGoodsId=$item['goods_id'];?>
			<li>
				<a href="<?php echo IUrl::creatUrl("/site/products/id/".$tmpGoodsId."/promo/groupon/active_id/".$tmpPId."");?>">
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
					<h3 class="pro_title"><?php echo isset($item['title'])?$item['title']:"";?></h3>
					<p class="pro_price">￥<?php echo isset($item['regiment_price'])?$item['regiment_price']:"";?></p>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</section>
<?php }?>
<!-- 团购商品 -->

<!-- 限时抢购 -->
<?php $panicbuying=Api::run('getPromotionList', 10);?>
<?php if($panicbuying){?>
<section class="home_activity panic_buy">
	<header class="home_layer_title">
		<h3>限时抢购</h3>
	</header>
	<!-- 推荐商品的前进和后退，这里只有需要滚动的有 -->
	<div class="control">
		<i id="home_panic_left" class="fa fa-angle-left"></i>
		<i id="home_panic_right" class="fa fa-angle-right"></i>
	</div>
	<!-- 推荐商品的前进和后退，这里只有需要滚动的有 -->
	<div id="home_panic" class="act_content">
		<ul>
			<?php foreach($items=$panicbuying as $key => $item){?>
			<?php $free_time = ITime::getDiffSec($item['end_time'])?>
			<?php $countNumsItem[] = $item['p_id'];?>
			<li>
				<!-- 限时抢购-倒计时 -->
				<div class="times">
					<span>倒计时：</span>
					<em id="cd_hour_<?php echo isset($item['p_id'])?$item['p_id']:"";?>"><?php echo floor($free_time/3600);?></em> 时
					<em id='cd_minute_<?php echo isset($item['p_id'])?$item['p_id']:"";?>'><?php echo floor(($free_time%3600)/60);?></em> 分
					<i id='cd_second_<?php echo isset($item['p_id'])?$item['p_id']:"";?>'><?php echo $free_time%60;?></i> 秒
				</div>
				<!-- 限时抢购-倒计时 -->
				<a title="<?php echo isset($item['name'])?$item['name']:"";?>" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."/promo/time/active_id/".$item['p_id']."");?>">
					<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
					<h3 class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></h3>
					<p class="pro_price">￥<?php echo isset($item['award_value'])?$item['award_value']:"";?></p>
				</a>
			</li>
			<?php }?>
		</ul>
	</div>
</section>
<?php }?>
<!-- 限时抢购 -->

<!-- 主页活动section：recommend-推荐商品、group_buy-团购商品、panic_buy限时抢购 -->

<!-- 广告位 -->
<section class="home_focus_show">
	<div class="banner_wrapper"><?php echo Ad::show("首页限时抢购下面广告1200*120(huewei)");?></div>
</section>
<!-- 广告位 -->
<!--积分兑换-->
<?php if($pointData = Api::run('getCostPointList',5)){?>
<section class="home_floor">
	<header class="home_layer_title">
		<h3>积分兑换</h3>
		<nav class="floor_nav"></nav>
		<a class="more" href="<?php echo IUrl::creatUrl("/site/costpoint");?>">更多></a>
	</header>
	<section class="floor_body">
		<div class="floor_goods">
			<ul class="costpoint">
				<?php foreach($items=$pointData as $key => $item){?>
				<li>
					<a class="home_pul_box_shadow" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."/promo/costpoint/active_id/".$item['id']."");?>">
						<img class="floor_goods_img" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
						<h3 class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></h3>
						<del>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></del>
						<p class="pro_price"><?php echo isset($item['point'])?$item['point']:"";?>积分</p>
					</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</section>
</section>
<?php }?>
<!--积分兑换-->
<!-- 开始首页分类 -->
<?php foreach($items=Api::run('getCategoryListTop') as $key => $first){?>
<section class="home_floor">
	<header class="home_layer_title">
		<h3><?php echo isset($first['name'])?$first['name']:"";?></h3>
		<nav class="floor_nav">
			<ul>
				<?php foreach($items=Api::run('getCategoryByParentid',array('#parent_id#',$first['id'])) as $key => $second){?>
				<li><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a></li>
				<?php }?>
			</ul>
		</nav>
		<a class="more" href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>">更多></a>
	</header>
	<section class="floor_body">
		<div class="floor_goods">
			<ul>
				<li class="floor_show">
					<a class="home_pul_box_shadow">
						<?php echo Ad::show("首页分类广告291*346(huawei)", $first['id']);?>
					</a>
				</li>
				<?php foreach($items=Api::run('getCategoryExtendList',array('#categroy_id#',$first['id']), 7) as $key => $item){?>
				<li>
					<a class="home_pul_box_shadow" href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>">
						<img class="floor_goods_img" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>">
						<h3 class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></h3>
						<del>￥<?php echo isset($item['market_price'])?$item['market_price']:"";?></del>
						<p class="pro_price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
					</a>
				</li>
				<?php }?>
			</ul>
		</div>
	</section>
</section>
<?php }?>

<!-- 广告位 -->
<section class="home_focus_show">
	<div class="banner_wrapper"><?php echo Ad::show("首页底部广告1200*120(huewei)");?></div>
</section>
<!-- 广告位 -->

<script>
//dom载入完毕执行
$(function(){
	// 调用焦点图
	$("#home_fouse").FengFocus({trigger : "mouseover"});
	$('#home_rec').kxbdSuperMarquee({
		distance: 218,
		time: 500,
		btnGo: {left:'#home_rec_left',right:'#home_rec_right'},
		direction: 'left'
	});
	// 调用焦点图
	$('#home_panic').kxbdSuperMarquee({
		distance: 1200,
		time: 500,
		btnGo: {left:'#home_panic_left',right:'#home_panic_right'},
		direction: 'left'
	});
	//显示抢购倒计时
	var cd_timer = new countdown();
	<?php if(isset($countNumsItem) && $countNumsItem){?>
	<?php foreach($items=$countNumsItem as $key => $item){?>
		cd_timer.add(<?php echo isset($item)?$item:"";?>);
	<?php }?>
	<?php }?>
});
</script>

</div>
<!--主要模板内容 结束-->

<footer class="foot">
	<section class="service">
		<ul>
			<li class="item1">
				<i class="fa fa-star"></i>
				<strong>正品优选</strong>
			</li>
			<li class="item2">
				<i class="fa fa-globe"></i>
				<strong>上市公司</strong>
			</li>
			<li class="item3">
				<i class="fa fa-inbox"></i>
				<strong>300家连锁门店</strong>
			</li>
			<li class="item4">
				<i class="fa fa-map-marker"></i>
				<strong>上百家维修网点 全国联保</strong>
			</li>
		</ul>
	</section>
	<section class="help">
		<div class="prompt_link">
			<?php $catIco = array('help-new','help-delivery','help-pay','help-user','help-service')?>
			<?php foreach($items=Api::run('getHelpCategoryFoot') as $key => $helpCat){?>
			<dl class="help_<?php echo $key+1;?>">
				<dt>
					<p class="line"></p>
					<p class="title"><a href="<?php echo IUrl::creatUrl("/site/help_list/id/".$helpCat['id']."");?>"><?php echo isset($helpCat['name'])?$helpCat['name']:"";?></a></p>
				</dt>
				<?php foreach($items=Api::run('getHelpListByCatidAll',array('#cat_id#',$helpCat['id'])) as $key => $item){?>
				<dd><a href="<?php echo IUrl::creatUrl("/site/help/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dd>
				<?php }?>
			</dl>
			<?php }?>
		</div>
		<div class="contact">
			<p class="line"></p>
			<em>400-888-8888</em>
			<span>24小时在线客服(仅收市话费)</span>
			<a href="#"><i class="fa fa-comments"></i> 在线客服</a>
		</div>
	</section>
	<section class="copy">
		<?php echo IFilter::stripSlash($this->_siteConfig->site_footer_code);?>
	</section>
</footer>

</body>
</html>
<script>
//当首页时显示分类
<?php if(IWeb::$app->getController()->getId() == 'site' && IWeb::$app->getController()->getAction()->getId() == 'index'){?>
$('.cat_list').removeClass('none');
<?php }?>

$(function(){
	$('input:text[name="word"]').val("<?php echo $this->word;?>");
});
</script>
