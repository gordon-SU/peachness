<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Omnipay\Omnipay;

class AlipayController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// echo "alipay";
		//===== web ===== 
		//创建支付单。
//	     $alipay = app('alipay.web');
//	     $alipay->setOutTradeNo('order_id');
//	     $alipay->setTotalFee('0.01');
//	     $alipay->setSubject('goods_name');
//	     $alipay->setBody('goods_description');
//
//	     $alipay->setQrPayMode('4'); //该设置为可选，添加该参数设置，支持二维码支付。
//
//	     // 跳转到支付页面。
//	     return redirect()->to($alipay->getPayLink());


		//===== wap ===
		//创建支付单。
		$alipay = app('alipay.wap');
		$alipay->setOutTradeNo('order_id');
		$alipay->setTotalFee('0.02');
		$alipay->setSubject('goods_name');
		$alipay->setBody('goods_description');

		// 跳转到支付页面。
		return redirect()->to($alipay->getPayLink());

	    //===== mobile === 
	    // 创建支付单。
	    $alipay = app('alipay.mobile');
	    $alipay->setOutTradeNo('order_id');
	    $alipay->setTotalFee('0.03');
	    $alipay->setSubject('goods_name');
	    $alipay->setBody('goods_description');

	    // 返回签名后的支付参数给支付宝移动端的SDK。
	    return $alipay->getPayPara();

	}

	public function pay()
	{
		$gateway = Omnipay::gateway();

		$options = [
			'out_trade_no' => date('YmdHis') . mt_rand(1000,9999),
			'subject' => 'Alipay Test',
			'total_fee' => '0.01',
		];

		$response = $gateway->purchase($options)->send();
		$response->redirect();
	}

	public function result(){

		$gateway = Omnipay::gateway();

		$options = [
			'request_params'=> $_REQUEST,
		];

		$response = $gateway->completePurchase($options)->send();

		if ($response->isSuccessful() && $response->isTradeStatusOk()) {
			//支付成功后操作
			exit('支付成功');
		} else {
			//支付失败通知.
			exit('支付失败');
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
