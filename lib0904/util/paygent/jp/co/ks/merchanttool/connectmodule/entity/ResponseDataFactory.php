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
 * 応答電文処理用オブジェクト作成クラス
 * 
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */
class ResponseDataFactory {

	/**
	 * ResponseData を作成
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
			// 照会の場合
			$resData = new ReferenceResponseDataImpl();
		} else {
			// 照会以外の場合
			$resData = new PaymentResponseDataImpl();
		}

		return $resData;
	}

}

?>