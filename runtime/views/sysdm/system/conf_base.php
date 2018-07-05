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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/php/newshop03/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/php/newshop03/index.php?controller=pic&action=file_manager_json";</script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop03/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">系统</a>
		</li>
		<li class="active">站点设置</li>
	</ul>
</div>

<div class="content">
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">网站设置</a></li>
			<li><a href="#tab2" data-toggle="tab">站点底部信息</a></li>
			<li><a href="#tab3" data-toggle="tab">其他设置</a></li>
			<li><a href="#tab4" data-toggle="tab">邮箱设置</a></li>
			<li><a href="#tab5" data-toggle="tab">系统设置</a></li>
		</ul>

		<div class="tab-content">
			<!--网站设置-->
			<div class="tab-pane active" id="tab1">
				<form action="<?php echo IUrl::creatUrl("/system/save_conf/form_index/base_conf");?>" method="post" enctype='multipart/form-data' name='base_conf'>
				<table class="table form-table">
					<colgroup>
						<col width="140px" />
						<col />
					</colgroup>

					<tr>
						<th>商店名称：</th>
						<td><input type='text' class='form-control' name='name' pattern='required' alt='商店名称必须填写' /></td>
					</tr>
					<tr>
						<th>商店网址：</th>
						<td>
							<input type='text' class='form-control' name='url' pattern='url' alt='商店网址必须填写' />
							<p class="help-block">* 网站完整的URL访问地址</p>
						</td>
					</tr>
					<tr>
						<th>网站LOGO：</th>
						<td>
							<?php if($this->_siteConfig->logo){?>
							<img src="<?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?>" style="width:220px;" />
							<?php }?>
							<p><input type='file' name='logo' class='mt-10' /></p>
						</td>
					</tr>
					<tr>
						<th>联系人：</th>
						<td><input type='text' class='form-control' name='master' /></td>
					</tr>
					<tr>
						<th>QQ：</th>
						<td><input type='text' class='form-control' pattern='qq' name='qq' empty alt='请填写正确的QQ号' /></td>
					</tr>
					<tr>
						<th>Email：</th>
						<td><input type='text' class='form-control' pattern='email' name='email' empty alt='请填写正确的email地址' /></td>
					</tr>
					<tr>
						<th>手机：</th>
						<td><input type='text' class='form-control' pattern='mobi' name='mobile' empty alt='请填写正确的手机号码' /></td>
					</tr>
					<tr>
						<th>客服电话：</th>
						<td><input type='text' class='form-control' pattern='phone' name='phone' empty alt='请填写正确的固定电话' /></td>
					</tr>
					<tr>
						<th>具体地址：</th>
						<td><input type='text' class='form-control' pattern='required' name='address' empty alt='商店名称必须填写' /></td>
					</tr>
					<tr>
						<th>商品货号前缀：</th>
						<td><input type='text' class='form-control' pattern='required' name='goods_no_pre' empty alt='商品货号前缀' /></td>
					</tr>
					<tr>
						<th>首页标题：</th>
						<td><input type='text' class='form-control' pattern='required' name='index_seo_title' empty alt='首页title后缀' /></td>
					</tr>
					<tr>
						<th>首页关键词：</th>
						<td><input type='text' class='form-control' pattern='required' name='index_seo_keywords' empty alt='首页keywords' /></td>
					</tr>
					<tr>
						<th>首页描述：</th>
						<td><input type='text' class='form-control' pattern='required' name='index_seo_description' empty alt='首页description' /></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<button class="btn btn-primary" type='submit'>保存基本设置</button>
						</td>
					</tr>
					</tfoot>
				</table>
				</form>
			</div>

			<!--网站底部信息设置-->
			<div class="tab-pane" id="tab2">
				<form action='<?php echo IUrl::creatUrl("/system/save_conf/form_index/site_footer_conf");?>' method='post' name='site_footer_conf'>
				<table class='table form-table'>
					<colgroup>
						<col width="140px" />
						<col />
					</colgroup>
					<tr>
						<th>站点底部信息：</th>
						<td>
							<textarea id="site_footer_code" name='site_footer_code' style='width:95%;height:300px;'><?php echo IFilter::stripSlash($this->confRow['site_footer_code']);?></textarea>
							<p class="help-block">设置站点底部页面信息，您可以点源代码试图直接进行代码编辑</p>
						</td>
					</tr>
					<tr>
						<th></th>
						<td><button type='submit' class='btn btn-primary'>保存站点底部信息</button></td>
					</tr>
				</table>
				</form>
			</div>

			<!--其他设置-->
			<div class="tab-pane" id="tab3">
				<form action='<?php echo IUrl::creatUrl("/system/save_conf/form_index/other_conf");?>' method='post' name='other_conf'>
				<table class="table form-table">
					<colgroup>
						<col width="140px" />
						<col />
					</colgroup>
					<tr>
						<th>默认的排序依据：</th>
						<td>
							<select name='order_by' class='form-control'>
								<option value='sort'>默认</option>
								<?php foreach($items=search_goods::getOrderType() as $key => $item){?>
								<option value='<?php echo isset($key)?$key:"";?>'><?php echo isset($item)?$item:"";?></option>
								<?php }?>
							</select>
							<p class="help-block">* 在商品列表页中商品的排序依据条件</p>
						</td>
					</tr>
					<tr>
						<th>发票税率：</th>
						<td><input type='text' name='tax' class='form-control w-auto' empty pattern='float' alt='请输入正确的整数或者浮点数' />% <p class="help-block">当买家需要发票的时候就要增加<商品金额>*<税率>的费用</p></td>
					</tr>
					<tr>
						<th>商家结算手续费：</th>
						<td><input type='text' name='commission' class='form-control w-auto' empty pattern='float' alt='请输入正确的整数或者浮点数' />% <p class="help-block">商家结算时，扣除<应结算总额>的百分比，最终商家结算金额为：<应结算总额> - <应结算总额> * <商家结算手续费></p></td>
					</tr>
					<tr>
						<th>默认备货时间：</th>
						<td><input type='text' class='form-control w-auto' name='stockup_time' pattern='int' alt='请填写整数' />天 <p class="help-block">* 订单确认后需要备货的时间</p></td>
					</tr>
					<tr>
						<th>新用户注册设置：</th>
						<td>
							<label class='radio-inline'><input type='radio' name='reg_option' value="0" />正常</label>
							<label class='radio-inline'><input type='radio' name='reg_option' value="1" />邮箱验证</label>
							<label class='radio-inline'><input type='radio' name='reg_option' value="3" />手机验证</label>
							<label class='radio-inline'><input type='radio' name='reg_option' value="2" />关闭注册</label>
							<p class="help-block">新用户注册配置，邮箱和手机验证要确保系统与验证接口对接正确</p>
						</td>
					</tr>
					<tr>
						<th>库存预警数量：</th>
						<td>
							<input type='text' class='form-control' name='store_num_warning' pattern='int' alt='请填写整数' /> <p class="help-block">当商品数量少于X件时，会在系统后台首页<a href="<?php echo IUrl::creatUrl("/system/default");?>"><库存预警></a>显示</p>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<button class='btn btn-primary' type='submit'>保存配置</button>
						</td>
					</tr>
				</table>
				</form>
			</div>

			<!--邮箱设置-->
			<div class="tab-pane" id="tab4">
				<form action='<?php echo IUrl::creatUrl("/system/save_conf/form_index/mail_conf");?>' method='post' name='mail_conf'>
				<table class="table form-table">
					<colgroup>
						<col width="140px" />
						<col />
					</colgroup>
					<tr>
						<th>说明：</th>
						<td>
							邮件配置要根据具体邮件服务器的要求才能正确发送，比如：<a href="http://bbs.aircheng.com/read-1647" target="_blank">163邮箱</a>，<a href="http://bbs.aircheng.com/read-1009" target="_blank">QQ邮箱</a><br/>
							邮件的内容模板在：【classes/mailtemplate.php】可以根据需要自行修改
						</td>
					</tr>
					<tr>
						<th>发送Email方式：</th>
						<td>
							<label class='radio-inline'><input type='radio' name='email_type' value='1' checked='checked' onclick="show_mail(1);" />第三方SMTP方式</label>
							<label class='radio-inline'><input type='radio' name='email_type' value='2' onclick="show_mail(2)" />本地mail邮箱</label>
							<p class="help-block">* 如果本地已经搭建好邮件服务，请选择 "本地mail邮箱"，否则选择" 第三方SMTP方式 "来发送邮件</p>
						</td>
					</tr>
					<tr>
						<th>发送邮件的地址：</th>
						<td>
							<input type='text' name='mail_address' pattern='email' alt='填写正确的email地址' class='form-control' />
							<p class="help-block">* 发送邮件所使用的email地址，邮件内容中的收件人信息就是显示此信息</p>
						</td>
					</tr>
					<tr>
						<th>安全协议：</th>
						<td>
							<label class='radio-inline'><input type='radio' name='email_safe' value='' checked='checked' />默认</label>
							<label class='radio-inline'><input type='radio' name='email_safe' value='ssl' />SSL</label>
							<label class='radio-inline'><input type='radio' name='email_safe' value='tls' />TLS</label>
							<p class="help-block">具体细则请参考各大邮件服务提供商</p>
						</td>
					</tr>
					<tr name='smtp'>
						<th>SMTP地址：</th>
						<td>
							<input type='text' name='smtp' class='form-control' pattern='required' empty alt='填写正确的email地址' />
							<p class="help-block">第三方的SMTP的URL地址</p>
						</td>
					</tr>
					<tr name='smtp'>
						<th>用户名：</th>
						<td>
							<input type='text' name='smtp_user' class='form-control' pattern='required' alt='发送邮件' empty />
							<p class="help-block">SMTP用户名</p>
						</td>
					</tr>
					<tr name='smtp'>
						<th>密码：</th>
						<td><input type='password' name='smtp_pwd' class='form-control' value='<?php echo isset($this->confRow['smtp_pwd'])?$this->confRow['smtp_pwd']:"";?>' empty /><p class="help-block">SMTP密码</p></td>
					</tr>
					<tr name='smtp'>
						<th>端口号：</th>
						<td><input type='text' name='smtp_port' class='form-control' empty /><p class="help-block">SMTP端口号(默认：25)</p></td>
					</tr>
					<tr>
						<th>测试邮件地址：</th>
						<td><input type='text' name='test_address' pattern='email' class='form-control' empty alt='填写正确的email地址' /><p class="help-block">用于测试邮件发送的功能【可选】</p></td>
					</tr>
					<tr>
						<th></th>
						<td>
							<button class='btn btn-primary' type='submit'>保存邮箱设置</button>
							<button class='btn btn-default' type='button' onclick="test_mail(this);"><span id='testmail'>测试邮件发送</span></button>
						</td>
					</tr>
				</table>
				</form>
			</div>

			<!--系统设置-->
			<div class="tab-pane" id="tab5">
				<form action="<?php echo IUrl::creatUrl("/system/save_conf/form_index/system_conf");?>" method="post" name='system_conf'>
				<table class="table form-table">
					<colgroup>
						<col width="150px" />
						<col />
					</colgroup>
					<tr>
						<th>清理模板缓存：</th>
						<td>
							<button class='btn btn-default' type='button' onclick="clearCache();">开始清理</button>
							<p class="help-block">清理系统编译生成的模板缓存文件</p>
						</td>
					</tr>
					<tr>
						<th>私密信息存储：</th>
						<td>
							<select name='safe' class='form-control' pattern='required' alt='请选择一种语言'>
								<option value='cookie'>COOKIE方案(存放于客户端)</option>
								<option value='session'>SESSION方案(存放于服务器端)</option>
							</select>
							<p class="help-block">注意：修改此设置后，用户会被强制退出。默认：COOKIE方案</p>
						</td>
					</tr>
					<tr>
						<th>上传容量限制：</th>
						<td><input type='text' name='uploadSize' class='form-control w-auto' empty pattern='int' alt='请输入MB数量' />MB <p class="help-block">上传图片及附件的容量限制，单位：MB</p></td>
					</tr>
					<tr>
						<th>设置语言包：</th>
						<td>
							<?php $langList = Config::getSitePlan('lang')?>
							<select class='form-control' name='lang' pattern='required' alt='请选择一种语言'>
								<?php foreach($items=$langList as $key => $item){?>
								<option value='<?php echo isset($key)?$key:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<p class="help-block">切换整站语言</p>
						</td>
					</tr>
					<tr>
						<th>报错显示设置：</th>
						<td>
							<select class='form-control' name="debug">
								<option value="0">隐藏错误【网站运营阶段】</option>
								<option value="1">部分显示【普通开发阶段】</option>
								<option value="2">全部显示【高质量开发阶段】</option>
							</select>
						</td>
					</tr>

					<tr>
						<th>伪静态：</th>
						<td>
							<label class='radio-inline'><input type='radio' name='rewriteRule' value="pathinfo" />开启</label>
							<label class='radio-inline'><input type='radio' name='rewriteRule' value="url" />关闭</label>
							<p class="help-block">开启伪静态前请先确保你的服务器环境支持伪静态规则，如果开启后网站无法打开，则需手动修改config/config.php【rewriteRule => url】</p>
						</td>
					</tr>

					<tr>
						<th>授权编号：</th>
						<td><input type='text' name='authorizeCode' class='form-control' empty /><p class="help-block">购买正式授权的编号 <a href="http://product.aircheng.com" target="_blank">点击查询</a></p></td>
					</tr>

					<tr>
						<th></th>
						<td><button class='btn btn-primary' type='submit'>保存系统设置</button></td>
					</tr>
				</table>
				</form>
			</div>
	    </div>
    </div>
</div>

<script type='text/javascript'>
//DOM加载完毕
$(function(){
	show_mail(1);

	//全部表单自动填入值
	var formNameArray = ['base_conf','other_conf','mail_conf','system_conf'];
	for(var index in formNameArray)
	{
		var formObject = new Form(formNameArray[index]);
		formObject.init(<?php echo JSON::encode($this->confRow);?>);
	}

	//装载编辑器
	KindEditor.ready(function(K){
		K.create('#site_footer_code',{"filterMode":false});
	});
});

//测试邮件发送
function test_mail(obj)
{
	$('form[name="mail_conf"] input:text').each(function(){
		$(this).trigger('change');
	});

	if($('form[name="mail_conf"] input:text.invalid-text').length > 0)
	{
		return;
	}

	//按钮控制
	obj.disabled = true;
	$('#testmail').html('正在测试发送请稍后...');

	var ajaxUrl = '<?php echo IUrl::creatUrl("/system/test_sendmail/@random@");?>';
	ajaxUrl     = ajaxUrl.replace('@random@',Math.random());

	$.getJSON(ajaxUrl,$('form[name="mail_conf"]').serialize(),function(content){
		obj.disabled = false;
		$('#testmail').html('测试邮件发送');
		alert(content.message);
	});
}

//清理缓存
function clearCache()
{
	loadding('请稍候，系统正在清理缓存文件...');
	jQuery.get('<?php echo IUrl::creatUrl("/system/clearCache");?>',function(content)
	{
		unloadding();
		var content = $.trim(content);
		if(content == 1)
			tips('清理成功！');
		else
			tips('清理失败！');
	});
}

//切换邮箱设置
function show_mail(checkedVal)
{
	if(checkedVal==1)
		$('table tr[name="smtp"] *').show();
	else
		$('table tr[name="smtp"] *').hide();
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