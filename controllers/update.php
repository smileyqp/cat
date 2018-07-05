<?php
/**
 * @brief 升级更新控制器
 */
class Update extends IController
{
	/**
	 * @brief iwebshop5.0 版本升级更新
	 */
	public function index()
	{
		set_time_limit(0);

		//获取banner数据
		$sql_banner = array();
		$siteConfigObj = new Config("site_config");
		$site_config   = $siteConfigObj->getInfo();
		if(isset($site_config['index_slide']) && $site_config['index_slide'])
		{
		    $index_slide = unserialize($site_config['index_slide']);
		    foreach ($index_slide as $key=>$val) {
		        $order = $key + 1;
		        $sql_banner[] = "INSERT INTO `{pre}banner`(`order`, `name`, `url`, `img`, `_hash`, `seller_id`) VALUES ($order,'{$val['name']}','{$val['url']}','{$val['img']}',0,0);";
		    }
		}

		$sql = array(
			"SET FOREIGN_KEY_CHECKS=0;",

			"ALTER TABLE `{pre}favorite` CHANGE `rid` `goods_id` INT(11) UNSIGNED NOT NULL COMMENT '商品ID';",
			"ALTER TABLE `{pre}order` ADD `spend_point` int(11) NOT NULL DEFAULT '0' COMMENT '商品购买所需积分';",
			"DROP TABLE IF EXISTS `{pre}category_extend_seller`;",
			"CREATE TABLE `{pre}category_extend_seller` (
			  `id` int(11) unsigned NOT NULL auto_increment,
			  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
			  `category_id` int(11) unsigned NOT NULL COMMENT '商品分类ID',
			  PRIMARY KEY  (`id`),
			  index (`goods_id`),
			  index (`category_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家店内商品分类与商品关系表';",

			"DROP TABLE IF EXISTS `{pre}category_seller`;",
			"CREATE TABLE `{pre}category_seller` (
			  `id` int(11) unsigned NOT NULL auto_increment COMMENT '分类ID',
			  `name` varchar(50) NOT NULL COMMENT '分类名称',
			  `parent_id` int(11) unsigned NOT NULL COMMENT '父分类ID',
			  `sort` smallint(5) NOT NULL default '0' COMMENT '排序',
			  `keywords` varchar(255) default NULL COMMENT 'SEO关键词和检索关键词',
			  `descript` varchar(255) default NULL COMMENT 'SEO描述',
			  `title` varchar(255) default NULL COMMENT 'SEO标题title',
			  `seller_id` int(11) unsigned NOT NULL COMMENT '商家ID',
			  PRIMARY KEY  (`id`),
			  index (`parent_id`),
			  index (`sort`),
			  index (`seller_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家店内商品分类表';",

			"DROP TABLE IF EXISTS `{pre}cost_point`;",
			"CREATE TABLE `{pre}cost_point` (
			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `name` varchar(20) NOT NULL COMMENT '活动名称',
			  `sort` smallint(5) NOT NULL COMMENT '顺序',
			  `goods_id` int(11) NOT NULL COMMENT '商品id',
			  `point` int(11) NOT NULL COMMENT '所需要的积分',
			  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭 0:否 1:是',
			  `user_group` text COMMENT '允许参与活动的用户组,all表示所有用户组',
			  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
			  PRIMARY KEY (`id`),
			  KEY `type` (`seller_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='商品积分兑换表';",

		    "DROP TABLE IF EXISTS `{pre}banner`;",
		    "CREATE TABLE `{pre}banner` (
                `order` smallint(5) unsigned NOT NULL COMMENT '排序',
                `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Banner名称',
                `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
                `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片文件',
                `_hash` int(11) unsigned NOT NULL COMMENT '预留散列字段',
                `seller_id` int(11) unsigned NOT NULL default '0' COMMENT '商家ID',
                PRIMARY KEY (`order`,`_hash`),
                index (`seller_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Banner表';",

			"INSERT INTO `{pre}payment` VALUES (NULL, '微信小程序支付', 1, 'mini_wechat', '微信小程序支付接口，去微信公众平台申请。<a href=\"https://mp.weixin.qq.com/cgi-bin/registermidpage?action=index\" target=\"_blank\">立即申请</a>', '/payments/logos/pay_mini_wechat.png', 1, 99, NULL, 0.00, 1, NULL,2);",

			"INSERT INTO `{pre}payment` VALUES (NULL, '快钱手机支付', 1, 'wap_bill99', '快钱是国内领先的独立第三方支付企业，旨在为各类企业及个人提供安全、便捷和保密的支付清算与账务服务。 <a href=\"https://www.99bill.com/\" target=\"_blank\">立即申请</a>', '/payments/logos/pay_wap_99bill.jpg', 1, 99, NULL, 0.00, 1, NULL,2);",

            "SET FOREIGN_KEY_CHECKS=1;",
		);

		$sql = array_merge($sql, $sql_banner);

		foreach($sql as $key => $val)
		{
		    IDBFactory::getDB()->query( $this->_c($val) );
		}

		$proDB = new IModel('promotion');
		$proDB->setData(array('user_group' => ''));
		$proDB->update('user_group = "all"');

		$rightDB = new IModel('right');
		$rightDB->setData(array('right' => 'goods@goods_list,goods@search,goods@search_result'));
		$rightDB->update('name="[商品]商品列表"');

		die("升级成功!! V5.1版本");
	}

	public function _c($sql)
	{
		return str_replace('{pre}',IWeb::$app->config['DB']['tablePre'],$sql);
	}
}