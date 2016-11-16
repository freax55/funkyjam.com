<?php
class AccountMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['id']) {
			$this->addError('id', '入力してください。');
		}
		if (!$values['password']) {
			$this->addError('password', '入力してください。');
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