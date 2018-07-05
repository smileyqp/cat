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
<script src='<?php echo IUrl::creatUrl("")."public/javascript/orderFormClass.js";?>'></script>
<script>
//创建订单表单实例
orderFormInstance = new orderFormClass();

//DOM加载完毕
$(function(){
	//商家信息
	orderFormInstance.seller = <?php echo JSON::encode($this->sellerData);?>;

	//商品价格
	orderFormInstance.goodsSum = "<?php echo $this->final_sum;?>";

	//配送方式初始化
	orderFormInstance.deliveryInit("<?php echo isset($this->custom['delivery'])?$this->custom['delivery']:"";?>");

	//收货地址数据
	orderFormInstance.addressInit();

	//支付方式
	orderFormInstance.paymentInit("<?php echo isset($this->custom['payment'])?$this->custom['payment']:"";?>");

	//免运费
	orderFormInstance.freeFreight = <?php echo JSON::encode($this->freeFreight);?>;
});
</script>

<section class="breadcrumb">
	<span>您当前的位置：</span> <a href="<?php echo IUrl::creatUrl("");?>">首页</a> » 填写核对订单信息
</section>

<section class="cart_2">
	<header class="cart_header">填写核对订单信息</header>
	<form action='<?php echo IUrl::creatUrl("/simple/cart3");?>' method='post' name='order_form' onsubmit='return orderFormInstance.isSubmit()'>
		<input type='hidden' name='direct_gid' value='<?php echo $this->gid;?>' />
		<input type='hidden' name='direct_type' value='<?php echo $this->type;?>' />
		<input type='hidden' name='direct_num' value='<?php echo $this->num;?>' />
		<input type='hidden' name='direct_promo' value='<?php echo $this->promo;?>' />
		<input type='hidden' name='direct_active_id' value='<?php echo $this->active_id;?>' />
		<section class="cart_item">
			<h3>收货人信息</h3>
			<div class="cart_item_addr">
				<h4>常用收货地址</h4>
				<ul class="addr_list">
					<?php foreach($items=$this->addressList as $key => $item){?>
					<li id="addressItem<?php echo isset($item['id'])?$item['id']:"";?>">
						<label>
							<input class="radio" name="radio_address" type="radio" value="<?php echo isset($item['id'])?$item['id']:"";?>" onclick="orderFormInstance.getDelivery(<?php echo isset($item['province'])?$item['province']:"";?>);" />
							<strong><?php echo isset($item['accept_name'])?$item['accept_name']:"";?></strong> <?php echo isset($item['province_val'])?$item['province_val']:"";?> <?php echo isset($item['city_val'])?$item['city_val']:"";?> <?php echo isset($item['area_val'])?$item['area_val']:"";?> <?php echo isset($item['address'])?$item['address']:"";?>
						</label>
						[<span onclick="orderFormInstance.addressEdit(<?php echo isset($item['id'])?$item['id']:"";?>)">修改地址</span>]
						[<span onclick="orderFormInstance.addressDel(<?php echo isset($item['id'])?$item['id']:"";?>)">删除</span>]
					</li>
					<?php }?>
					<li>
						<label><a href="javascript:orderFormInstance.addressAdd();" style="color:#005ea7;">添加新地址</a></label>
					</li>
				</ul>
				<!--收货地址项模板-->
				<script type='text/html' id='addressLiTemplate'>
				<li id="addressItem<%=item['id']%>">
					<label><input class="radio" name="radio_address" type="radio" value="<%=item['id']%>" onclick="orderFormInstance.getDelivery(<%=item['province']%>);" /><%=item['accept_name']%>&nbsp;&nbsp;&nbsp;<%=item['province_val']%> <%=item['city_val']%> <%=item['area_val']%> <%=item['address']%></label> [<a href="javascript:orderFormInstance.addressEdit(<%=item['id']%>);" style="color:#005ea7;">修改地址</a>] [<a href="javascript:orderFormInstance.addressDel(<%=item['id']%>);" style="color:#005ea7">删除</a>]
				</li>
				</script>
			</div>
		</section>
		<section class="cart_item">
			<h3>配送方式</h3>
			<div class="cart_item_express">
				<table>
					<col width="180">
					<col>
					<tbody>
						<?php foreach($items=Api::run('getDeliveryList') as $key => $item){?>
						<tr>
							<th>
								<label>
									<input type="radio" name="delivery_id" value="<?php echo isset($item['id'])?$item['id']:"";?>" paytype="<?php echo isset($item['type'])?$item['type']:"";?>" onclick='orderFormInstance.deliverySelected(<?php echo isset($item['id'])?$item['id']:"";?>);' />
									<?php echo isset($item['name'])?$item['name']:"";?>
								</label>
							</th>
							<td>
								<span id="deliveryShow<?php echo isset($item['id'])?$item['id']:"";?>"></span>
								<?php echo isset($item['description'])?$item['description']:"";?>
								<?php if($item['type'] == 2){?>
								<a href="javascript:orderFormInstance.selectTakeself(<?php echo isset($item['id'])?$item['id']:"";?>);"><span class="red">选择自提点</span></a>
								<span id="takeself<?php echo isset($item['id'])?$item['id']:"";?>"></span>
								<?php }?>
							</td>
						</tr>
						<?php }?>
					</tbody>

					<!--配送信息-->
					<script type='text/html' id='deliveryTemplate'>
						<span style="color:#e4393c">运费：￥<%=item['price']%></span>
						<%if(item['protect_price'] > 0){%>
						<span style="color:#e4393c">保价：￥<%=item['protect_price']%></span>
						<%}%>
					</script>

					<!--物流自提点-->
					<script type='text/html' id='takeselfTemplate'>
						[<%=item['address']%> <%=item['name']%> <%=item['phone']%> <%=item['mobile']%>]
					</script>

					<tfoot>
						<th>指定送货时间：</th>
						<td>
							<label class='attr'><input type='radio' name='accept_time' checked="checked" value='任意' /> 任意</label>
							<label class='attr'><input type='radio' name='accept_time' value='周一到周五' /> 周一到周五</label>
							<label class='attr'><input type='radio' name='accept_time' value='周末' /> 周末</label>
						</td>
					</tfoot>
				</table>
			</div>
		</section>
		<section class="cart_item" id="paymentBox">
			<h3>支付方式</h3>
			<div class="cart_item_pay">
				<table width="100%" class="border_table">
					<col width="180">
					<col>
					<?php foreach($items=Api::run('getPaymentList') as $key => $item){?>
					<?php $paymentPrice = CountSum::getGoodsPaymentPrice($item['id'],$this->sum);?>
					<tr>
						<th>
							<label>
								<input class="radio" name="payment" alt="<?php echo isset($paymentPrice)?$paymentPrice:"";?>" onclick='orderFormInstance.paymentSelected(<?php echo isset($item['id'])?$item['id']:"";?>);' title="<?php echo isset($item['name'])?$item['name']:"";?>" type="radio" value="<?php echo isset($item['id'])?$item['id']:"";?>" />
								<?php echo isset($item['name'])?$item['name']:"";?>
							</label>
						</th>
						<td><?php echo isset($item['note'])?$item['note']:"";?> <?php if($paymentPrice){?>支付手续费：￥<?php echo isset($paymentPrice)?$paymentPrice:"";?><?php }?></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</section>
		<section class="cart_item">
			<h3>订单附言</h3>
			<div class="cart_item_msg">
				<table>
					<col width="120px">
					<col>
					<tr>
						<th>订单附言：</th>
						<td><input class="input_text" type="text" name='message' /></td>
					</tr>
				</table>
			</div>
		</section>
		<section class="cart_item">
			<h3>购买的商品</h3>
			<div class="cart_prompts <?php if(empty($this->promotion)){?>none<?php }?>">
				<strong>恭喜，您的订单已经满足了以下优惠活动！</strong>
				<ol>
					<?php foreach($items=$this->promotion as $key => $item){?>
					<li><?php echo isset($item['plan'])?$item['plan']:"";?>，<?php echo isset($item['info'])?$item['info']:"";?></li>
					<?php }?>
				</ol>
			</div>
			<div class="cart_item_goods">
				<table>
					<col width="115">
					<col>
					<col width="80">
					<col width="80">
					<col width="80">
					<col width="80">
					<col width="80">
					<thead>
						<tr>
							<th>图片</th>
							<th>商品名称</th>
							<th>赠送积分</th>
							<th>单价</th>
							<th>优惠</th>
							<th>数量</th>
							<th>小计</th>
						</tr>
					</thead>
					<tbody>
						<!-- 商品展示 开始-->
						<?php foreach($items=$this->goodsList as $key => $item){?>
						<tr>
							<td><img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/66/h/66");?>" width="66px" height="66px" alt="<?php echo isset($item['name'])?$item['name']:"";?>"></td>
							<td>
								<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['goods_id']."");?>" class="blue"><?php echo isset($item['name'])?$item['name']:"";?></a>
								<?php if(isset($item['spec_array'])){?>
								<p>
								<?php $spec_array=goods_class::show_spec($item['spec_array']);?>
								<?php foreach($items=$spec_array as $specName => $specValue){?>
									<?php echo isset($specName)?$specName:"";?>：<?php echo isset($specValue)?$specValue:"";?> &nbsp&nbsp
								<?php }?>
								</p>
								<?php }?>
							</td>
							<td><?php echo isset($item['point'])?$item['point']:"";?></td>
							<td><em>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></em></td>
							<td>减￥<?php echo isset($item['reduce'])?$item['reduce']:"";?></td>
							<td><?php echo isset($item['count'])?$item['count']:"";?></td>
							<td id="deliveryFeeBox_<?php echo isset($item['goods_id'])?$item['goods_id']:"";?>_<?php echo isset($item['product_id'])?$item['product_id']:"";?>_<?php echo isset($item['count'])?$item['count']:"";?>"><em>￥<?php echo isset($item['sum'])?$item['sum']:"";?></em></td>
						</tr>
						<?php }?>
						<!-- 商品展示 结束-->
					</tbody>
				</table>
			</div>
		</section>
		<section class="cart_item">
			<h3>结算信息</h3>
			<div class="cart_item_count">
				<div class="count">
					<?php if($this->final_sum != $this->sum){?>优惠后总金额<?php }else{?>商品总金额<?php }?>：<strong><?php echo $this->final_sum;?></strong> -
					代金券：<strong name='ticket_value'>0</strong> +
					税金：<strong id='tax_fee'>0</strong> +
					运费总计：<strong id='delivery_fee_show'>0</strong> +
					保价：<strong id='protect_price_value'>0</strong> +
					支付手续费：<strong id='payment_value'>0</strong>
					<?php if($this->spend_point > 0){?> + 消耗积分：<strong><?php echo $this->spend_point;?></strong><?php }?>
					<br>
					<div class="use_ticket_btn" onclick="orderFormInstance.ticketShow()">
						<i class="fa fa-tag"></i>
						<span>使用代金卷</span>
					</div>
				</div>
				<table>
					<col width="220">
					<col>
					<col width="250">
					<tr>
						<td>
							是否需要发票？(税金:￥<?php echo $this->goodsTax;?>)
							<input class="radio" onclick="orderFormInstance.doAccount();$('#tax_title').toggle();" name="taxes" type="checkbox" value="<?php echo $this->goodsTax;?>">
						</td>
						<td>
							<label id="tax_title" class='none'>
								<select name="invoice_id" class="input_select">
									<option value="">请选择发票...</option>
									<?php foreach($items=Api::run("getInvoiceListByUserId") as $key => $item){?>
									<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['company_name'])?$item['company_name']:"";?></option>
									<?php }?>
								</select>
								<a href="javascript:orderFormInstance.editInvoice();">【添加】</a>
							</label>
						</td>
						<td>
							<div class="all_count">
								应付总额：<em>￥<span id='final_sum'><?php echo $this->final_sum;?></span></em> 元
							</div>
						</td>
					</tr>
				</table>
			</div>
		</section>
		<label class="cart_topay_btn">
			<input type="submit">
			<span>确定无误，提交订单</span>
		</label>
	</form>
</section>

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
