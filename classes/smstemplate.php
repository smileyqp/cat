<?php
/**
 * @copyright (c) 2011 aircheng.com
 * @file smstemplate.php
 * @brief 短信发送模板
 * @author chendeshan
 * @date 2014/8/11 9:51:51
 * @version 2.9
 */

 /**
 * @class smsTemplate
 * @brief 短信发送模板
 */
class smsTemplate
{
	//短信模板信息不存在
	public static function __callStatic($funcname, $arguments)
	{
		return "";
	}

	/**
	 * @brief 订单发货的信息模板
	 * @param array $data 替换的数据
	 */
	public static function sendGoods($data = null)
	{
		$templateString = "您好{user_name},订单号:{order_no},已由{sendor}发货,物流公司:{delivery_company},物流单号:{delivery_no}";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 手机找回密码模板
	 * @param array $data 替换的数据
	 */
	public static function findPassword($data = null)
	{
		$templateString = "您的验证码为:{mobile_code},请注意保管!";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 手机短信校验码
	 * @param array $data 替换的数据
	 */
	public static function checkCode($data = null)
	{
		$templateString = "您的验证码为:{mobile_code},请注意保管!";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 自提点确认短信
	 * @param array $data 替换的数据
	 */
	public static function takeself($data = null)
	{
		$templateString = "您的订单号:{orderNo},{name}自提地址:{address},领取验证码:{mobile_code},请尽快领取";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 商户注册提示管理员
	 * @param array $data 替换的数据
	 */
	public static function sellerReg($data = null)
	{
		$templateString = "{true_name},申请加盟到平台,请尽快登录后台进行处理";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 商户处理结果
	 * @param array $data 替换的数据
	 */
	public static function sellerCheck($data = null)
	{
		$templateString = "您申请的加盟商状态已经被修改为:{result}状态,请登录您的商户后台查看具体的详情";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 订单付款通知管理员
	 */
	public static function payFinishToAdmin($data = null)
	{
		$templateString = "商城订单:{orderNo},已经付款,请尽快登录后台进行处理";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 订单付款通知管理员
	 */
	public static function payFinishToUser($data = null)
	{
		$templateString = "您的订单号:{orderNo},已付款成功,稍后我们会尽快为您服务";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 到货通知模板
	 * @param array $data 替换的数据
	 */
	public static function notify($data = null)
	{
		$templateString = "尊敬的用户，您需要购买的 <{goodsName}> 现已全面到货，机不可失，从速购买！{url}; 退订回N";
		return strtr($templateString,$data);
	}

	/**
	 * @brief 订单已被自提信息模板
	 * @param array $data 替换的数据
	 */
	public static function takeselfGoods($data = null)
	{
		$templateString = "您好{user_name},订单号:{order_no},在{takeself}已经成功提货";
		return strtr($templateString,$data);
	}
}