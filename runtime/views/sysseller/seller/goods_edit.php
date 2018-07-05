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
		<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/php/newshop04/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/php/newshop04/index.php?controller=pic&action=file_manager_json";</script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/my97date/wdatepicker.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.ui.widget.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.iframe-transport.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.fileupload.js"></script>
<?php $seller_id = $this->seller['seller_id']?>
<article class="module width_full">
	<header>
		<h3 class="tabs_involved">商品编辑</h3>

		<ul class="tabs" name="menu1">
			<li id="li_1" class="active"><a href="javascript:select_tab('1');">商品信息</a></li>
			<li id="li_2"><a href="javascript:select_tab('2');">描述</a></li>
			<li id="li_3"><a href="javascript:select_tab('3');">SEO优化</a></li>
		</ul>
	</header>

	<form action="<?php echo IUrl::creatUrl("/seller/goods_update");?>" name="goodsForm" method="post" novalidate="true">
		<input type="hidden" name="id" value="0" />
		<input type='hidden' name="img" value="" />
		<input type='hidden' name="_imgList" value="" />
		<input type='hidden' name="callback" value="<?php echo IUrl::getRefRoute(false);?>" />

		<!--商品信息 开始-->
		<div class="module_content" id="table_box_1">
			<fieldset>
				<label>商品名称</label>
				<input name="name" type="text" value="" pattern="required" alt="商品名称不能为空" />
			</fieldset>

			<fieldset>
				<label>关键词</label>
				<input type='text' name='search_words' value='' />
				<label class="tip">每个关键词最长为15个字符，超过后系统不予存储，每个词以逗号分隔</label>
			</fieldset>

			<fieldset>
				<label>所属分类</label>
				<div class="box">
					<div id="__categoryBox" style="margin-bottom:8px"></div>
					<input class="alt_btn" type="button" name="_goodsCategoryButton" value="设置分类" />
					<?php plugin::trigger('goodsCategoryWidget',array("type" => "checkbox","name" => "_goods_category[]","value" => isset($goods_category) ? $goods_category : ""))?>
				</div>
			</fieldset>

			<fieldset>
				<label>店内分类</label>
				<div class="box">
					<div id="_goods_category_seller" style="margin-bottom:8px"></div>
					<input class="alt_btn" type="button" name="_goods_category_seller" value="设置分类" />
					<?php plugin::trigger('goodsCategoryWidget',array("seller_id" => $this->seller['seller_id'],"id" => "_goods_category_seller","type" => "checkbox","table" => "category_seller","name" => "_goods_category_seller[]","value" => isset($goods_category_seller) ? $goods_category_seller : ""))?>
				</div>
			</fieldset>

			<fieldset>
				<label>商品排序</label>
				<input name="sort" type="text" pattern="int" value="99" />
			</fieldset>

			<fieldset>
				<label>计件单位显示</label>
				<input name="unit" type="text" value="件"/>
			</fieldset>

			<fieldset>
				<label>是否免运费</label>
				<div class="box">
					<label><input type='radio' name='is_delivery_fee' value='1'  />是</label>
					<label><input type='radio' name='is_delivery_fee' value='0' checked="checked" />否</label>
				</div>
			</fieldset>

			<fieldset style="min-width:500px;overflow-x:scroll;">
				<label>基本数据</label>
				<table class="tablesorter clear">
					<thead id="goodsBaseHead"></thead>
					<tbody id="goodsBaseBody"></tbody>

					<!--商品标题模板-->
					<script id="goodsHeadTemplate" type='text/html'>
					<tr>
						<th>商品货号</th>
						<%var isProduct = false;%>
						<%for(var item in templateData){%>
						<%isProduct = true;%>
						<th><a href="javascript:confirm('确定要删除此列规格？','delSpec(<%=templateData[item]['id']%>)');"><%=templateData[item]['name']%>【删】</a></th>
						<%}%>
						<th>库存</th>
						<th>市场价格</th>
						<th>销售价格</th>
						<th>成本价格</th>
						<th>重量(克)</th>
						<%if(isProduct == true){%>
						<th>操作</th>
						<%}%>
					</tr>
					</script>

					<!--商品内容模板-->
					<script id="goodsRowTemplate" type="text/html">
					<%var i=0;%>
					<%for(var item in templateData){%>
					<%item = templateData[item]%>
					<tr>
						<td><input class="small" name="_goods_no[<%=i%>]" pattern="required" type="text" value="<%=item['goods_no'] ? item['goods_no'] : item['products_no']%>" /></td>
						<%var isProduct = false;%>
						<%var specArrayList = typeof item['spec_array'] == 'string' && item['spec_array'] ? JSON().parse(item['spec_array']) : item['spec_array'];%>
						<%for(var result in specArrayList){%>
						<%result = specArrayList[result]%>
						<input type='hidden' name="_spec_array[<%=i%>][]" value='<%=JSON().stringify(result)%>' />
						<%isProduct = true;%>
						<td>
							<%if(result['type'] == 1){%>
								<%=result['value']%>
							<%}else{%>
								<img class="img_border" width="30px" height="30px" src="<%=webroot(result['value'])%>">
							<%}%>
						</td>
						<%}%>
						<td><input class="tiny" name="_store_nums[<%=i%>]" type="text" pattern="int" value="<%=item['store_nums']?item['store_nums']:100%>" /></td>
						<td><input class="tiny" name="_market_price[<%=i%>]" type="text" pattern="float" value="<%=item['market_price']%>" /></td>
						<td>
							<input type='hidden' name="_groupPrice[<%=i%>]" value="<%=item['groupPrice']%>" />
							<input class="tiny" name="_sell_price[<%=i%>]" type="text" pattern="float" value="<%=item['sell_price']%>" />
							<input type="button" onclick="memberPrice(this,<?php echo isset($seller_id)?$seller_id:"";?>);" value="会员价格 <%if(item['groupPrice']){%>*<%}%>" />
						</td>
						<td><input class="tiny" name="_cost_price[<%=i%>]" type="text" pattern="float" empty value="<%=item['cost_price']%>" /></td>
						<td><input class="tiny" name="_weight[<%=i%>]" type="text" pattern="float" empty value="<%=item['weight']%>" /></td>
						<%if(isProduct == true){%>
						<td><a href="javascript:void(0)" onclick="delProduct(this);"><img src="<?php echo $this->getWebSkinPath()."images/main/icn_trash.png";?>" alt="删除" /></a></td>
						<%}%>
					</tr>
					<%i++;%>
					<%}%>
					</script>
				</table>
			</fieldset>

			<fieldset>
				<label>商品模型</label>
				<select name="model_id" onchange="create_attr(this.value)">
					<option value="0">通用类型 </option>
                    <?php foreach($items=Api::run('getModelListAll') as $key => $item){?>
					<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
					<?php }?>
				</select>
			</fieldset>

			<fieldset>
				<label>规格</label>
				<div class="box">
					<select class='auto' onchange='selSpecVal(this);' id='specNameSel'>
						<option value=''>选规格名称</option>
                        <?php foreach($items=Api::run('getSpecListAll') as $key => $item){?>
						<option value='<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></option>
						<?php }?>
					</select>
					<select class='auto' onchange='selSpec(this);' id='specValSel'><option value='0'>选规格数据</option></select>
					<button class="btn" onclick="addNewSpec(<?php echo isset($seller_id)?$seller_id:"";?>);" type="button"><span class="add">新建规格</span></button>
					<label class="tip">可从现有规格中选择或新建规格生成货品。比如：尺码，颜色，类型...</label>
				</div>
			</fieldset>

			<fieldset id="properties" style="display:none">
				<label>扩展属性</label>
				<table class="tablesorter clear" id="propert_table">
				</table>

				<!--商品属性模板 开始-->
				<script type='text/html' id='propertiesTemplate'>
				<%for(var item in templateData){%>
				<%item = templateData[item]%>
				<%var valueItems = item['value'].split(',');%>
				<tr>
					<td>
						<%=item["name"]%>：
						<%if(item['type'] == 1){%>
							<%for(var tempVal in valueItems){%>
							<%tempVal = valueItems[tempVal]%>
								<span><input type="radio" name="attr_id_<%=item['id']%>" value="<%=tempVal%>" /><%=tempVal%></span>
							<%}%>
						<%}else if(item['type'] == 2){%>
							<%for(var tempVal in valueItems){%>
							<%tempVal = valueItems[tempVal]%>
								<input type="checkbox" name="attr_id_<%=item['id']%>[]" value="<%=tempVal%>"/><%=tempVal%>
							<%}%>
						<%}else if(item['type'] == 3){%>
							<select name="attr_id_<%=item['id']%>">
							<%for(var tempVal in valueItems){%>
							<%tempVal = valueItems[tempVal]%>
							<option value="<%=tempVal%>"><%=tempVal%></option>
							<%}%>
							</select>
						<%}else if(item['type'] == 4){%>
							<input type="text" name="attr_id_<%=item['id']%>" value="<%=item['value']%>" class="small" />
						<%}%>
					</td>
				</tr>
				<%}%>
				</script>
				<!--商品属性模板 结束-->
			</fieldset>

			<fieldset>
				<label>商品品牌</label>
				<select name="brand_id">
					<option value="0">请选择</option>
                    <?php foreach($items=Api::run('getBrandListAllOnce') as $key => $item){?>
					<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
					<?php }?>
				</select>
			</fieldset>

			<fieldset>
				<label>商品状态</label>
				<div class="box">
					<label><input type='radio' name='is_del' value='3' checked="checked" />申请上架</label>
					<label><input type='radio' name='is_del' value='2' />下架</label>
				</div>
			</fieldset>

			<fieldset>
				<label>产品相册</label>
				<div class="box">
					<input id="fileUpload" type="file" style="width:70px;" accept="image/png,image/gif,image/jpeg" name="_goodsFile" multiple="multiple" data-url="<?php echo IUrl::creatUrl("/goods/goods_img_upload/seller_id/".$seller_id."");?>" />
				</div>
				<label class="tip" id="uploadPercent">可以上传多张图片，分辨率3000px以下，大小不得超过<?php echo IUpload::getMaxSize();?></label>
				<div class="box" id="thumbnails"></div>
				<!--图片模板-->
				<script type='text/html' id='picTemplate'>
				<span class='pic'>
					<img name="picThumb" onclick="defaultImage(this);" style="margin:5px; opacity:1;width:100px;height:100px" src="<%=webroot(picRoot)%>" alt="<%=picRoot%>" />
					<p>
						<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').insertBefore($(this).parents('.pic').prev());"><img src="<?php echo $this->getWebSkinPath()."images/main/arrow_left.png";?>" title="左移动" alt="左移动" /></a>
						<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').remove();"><img src="<?php echo $this->getWebSkinPath()."images/main/sign_cacel.png";?>" title="删除" alt="删除" /></a>
						<a class='orange' href='javascript:void(0)' onclick="$(this).parents('.pic').insertAfter($(this).parents('.pic').next());"><img src="<?php echo $this->getWebSkinPath()."images/main/arrow_right.png";?>" title="右移动" alt="右移动" /></a>
					</p>
				</span>
				</script>
			</fieldset>
		</div>
		<!--商品信息 结束-->

		<!--商品描述 开始-->
		<div class="module_content" id="table_box_2" style="display:none;">
			<fieldset>
				<label>产品描述</label>
				<div class="clear" style="width:98%;margin:10px 10px;">
					<textarea id="content" name="content" style="width:100%;height:400px;"></textarea>
				</div>
			</fieldset>
		</div>
		<!--商品描述 结束-->

		<!--SEO 开始-->
		<div class="module_content" id="table_box_3" style="display:none;">
			<fieldset>
				<label>SEO关键词</label>
				<input name="keywords" type="text" value="" />
			</fieldset>

			<fieldset>
				<label>SEO描述</label>
				<textarea name="description" style="height:200px;"></textarea>
			</fieldset>
		</div>
		<!--SEO 结束-->

		<footer>
			<div class="submit_link">
				<input type="submit" class="alt_btn" value="确 定" onclick="return checkForm()" />
				<input type="reset" value="重 置" />
			</div>
		</footer>
	</form>

</article>

<script language="javascript">
//创建表单实例
var formObj = new Form('goodsForm');

//默认货号
var defaultProductNo = '<?php echo goods_class::createGoodsNo();?>';

$(function()
{
	//商品图片的回填
	<?php if(isset($goods_photo)){?>
	var goodsPhoto = <?php echo JSON::encode($goods_photo);?>;
	for(var item in goodsPhoto)
	{
		var picHtml = template.render('picTemplate',{'picRoot':goodsPhoto[item].img});
		$('#thumbnails').append(picHtml);
	}
	<?php }?>

	//商品默认图片
	<?php if(isset($form['img']) && $form['img']){?>
	$('#thumbnails img[name="picThumb"][alt="<?php echo $form['img'];?>"]').addClass('current');
	<?php }?>

	initProductTable();

	//存在商品信息
	<?php if(isset($form)){?>
	var goods = <?php echo JSON::encode($form);?>;

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':[goods]});
	$('#goodsBaseBody').html(goodsRowHtml);

	formObj.init(goods);

	//模型选择
	$('[name="model_id"]').change();
	<?php }else{?>
	$('[name="_goods_no[0]"]').val(defaultProductNo);
	<?php }?>

	//存在货品信息,进行数据填充
	<?php if(isset($product)){?>
	var spec_array = <?php echo $product[0]['spec_array'];?>;
	var product    = <?php echo JSON::encode($product);?>;

	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':spec_array});
	$('#goodsBaseHead').html(goodsHeadHtml);

	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':product});
	$('#goodsBaseBody').html(goodsRowHtml);
	<?php }?>

	//编辑器载入
	KindEditorObj = KindEditor.create('#content',{"filterMode":false});
});

//删除货品
function delProduct(_self)
{
	$(_self).parent().parent().remove();
	if($('#goodsBaseBody tr').length == 0)
	{
		initProductTable();
	}
}

//提交表单前的检查
function checkForm()
{
	//整理商品图片
	var goodsPhoto = [];
	$('#thumbnails img[name="picThumb"]').each(function(){
		goodsPhoto.push(this.alt);
	});
	if(goodsPhoto.length > 0)
	{
		$('input[name="_imgList"]').val(goodsPhoto.join(','));
		$('input[name="img"]').val($('#thumbnails img[name="picThumb"][class="current"]').attr('alt'));
	}
	return true;
}

//tab标签切换
function select_tab(curr_tab)
{
	$("form[name='goodsForm'] > div").hide();
	$("#table_box_"+curr_tab).show();
	$("ul[name=menu1] > li").removeClass('active');
	$('#li_'+curr_tab).addClass('active');
}

//根据模型动态生成扩展属性
function create_attr(model_id)
{
	$.getJSON("<?php echo IUrl::creatUrl("/block/attribute_init");?>",{'model_id':model_id}, function(json)
	{
		if(json && json.length > 0)
		{
			var templateHtml = template.render('propertiesTemplate',{'templateData':json});
			$('#propert_table').html(templateHtml);
			$('#properties').show();

			//表单回填设置项
			<?php if(isset($goods_attr)){?>
			<?php $attrArray = array();?>
			<?php foreach($items=$goods_attr as $key => $item){?>
			<?php $valArray = explode(',',$item);?>
			<?php $attrArray[] = '"attr_id_'.$key.'[]":"'.join(";",$valArray).'"'?>
			<?php $attrArray[] = '"attr_id_'.$key.'":"'.join(";",$valArray).'"'?>
			<?php }?>
			formObj.init({<?php echo join(',',$attrArray);?>});
			<?php }?>
		}
		else
		{
			$('#properties').hide();
		}
	});
}

//添加新规格
function addNewSpec(seller_id)
{
	var url = creatUrl("goods/spec_edit/seller_id/@seller_id@");
	url     = url.replace("@seller_id@",seller_id);
	art.dialog.open(url,{
		id:'addSpecWin',
	    title:'规格设置',
	    okVal:'确定',
	    ok:function(iframeWin, topWin){
	    	var formObject = iframeWin.document.forms['specForm'];
	    	if(formObject.onsubmit() == false)
	    	{
	    		return false;
	    	}
			$.getJSON(formObject.action,$(formObject).serialize(),function(json){
				if(json.flag == 'success' && json.data)
				{
					var insertHtml = '<option value="'+json.data.id+'">'+json.data.name+'</option>';
					$('#specNameSel').append(insertHtml);
					$('#specNameSel').find('option:last').attr("selected",true);
					$('#specNameSel').trigger('change');
					return true;
				}
				else
				{
					alert(json.message);
					return false;
				}
			});
	    }
	});
}
</script>
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."public/javascript/goods_edit.js";?>"></script>
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