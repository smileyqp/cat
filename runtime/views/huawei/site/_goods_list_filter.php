<!-- 商品价格\品牌展示\商品属性 -->
<section class="goods_tag">
	<!--品牌展示-->
	<?php $brandList = search_goods::$brandSearch?>
	<?php if($brandList){?>
	<dl>
		<dt><div>品牌:</div></dt>
		<dd id='brand_dd'>
			<a class="current" href="<?php echo search_goods::searchUrl('brand','');?>">不限</a>
			<?php foreach($items=$brandList as $key => $item){?>
			<a href="<?php echo search_goods::searchUrl('brand',$item['id']);?>" id='brand_<?php echo isset($item['id'])?$item['id']:"";?>'><?php echo isset($item['name'])?$item['name']:"";?></a>
			<?php }?>
		</dd>
	</dl>
	<?php }?>
	<!--品牌展示-->
	<!--商品属性-->
	<?php foreach($items=search_goods::$attrSearch as $key => $item){?>
	<dl>
		<dt><div><?php echo isset($item['name'])?$item['name']:"";?>:</div></dt>
		<dd id='attr_dd_<?php echo isset($item['id'])?$item['id']:"";?>'>
			<a class="current" href="<?php echo search_goods::searchUrl('attr['.$item["id"].']','');?>">不限</a>
			<?php foreach($items=$item['value'] as $key => $attr){?>
			<a href="<?php echo search_goods::searchUrl('attr['.$item["id"].']',$attr);?>" id="attr_<?php echo isset($item['id'])?$item['id']:"";?>_<?php echo md5($attr);?>"><?php echo isset($attr)?$attr:"";?></a>
			<?php }?>
		</dd>
	</dl>
	<?php }?>
	<!--商品属性-->
	<!--商品价格-->
	<dl>
		<dt><div>价格:</div></dt>
		<dd id='price_dd'>
			<a class="current" href="<?php echo search_goods::searchUrl(array('min_price','max_price'),'');?>">不限</a>
			<?php foreach($items=search_goods::$priceSearch as $key => $item){?>
			<?php $priceZone = explode('-',$item)?>
			<a href="<?php echo search_goods::searchUrl(array('min_price','max_price'),array($priceZone[0],$priceZone[1]));?>" id="<?php echo isset($item)?$item:"";?>"><?php echo isset($item)?$item:"";?></a>
			<?php }?>
			<p class="condition">
				<input type="text" name="min_price"> 至 <input type="text" name="max_price"> 元
				<button onclick="priceLink();">确定</button>
			</p>
		</dd>
	</dl>
	<!--商品价格-->
</section>
<!-- 商品价格\品牌展示\商品属性 -->

<!--商品排序展示-->
<section class="goods_sort">
	<h3><div>排序:</div></h3>
	<ul>
		<?php foreach($items=search_goods::getOrderType() as $key => $item){?>
		<li id="order_<?php echo isset($key)?$key:"";?>">
			<a href="<?php echo search_goods::searchUrl(array('order','by'),array($key,search_goods::getOrderBy($key)));?>"><?php echo isset($item)?$item:"";?></a>
		</li>
		<?php }?>
	</ul>
</section>
<!--商品排序展示-->

<script type='text/javascript'>
//价格跳转
function priceLink(){
	var minVal = $('input[name="min_price"]').val();
	var maxVal = $('input[name="max_price"]').val();
	if(isNaN(minVal) || isNaN(maxVal)){
		alert('价格填写不正确');
		return '';
	}
	var searchUrl = "<?php echo search_goods::searchUrl(array('min_price','max_price'),array('__min_price__','__max_price__'));?>";
	searchUrl     = searchUrl.replace("__min_price__",minVal).replace("__max_price__",maxVal);
	window.location.href = searchUrl;
}

//筛选条件按钮高亮
$(function(){
	//品牌模块高亮和预填充
	<?php $brand = IFilter::act(IReq::get('brand'),'int');?>
	<?php if($brand){?>
	$('#brand_dd>*').removeClass('current');
	$('#brand_<?php echo isset($brand)?$brand:"";?>').addClass('current');
	<?php }?>

	//属性模块高亮和预填充
	<?php $tempArray = IReq::get('attr')?>
	<?php if($tempArray){?>
		<?php $json = JSON::encode(array_map('md5',$tempArray))?>
		var attrArray = <?php echo isset($json)?$json:"";?>;
		for(val in attrArray)
		{
			if(attrArray[val])
			{
				$('#attr_dd_'+val+'>*').removeClass('current');
				$('#attr_'+val+'_'+attrArray[val]).addClass('current');
			}
		}
	<?php }?>

	//价格模块高亮和预填充
	<?php if(IReq::get('min_price') || IReq::get('max_price')){?>
	<?php $priceId = IFilter::act(IReq::get('min_price'))."-".IFilter::act(IReq::get('max_price'))?>
	$('#price_dd>*').removeClass('current');
	$('#<?php echo isset($priceId)?$priceId:"";?>').addClass('current');
	$('input[name="min_price"]').val("<?php echo IFilter::act(IReq::get('min_price'));?>");
	$('input[name="max_price"]').val("<?php echo IFilter::act(IReq::get('max_price'));?>");
	<?php }?>

	//排序字段
	<?php $orderValue = IFilter::act(IReq::get('order'))?>
	<?php if($orderValue){?>
	$('#order_<?php echo isset($orderValue)?$orderValue:"";?>').addClass('current');
	<?php }?>

	//顺序
	<?php $byValue = IReq::get('by')?>
	<?php if($byValue == "desc"){?>
	$('#order_<?php echo isset($orderValue)?$orderValue:"";?>').addClass('desc');
	<?php }else{?>
	$('#order_<?php echo isset($orderValue)?$orderValue:"";?>').addClass('asc');
	<?php }?>

	//显示方式
	<?php $showType = IReq::get('show_type');?>
	<?php if($showType == "win"){?>
	$('[name="goodsItems"]').attr({"class":"clearfix win"});
	$('[name="goodsImage"]').css({"width":200,"height":200});
	$('#winButton').addClass('active');
	<?php }elseif($showType == "list"){?>
	$('[name="goodsItems"]').attr({"class":"clearfix list"});
	$('[name="goodsImage"]').css({"width":115,"height":115});
	$('#listButton').addClass('active');
	<?php }?>
});
</script>
