<?php
class GoodsMaintenanceValidator extends BaseValidator
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
		if (!$values['area']) {
			$this->addError('area', '入力してください。');
		}
		if (!$values['color']) {
//			$this->addError('color', '入力してください。');
		}
		if (!$values['size']) {
//			$this->addError('size', '入力してください。');
		}
		if (!$values['stock']) {
//			$this->addError('stock', '入力してください。');
		}
		elseif (!$this->isNumber($values['stock'])) {
			$this->addError('stock', '数字で入力してください。');
		}
		if (!$values['price']) {
			$this->addError('price', '入力してください。');
		}
		if (!$values['note']) {
//			$this->addError('note', '入力してください。');
		}
		if (!$values['image']->tmpFilePath) {
//			$this->addError('image', 'ファイルを選択してください。');
		}
		if (!$values['inquiries_tel']) {
//			$this->addError('inquiries_tel', '入力してください。');
		}
		elseif (!$this->isNumber($values['inquiries_tel'])) {
			$this->addError('inquiries_tel', '数字で入力してください。');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>