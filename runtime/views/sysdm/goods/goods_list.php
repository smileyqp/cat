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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">商品</a>
		</li>
		<li>
			<a href="#">商品管理</a>
		</li>
		<li class="active">商品列表</li>
	</ul>
</div>

<div class="content">
	<table class="table list-table">
		<colgroup>
			<col width="30px" />
			<col />
			<col width="200px" />
			<col width="80px" />
			<col width="70px" />
			<col width="85px" />
			<col width="60px" />
			<col width="110px" />
		</colgroup>
		<caption>
			<a class="btn btn-default" href='<?php echo IUrl::creatUrl("/goods/goods_edit");?>'>
			    <i class="fa fa-plus"></i>添加商品
			</a>

			<a class="btn btn-default" onclick="selectAll('id[]')">
			    <i class="fa fa-check"></i>全选
			</a>

			<div class="btn-group">
				<button type="button" class="btn btn-default"><i class="fa fa-cogs"></i>批量操作</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="javascript:void(0);" onclick="goods_stats('up')">上架</a></li>
					<li><a href="javascript:void(0);" onclick="goods_stats('down')">下架</a></li>
					<li><a href="javascript:void(0);" onclick="goods_stats('check')">待审</a></li>
					<li><a href="javascript:void(0);" onclick="goods_del()">删除</a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" onclick="goodsCommend()">商品推荐</a></li>
					<li><a href="javascript:void(0);" onclick="goodsShare()">商品共享</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo IUrl::creatUrl("/goods/goods_report/?".$search."");?>" target="_blank">导出Excel</a></li>
				</ul>
			</div>

			<a class="btn btn-default" href="<?php echo IUrl::creatUrl("/goods/goods_recycle_list");?>">
			    <i class="fa fa-trash"></i>回收站
			</a>

			<a class="btn btn-default" onclick="goodsSetting();">
		    	<i class="fa fa-cogs"></i>批量设置
			</a>

        	<a class="btn btn-default" href="javascript:searchGoods({'submit':filterResult,'mode':'normal','data':'<?php echo isset($search)?$search:"";?>'});">
        		<i class="fa fa-search"></i>检索
        	</a>
		</caption>
		<thead>
			<tr>
				<th></th>
				<th>商品名称</th>
				<th>分类</th>
				<th>销售价</th>
				<th>库存</th>
				<th>状态</th>
				<th>排序</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<form action="" method="post" name="orderForm">
			<?php foreach($items=$this->goodsHandle->find() as $key => $item){?>
			<tr>
				<td><input name="id[]" type="checkbox" value="<?php echo isset($item['id'])?$item['id']:"";?>" /></td>
				<td>
					<img src='<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/50/h/50");?>' class='pull-left img-thumbnail' />
					<a href="javascript:jumpUrl('<?php echo isset($item['is_del'])?$item['is_del']:"";?>','<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>')" title="<?php echo htmlspecialchars($item['name']);?>"><?php echo isset($item['name'])?$item['name']:"";?></a>
				</td>
				<td>
				<?php foreach($items=Api::run('getCategoryExtendNameByCategoryid',array('id'=>$item["id"])) as $key => $catName){?>
					[<?php echo isset($catName['name'])?$catName['name']:"";?>]
				<?php }?>
				</td>
				<td><a href="javascript:quickEdit(<?php echo isset($item['id'])?$item['id']:"";?>,'price');"  title="点击更新价格" id="priceText<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['sell_price'])?$item['sell_price']:"";?></a></td>
				<td><a href="javascript:quickEdit(<?php echo isset($item['id'])?$item['id']:"";?>,'store');"  title="点击更新库存" id="storeText<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['store_nums'])?$item['store_nums']:"";?></a></td>
				<td>
					<select class="form-control input-sm" onchange="changeIsDel(<?php echo isset($item['id'])?$item['id']:"";?>,this)">
						<option value="up" <?php echo $item['is_del']==0 ? 'selected':'';?>>上架</option>
						<option value="down" <?php echo $item['is_del']==2 ? 'selected':'';?>>下架</option>
						<option value="check" <?php echo $item['is_del']==3 ? 'selected':'';?>>待审</option>
					</select>
				</td>
				<td><input type="text" class="form-control input-sm" value="<?php echo isset($item['sort'])?$item['sort']:"";?>" onchange="changeSort(<?php echo isset($item['id'])?$item['id']:"";?>,this);" /></td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/goods/goods_edit/id/".$item['id']."");?>"><i class='operator fa fa-edit'></i></a>
					<a onclick="delModel({link:'<?php echo IUrl::creatUrl("/goods/goods_del/id/".$item['id']."");?>'})" ><i class='operator fa fa-close'></i></a>

					<?php if($item['seller_id']){?>
					<a href="<?php echo IUrl::creatUrl("/site/home/id/".$item['seller_id']."");?>" target="_blank"><i class="operator fa fa-user"></i></a>
					<?php }?>

					<?php if($item['is_share'] == 1){?>
					<i class="operator fa fa-share-alt"></i>
					<?php }?>
				</td>
			</tr>
			<?php }?>
			</form>
		</tbody>
	</table>
</div>

<?php echo $this->goodsHandle->getPageBar();?>

<!--库存更新模板-->
<script id="goodsStoreTemplate" type="text/html">
<form name="quickEditForm" style="max-height:450px;overflow-x:hidden;">
<table class="table">
	<thead>
		<tr>
			<th>商品</th>
			<th>库存量</th>
		</tr>
	</thead>
	<tbody>
	<%for(var item in templateData){%>
		<%item=templateData[item]%>
		<tr>
			<td>
				<%=item['name']%>
				&nbsp;&nbsp;&nbsp;
				<%var specArrayList = item['spec_array'] ? JSON().parse(item['spec_array']) : [];%>
				<%for(var result in specArrayList){%>
					<%result = specArrayList[result]%>
					<%if(result['type'] == 1){%>
						<%=result['value']%>
					<%}else{%>
						<img class="img-thumbnail" width="30px" height="30px" src="<%=webroot(result['value'])%>">
					<%}%>
					&nbsp;&nbsp;&nbsp;
				<%}%>
			</td>
			<td>
				<input type="text" class="form-control input-sm" name="data[<%=item['id']%>]" value="<%=item['store_nums']%>" />
			</td>
		</tr>
	<%}%>
	</tbody>
</table>
<input type='hidden' name='goods_id' value="<%=item['goods_id']%>" />
</form>
</script>

<!--价格更新的模板-->
<script id="goodsPriceTemplate" type="text/html">
<form name="quickEditForm" style="max-height:450px;overflow-x:hidden;">
<table class="table">
	<thead>
		<tr>
			<th>商品</th>
			<th>市场价</th>
			<th>销售价</th>
			<th>成本价</th>
		</tr>
	</thead>
	<tbody>
	<%for(var item in templateData){%>
		<%item=templateData[item]%>
		<tr>
			<td>
				<%=item['name']%>
				&nbsp;&nbsp;&nbsp;
				<%var specArrayList = item['spec_array'] ? JSON().parse(item['spec_array']) : [];%>
				<%for(var result in specArrayList){%>
					<%result = specArrayList[result]%>
					<%if(result['type'] == 1){%>
						<%=result['value']%>
					<%}else{%>
						<img class="img-thumbnail" width="30px" height="30px" src="<%=webroot(result['value'])%>">
					<%}%>
					&nbsp;&nbsp;&nbsp;
				<%}%>
			</td>
			<td><input type="text" class="form-control input-sm" name="data[<%=item['id']%>][market_price]" value="<%=item['market_price']%>" /></td>
			<td><input type="text" class="form-control input-sm" name="data[<%=item['id']%>][sell_price]" value="<%=item['sell_price']%>" /></td>
			<td><input type="text" class="form-control input-sm" name="data[<%=item['id']%>][cost_price]" value="<%=item['cost_price']%>" /></td>
		</tr>
	<%}%>
	</tbody>
</table>
<input type='hidden' name='goods_id' value="<%=item['goods_id']%>" />
</form>
</script>

<!--推荐更新模板-->
<script id="goodsCommendTemplate" type="text/html">
<form name="commendForm" style="max-height:450px;overflow-x:hidden;">
<table class="table">
	<thead>
		<tr>
			<th>商品</th>
			<th>推荐选项</th>
		</tr>
	</thead>
	<tbody>
	<%for(var item in templateData){%>
		<%item=templateData[item]%>
		<tr>
			<td>
				<input type="hidden" name="data[<%=item['id']%>][]" value="" />
				<%=item['name']%>
			</td>
			<td>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[<%=item['id']%>][]" value="1" <%if(item['commend'] && item['commend'][1]){%>checked="checked"<%}%> />最新商品
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[<%=item['id']%>][]" value="2" <%if(item['commend'] && item['commend'][2]){%>checked="checked"<%}%> />特价商品
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[<%=item['id']%>][]" value="3" <%if(item['commend'] && item['commend'][3]){%>checked="checked"<%}%> />热卖商品
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[<%=item['id']%>][]" value="4" <%if(item['commend'] && item['commend'][4]){%>checked="checked"<%}%> />推荐商品
                </label>
			</td>
		</tr>
	<%}%>
	</tbody>
</table>
</form>
</script>

<script type="text/javascript">
//检索商品
function filterResult(iframeWin)
{
	var searchForm   = iframeWin.document.body;
	var searchString = $(searchForm).find("form").serialize();
	var jumpUrl      = creatUrl("/goods/goods_list/"+searchString);
	window.location.href = jumpUrl;
}

//商品推荐标签
function goodsCommend()
{
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		var idString = [];
		$('input:checkbox[name="id[]"]:checked').each(function(i)
		{
			idString.push(this.value);
		});

		$.getJSON("<?php echo IUrl::creatUrl("/block/goodsCommend");?>",{"id":idString.join(',')},function(json)
		{
			var templateHtml = template.render("goodsCommendTemplate",{'templateData':json});
			art.dialog(
			{
				okVal:"保存",
			    content: templateHtml,
			    ok:function(iframeWin)
			    {
			    	var formObj = iframeWin.document.forms['commendForm'];
			    	$.getJSON("<?php echo IUrl::creatUrl("/goods/update_commend");?>",$(formObj).serialize(),function(content)
			    	{
			    		if(content.result == 'fail')
			    		{
			    			alert(content.data);
			    		}
			    	});
			    }
			});
		});
	}
	else
	{
		alert("请选择您要操作的商品");
	}
}

//展示库存
function quickEdit(gid,typeVal)
{
	var submitUrl    = "";
	var templateName = "";
	var freshArea    = "";

	switch(typeVal)
	{
		case "store":
		{
			submitUrl    = "<?php echo IUrl::creatUrl("/goods/update_store");?>";
			templateName = "goodsStoreTemplate";
			freshArea    = "storeText";
		}
		break;

		case "price":
		{
			submitUrl    = "<?php echo IUrl::creatUrl("/goods/update_price");?>";
			templateName = "goodsPriceTemplate";
			freshArea    = "priceText";
		}
		break;
	}

	$.getJSON("<?php echo IUrl::creatUrl("/block/getGoodsData");?>",{"id":gid},function(json)
	{
		var templateHtml = template.render(templateName,{'templateData':json});
		art.dialog(
		{
			okVal:"保存",
		    content: templateHtml,
		    ok:function(iframeWin)
		    {
		    	var formObj = iframeWin.document.forms['quickEditForm'];
		    	$.getJSON(submitUrl,$(formObj).serialize(),function(content)
		    	{
		    		if(content.result == 'success')
		    		{
		    			$("#"+freshArea+gid).text(content.data);
		    		}
		    		else
		    		{
		    			alert(content.data);
		    		}
		    	});
		    }
		});
	});
}

//修改排序
function changeSort(gid,obj)
{
	var selectedValue = obj.value;
	$.getJSON("<?php echo IUrl::creatUrl("/goods/ajax_sort");?>",{"id":gid,"sort":selectedValue});
}

//修改上下架
function changeIsDel(gid,obj)
{
	var selectedValue = $(obj).find('option:selected').val();
	$.getJSON("<?php echo IUrl::creatUrl("/goods/goods_stats");?>",{"id":gid,"type":selectedValue});
}

//upload csv file callback
function artDialogCallback(message)
{
	message ? alert(message) : window.location.reload();
}

//删除
function goods_del()
{
	var flag = 0;
	$('input:checkbox[name="id[]"]:checked').each(function(i){flag = 1;});
	if(flag == 0)
	{
		alert('请选择要删除的数据');
		return false;
	}
	$("form[name='orderForm']").attr('action','<?php echo IUrl::creatUrl("/goods/goods_del");?>');
	confirm('确定要删除所选中的信息吗？','formSubmit(\'orderForm\')');
}

//上下架操作
function goods_stats(type)
{
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		var urlVal = "<?php echo IUrl::creatUrl("/goods/goods_stats/type/@type@");?>";
		urlVal = urlVal.replace("@type@",type);
		$("form[name='orderForm']").attr('action',urlVal);
		confirm('确定将选中的商品进行操作吗？',"formSubmit('orderForm')");
	}
	else
	{
		alert('请选择要操作的商品!');
		return false;
	}
}

//商品详情的跳转连接
function jumpUrl(is_del,url)
{
	is_del == 0 ? window.open(url) : alert("该商品没有上架无法查看");
}

//商品批量共享
function goodsShare()
{
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		var idString = [];
		$('input:checkbox[name="id[]"]:checked').each(function(i)
		{
			idString.push(this.value);
		});

		$.get("<?php echo IUrl::creatUrl("/goods/goods_share");?>",{"id":idString.join(',')},function(json)
		{
			window.location.reload();
		});
	}
	else
	{
		alert("请选择您要操作的商品");
	}
}

// 商品批量设置
function goodsSetting()
{
	if($('input:checkbox[name="id[]"]:checked').length > 0)
	{
		var idArray = [];
		var idString = '';
		$('input:checkbox[name="id[]"]:checked').each(function(i)
		{
			idArray.push(this.value);
		});
		idString = idArray.join(',');

		var urlVal = "<?php echo IUrl::creatUrl("/goods/goods_setting/id/@id@");?>";
		urlVal = urlVal.replace("@id@",idString);
		art.dialog.open(urlVal,{
			id:'goods_setting',
			title:'商品批量设置',
			okVal:'保存设置',
			ok:function(iframeWin, topWin){
				var formObject = iframeWin.document.forms[0];
				if(formObject.onsubmit() == false)
				{
					return false;
				}
				loadding();
				formObject.submit();
				return false;
			}
		});
	}
	else
	{
		alert("请选择您要操作的商品");
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