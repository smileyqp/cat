<?php
/**
 * @copyright Copyright(c) 2011 aircheng.com
 * @file util.php
 * @brief 公共函数类
 * @author kane
 * @date 2011-01-13
 * @version 0.6
 * @note
 */

 /**
 * @class Util
 * @brief 公共函数类
 */
class Util
{
	/**
	 * @brief 显示错误信息（dialog框）
	 * @param string $message	错误提示字符串
	 */
	public static function showMessage($message)
	{
		echo '<script type="text/javascript">typeof(tips) == "function" ? tips("'.$message.'") : alert("'.$message.'");</script>';
		exit;
	}

	//字符串拼接
	public static function joinStr($id)
	{
		if(is_array($id))
		{
			$where = "id in (".join(',',$id).")";
		}
		else
		{
			$where = 'id = '.$id;
		}
		return $where;
	}

	/**
	 * 商品价格格式化
	 * @param $price float 商品价
	 * @return float 格式化后的价格
	 */
	public static function priceFormat($price)
	{
		return round($price,2);
	}

	/**
	 * 检索自动执行
	 * @param array $search 查询拼接规则， key(字段) => like,likeValue(数据)
	 */
	public static function search($search)
	{
		$where = array(1);
		if($search && is_array($search))
		{
			//like子句处理
			if(isset($search['like']) && $search['likeValue'])
			{
				$search['like']      = IFilter::act($search['like'],"strict");
				$search['likeValue'] = IFilter::act($search['likeValue']);

				$where[] = $search['like']." like '%".$search['likeValue']."%' ";
			}
			unset($search['like']);
			unset($search['likeValue']);

			//自定义子句处理
			foreach($search as $key => $val)
			{
				$key = IFilter::act($key,'strict');
				$val = IFilter::act($val,'strict');

				if($val === '' || $key === '' || $val == 'favicon.ico')
				{
					continue;
				}

				if( strpos($key,'num') !== false || in_array($val[0],array("<",">","=")) )
				{
					$where[] = $key." ".$val;
				}
				else
				{
					$where[] = $key."'".$val."'";
				}
			}
		}
		return join(" and ",$where);
	}

	/**
	 * @brief 计算折扣率
	 * @param $originalPrice float 原价
	 * @param $nowPrice float 现价
	 * @return float 折扣数
	 */
	public static function discount($originalPrice,$nowPrice)
	{
		if($originalPrice >= $nowPrice)
		{
			return round($nowPrice/$originalPrice,2)*10;
		}
		return "";
	}
}