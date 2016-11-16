<?php
ini_set("memory_limit", -1);
set_time_limit(90);

session_cache_limiter('public');
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');

class OrderExportController extends MaintenanceController
{
	function OrderExportController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/order/';

		$this->tableName = '"order"';
		$this->keyName = 'order_no';
		$this->order = 'order_desc_no, order_no';
		$this->where = "d_stamp is null and category_code = 'A011' and dl_stamp is null";
	}

    function executeList() {
		$rows = null;
		
		/*
		 * Filemaker�ǰ����ݤˡ�DB����¸���Ƥ�����̾�Ǥϡ�Ĺ�����ƻȤ��ɤ���
		 * Filemaker�ǤΤ��̤�ɽ����Ԥ�
		 */
		$paymentList = array(
			'͹�ؿ���' => '1.͹�ؿ���',
			'���쥸�åȥ�����' => '2.BBC������PC',
			'��Х�����FJSHOP BariBariCrewCARD' => '3.BBC������MB',
			'����ӥ˷��' => '4.����ӥ�PC',
			'��Х�����FJSHOP ����ӥ˷��' => '5.����ӥ�MB',
			'ATM���' => '6.ATMPC',
			'��Х�����FJSHOP ATM���' => '7.ATMMB',
			'ͽ��' => '6.BBCͽ��',
		);
		
		$list = $this->getList($limit, $offset);
		
		$this->db->begin();
		foreach ($list as $order_desc_no => $orderList) {
			$orderDesc = $this->getOrderDesc($order_desc_no);


			foreach ($orderList as $order_no => $order) {
				$seatType = '';
				if(strpos($order['place'], '���꡼����') !== false) {
					$seatType = 'A';
				} elseif(strpos($order['place'], '���������') !== false) {
					$seatType = 'S';
				}
				$orderCols = array();
				$orderCols[] = $order['order_no'];
				$orderCols[] = $order['item_code'];
				$orderCols[] = str_replace('-', '.', substr($order['c_stamp'], 0, 10));
				$orderCols[] = '���������� �����å�';
				$orderCols[] = $paymentList[$orderDesc['payment']];
				$orderCols[] = $orderDesc['member_no'];
				$orderCols[] = $order['place'];
				$orderCols[] = str_replace('-', '.', $order['p_date']);
				$orderCols[] = $order['name'];
				$orderCols[] = $order['quantity'];
				$orderCols[] = $order['price'];
				$orderCols[] = $seatType;
				
				$cols = implode(',', $orderCols);
				
				$rows .= $cols . "\n";
				
				//��������ɺѤ�����
				$query = "update \"order\" set dl_stamp = current_timestamp where order_no = $order_no;";
				$this->db->executeQuery($query);
			}
		}
		
		$today = getdate();
		$filename = sprintf('kubota_ticket%04d%02d%02d.csv', $today['year'], $today['mon'], $today['mday']);

		$rows = mb_convert_encoding($rows, 'SJIS', 'EUC-JP');

		header("Content-type: application/x-csv; charset=Shift_JIS");
		header("Content-disposition: attachment; filename=" . $filename);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . strlen($rows));
		
		print($rows);
		
		$this->db->commit();
		
		return GW_TERMINATE_PROCESS;
	}
	
	function getList($limit, $offset) {
		$query = 'select * from ' . $this->tableName;
		$query = $this->db->buildQuery($query, $this->where, $this->order, $limit, $offset);
		return $this->db->select($query, array('order_desc_no', $this->keyName));
	}

	function getOrderDesc($order_desc_no) {
		if(empty($order_desc_no)) {
			return false;
		}
		$query = sprintf("select payment, member_no from order_desc where order_desc_no='%d'", $order_desc_no);
		$query = $this->db->buildQuery($query);
		$result = $this->db->select($query);
		if(count($result)) {
			return $result[0];
		}
	}
}

$controller = new OrderExportController();
$controller->process();

exit();
?>