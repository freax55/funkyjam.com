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
			'申し込み日',
			'支払い方法',
			'ﾅﾝﾊﾞﾘﾝｸﾞ',
			'受付番号',
			'氏名',
			'郵便番号',
			'住所1',
			'住所2',
			'電話番号',
			'商品番号',
			'商品名',
			'色',
			'サイズ',
			'数量',
			'商品金額',
			'発送梱包費',
			'合計金額'
		);

		$cols = implode(',', $orderCols);

		$rows .= $cols . "\n";

		$orderDescList = $this->getOrderDesc();
		foreach($orderDescList as $orderDesc) {
			$orderList = $this->getOrder($orderDesc['order_desc_no']);

			// 該当オーダーの有無確認
			if(!empty($orderList)) {
				// 注文の合計金額計算
				foreach($orderList as $order) {
					$orderDesc['total'] += $order['price'] * $order['quantity'];
				}
				$orderDesc['total'] += $orderDesc['carriage'];

				foreach($orderList as $order) {
					$orderCols = array();
					$orderCols[] = date('Y/m/d', strtotime($orderDesc['apply_date'])); // 申し込み日
					$orderCols[] = $orderDesc['payment']; // 支払い方法
					$orderCols[] = ''; // ﾅﾝﾊﾞﾘﾝｸﾞ (業者側で入れる番号。空文字を入れる)
					$orderCols[] = $orderDesc['order_desc_no']; // 受付番号
					$orderCols[] = $orderDesc['name']; // 氏名
					$orderCols[] = $this->convertEnNumber($orderDesc['zip']); // 郵便番号
					$orderCols[] = $this->convertEnNumber($orderDesc['address1'] . $orderDesc['address2']); // 住所1
					$orderCols[] = $this->convertEnNumber($orderDesc['address3']); // 住所2
					$orderCols[] = $this->convertEnNumber($orderDesc['tel']); // 電話番号
					$orderCols[] = $order['item_code']; // 商品番号
					$orderCols[] = $order['name']; // 商品名
					$orderCols[] = $order['color']; // 色
					$orderCols[] = $order['size']; // サイズ
					$orderCols[] = $order['quantity']; // 数量
					$orderCols[] = $order['price']; // 商品金額
					$orderCols[] = $orderDesc['carriage']; // 発送梱包費
					$orderCols[] = $orderDesc['total']; // 合計金額

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
	 * [getOrder 1オーダー内 商品単位の情報取得]
	 * @param  [type] $order_desc_no [description]
	 * @return [type]                [description]
	 */
	function getOrder($order_desc_no) {
		if(empty($order_desc_no)) {
			return false;
		}
		// カテゴリの種類が「goods」の商品のオーダーのみ取得（colorとsizeはitemテーブルから取得）
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
	 * [getOrderDesc 1オーダー単位の情報取得]
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
		$text = mb_ereg_replace("(ー|−|―|‐)", "-", $text);
		return $text;
	}
}

$controller = new OrderExportController();
$controller->process();

exit();
?>