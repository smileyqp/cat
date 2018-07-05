<?php
/**
 * @copyright (c) 2011 aircheng.com
 * @file errors.php
 * @brief 错误处理类
 * @author chendeshan
 * @date 2018/5/6 9:19:24
 * @version 5.1
 */
class Errors extends IController
{
	public function error404($data)
	{
		$data = "访问的资源地址不存在";
		$this->setRenderData(array('data' => $data,'httpcode' => '404'));
		$this->redirect('error',false);
	}

	public function error403($data)
	{
		$data = IFilter::act($data);
		$this->setRenderData(array('data' => $data,'httpcode' => '403'));
		$this->redirect('error',false);
	}

	public function error503($data)
	{
		$data = IFilter::act($data);
		$this->setRenderData(array('data' => $data,'httpcode' => '503'));
		$this->redirect('error',false);
	}
}