<?php
ini_set("memory_limit", -1);
set_time_limit(90);

session_cache_limiter('public');
require_once($_SERVER['USER_ROOT'] . '/lib/MaintenanceController.php');
require_once('./validator.php');

class OrderExportController extends MaintenanceController
{
	var $start = null;
	var $end = null;

	function OrderExportController() {
		$this->MaintenanceController();

		$this->_base_dir = 'admin/order/';

		$this->_gw_default_action = 'new';
	}

    function executeDownload() {
		if (!$this->validate()) {
			$this->prepareNewBase();

			$this->errors = $this->getErrors();
			$action = 'new';
			$view = $this->_base_dir . $action;
			$this->renderFilter($action, $view);

			return $this->render($view);
		}

		$orderCols = array(
			'����������',
			'��ʧ����ˡ',
			'�Ŏݎʎގ؎ݎ���',
			'�����ֹ�',
			'��̾',
			'͹���ֹ�',
			'����1',
			'����2',
			'�����ֹ�',
			'�����ֹ�',
			'����̾',
			'��',
			'������',
			'����',
			'���ʶ��',
			'ȯ��������',
			'��׶��'
		);

		$cols = implode(',', $orderCols);

		$rows .= $cols . "\n";

		$orderDescList = $this->getOrderDesc();
		foreach($orderDescList as $orderDesc) {
			$orderList = $this->getOrder($orderDesc['order_desc_no']);

			// ��������������̵ͭ��ǧ
			if(!empty($orderList)) {
				// ��ʸ�ι�׶�۷׻�
				foreach($orderList as $order) {
					$orderDesc['total'] += $order['price'] * $order['quantity'];
				}
				$orderDesc['total'] += $orderDesc['carriage'];

				foreach($orderList as $order) {
					$orderCols = array();
					$orderCols[] = date('Y/m/d', strtotime($orderDesc['apply_date'])); // ����������
					$orderCols[] = $orderDesc['payment']; // ��ʧ����ˡ
					$orderCols[] = ''; // �Ŏݎʎގ؎ݎ��� (�ȼ�¦��������ֹ档��ʸ���������)
					$orderCols[] = $orderDesc['order_desc_no']; // �����ֹ�
					$orderCols[] = $orderDesc['name']; // ��̾
					$orderCols[] = $this->convertEnNumber($orderDesc['zip']); // ͹���ֹ�
					$orderCols[] = $this->convertEnNumber($orderDesc['address1'] . $orderDesc['address2']); // ����1
					$orderCols[] = $this->convertEnNumber($orderDesc['address3']); // ����2
					$orderCols[] = $this->convertEnNumber($orderDesc['tel']); // �����ֹ�
					$orderCols[] = $order['item_code']; // �����ֹ�
					$orderCols[] = $order['name']; // ����̾
					$orderCols[] = $order['color']; // ��
					$orderCols[] = $order['size']; // ������
					$orderCols[] = $order['quantity']; // ����
					$orderCols[] = $order['price']; // ���ʶ��
					$orderCols[] = $orderDesc['carriage']; // ȯ��������
					$orderCols[] = $orderDesc['total']; // ��׶��

					$cols = implode(',', $orderCols);

					$rows .= $cols . "\n";
				}
			}
		}

		$today = getdate();
		$filename = sprintf('kubota_goods%04d%02d%02d.csv', $today['year'], $today['mon'], $today['mday']);

		$rows = mb_convert_encoding($rows, 'SJIS', 'EUC-JP');

		header("Content-type: application/x-csv; charset=Shift_JIS");
		header("Content-disposition: attachment; filename=" . $filename);
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . strlen($rows));

		print($rows);

		return GW_TERMINATE_PROCESS;
	}

	/**
	 * [getOrder 1���������� ����ñ�̤ξ������]
	 * @param  [type] $order_desc_no [description]
	 * @return [type]                [description]
	 */
	function getOrder($order_desc_no) {
		if(empty($order_desc_no)) {
			return false;
		}
		// ���ƥ���μ��ब��goods�פξ��ʤΥ��������Τ߼�����color��size��item�ơ��֥뤫�������
		$query = sprintf('
			select
				o.order_no, o.order_desc_no, o.item_code, o.name, o.quantity, o.price,o.color,o.size
			from "order" as o
				inner join "category" as c on o.category_code = c.category_code
			where o.order_desc_no = \'%d\'
				and c.kind = \'goods\'
			group by o.order_no, o.order_desc_no, o.item_code, o.name, o.quantity, o.price,o.color,o.size
			', $order_desc_no);
		$query = $this->db->buildQuery($query);
		return $this->db->select($query);
	}

	/**
	 * [getOrderDesc 1��������ñ�̤ξ������]
	 * @return [type] [description]
	 */
	function getOrderDesc() {
		$query = sprintf("
			select
				order_desc_no, payment, carriage, name, zip, address1, address2, address3, tel, apply_date, payment
			from order_desc
			where apply_date >= '%s 00:00:00'
				and apply_date <= '%s 23:59:59'
			order by apply_date", $this->start, $this->end);
		$query = $this->db->buildQuery($query);
		return $this->db->select($query);
	}

	function convertEnNumber($text) {
		$text = mb_convert_kana($text, 'n', 'EUC-JP');
		$text = mb_ereg_replace("(��|��|��|��)", "-", $text);
		return $text;
	}
}

$controller = new OrderExportController();
$controller->process();

exit();
?>