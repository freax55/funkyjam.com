<?php
class PlaceMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['name']) {
			$this->addError('name', '���Ϥ��Ƥ���������');
		}
		if (!$values['address']) {
//			$this->addError('address', '���Ϥ��Ƥ���������');
		}
		if (!$values['type']) {
			$this->addError('type', '���Ϥ��Ƥ���������');
		}
		if (!$values['tel']) {
//			$this->addError('tel', '���Ϥ��Ƥ���������');
		}
		if (!$values['map']) {
//			$this->addError('map', '���Ϥ��Ƥ���������');
		}
		if (!$values['access']) {
//			$this->addError('access', '���Ϥ��Ƥ���������');
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