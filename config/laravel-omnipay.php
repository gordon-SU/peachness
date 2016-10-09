<?php

return [

	// 默认支付网关
	'default' => 'alipay',

	// 各个支付网关配置
	'gateways' => [
		'paypal' => [
			'driver' => 'PayPal_Express',
			'options' => [
				'solutionType' => '',
				'landingPage' => '',
				'headerImageUrl' => ''
			]
		],

		'alipay' => [
			'driver' => 'Alipay_Express',
			'options' => [
				'partner' => '2088002486587356',
				'key' => '2016090801867289',
				'sellerEmail' =>'your alipay account here',
				'returnUrl' => 'your returnUrl here',
				'notifyUrl' => 'your notifyUrl here'
			]
		]
	]

];