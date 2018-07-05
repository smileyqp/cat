<?php
/**
 * @copyright (c) 2014 aircheng.com
 * @file other.php
 * @brief 其他api方法
 * @author chendeshan
 * @date 2016/4/11 12:54:16
 * @version 4.4
 */
class APIOther
{
	//获取促销规则
	public function getProrule($seller_id = 0)
	{
		$seller_id  = IFilter::act($seller_id,'int');
		$proRuleObj = new ProRule(999999999,$seller_id);
		$proRuleObj->isGiftOnce = false;
		$proRuleObj->isCashOnce = false;
		return $proRuleObj->getInfo();
	}

	//获取支付方式
	public function getPaymentList()
	{
		$user_id = IWeb::$app->getController()->user['user_id'];
		$where = 'status = 0';

		if(!$user_id)
		{
			$where .= " and class_name != 'balance' ";
		}

		switch(IClient::getDevice())
		{
			//移动支付
			case IClient::MOBILE:
			{
				//如果是微信客户端,必须用微信专用支付
				if(IClient::isWechat() == true)
				{
					$where .= " and class_name in ( 'wap_wechat','balance','wap_unionpay' ) ";
				}
				//如果是微信小程序，必须用小程序专用支付
				else if(IClient::isMini() == true)
				{
					$where .= " and class_name in ( 'mini_wechat','balance' ) ";
				}
				else
				{
					$where .= " and client_type in(2,3) and class_name not in ('wap_wechat','mini_wechat') ";

					//如果不是APP客户端，就要屏蔽纯APP支付
					if(IClient::isApp() == false)
					{
						$where .= " and class_name not like 'app_%' ";
					}
				}
				//追加线下支付方式
				$where .= " or (type = 2 and client_type in(2,3) and status = 0) ";
			}
			break;

			//pc支付
			case IClient::PC:
			{
				$where .= ' and client_type in(1,3) ';
			}
			break;
		}
		$paymentDB = new IModel('payment');
		return $paymentDB->query($where,"*","`order` asc");
	}

	//线上充值的支付方式
	public function getPaymentListByOnline()
	{
		$where = " type = 1 and status = 0 and class_name not in ('balance','offline') ";
		switch(IClient::getDevice())
		{
			//移动支付
			case IClient::MOBILE:
			{
				//如果是微信客户端,必须用微信专用支付
				if(IClient::isWechat() == true)
				{
					$where .= " and class_name in ( 'wap_wechat','wap_unionpay') ";
				}
				//如果是微信小程序，必须用小程序专用支付
				else if(IClient::isMini() == true)
				{
					$where .= " and class_name in ( 'mini_wechat' ) ";
				}
				else
				{
					$where .= " and client_type in(2,3) and class_name not in ('wap_wechat','mini_wechat') ";

					//如果不是APP客户端，就要屏蔽纯APP支付
					if(IClient::isApp() == false)
					{
						$where .= " and class_name not like 'app_%' ";
					}
				}
			}
			break;

			//pc支付
			case IClient::PC:
			{
				$where .= ' and client_type in(1,3) ';
			}
			break;
		}

		$paymentDB = new IModel('payment');
		return $paymentDB->query($where,"*","`order` asc");
	}

	//获取banner数据
	public function getBannerList()
	{
	    $bannerDB = new IQuery('banner');
	    $bannerList = $bannerDB->find();
	    if ($bannerList)
	    {
	        return $bannerList;
	    }
	    $cacheObj = new ICache();
		$defaultBanner = $cacheObj->get('defaultBanner');
		if(!$defaultBanner)
		{
			$defaultBanner = file_get_contents("http://product.aircheng.com/proxy/defaultBanner");
			$cacheObj->set('defaultBanner',$defaultBanner);
		}
		return JSON::decode($defaultBanner);
	}

	//获取默认广告位数据
	public function getAdRow($adName)
	{
		$isCache   = true;
		$cacheObj  = new ICache();
		$defaultAd = $cacheObj->get('ad'.$adName);
		if(!$defaultAd || $isCache == false)
		{
			$ch = curl_init("https://product.aircheng.com/proxy/getAdRow");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "name=".$adName);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			$defaultAd = curl_exec($ch);
			$cacheObj->set('ad'.$adName,$defaultAd);
		}
		return $defaultAd;
	}
}