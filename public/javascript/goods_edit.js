//初始化货品表格
function initProductTable()
{
	//默认产生一条商品标题空挡
	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':[]});
	$('#goodsBaseHead').html(goodsHeadHtml);

	//默认产生一条商品空挡
	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':[[]]});
	$('#goodsBaseBody').html(goodsRowHtml);
}

//选择规格值后重新生成货品
function selSpec(obj)
{
	var specIsHere    = getIsHereSpec();
	var specValueData = specIsHere.specValueData;
	var specData      = specIsHere.specData;

	//追加新建规格
	var jsonData = $(obj).find("option:selected").val();
	if(!jsonData)
	{
		return;
	}
	var json = $.parseJSON(jsonData);

	//判断规格数据是否重复
	if(specValueData[json.name])
	{
		for(var k in specValueData[json.name])
		{
			if(specValueData[json.name][k]['tip'] == json.tip && specValueData[json.name][k]['value'] == json.value)
			{
				alert('规格值重复');
				return;
			}
		}
	}
	else
	{
		specData[json.name]      = json;
		specValueData[json.name] = [];
	}
	specValueData[json.name].push({"tip":json.tip,"value":json.value});
	createProductList(specData,specValueData);
}

//根据规格ID通过ajax获取规格值
function selSpecVal(obj)
{
	var spec_id    = $(obj).val();
	var optionHtml = '<option value="">选择规格值</option>';
	$.getJSON(creatUrl("block/spec_value_list"),{"id":spec_id},function(json)
	{
		if(json.value)
		{
			var valObj = $.parseJSON(json.value);
			for(var i in valObj)
			{
				json.tip   = i;
				json.value = valObj[i];
				optionHtml+= "<option value='"+JSON.stringify(json)+"'>"+i+"</option>";
			}
			$('#specValSel').html(optionHtml);
		}
	});
	$('#specValSel').html(optionHtml);
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

//笛卡儿积组合
function descartes(list,specData)
{
	//parent上一级索引;count指针计数
	var point  = {};

	var result = [];
	var pIndex = null;
	var tempCount = 0;
	var temp   = [];

	//根据参数列生成指针对象
	for(var index in list)
	{
		if(typeof list[index] == 'object')
		{
			point[index] = {'parent':pIndex,'count':0}
			pIndex = index;
		}
	}

	//单维度数据结构直接返回
	if(pIndex == null)
	{
		return list;
	}

	//动态生成笛卡尔积
	while(true)
	{
		for(var index in list)
		{
			tempCount = point[index]['count'];
			var itemSpecData = list[index][tempCount];
			temp.push({"id":specData[index].id,"type":specData[index].type,"name":specData[index].name,"value":itemSpecData.value,"tip":itemSpecData.tip});
		}

		//压入结果数组
		result.push(temp);
		temp = [];

		//检查指针最大值问题
		while(true)
		{
			if(point[index]['count']+1 >= list[index].length)
			{
				point[index]['count'] = 0;
				pIndex = point[index]['parent'];
				if(pIndex == null)
				{
					return result;
				}

				//赋值parent进行再次检查
				index = pIndex;
			}
			else
			{
				point[index]['count']++;
				break;
			}
		}
	}
}

//获取已经存在的规格
function getIsHereSpec()
{
	//开始遍历规格
	var specValueData = {};
	var specData      = {};

	//规格已经存在的数据
	if($('input:hidden[name^="_spec_array"]').length > 0)
	{
		$('input:hidden[name^="_spec_array"]').each(function()
		{
			var json = $.parseJSON(this.value);
			if(!specValueData[json.name])
			{
				specData[json.name]      = json;
				specValueData[json.name] = [];
			}

			//去掉spec_array中的已经添加的重复值
			for(var i in specValueData[json.name])
			{
				for(var item in specValueData[json.name][i])
				{
					item = specValueData[json.name][i];
					if(item.value == json.value && item.tip == json.tip)
					{
						return;
					}
				}
			}
			specValueData[json.name].push({"tip":json.tip,"value":json.value});
		});
	}
	return {"specData":specData,"specValueData":specValueData};
}

/**
 * @brief 根据规格数据生成货品序列
 * @param object specData规格数据对象
 * @param object specValueData 规格值对象集合
 */
function createProductList(specData,specValueData)
{
	//生成货品的笛卡尔积
	var specMaxData = descartes(specValueData,specData);

	//生成最终的货品数据
	var productList = [];
	for(var i = 0;i < specMaxData.length;i++)
	{
		//从表单中获取默认商品数据
		var productJson = {};
		var defaultIndex = $('#goodsBaseBody tr').length > i ? i : i%$('#goodsBaseBody tr').length;
		$('#goodsBaseBody tr:eq('+defaultIndex+')').find('input[type="text"]').each(function(){
			productJson[this.name.replace(/^_(\w+)\[\d+\]/g,"$1")] = this.value;
		});

		var productItem = {};
		for(var index in productJson)
		{
			//自动组建货品号
			if(index == 'goods_no')
			{
				//值为空时设置默认货号
				if(productJson[index] == '')
				{
					productJson[index] = defaultProductNo;
				}

				if(productJson[index].match(/(?:\-\d*)$/) == null)
				{
					//正常货号生成
					productItem['goods_no'] = productJson[index]+'-'+(i+1);
				}
				else
				{
					//货号已经存在则替换
					productItem['goods_no'] = productJson[index].replace(/(?:\-\d*)$/,'-'+(i+1));
				}
			}
			else
			{
				productItem[index] = productJson[index];
			}
		}
		productItem['spec_array'] = specMaxData[i];
		productList.push(productItem);
	}

	//创建规格标题
	var goodsHeadHtml = template.render('goodsHeadTemplate',{'templateData':specData});
	$('#goodsBaseHead').html(goodsHeadHtml);

	//创建货品数据表格
	var goodsRowHtml = template.render('goodsRowTemplate',{'templateData':productList});
	$('#goodsBaseBody').html(goodsRowHtml);

	if($('#goodsBaseBody tr').length == 0)
	{
		initProductTable();
	}
}

/**
 * 图片上传回调,handers.js回调
 * @param picJson => {'flag','img','list','show'}
 */
function uploadPicCallback(picJson)
{
	var picHtml = template.render('picTemplate',{'picRoot':picJson.img});
	$('#thumbnails').append(picHtml);

	//默认设置第一个为默认图片
	if($('#thumbnails img[name="picThumb"][class="current"]').length == 0)
	{
		$('#thumbnails img[name="picThumb"]:first').addClass('current');
	}
}

/**
 * 设置商品默认图片
 */
function defaultImage(_self)
{
	$('#thumbnails img[name="picThumb"]').removeClass('current');
	$(_self).addClass('current');
}

//删除规格
function delSpec(specId)
{
	$('input:hidden[name^="_spec_array"]').each(function()
	{
		var json = $.parseJSON(this.value);
		if(json.id == specId)
		{
			$(this).remove();
		}
	});

	//当前已经存在的规格数据
	var specIsHere = getIsHereSpec();
	createProductList(specIsHere.specData,specIsHere.specValueData);
}

//jquery图片上传
$('[name="_goodsFile"]').fileupload({
    dataType: 'json',
    done: function (e, data)
    {
    	if(data.result && data.result.flag == 1)
    	{
    		uploadPicCallback(data.result);
    	}
    	else
    	{
    		alert(data.result.error);
    		$('#uploadPercent').text(data.result.error);
    	}
    },
    progressall: function (e, data)
    {
        var progress = parseInt(data.loaded / data.total * 100);
        $('#uploadPercent').text("加载完成："+progress+"%");
    }
});

/**
 * 会员价格
 * @param obj 按钮所处对象
 */
function memberPrice(obj,seller_id)
{
	var sellerId  = seller_id ? seller_id : 0;
	var sellPrice = $(obj).siblings('input[name^="_sell_price"]')[0].value;
	if($.isNumeric(sellPrice) == false)
	{
		alert('请先设置商品的价格再设置会员价格');
		return;
	}

	var groupPriceValue = $(obj).siblings('input[name^="_groupPrice"]');

	//用户组的价格
	art.dialog.data('groupPrice',groupPriceValue.val());

	//开启新页面
	var tempUrl = creatUrl("goods/member_price/sell_price/@sell_price@/seller_id/@seller_id@");
	tempUrl = tempUrl.replace('@sell_price@',sellPrice).replace('@seller_id@',sellerId);
	art.dialog.open(tempUrl,{
		id:'memberPriceWindow',
	    title: '会员价格',
	    ok:function(iframeWin, topWin)
	    {
	    	var formObject = iframeWin.document.forms['groupPriceForm'];
	    	var groupPriceObject = {};
	    	$(formObject).find('input[name^="groupPrice"]').each(function(){
	    		if(this.value != '')
	    		{
	    			//去掉前缀获取group的ID
		    		var groupId = this.name.replace('groupPrice','');

		    		//拼接json串
		    		groupPriceObject[groupId] = this.value;
	    		}
	    	});

	    	//更新会员价格值
    		var temp = [];
    		for(var gid in groupPriceObject)
    		{
    			temp.push('"'+gid+'":"'+groupPriceObject[gid]+'"');
    		}
    		groupPriceValue.val('{'+temp.join(',')+'}');
    		return true;
		}
	});
}