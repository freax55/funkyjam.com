<?php
class AccountMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['id']) {
			$this->addError('id', '���Ϥ��Ƥ���������');
		}
		if (!$values['password']) {
			$this->addError('password', '���Ϥ��Ƥ���������');
		}
		if (!$values['note']) {
//			$this->addError('note', '���Ϥ��Ƥ���������');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>