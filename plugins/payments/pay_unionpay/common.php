<?php
class CommonPay
{
	// ######(以下配置为PM环境：入网测试环境用，生产环境配置见文档说明)#######
	// 签名证书（私钥）路径
	const SDK_SIGN_CERT_PATH = 'key/700000000000001_acp.pfx';
	// 签名证书密码
	static $SDK_SIGN_CERT_PWD = '000000';
	// 验签证书
	const SDK_ENCRYPT_CERT_PATH = 'key/verify_sign_acp.cer';

	// 验签证书路径（请配到文件夹，不要配到具体文件）
	const SDK_VERIFY_CERT_DIR ='key';

	static function setCertPwd($cert_pwd)
	{
		self::$SDK_SIGN_CERT_PWD = $cert_pwd;
	}

	/**
	 * 数组 排序后转化为字体串
	 *
	 * @param array $params
	 * @param boolen 是否编码
	 * @param boolen 是否包括签名
	 * @return string
	 */
	public static function coverParamsToString($params,$encode = false,$isIncludeSign = false)
	{
		$sign_str = '';
		// 排序
		ksort ( $params );
		foreach ( $params as $key => $val )
		{
			if ($isIncludeSign == false && $key == 'signature')
			{
				continue;
			}

			if($encode == true)
			{
				$val = urlencode($val);
			}
			$sign_str .= $key . '=' . $val . '&';
		}
		return trim($sign_str,'&');
	}

	/**
	 * 签名
	 *
	 * @param String $params_str
	 */
	static function sign(&$params)
	{
		if(isset($params['transTempUrl']))
		{
			unset($params['transTempUrl']);
		}
		// 转换成key=val&串
		$params_str = self::coverParamsToString ( $params );

		$params_sha1x16 = sha1 ( $params_str, FALSE );
		// 签名证书路径
		$cert_path = self::SDK_SIGN_CERT_PATH;
		$private_key = self::getPrivateKey ( $cert_path );
		// 签名
		$sign_falg = openssl_sign ( $params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1 );
		if ($sign_falg)
		{
			$signature_base64 = base64_encode ( $signature );
			$params['signature'] = $signature_base64;
		}
		else
		{
			exit ( ">>>>>签名失败<<<<<<<" );
		}
	}

	/**
	 * 验签
	 *
	 * @param String $params_str
	 * @param String $signature_str
	 */
	static function verify($params)
	{
		$public_key = self::getPulbicKeyByCertId( $params ['certId'] );

		// 签名串
		$signature_str = $params['signature'];
		unset( $params['signature'] );
		$params_str     = self::coverParamsToString ( $params );
		$signature      = base64_decode ( $signature_str );
		$params_sha1x16 = sha1 ( $params_str, FALSE );
		return openssl_verify ( $params_sha1x16, $signature,$public_key, OPENSSL_ALGO_SHA1 );
	}

	/**
	 * 根据证书ID 加载 证书
	 *
	 * @param unknown_type $certId
	 * @return string NULL
	 */
	static function getPulbicKeyByCertId($certId)
	{
		// 证书目录
		$cert_dir = self::SDK_VERIFY_CERT_DIR;
		$handle = opendir ( dirname(__FILE__)."/".$cert_dir );
		if ($handle)
		{
			while (( $file = readdir ( $handle ) )!== false)
			{
				clearstatcache ();
				$filePath = $cert_dir . '/' . $file;
				if (is_file ( dirname(__FILE__)."/".$filePath ))
				{
					if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'cer')
					{
						if (self::getCertIdByCerPath ( $filePath ) == $certId)
						{
							closedir ( $handle );
							return self::getPublicKey ( $filePath );
						}
					}
				}
			}
		}
		else
		{
			exit ( '证书目录 ' . $cert_dir . '不正确' );
		}
		closedir ( $handle );
		die("在证书目录中没有找到 <公钥验签证书> ");
	}

	/**
	 * 取证书ID(.pfx)
	 * @return unknown
	 */
	static function getCertId($cert_path)
	{
		$pkcs12certdata = file_get_contents ( dirname(__FILE__).'/'.$cert_path );
		openssl_pkcs12_read( $pkcs12certdata, $certs, self::$SDK_SIGN_CERT_PWD );
		$x509data = $certs['cert'];
		openssl_x509_read( $x509data );
		$certdata = openssl_x509_parse ( $x509data );
		return $certdata ['serialNumber'];
	}

	/**
	 * 取证书ID(.cer)
	 * @param unknown_type $cert_path
	 */
	static function getCertIdByCerPath($cert_path)
	{
		$x509data = file_get_contents (dirname(__FILE__).'/'.$cert_path );
		openssl_x509_read ( $x509data );
		$certdata = openssl_x509_parse ( $x509data );
		return $certdata['serialNumber'];
	}

	/**
	 * 签名证书ID
	 * @return unknown
	 */
	static function getSignCertId()
	{
		// 签名证书路径
		return self::getCertId ( self::SDK_SIGN_CERT_PATH );
	}

	/**
	 * 取证书公钥 -验签
	 * @return string
	 */
	static function getPublicKey($cert_path)
	{
		return file_get_contents ( dirname(__FILE__).'/'.$cert_path );
	}

	/**
	 * 返回(签名)证书私钥
	 * @return unknown
	 */
	static function getPrivateKey($cert_path)
	{
		$pkcs12 = file_get_contents ( dirname(__FILE__).'/'.$cert_path );
		openssl_pkcs12_read( $pkcs12, $certs, self::$SDK_SIGN_CERT_PWD );
		return $certs ['pkey'];
	}
}