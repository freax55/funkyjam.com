<?php
class CategoryMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['category_code']) {
			$this->addError('code', '���Ϥ��Ƥ���������');
		}
		if (!$values['name']) {
			$this->addError('name', '���Ϥ��Ƥ���������');
		}
		if (!$values['kind']) {
			$this->addError('kind', '���򤷤Ƥ���������');
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