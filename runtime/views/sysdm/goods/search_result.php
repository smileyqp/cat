<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品检索列表</title>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/php/newshop04/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/php/newshop04/runtime/_systemjs/artdialog/skins/aero.css" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="min-width:620px;margin-top:10px;height:550px;overflow-y:scroll">
	<table class="table table-bordered">
		<colgroup>
			<col width="150px" />
			<col />
			<col width="90px" />
			<col width="70px" />
		</colgroup>

		<tbody>
			<?php if($this->goodsData){?>
			<?php foreach($items=$this->goodsData as $key => $item){?>
			<tr>
				<td>
					<div class="<?php echo $this->type;?>">
						<label>
							<input type='<?php echo $this->type;?>' name='id[]' value="<?php echo isset($item['goods_id'])?$item['goods_id']:"";?>" id="goods<?php echo isset($key)?$key:"";?>" />
							<?php echo isset($item['goods_no'])?$item['goods_no']:"";?>
						</label>
						<script>$("#goods<?php echo isset($key)?$key:"";?>").attr('data',JSON.stringify(<?php echo JSON::encode($item);?>));</script>
					</div>
				</td>
				<td>
					<?php echo isset($item['name'])?$item['name']:"";?>

					<?php $spec_array=goods_class::show_spec($item['spec_array']);?>
					<p><?php foreach($items=$spec_array as $specName => $specValue){?><?php echo isset($specName)?$specName:"";?>：<?php echo isset($specValue)?$specValue:"";?> &nbsp;&nbsp;<?php }?></p>
				</td>
				<td>￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></td>
				<td><img src="<?php echo IUrl::creatUrl("".$item['img']."");?>" width="45px" /></td>
			</tr>
			<?php }?>
			<?php }else{?>
			<tr>
				<td colspan="4">对不起，没有找到相关商品</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
</body>
</html>
