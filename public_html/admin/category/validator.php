<?php
class CategoryMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['category_code']) {
			$this->addError('code', '入力してください。');
		}
		if (!$values['name']) {
			$this->addError('name', '入力してください。');
		}
		if (!$values['kind']) {
			$this->addError('kind', '選択してください。');
		}
		if (!$values['note']) {
//			$this->addError('note', '入力してください。');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>