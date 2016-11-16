<?php
class OrderExportValidator extends BaseValidator
{
	function validateDownload($values) {
		if(empty($values['start']) || empty($values['end'])) {
			$this->addError('date', 'グッズ申込日を入力してください');
		} elseif(!$this->isDate($values['start']) || !$this->isDate($values['end'])) {
			$this->addError('date', 'グッズ申込日の形式が正しくありません');
		}
	}
	
	function isDate($date) {
		if(empty($date)) {
			return false;
		}
		if(mb_ereg_match('^[0-9]{4}-[0-9]{2}-[0-9]{2}$', $date)) {
			return true;
		} if(mb_ereg_match('^[0-9]{4}/[0-9]{2}/[0-9]{2}$', $date)) {
			return true;
		}
		
		return false;
	}
}
?>