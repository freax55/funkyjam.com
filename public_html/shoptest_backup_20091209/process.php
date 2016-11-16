<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib/DatabaseAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/paygent/Paygent.php');

class Action extends DatabaseAction {
	function execute() {
		$p = new Paygent();
		$p->init();

		define('MERCHANT_ID', '16660');
		define('CONNECT_ID', 'funkyjamtest');
		define('CONNECT_PASSWORD', '8xSFTf28nU5xfNb6');
		define('TELEGRAM_VERSION', '1.0');
		
		/*
		 * telegram_kind�ˤĤ��Ƥ�
		 * ��ʸ���̤�ɽ��3��ο������Ϥ�
		 * 
		 * 010��ATM��ѿ���
		 * 020�������ɷ�ѥ�������
		 * 021�������ɷ�ѥ������ꥭ��󥻥�
		 * 022�������ɷ�����
		 * 023�������ɷ����奭��󥻥�
		 * 024�������ɷ��3D��������
		 * 028�������ɷ�ѥ������긺��
		 * 029�������ɷ����帺��
		 * 025�������Ⱦ���������ʸ
		 * 026�������Ⱦ�������ʸ
		 * 027�������Ⱦ���Ȳ���ʸ
		 * 030������ӥ˷��(�ֹ�����)����
		 * 040������ӥ˷��(ʧ��ɼ����)����
		 * 050����ԥͥåȷ�ѿ���
		 * 060����ԥͥåȷ��ASP
         * 070�����۸��·��
         * 091����Ѿ���ʬ�Ȳ�
         */
		$telegram_kind = '010';
		$trading_id = '';
		$payment_id = '';
		
		$params = array(
			"merchant_id"=>MERCHANT_ID,
			"connect_id"=>CONNECT_ID,
			"connect_password"=>CONNECT_PASSWORD,
			"telegram_kind"=>$telegram_kind,
			"telegram_version"=>TELEGRAM_VERSION,
			"trading_id"=>$trading_id,
			"payment_id"=>$payment_id
		);

		$params['payment_amount'] = '2000';
		$params['payment_detail'] = '�ե��󥭡�����ྦ�����';
		$params['payment_detail_kana'] = '�̎��ݎ�-���ގԎю��֎��ˎݎ��ގ�����';

		$p->set($params);
		
		$res = $p->run();
		echo '<pre>';
		var_dump($res);
		echo '</pre>';
		$this->payment_id = $res['payment_id'];
		$this->trading_id = $res['trading_id'];
		$this->pay_center_number = $res['pay_center_number'];
		$this->customer_number = $res['customer_number'];
		$this->conf_number = $res['conf_number'];
		$this->payment_limit_date = $res['payment_limit_date'];

		exit();
		
		$this->__controller->redirectToAction('complete');

		return false;
	}
}
?>