<?php
class MemberMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['file']->tmpFilePath) {
			$this->addError('file', '�ե���������򤷤Ƥ���������');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>