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
            <script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/php/newshop04/index.php?controller=pic&action=upload_json";window.KindEditor.options.fileManagerJson = "/php/newshop04/index.php?controller=pic&action=file_manager_json";</script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/my97date/wdatepicker.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.ui.widget.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.iframe-transport.js"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jqueryFileUpload/jquery.fileupload.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">系统</a>
		</li>
		<li>
			<a href="#">商品管理</a>
		</li>
		<li class="active">商品编辑</li>
	</ul>
</div>

<div class="content">
	<form action="<?php echo IUrl::creatUrl("/goods/goods_update");?>" name="goodsForm" method="post" novalidate="true">
	<input type="hidden" name="id" value="" />
	<input type='hidden' name="img" value="" />
	<input type='hidden' name="_imgList" value="" />
	<input type='hidden' name="callback" value="<?php echo IUrl::getRefRoute(false);?>" />

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">商品信息</a></li>
			<li><a href="#tab2" data-toggle="tab">描述</a></li>
			<li><a href="#tab3" data-toggle="tab">营销选项</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<table class="table form-table">
					<colgroup>
						<col width="130px" />
						<col />
					</colgroup>

					<tr>
						<th>商品名称：</th>
						<td>
							<input class="form-control" name="name" type="text" value="" pattern="required" />
						</td>
					</tr>
					<tr>
						<th>关键词：</th>
						<td>
							<input type='text' class='form-control' name='search_words' value='' />
							<p class="help-block">每个关键词最长为15个字符，必须以","(逗号)分隔符</p>
						</td>
					</tr>
					<tr>
						<th>所属商户：</th>
						<td>
							<select class="form-control" name="seller_id">
								<option value="0">商城平台自营 </option>
								<?php foreach($items=Api::run('getSellerListAll') as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?>-<?php echo isset($item['seller_name'])?$item['seller_name']:"";?></option>
								<?php }?>
							</select>
							<p class="help-block"><a href='<?php echo IUrl::creatUrl("/member/seller_edit");?>'>请点击添加商户</a></p>
						</td>
					</tr>
					<tr>
						<th>所属分类：</th>
						<td>
							<div id="__categoryBox" style="margin-bottom:8px"></div>
							<button class="btn btn-primary" type="button" name="_goodsCategoryButton"><i class="fa fa-list"></i> 设置分类</button>
							<?php plugin::trigger('goodsCategoryWidget',array("type" => "checkbox","name" => "_goods_category[]","value" => isset($goods_category) ? $goods_category : ""))?>
							<a href='<?php echo IUrl::creatUrl("/goods/category_edit");?>'>添加新分类</a>
						</td>
					</tr>
					<tr>
						<th>是否上架：</th>
						<td>
                            <label class="radio-inline">
                                <input type="radio" name="is_del" value="0" checked >是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_del" value="2">否
                            </label>
                            <p class="help-block">只有上架的商品才会在前台显示出来，客户是无法看到下架商品</p>
						</td>
					</tr>
					<tr>
						<th>是否共享：</th>
						<td>
                            <label class="radio-inline">
                                <input type="radio" name="is_share" value="1">是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_share" value="0" checked>否
                            </label>
                            <p class="help-block">商城平台的商品可以被商家复制共享</p>
						</td>
					</tr>
					<tr>
						<th>是否免运费：</th>
						<td>
                            <label class="radio-inline">
                                <input type="radio" name="is_delivery_fee" value="1">是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_delivery_fee" value="0" checked>否
                            </label>
                            <p class="help-block">是否免运费</p>
						</td>
					</tr>
					<tr>
						<th>附属数据：</th>
						<td>
							<table class="table no-padding">
								<thead>
									<tr>
										<td>购买成功增加积分</td><td>排序</td><td>计件单位显示</td><td>购买成功增加经验值</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input class="form-control w-auto" name="point" type="text" pattern="int" value="0"/></td>
										<td><input class="form-control w-auto" name="sort" type="text" pattern="int" value="99"/></td>
										<td><input class="form-control w-auto" name="unit" type="text" value="件"/></td>
										<td><input class="form-control w-auto" name="exp" type="text" pattern="int" value="0"/></td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<th>基本数据：</th>
						<td>
							<div class="table-responsive" id="productBox">
							<table class="table">
								<thead id="goodsBaseHead"></thead>

								<!--商品标题模板-->
								<script id="goodsHeadTemplate" type='text/html'>
								<tr>
									<td>商品货号</td>
									<%var isProduct = false;%>
									<%for(var item in templateData){%>
									<%isProduct = true;%>
									<td><a href="javascript:confirm('确定要删除此列规格？','delSpec(<%=templateData[item]['id']%>)');"><%=templateData[item]['name']%></a></td>
									<%}%>
									<td>库存</td>
									<td>市场价格</td>
									<td>销售价格</td>
									<td>成本价格</td>
									<td>重量(克)</td>
									<%if(isProduct == true){%>
									<td>操作</td>
									<%}%>
								</tr>
								</script>

								<tbody id="goodsBaseBody"></tbody>

								<!--商品内容模板-->
								<script id="goodsRowTemplate" type="text/html">
								<%var i=0;%>
								<%for(var item in templateData){%>
								<%item = templateData[item]%>
								<tr>
									<td><input class="form-control input-sm" name="_goods_no[<%=i%>]" pattern="required" type="text" value="<%=item['goods_no'] ? item['goods_no'] : item['products_no']%>" style="width:120px" /></td>
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
											<img class="img-thumbnail" width="30px" height="30px" src="<%=webroot(result['value'])%>">
										<%}%>
									</td>
									<%}%>
									<td><input class="form-control input-sm" name="_store_nums[<%=i%>]" type="text" pattern="int" value="<%=item['store_nums']?item['store_nums']:100%>" style="width:70px" /></td>
									<td><input class="form-control input-sm" name="_market_price[<%=i%>]" type="text" pattern="float" value="<%=item['market_price']%>" style="width:70px" /></td>
									<td>
										<input type='hidden' name="_groupPrice[<%=i%>]" value="<%=item['groupPrice']%>" />
										<input class="form-control input-sm" name="_sell_price[<%=i%>]" type="text" pattern="float" value="<%=item['sell_price']%>" style="width:70px;display:inline;" />
										<button class="btn btn-sm <%if(item['groupPrice']){%>btn-success<%}else{%>btn-default<%}%>" type="button" onclick="memberPrice(this);"><i class="fa fa-user"></i> 会员价格</button>
									</td>
									<td><input class="form-control input-sm" name="_cost_price[<%=i%>]" type="text" pattern="float" empty value="<%=item['cost_price']%>" style="width:70px" /></td>
									<td><input class="form-control input-sm" name="_weight[<%=i%>]" type="text" pattern="float" empty value="<%=item['weight']%>" style="width:70px" /></td>
									<%if(isProduct == true){%>
									<td><a onclick="delProduct(this);"><i class='operator fa fa-close'></i></td>
									<%}%>
								</tr>
								<%i++;%>
								<%}%>
								</script>
							</table>
							</div>
						</td>
					</tr>
					<tr>
						<th>商品模型：</th>
						<td>
							<select class="form-control " name="model_id" onchange="create_attr(this.value)">
								<option value="0">通用类型 </option>
								<?php foreach($items=Api::run('getModelListAll') as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
							<p class="help-block">可以加入商品扩展属性，比如：型号，年代，款式...</p>
						</td>
					</tr>
					<tr>
						<th>规格：</th>
						<td>
							<div class="row">
								<div class="col-xs-3">
		                            <select class='form-control' onchange='selSpecVal(this);' id='specNameSel'>
		                                <option value=''>选规格名称</option>
		                                <?php foreach($items=Api::run('getSpecListAll') as $key => $item){?>
		                                <option value='<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></option>
		                                <?php }?>
		                            </select>
		                        </div>

		                        <div class="col-xs-3">
		                            <select class='form-control' onchange='selSpec(this);' id='specValSel'>
		                            	<option value='0'>选规格数据</option>
		                            </select>
		                        </div>

		                        <div class="col-xs-2">
		                        	<button class="btn btn-default" onclick="addNewSpec(0);" type="button">新建规格</button>
		                        </div>
	                        </div>
	                        <p class="help-block">可从现有规格中选择或新建规格生成货品。比如：尺码，颜色，类型...</p>
						</td>
					</tr>
					<tr id="properties" style="display:none">
						<th>扩展属性：</th>
						<td>
							<table class="table table-bordered" id="propert_table">
							<script type='text/html' id='propertiesTemplate'>
							<tbody>
							<%for(var item in templateData){%>
							<%item = templateData[item]%>
							<%var valueItems = item['value'].split(',');%>
								<tr>
									<td><%=item["name"]%></td>
									<td>
										<%if(item['type'] == 1){%>
											<%for(var tempVal in valueItems){%>
												<%tempVal = valueItems[tempVal]%>
		                                        <label class="radio-inline">
		                                            <input type="radio" name="attr_id_<%=item['id']%>" value="<%=tempVal%>" ><%=tempVal%>
		                                        </label>
											<%}%>
										<%}else if(item['type'] == 2){%>
		                                    <%for(var tempVal in valueItems){%>
												<%tempVal = valueItems[tempVal]%>
	                                            <label class="checkbox-inline">
	                                                <input type="checkbox" name="attr_id_<%=item['id']%>[]" value="<%=tempVal%>" >><%=tempVal%>
	                                            </label>
											<%}%>
	                                    <%}else if(item['type'] == 3){%>
											<select class="form-control" name="attr_id_<%=item['id']%>">
											<%for(var tempVal in valueItems){%>
												<%tempVal = valueItems[tempVal]%>
												<option value="<%=tempVal%>"><%=tempVal%></option>
											<%}%>
											</select>
										<%}else if(item['type'] == 4){%>
											<input type="text" name="attr_id_<%=item['id']%>" value="<%=item['value']%>" class="form-control" />
										<%}%>
									</td>
								</tr>
							<%}%>
							</script>
							</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<th>商品推荐：</th>
						<td>
                            <label class="checkbox-inline">
                                <input type="checkbox" name='_goods_commend[]' value="1">最新商品
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name='_goods_commend[]' value="2">特价商品
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name='_goods_commend[]' value="3">热卖商品
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name='_goods_commend[]' value="4">推荐商品
                            </label>
						</td>
					</tr>
					<tr>
						<th>商品品牌：</th>
						<td>
							<select class="form-control" name="brand_id">
								<option value="0">请选择</option>
								<?php foreach($items=Api::run('getBrandListAllOnce') as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>产品相册：</th>
						<td>
							<input id="fileUpload" type="file" accept="image/png,image/gif,image/jpeg" name="_goodsFile" multiple="multiple" data-url="<?php echo IUrl::creatUrl("/goods/goods_img_upload");?>" />
							<p class="help-block" id="uploadPercent">可以上传多张图片，分辨率3000px以下，大小不得超过<?php echo IUpload::getMaxSize();?></p>
						</td>
					</tr>
					<tr>
						<td></td>
						<td id="thumbnails"></td>

						<!--图片模板-->
						<script type='text/html' id='picTemplate'>
						<div class='pic pull-left'>
							<img name="picThumb" onclick="defaultImage(this);" class="img-thumbnail" style="width:100px;height:100px" src="<%=webroot(picRoot)%>" alt="<%=picRoot%>" />
							<p class="text-center">
								<a href='javascript:;' onclick="$(this).parents('.pic').insertBefore($(this).parents('.pic').prev());"><i class="operator fa fa-backward" title="左移动"></i></a>
								<a href='javascript:;' onclick="$(this).parents('.pic').remove();"><i class="operator fa fa-close" title="删除"></i></a>
								<a href='javascript:;' onclick="$(this).parents('.pic').insertAfter($(this).parents('.pic').next());"><i class="operator fa fa-forward" title="右移动"></i></a>
							</p>
						</div>
						</script>
					</tr>
				</table>
			</div>

			<div class="tab-pane" id="tab2">
				<table class="table form-table">
					<colgroup>
						<col width="130px" />
						<col />
					</colgroup>
					<tr>
						<th>产品描述：</th>
						<td><textarea id="content" name="content" style="width:100%;height:400px;"></textarea></td>
					</tr>
				</table>
			</div>

			<div class="tab-pane" id="tab3">
				<table class="table form-table">
					<colgroup>
						<col width="130px" />
						<col />
					</colgroup>

					<tr>
						<th>SEO关键词：</th><td><input class="form-control" name="keywords" type="text" value="" /></td>
					</tr>
					<tr>
						<th>SEO描述：</th><td><textarea class="form-control" name="description"></textarea></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="text-center">
			<button class='btn btn-primary' type="submit" onclick="return checkForm()">发布商品</button>
		</div>
	</div>
	</form>
</div>

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

	//商品促销回填
	<?php if(isset($goods_commend)){?>
	formObj.setValue('_goods_commend[]',"<?php echo join(';',$goods_commend);?>");
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

//根据模型动态生成扩展属性
function create_attr(model_id)
{
	$.getJSON("<?php echo IUrl::creatUrl("/block/attribute_init");?>",{'model_id':model_id,'random':Math.random()}, function(json)
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
			<?php $attrArray[] = '"attr_id_'.$key.'[]":"'.join(";",IFilter::act($valArray)).'"'?>
			<?php $attrArray[] = '"attr_id_'.$key.'":"'.join(";",IFilter::act($valArray)).'"'?>
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
//设置规格区域的width值，可以自适应宽度出现滚动条
$('#productBox').css({"width":$('#productBox').parent().css('width')});
</script>
<script type="text/javascript" src="<?php echo IUrl::creatUrl("")."public/javascript/goods_edit.js";?>"></script>
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