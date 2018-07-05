<?php
/**
 * @copyright (c) 2011 aircheng.com
 * @file service.php
 * @brief 外部调用服务类，可以给APP应用提供JSON数据结构
 * @author nswe
 * @date 2018/4/13 9:27:08
 * @version 5.1
 * @note 所有的请求都需要签名验证，通过priKey方法获取密钥，然后把参数进行md5加密
 */
class service extends IController
{
	//请求接口方法名
	private $method = '';

	//请求的参数
	private $param = '';

	//数据
	public $data = '';

	//初始化函数,校验API
	public function init()
	{
		$sign  = IReq::get('sign');
		$param = array(
			'method' => IReq::get('method'),//方法名字
			'rand'   => IReq::get('rand'),//随机数字
			'time'   => IReq::get('time'),//请求的时间戳
		);

		//扩展参数的处理
		$sendParam = IFilter::act(IReq::get('param'));
		if($sendParam)
		{
			$param['param'] = $sendParam;
		}

		//1,检测数据完整性
		if(in_array('',$param) || !$sign)
		{
			$this->setError("API接口缺少必要参数");
		}
		//2,随机数不够标准
		else if(strlen($param['rand']) <= 5)
		{
			$this->setError("随机数字必须大于5位");
		}
		//3,校验时间是否超时
		else if($param['time']+30 <= time())
		{
			$this->setError("有效时间已过");
		}
		//4,md5加密对比sign是否合法
		else if($this->sign($param) != $sign)
		{
			$this->setError("sign非法");
		}

		//有报错信息程序终止
		if($this->getError())
		{
			$this->show();
			exit;
		}
		$this->method = $param['method'];
		$this->param  = $sendParam;
	}

	//执行接口
	public function api()
	{
		try
		{
			$param    = array($this->method);
			$urlParam = IFilter::act(IReq::get('param'));

			//对参数的处理
			if($urlParam)
			{
				if(is_array($urlParam))
				{
					foreach($urlParam as $k => $v)
					{
						$param[] = !$k || is_numeric($k) ? $v : array("#".$k."#",$v);
					}
				}
				else if(is_string($urlParam))
				{
					$param[] = $urlParam;
				}
			}
			Api::$type = 'out';//设置API类的使用方式远程调用
			$resource  = call_user_func_array(array("Api","run"),$param);
			if($resource instanceof IQuery)
			{
				$this->data = $resource->find();
			}
			else
			{
				$this->data = $resource;
			}
		}
		catch(Exception $e)
		{
			$this->setError($e->getMessage());
		}
		$this->show();
	}

	/**
	 * @brief 输出结果
	 * @param $result array('data' => '结果数据','status' => '执行状态success or fail','error' => '错误内容') 数据结果
	 */
	private function show()
	{
		$result = array('data' => $this->data,'status' => 'fail','error' => $this->getError());

		//正常
		if(!$result['error'])
		{
			$result['status'] = 'success';
		}
		echo $this->encode($result);
	}

	/**
	 * @brief 转换数据结构
	 * @param $data array  待转换的数据
	 * @param $type string 数据类型json
	 * @return string 数据结果
	 */
	private function encode($data,$type = 'json')
	{
		switch($type)
		{
			case "json":
			{
				$data = JSON::encode($data);
			}
			break;
		}
		return $data;
	}

	/**
	 * @brief 加密算法
	 * @param array $param 加密的数据
	 * @return 签名数据
	 */
	private function sign($param)
	{
		$key = $this->getPriKey();//通讯密钥
		ksort($param);
		reset($param);
		return md5(http_build_query($param).$key);
	}

	/**
	 * @brief 获取通讯密钥
	 * @return string 密钥
	 * @tips 默认密钥在config/config.php中的encryptKey字段
	 */
	private function getPriKey()
	{
		return IWeb::$app->config['encryptKey'];
	}
}