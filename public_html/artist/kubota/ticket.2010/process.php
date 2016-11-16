<?php
require_once('auth.php');

class ticketAction extends AuthAction {
	function init() {
		parent::init();
		
		define('AFF_NO', '01051580');
		define('AFF_NAME', 'BARI BARI CREW TICKET');
//		define('RET_URL', 'http://funkyjam.evol-ni.com/artist/kubota/ticket/index.php?action=complete&');
		define('RET_URL', 'https://www.funkyjam.com/artist/kubota/ticket/index.php?action=complete&');
//		define('OMC_URL', 'https://www2.e-colle.com/paytest/test_pay_init.asp');
		define('OMC_URL', 'https://www2.e-colle.com/settlement/xt_pay_funkyjam.asp');
	}
	
	function execute() {
		$db =& $this->_db;

//		$_REQUEST['debug'] = true;
		
		//DB登録処理
		$db->begin();
		$result = $db->statement('artist/kubota/ticket/sql/lock_table.sql');

		$result = $db->statement('artist/kubota/ticket/sql/new_order_desc_no.sql');
		$row = $db->fetch_assoc($result);
		
		$this->p04 = $row['new_no'];
		
		$db->assign($this->getProperties());
		
		foreach($this->cart as $value){
			$db->assign("item", $value);
			$result = $db->statement('artist/kubota/ticket/sql/insert_order.sql');
		}
		$db->statement('artist/kubota/ticket/sql/insert_order_desc.sql');
		$db->commit();
		
		if ($this->payment == 'クレジットカード') {
			$price = $this->total + $this->carriageTotal;
			$trnid1 = $this->genTrnid1($this->p04, $price, $this->member_no);

			$params = array();
			$params[] = 'p01=' . AFF_NO;
			$params[] = 'p02=' . urlencode(mb_convert_encoding(AFF_NAME, 'SJIS', 'EUC-JP'));
			$params[] = 'p03=' . $trnid1;
			$params[] = 'p04=' . urlencode($this->p04);
			$params[] = 'p05=' . $price;
			$params[] = 'p06=' . date('Ymd');
			$params[] = 'p07=' . urlencode(RET_URL);
			$params[] = 'p08=' . urlencode($this->member_no);
			$params[] = 'p09=' . '01';
			$params[] = 'p10=' . '1';
			
			$url = OMC_URL . "?" . implode('&', $params);
			
			$this->__controller->redirectToURL($url);
		}
		else {
			$this->__controller->redirectToAction('complete');
		}

		return false;
	}

	function genTrnid1($order_desc_no, $price, $member_no) {
		$params = array();
		$p01 = AFF_NO;
		$a02 = AFF_NAME;
		$a04 = $order_desc_no;
		$a05 = $price;
		$a07 = RET_URL;
		$a08 = $member_no;
		$a09 = '01';
		$a10 = '1';

		$argument = "\"$p01\" \"$a02\" \"$a04\" \"$a05\" \"$a07\" \"$a08\" \"$a09\" \"$a10\"";
		$cmd = '/home/funkyjam/lib/omc/trnid1gen ' . $argument;
		$trnid1 = `$cmd`;

		return $trnid1;
	}
}
?>