<?php
class GoodsMaintenanceValidator extends BaseValidator
{
	function validateAdd($values) {
		if (!$values['item_code']) {
			$this->addError('code', '���Ϥ��Ƥ���������');
		}
		if (!$values['name']) {
			$this->addError('name', '���Ϥ��Ƥ���������');
		}
		if (!$values['category_code']) {
			$this->addError('category', '���򤷤Ƥ���������');
		}
		if (!$values['area']) {
			$this->addError('area', '���Ϥ��Ƥ���������');
		}
		if (!$values['color']) {
//			$this->addError('color', '���Ϥ��Ƥ���������');
		}
		if (!$values['size']) {
//			$this->addError('size', '���Ϥ��Ƥ���������');
		}
		if (!$values['stock']) {
//			$this->addError('stock', '���Ϥ��Ƥ���������');
		}
		elseif (!$this->isNumber($values['stock'])) {
			$this->addError('stock', '���������Ϥ��Ƥ���������');
		}
		if (!$values['price']) {
			$this->addError('price', '���Ϥ��Ƥ���������');
		}
		if (!$values['note']) {
//			$this->addError('note', '���Ϥ��Ƥ���������');
		}
		if (!$values['image']->tmpFilePath) {
//			$this->addError('image', '�ե���������򤷤Ƥ���������');
		}
		if (!$values['inquiries_tel']) {
//			$this->addError('inquiries_tel', '���Ϥ��Ƥ���������');
		}
		elseif (!$this->isNumber($values['inquiries_tel'])) {
			$this->addError('inquiries_tel', '���������Ϥ��Ƥ���������');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>