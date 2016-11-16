<?php
/**
 * PAYGENT B2B MODULE
 * ResponseDataFactory.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

include_once("jp/co/ks/merchanttool/connectmodule/exception/PaygentB2BModuleException.php");
include_once("jp/co/ks/merchanttool/connectmodule/system/PaygentB2BModuleResources.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/ReferenceResponseDataImpl.php");
include_once("jp/co/ks/merchanttool/connectmodule/entity/PaymentResponseDataImpl.php");

/**
 * ������ʸ�����ѥ��֥������Ⱥ������饹
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */
class ResponseDataFactory {

	/**
	 * ResponseData �����
	 * 
	 * @param kind
	 * @return ResponseData
	 */
	function create($kind) {
		$resData = null;
		$masterFile = null;
		
		$masterFile = PaygentB2BModuleResources::getInstance();
		
		// Create ResponseData
		if ($masterFile->isTelegramKindRef($kind)) {
			// �Ȳ�ξ��
			$resData = new ReferenceResponseDataImpl();
		} else {
			// �Ȳ�ʳ��ξ��
			$resData = new PaymentResponseDataImpl();
		}

		return $resData;
	}

}

?>