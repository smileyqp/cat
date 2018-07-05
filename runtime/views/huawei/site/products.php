<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->_siteConfig->name;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
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
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryZoom/jquery.imagezoom.min.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/jqueryZoom/imagezoom.css" />
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquerySlider/jquery.bxslider.min.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/jquerySlider/jquery.bxslider.css" />
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."public/javascript/products.js";?>"></script>
<?php $breadGuide = goods_class::catRecursion($category);?>
<div class="bigweb">
	<section class="breadcrumb">
		<span>您当前的位置：</span> <a href="<?php echo IUrl::creatUrl("");?>">首页</a> >
		<?php foreach($items=$breadGuide as $key => $item){?>
		<a href='<?php echo IUrl::creatUrl("/site/pro_list/cat/".$item['id']."");?>'><?php echo isset($item['name'])?$item['name']:"";?></a> >
		<?php }?>
		<?php echo isset($name)?$name:"";?>
	</section>
	<section class="goods_base">
		<!--图片放大镜-->
		<section class="goods_zoom">
			<div class="pic_show" style="width:435px;height:435px;position:relative;z-index:5;padding-bottom:5px;">
				<img id="picShow" rel="" src="" />
			</div>

			<ul id="goodsPhotoList" class="pic_thumb">
				<?php foreach($items=$photo as $key => $item){?>
				<li>
					<a href="javascript:void(0);" thumbimg="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/435/h/435");?>" sourceimg="<?php echo IUrl::creatUrl("".$item['img']."");?>">
						<img src='<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/60/h/60");?>' width="60px" height="60px" />
					</a>
				</li>
				<?php }?>
			</ul>
		</section>
		<!--图片放大镜-->
		<section class="goods_info">
			<h1 class="goods_info_title"><?php echo isset($name)?$name:"";?></h1>
			<div class="goods_info_num">商品编号：<span id="data_goodsNo"><?php echo $goods_no?$goods_no:$id;?></span></div>
			<!--基本信息区域-->
			<ul class="goods_ul">
				<li>
					<?php if(isset($brand)){?>品牌：<?php echo isset($brand)?$brand:"";?><?php }?>
				</li>

				<!--活动页面-->
				<?php if(isset($activeTemplate)){?>
				<?php require(ITag::createRuntime("$activeTemplate"));?>
				<?php }?>

				<!--普通正常-->
				<?php if($promo == ''){?>
					<?php if($group_price){?>
					<li>会员价：<em class="price">￥<span id="data_groupPrice"><?php echo isset($group_price)?$group_price:"";?></span></em></li>
					<li>原售价：￥<del id="data_sellPrice"><?php echo isset($sell_price)?$sell_price:"";?></del></li>
					<?php }else{?>
					<li>销售价：<em class="price">￥<span id="data_sellPrice"><?php echo isset($sell_price)?$sell_price:"";?></span></em></li>
					<?php }?>
				<?php }?>

				<li>市场价：￥<del id="data_marketPrice"><?php echo isset($market_price)?$market_price:"";?></del></li>

				<li>
					库存：现货 <span id="data_storeNums"><?php echo isset($store_nums)?$store_nums:"";?> </span>
					<span class="favorite" onclick="favorite_add_ajax(<?php echo isset($id)?$id:"";?>,this);">
						<i class="fa fa-heart"></i>
						收藏此商品
					</span>
				</li>

				<li>
					<div class="star_box">
						<strong class="item">顾客评分：</strong>
						<span class="star star_<?php echo Common::gradeWidth($grade,$comments);?>"></span>
						<u>(已有<?php echo isset($comments)?$comments:"";?>人评价)</u>
					</div>
				</li>

				<?php if($point > 0){?>
				<li>送积分：单件送<?php echo isset($point)?$point:"";?>分</li>
				<?php }?>

				<li>
					至
					<a class="sel_area blue" href="javascript:;" name="localArea">当前地区</a>：
					<span id="deliveInfo"></span>
					<div class="area_box">
						<ul>
							<li><a data-code="1" href="#J_PostageTableCont"><strong>全部</strong></a></li>
							<?php foreach($items=Api::run('getAreasListTop') as $key => $item){?>
							<li><a href="javascript:void(0);" name="areaSelectButton" value="<?php echo isset($item['area_id'])?$item['area_id']:"";?>"><?php echo isset($item['area_name'])?$item['area_name']:"";?></a></li>
							<?php }?>
						</ul>
					</div>
				</li>

				<!--商家信息 开始-->
				<?php if(isset($seller)){?>
				<li>商家：<a class="orange" href="<?php echo IUrl::creatUrl("/site/home/id/".$seller_id."");?>"><?php echo isset($seller['true_name'])?$seller['true_name']:"";?></a></li>
				<li>联系电话：<?php echo isset($seller['phone'])?$seller['phone']:"";?></li>
				<li>所在地：<?php echo join(' ',area::name($seller['province'],$seller['city'],$seller['area']));?></li>
				<li><?php plugin::trigger("onServiceButton",$seller['id'])?></li>
				<?php }?>
				<!--商家信息 结束-->
			</ul>
			<!--购买区域-->
			<div class="good_info_buy">
			<?php if($store_nums <= 0){?>
				该商品已售完，不能购买，您可以看看其它商品！(<a href="<?php echo IUrl::creatUrl("/simple/arrival/goods_id/".$id."");?>" class="orange">到货通知</a>)
			<?php }else{?>
				<?php if($spec_array){?>
				<!--商品规格选择 开始-->
				<?php foreach($items=JSON::decode($spec_array) as $key => $item){?>
				<dl>
					<dt><?php echo isset($item['name'])?$item['name']:"";?>：</dt>
					<dd>
						<div class="item">
						<?php foreach($items=$item['value'] as $specValueKey => $spec_value){?>
						<?php list($item['tip'],$item['value'])=[key($spec_value),current($spec_value)]?>
						<?php if($item['type'] == 1){?>
						<!--文字规格 -->
						<span  specId="<?php echo isset($item['id'])?$item['id']:"";?>" id="<?php echo isset($item['id'])?$item['id']:"";?><?php echo isset($specValueKey)?$specValueKey:"";?>" title="<?php echo htmlspecialchars($item['tip']);?>"><?php echo isset($item['value'])?$item['value']:"";?></span>

						<?php }else{?>
						<!--图片规格 -->
						<span  specId="<?php echo isset($item['id'])?$item['id']:"";?>" id="<?php echo isset($item['id'])?$item['id']:"";?><?php echo isset($specValueKey)?$specValueKey:"";?>" title="<?php echo htmlspecialchars($item['tip']);?>">
							<img src="<?php echo IUrl::creatUrl("".$item['value']."");?>">
						</span>
						<?php }?>
						<script>$('#<?php echo isset($item['id'])?$item['id']:"";?><?php echo isset($specValueKey)?$specValueKey:"";?>').data('specData',<?php echo JSON::encode($item);?>);</script>
						<?php }?>
						</div>
					</dd>
				</dl>
				<?php }?>
				<!--商品规格选择 结束-->
				<?php }?>

				<dl>
					<dt>购买数量：</dt>
					<dd>
						<div class="goods_resize">
							<span class="reduce" id="buyReduceButton">─</span>
							<input class="input" type="text" id="buyNums" value="1" maxlength="5" />
							<span class="add" id="buyAddButton">+</span>
						</div>
					</dd>
				</dl>

				<div class="btn_submit_buy" id="buyNowButton">
					<i class="fa fa-shopping-cart"></i>
					<span>立即购买</span>
				</div>
				<div class="btn_add_cart" id="joinCarButton">
					<i class="fa fa-cart-plus"></i>
					<span>加入购物车</span>
				</div>
			<?php }?>
			</div>
		</section>
	</section>

	<section class="web">
		<!-- 产品详情 -->
		<section class="products_main">
			<!-- 详情目录 -->
			<div class="goods_tab" name="showButton">
				<label class="current">商品详情</label>
				<label>顾客评价(<?php echo isset($comments)?$comments:"";?>)</label>
				<label>购买记录(<?php echo isset($buy_num)?$buy_num:"";?>)</label>
				<label>购买前咨询(<?php echo isset($refer)?$refer:"";?>)</label>
				<label>网友讨论圈(<?php echo isset($discussion)?$discussion:"";?>)</label>
			</div>
			<!-- 详情目录 -->
			<div class="goods_con" name="showBox">
				<!-- 商品详情 start -->
				<div>
					<ul class="goods_infos">
						<li>商品名称：<?php echo isset($name)?$name:"";?></li>

						<?php if(isset($brand) && $brand){?>
						<li>品牌：<?php echo isset($brand)?$brand:"";?></li>
						<?php }?>

						<?php if(isset($weight) && $weight){?>
						<li>商品毛重：<label id="data_weight"><?php echo isset($weight)?$weight:"";?></label></li>
						<?php }?>

						<?php if(isset($unit) && $unit){?>
						<li>单位：<?php echo isset($unit)?$unit:"";?></li>
						<?php }?>

						<?php if(isset($up_time) && $up_time){?>
						<li>上架时间：<?php echo isset($up_time)?$up_time:"";?></li>
						<?php }?>

						<?php if(($attribute)){?>
						<?php foreach($items=$attribute as $key => $item){?>
						<li><?php echo isset($item['name'])?$item['name']:"";?>：<?php echo isset($item['attribute_value'])?$item['attribute_value']:"";?></li>
						<?php }?>
						<?php }?>
					</ul>
					<?php if(isset($content) && $content){?>
					<article class="article_content">
						<h3>产品描述：</h3>
						<?php echo isset($content)?$content:"";?>
					</article>
					<?php }?>
				</div>
				<!-- 商品详情 end -->

				<!-- 顾客评论 start -->
				<div class="none comment_list">
					<div id='commentBox'></div>
					<!--评论JS模板-->
					<script type='text/html' id='commentRowTemplate'>
					<div class="comment_item">
						<div class="user">
							<img src="<%=webroot(head_ico)%>" width="70px" height="70px" onerror="this.src='<?php echo $this->getWebSkinPath()."image/user_ico.gif";?>'" />
							<span><%=username%></span>
						</div>
						<div class="desc">
							<time><%=comment_time%></time>
							<div class="star_box">
								<strong class="item">评分：</strong>
								<span class="star star_<%=point%>"></span>
							</div>
							<p class="contents"><strong>评价：</strong><span><%=contents%></span></p>
							<%if(recontents){%>
							<p class="recontents"><strong>回复：</strong><span><%=recontents%></span></p>
							<%}%>
						</div>
					</div>
					</script>
				</div>
				<!-- 顾客评论 end -->

				<!-- 购买记录 start -->
				<div class="none history_list">
					<table>
						<thead>
							<tr>
								<th>购买人</th>
								<th>出价</th>
								<th>数量</th>
								<th>购买时间</th>
								<th>状态</th>
							</tr>
						</thead>
						<tbody class="dashed" id="historyBox"></tbody>
					</table>
					<!--购买历史js模板-->
					<script type='text/html' id='historyRowTemplate'>
					<tr>
						<td><strong><%=username?username:'游客'%></strong></td>
						<td><em><%=goods_price%></em></td>
						<td><u><%=goods_nums%></u></td>
						<td><time><%=completion_time%></time></td>
						<td><span>成交</span></td>
					</tr>
					</script>
				</div>
				<!-- 购买记录 end -->

				<!-- 购买前咨询 start -->
				<div class="none ask_list ">
					<a class="ask_btn" href="<?php echo IUrl::creatUrl("/site/consult/id/".$id."");?>">我要咨询</a>
					<div id='referBox'></div>
					<!--购买咨询JS模板-->
					<script type='text/html' id='referRowTemplate'>
					<div class="ask_item">
						<div class="user">
							<img src="<%=webroot(head_ico)%>" width="70px" height="70px" onerror="this.src='<?php echo $this->getWebSkinPath()."image/user_ico.gif";?>'" />
							<span><%=username%></span>
						</div>
						<div class="desc">
							<header>
								<i class="fa fa-comment-alt"></i>
								<strong>咨询内容：</strong>
								<time><%=time%></time>
							</header>
							<section><%=question%></section>
							<%if(answer){%>
							<div class="answer">
								<header>
									<i class="fa fa-comments-alt"></i>
									<strong>商家回复：</strong>
									<time><%=reply_time%></time>
								</header>
								<section><%=answer%></section>
							</div>
							<%}%>
						</div>
					</div>
					</script>
				</div>
				<!-- 购买前咨询 end -->

				<!-- 网友讨论圈 start -->
				<div class="none discussion_list">
					<a class="ask_btn" name="discussButton">发表话题</a>
					<div id='discussBox'></div>
					<!--讨论JS模板-->
					<script type='text/html' id='discussRowTemplate'>
						<div class="discussion_item">
							<strong><%=username%></strong>
							<time><%=time%></time>
							<p><%=contents%></p>
						</div>
					</script>
					<section class="discuss_form none" id="discussTable">
						<dl>
							<dt>讨论内容：</dt>
							<dd><textarea class="input_textarea" id="discussContent" pattern="required" alt="请填写内容"></textarea></dd>
						</dl>
						<dl>
							<dt>验证码：</dt>
							<dd>
								<input type='text' class='input_text w100' name='captcha' pattern='^\w{5}$' alt='填写下面图片所示的字符' />
								<img src='<?php echo IUrl::creatUrl("/site/getCaptcha");?>' id='captchaImg' onclick="changeCaptcha()" />
							</dd>
						</dl>
						<dl>
							<dt></dt>
							<dd><input class="input_submit" type="submit" name="sendDiscussButton" value="发表" /></dd>
						</dl>
					</section>
				</div>
				<!-- 网友讨论圈 end -->
			</div>
		</section>
		<!-- 产品详情 -->
		<!-- 产品详情侧边 -->
		<aside class="products_bar">
			<?php if(Api::run('getProrule',$seller_id)){?>
			<nav class="products_bar_box">
				<h3 class="products_bar_box_head">促销活动</h3>
				<ul class="products_bar_sales">
					<?php foreach($items=Api::run('getProrule',$seller_id) as $key => $item){?>
					<li><?php echo isset($item['info'])?$item['info']:"";?></li>
					<?php }?>
				</ul>
			</nav>
			<?php }?>
			<div class="products_bar_box">
				<h3 class="products_bar_box_head">热卖排行</h3>
				<ul class="products_bar_hot">
					<?php foreach($items=Api::run('getCommendHot', 8) as $key => $item){?>
					<li>
						<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>">
							<i class="goods_mark"></i>
							<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/56/h/56");?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>">
							<div>
								<p class="goods_title"><span><?php echo isset($item['name'])?$item['name']:"";?></span></p>
								<p class="goods_sell_price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
							</div>
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
		</aside>
		<!-- 产品详情侧边 -->
	</section>
</div>
<script>
$(function(){
	//初始化商品详情对象
	var productInstance = new productClass("<?php echo isset($id)?$id:"";?>","<?php echo isset($this->user['user_id'])?$this->user['user_id']:"";?>","<?php echo isset($promo)?$promo:"";?>","<?php echo isset($active_id)?$active_id:"";?>");

	//初始化商品轮换图
	$('#goodsPhotoList').bxSlider({
		infiniteLoop:false,
		hideControlOnEnd:true,
		controls:true,
		pager:false,
		minSlides: 5,
		maxSlides: 5,
		slideWidth: 72,
		slideMargin: 15,
		onSliderLoad:function(currentIndex){
			//默认初始化显示第一张
			$('[thumbimg]:eq('+currentIndex+')').trigger('click');
			//放大镜
			$("#picShow").imagezoom();
		}
	});

	//城市地域选择按钮事件
	$('.sel_area').hover(
		function(){
			$('.area_box').show();
		},function(){
			$('.area_box').hide();
		}
	);

	$('.area_box').hover(
		function(){
			$('.area_box').show();
		},function(){
			$('.area_box').hide();
		}
	);

	//按钮绑定
	$('[name="showButton"]>label').click(function(){
		$(this).siblings().removeClass('current');
		$(this).addClass('current');

		$('[name="showBox"]>div').hide();
		$('[name="showBox"]>div:eq('+$(this).index()+')').show();

		switch($(this).index())
		{
			case 1:
			{
				productInstance.comment_ajax();
			}
			break;

			case 2:
			{
				productInstance.history_ajax();
			}
			break;

			case 3:
			{
				productInstance.refer_ajax();
			}
			break;

			case 4:
			{
				productInstance.discuss_ajax();
			}
			break;
		}
	});
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
