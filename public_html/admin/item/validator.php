<?php
class ItemMaintenanceValidator extends BaseValidator
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
		if (!$values['color']) {
//			$this->addError('color', '���Ϥ��Ƥ���������');
		}
		if (!$values['size']) {
//			$this->addError('size', '���Ϥ��Ƥ���������');
		}
		if (!$this->isNumber($values['stock'])) {
			$this->addError('stock', '���������Ϥ��Ƥ���������');
		}
		if (!$values['p_date']) {
//			$this->addError('p_date', '���Ϥ��Ƥ���������');
		}
		if (!$values['price']) {
			$this->addError('price', '���Ϥ��Ƥ���������');
		}
		if (!$values['area'] && !$values['otherArea']) {
//			$this->addError('area', '���Ϥ��Ƥ���������');
		}
		if (!$values['place_no']) {
//			$this->addError('place', '���򤷤Ƥ���������');
		}
		if (!$values['open_time']) {
//			$this->addError('open_time', '���Ϥ��Ƥ���������');
		}
		if (!$values['start_time']) {
//			$this->addError('start_time', '���Ϥ��Ƥ���������');
		}
		if (!$values['p_release']) {
//			$this->addError('p_release', '���Ϥ��Ƥ���������');
		}
		if (!$values['g_release']) {
//			$this->addError('g_release', '���Ϥ��Ƥ���������');
		}
		if (!$values['note']) {
//			$this->addError('note', '���Ϥ��Ƥ���������');
		}
		if (!$values['inquiries']) {
//			$this->addError('inquiries', '���Ϥ��Ƥ���������');
		}
		if (!$values['inquiries_tel']) {
//			$this->addError('inquiries_tel', '���Ϥ��Ƥ���������');
		}
		if (!$values['image']->tmpFilePath) {
//			$this->addError('image', '�ե���������򤷤Ƥ���������');
		}
	}

    function validateChange($values)
    {
		$this->validateAdd($values);
    }
}
?>