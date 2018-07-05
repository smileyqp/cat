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
            <div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">会员</a>
		</li>
		<li>
			<a href="#">会员管理</a>
		</li>
		<li class="active">会员列表</li>
	</ul>
</div>

<div class="content">
	<table class="table list-table">
		<colgroup>
			<col width="35px" />
			<col />
			<col width="100px" />
			<col width="80px" />
			<col width="50px" />
			<col width="100px"/>
			<col width="90px" />
			<col width="60px" />
			<col width="50px" />
			<col width="100px" />
			<col width="100px" />
			<col width="90px" />
		</colgroup>
		<caption>
            <a class="btn btn-default" href='<?php echo IUrl::creatUrl("/member/member_edit");?>'>
                <i class="fa fa-plus"></i>添加会员
            </a>
            <a class="btn btn-default" onclick="selectAll('check[]')">
                <i class="fa fa-check"></i>全选
            </a>
            <a class="btn btn-default" onclick="delModel({'form':'member_list',msg:'确定要删除所选中的会员吗？<br />删除的会员可以从回收站找回。'})">
                <i class="fa fa-close"></i>批量删除
            </a>
            <a class="btn btn-default" href='<?php echo IUrl::creatUrl("/member/recycling");?>'>
                <i class="fa fa-trash"></i>回收站
            </a>
            <a class="btn btn-default" onclick="balance_add()">
                <i class="fa fa-yen"></i>预付款管理
            </a>

			<form name="searchuser" action="<?php echo IUrl::creatUrl("/");?>" method="get" class="pull-right form-inline" style="margin:0">
				<input type='hidden' name='controller' value='member' />
				<input type='hidden' name='action' value='member_list' />
				<select class="form-control" name="search">
					<option value="u.username">用户名</option>
					<option value="m.true_name">姓名</option>
					<option value="m.mobile">手机</option>
					<option value="m.email">Email</option>
				</select>
				<input class="form-control" name="keywords" type="text" value="<?php echo isset($keywords)?$keywords:"";?>"/>
				<button class="btn btn-default" type="submit">
				    <i class="fa fa-search"></i>搜 索
				</button>
			</form>
		</caption>
		<thead>
			<tr>
				<th></th>
				<th>用户名</th>
				<th>会员等级</th>
				<th>姓名</th>
				<th>性别</th>
				<th>Email</th>
				<th>余额</th>
				<th>积分</th>
				<th>状态</th>
				<th>注册日期</th>
				<th>手机</th>
				<th>操作</th>
			</tr>
		</thead>
		<form action="<?php echo IUrl::creatUrl("/member/member_reclaim");?>" method="post" name="member_list" onsubmit="return checkboxCheck('check[]','尚未选中任何记录！')">
		<tbody>
           <?php foreach($items=$this->query->find() as $key => $item){?>
			<tr>
				<td><input name="check[]" type="checkbox" value="<?php echo isset($item['user_id'])?$item['user_id']:"";?>" /></td>
				<td title="<?php echo htmlspecialchars($item['username']);?>"><?php echo isset($item['username'])?$item['username']:"";?></td>
				<td title="<?php echo isset($group[$item['group_id']])?$group[$item['group_id']]:"";?>"><?php echo isset($group[$item['group_id']])?$group[$item['group_id']]:"";?></td>
				<td title="<?php echo htmlspecialchars($item['true_name']);?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?></td>
				<td><?php if($item['sex']=='1'){?>男<?php }else{?>女<?php }?></td>
				<td title="<?php echo htmlspecialchars($item['email']);?>"><?php echo isset($item['email'])?$item['email']:"";?></td>
				<td title="<?php echo isset($item['balance'])?$item['balance']:"";?>"><?php echo isset($item['balance'])?$item['balance']:"";?></td>
				<td title="<?php echo isset($item['point'])?$item['point']:"";?>"><?php echo isset($item['point'])?$item['point']:"";?></td>
				<td title="<?php echo Common::userStatusText($item['status']);?>"><?php echo Common::userStatusText($item['status']);?></td>
				<td title="<?php echo isset($item['time'])?$item['time']:"";?>"><?php echo isset($item['time'])?$item['time']:"";?></td>
				<td title="<?php echo htmlspecialchars($item['mobile']);?>"><?php echo isset($item['mobile'])?$item['mobile']:"";?></td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/member/member_edit/uid/".$item['user_id']."");?>"><i class='operator fa fa-edit'></i></a>
					<a onclick="delModel({link:'<?php echo IUrl::creatUrl("/member/member_reclaim/check/".$item['user_id']."");?>'})"><i class='operator fa fa-close'></i></a>
				</td>
			</tr>
			<?php }?>
		</tbody>
		</form>
	</table>
</div>
<?php echo $this->query->getPageBar();?>

<script language="javascript">
//预加载
$(function(){
	var formObj = new Form('searchuser');
	formObj.init({'search':'<?php echo isset($search)?$search:"";?>'});
})

//预付款管理入口
function balance_add()
{
	if(!checkboxCheck('check[]','请选择要进行预付款操作的用户！'))
	{
		return;
	}

	art.dialog.open("<?php echo IUrl::creatUrl("/member/member_balance");?>",{
	    title: '预付款管理',
	    ok:function(iframeWin, topWin)
	    {
	    	var formObject = iframeWin.document.forms['balanceForm'];
	    	if(formObject.onsubmit() == false)
	    	{
	    		return false;
	    	}

	    	//进行post提交
	    	var postData = $('[name="member_list"]').serialize()+'&'+$(formObject).serialize();
	    	$.post('<?php echo IUrl::creatUrl("/member/member_recharge");?>',postData,function(json){
	    		if(json.flag == 'success')
	    		{
	    			tips('操作成功');
	    			window.location.reload();
	    			return false;
	    		}
	    		else
	    		{
	    			alert(json.message);
	    			return false;
	    		}
	    	},'json');
	    	return false;
		}
	});
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