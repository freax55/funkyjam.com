<?php
class PlaceMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['name']) {
			$this->addError('name', '入力してください。');
		}
		if (!$values['address']) {
//			$this->addError('address', '入力してください。');
		}
		if (!$values['type']) {
			$this->addError('type', '入力してください。');
		}
		if (!$values['tel']) {
//			$this->addError('tel', '入力してください。');
		}
		if (!$values['map']) {
//			$this->addError('map', '入力してください。');
		}
		if (!$values['access']) {
//			$this->addError('access', '入力してください。');
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