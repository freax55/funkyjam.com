<?php
class ItemMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['item_code']) {
			$this->addError('code', '入力してください。');
		}
		if (!$values['name']) {
			$this->addError('name', '入力してください。');
		}
		if (!$values['category_code']) {
			$this->addError('category', '選択してください。');
		}
		if (!$values['color']) {
//			$this->addError('color', '入力してください。');
		}
		if (!$values['size']) {
//			$this->addError('size', '入力してください。');
		}
		if (!$this->isNumber($values['stock'])) {
			$this->addError('stock', '数字で入力してください。');
		}
		if (!$values['p_date']) {
//			$this->addError('p_date', '入力してください。');
		}
		if (!$values['price']) {
			$this->addError('price', '入力してください。');
		}
		if (!$values['area'] && !$values['otherArea']) {
//			$this->addError('area', '入力してください。');
		}
		if (!$values['place_no']) {
//			$this->addError('place', '選択してください。');
		}
		if (!$values['open_time']) {
//			$this->addError('open_time', '入力してください。');
		}
		if (!$values['start_time']) {
//			$this->addError('start_time', '入力してください。');
		}
		if (!$values['p_release']) {
//			$this->addError('p_release', '入力してください。');
		}
		if (!$values['g_release']) {
//			$this->addError('g_release', '入力してください。');
		}
		if (!$values['note']) {
//			$this->addError('note', '入力してください。');
		}
		if (!$values['inquiries']) {
//			$this->addError('inquiries', '入力してください。');
		}
		if (!$values['inquiries_tel']) {
//			$this->addError('inquiries_tel', '入力してください。');
		}
		if (!$values['image']->tmpFilePath) {
//			$this->addError('image', 'ファイルを選択してください。');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>