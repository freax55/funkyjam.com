<?php
class MemberMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['file']->tmpFilePath) {
			$this->addError('file', 'ファイルを選択してください。');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>