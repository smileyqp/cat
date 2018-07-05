<?php
/**
 * @copyright (c) 2011 aircheng.com
 * @file api.php
 * @brief api入口类
 * @author chendeshan
 * @date 2018/4/3 19:08:14
 * @version 5.1
 */
define('API_PATH',dirname(__FILE__).'/api/');
/**
 * @class Api
 * @brief api处理类
 *
 * $data = Api::run(接口名字,参数...) 接口名字定义于 api_resource.php 文件中，有2种方式即：query标签式 和 class 自定义式
 * 其中的参数是以匿名的方式传送到接口里面的，在query标签式里面可以传入int类型，表示显示的数量如10；除此之外则是排序字段如 'id+'或'id-'
 * 在class自定义式里面则是根据
 * 具体的函数定义去传递参数
 */
class Api
{
	//已经存在的api对象集[单例]
	private static $apiInstance = array();

	//api资源配置信息[单例]
	private static $apiResource = array();

	//运行方式，(1)远程外部API【out】; (2)系统内部调用【in】
	public static $type = 'in';

    /**
     * @brief api调用接口
     * @param string $apiName API名称
     * @return mixed
     */
	public static function run($apiName)
	{
		//载入api资源配置信息
		if(empty(self::$apiResource))
		{
			self::$apiResource = include(API_PATH.'api_resource.php');

			//载入主题config中定义的api
			$themeConfig = IWeb::$app->getController()->getViewPath()."config.php";
			if(is_file($themeConfig) && ($themeApi = include($themeConfig)) && isset($themeApi['api']) && is_array($themeApi['api']) && $themeApi['api'])
			{
				self::$apiResource = array_merge(self::$apiResource,$themeApi['api']);
			}
		}

		//资源配置信息中不存在当前调用的API
		if(!isset(self::$apiResource[$apiName]))
		{
			self::error($apiName,'api is undefined');
		}

		//匿名参数处理
		$agumentsArray = func_get_args();
		array_shift($agumentsArray);

		$apiConf = self::$apiResource[$apiName];

		//1,单纯的数据库读取方式
		if(isset($apiConf['query']) && $apiConf['query'])
		{
			return self::query($apiConf['query'],$agumentsArray);
		}
		//2,自定义处理方式
		else
		{
			$fileName   = isset($apiConf['file'])  ? $apiConf['file']  : '';
			$className  = isset($apiConf['class']) ? $apiConf['class'] : '';
			$methodName = $apiName;

			if(!$fileName || !$className)
			{
				self::error($apiName,'param is lack');
			}

			//如果当前API中的自定义处理对象已经存在,则直接调用 [缓存]
			if(isset(self::$apiInstance[$className]) && (self::$apiInstance[$className] instanceof $className))
			{
				return call_user_func_array(array(self::$apiInstance[$className],$methodName),$agumentsArray);
			}
			//自定义对象不存在则需要创建
			else
			{
				if(file_exists(API_PATH.$fileName))
				{
					include(API_PATH.$fileName);
					if(!class_exists($className))
					{
						self::error($apiName,'class is not exists');
					}

					$apiObj = new $className;
					self::$apiInstance[$className] = $apiObj;
					return call_user_func_array(array($apiObj,$methodName),$agumentsArray);
				}
				else
				{
					self::error($apiName,'file is not exists');
				}
			}
		}
	}

    /**
     * @brief 单纯数据库查询api统一处理方法
     * @param array $queryInfo 数据查询配置信息
     * @param array $aguments  排序和限制条数(order,limit)
     * @return array
     */
	private static function query($queryInfo,$aguments)
	{
		//参数重置order,limit参数
		if($aguments)
		{
			foreach($aguments as $param)
			{
				if(is_numeric($param))
				{
					$queryInfo['limit'] = $param;
					unset($queryInfo['page']);
				}
				else if(is_array($param) && $param)
				{
					//【不建议使用】旧的参数模式，比如：array(键名1,键值1),array(键名2,键值2)
					if(count($param) == 2 && isset($param[0]) && isset($param[1]))
					{
						if($param[0] == 'page')
						{
							$queryInfo['page'] = $param[1];
							unset($queryInfo['limit']);
						}
						else
						{
							$queryInfo['where'] = strtr($queryInfo['where'],array($param[0] => $param[1]));
						}
					}

					//新的参数模式，比如：array(键名1 => 键值1,键名2 => 键值2)
					if(is_string(key($param)))
					{
						if(isset($param['page']))
						{
							$queryInfo['page'] = $param['page'];
							unset($queryInfo['limit']);
							unset($param['page']);
						}
						else
						{
							foreach($param as $fromVal => $toVal)
							{
								$queryInfo['where'] = strtr($queryInfo['where'],array("#".$fromVal."#" => $toVal));
							}
						}
					}
				}
				else
				{
					$queryInfo['order'] = str_replace(array('+','-'),array(' asc',' desc'),$param);
				}
			}
		}

		$tableObj = new IQuery($queryInfo['name']);
		unset($queryInfo['name']);

		foreach($queryInfo as $key => $val)
		{
			$tableObj->$key = $val;
		}

		//存在分页
		if(isset($queryInfo['page']))
		{
			return $tableObj;
		}
		//没有分页
		else
		{
			$dataResult = $tableObj->find();
			if($dataResult && isset($queryInfo['type']))
			{
				$dataResult = current($dataResult);
				if($queryInfo['type'] != 'row')
				{
					return isset($dataResult[$queryInfo['type']]) ? $dataResult[$queryInfo['type']] : 0;
				}
			}
			return $dataResult;
		}
	}

    /**
     * @brief api错误处理
     * @param string $apiName api名称
     * @param string $message 错误信息
     * @return Error
     */
	private static function error($apiName,$message)
	{
		throw new IException("API of ".$apiName." is called error , ".$message);
	}
}