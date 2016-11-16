<?php
/**
 * PAYGENT B2B MODULE
 * StringUtil.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 * /

/**
 * ��³�⥸�塼�롡StringUtitily
 *
 * @version $Revision: 1.6 $
 * @author $Author: t-mori $
 */

class StringUtil{

	/** ���̤��Ѵ����륫������ʸ����Υޥåԥ󥰾�����Ǽ���Ƥ���ޥå� */
	var $katakanaMap = array();
	
	var $zenKana = array("��", "��", "��", "��", "��", "��", "��", "��", "��", "��", 
			"��", "��", "��", "��", /*"��", */"��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",	
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��" );

	var $hanKana = array("��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��",
			"����", "����", "����", "����", "����", "����", "����", "����", "����", "����",
			"����", "����", "��", "�Î�", "�Ď�", "�ʎ�", "�ˎ�", "�̎�", "�͎�", "�Ύ�",
			"����", "�ʎ�", "�ˎ�", "�̎�", "�͎�", "�Ύ�", "��", "��", "��", "��", "��",
			"��", "��", "��", "��", "��" );

	/**
	 * �ǥե���ȥ��󥹥ȥ饯��
	 */
	function StringUtil() {

		if (count($this->zenKana) == count($this->katakanaMap)) {
			return;
		}
		
		for ($i = 0; $i < count($this->zenKana); $i++) {
			$this->katakanaMap[$this->zenKana[$i]] = $this->hanKana[$i];
		}
	}
	
	/**
	 * �ѥ�᡼���� null �ޤ��϶�ʸ������Ƚ�Ǥ���
	 * 
	 * @param str String Ƚ�ꤹ��ʸ����
	 * @return <code>null</code>�ޤ��϶�ʸ���ξ�硢<code>true</code>
	 */
	function isEmpty($str) {
		return (!isset($str) || strlen(trim($str)) <= 0);
	}

	/**
	 * split(ʬ���������)
	 * 
	 * @param str String ʬ���о�ʸ����
	 * @param delim String ���ڤ�ʸ��
	 * @param limit int ��̤�����
	 * @return String[] ʬ����ʸ������
	 */
	function split($str, $delim, $limit = -1) {
		
		$delimLength = strlen($delim);
		$pos = 0;
		$index = 0;
		$list = array();
		if ($delimLength != 0) {
			
			while (!(($index = strpos($str, $delim, $pos)) === false)) {
				$list[] = substr($str, $pos, $index-$pos);
				$pos = $index + $delimLength;
				if ($pos >= strlen($str)) break;
			}
			if ($pos == strlen($str)) {
				$list[] = "";		// the last is the delimiter.
			} else 	if ($pos < strlen($str)) {
				$list[] = substr($str, $pos);
			}
		} else {
			for ($i = 0; $i < strlen($str); $i++) {
				$c = $str{$i};
				$list[] = "" . $c;
			}
		}
		
		$rs = &$list;

		if ((0 < $limit) && ($limit < count($rs))) {
			// limit ��ꡢʬ�����¿����硢ʬ����� limit �˹�碌��
			$temp = array();

			$pos = 0;
			for ($i = 0; $i < $limit - 1; $i++) {
				$temp[] = $rs[$i];
				$pos += strlen($rs[$i]) + strlen($delim);
			}

			$temp[$limit - 1] = substr($str, $pos);
			for ($i = $limit; $i < count($rs); $i++) {
				$sb = $temp[$limit - 1];		
			}

			$rs = $temp;
		}

		return $rs;
	}

	/**
	 * ����Ƚ��
	 * 
	 * @param str String ����Ƚ���о�ʸ����
	 * @return boolean true=���� false=���Ͱʳ�
	 */
	function isNumeric($str) {
		$rb = is_numeric($str);

		return $rb;
	}

	/**
	 * ���͡����Ƚ��
	 * 
	 * @param str String ����Ƚ���о�ʸ����
	 * @param len int Ƚ���о� Length
	 * @return boolean true=�������� false=���ͤǤʤ� or ����㤤
	 */
	function isNumericLength($str, $len) {
		$rb = false;

		if (StringUtil::isNumeric($str)) {
			if (strlen($str) == $len) {
				$rb = true;
			}
		}

		return $rb;
	}

	/**
	 * ���ѥ�������ʸ����Ⱦ�ѥ������ʤγ���ʸ�����Ѵ����롣 ���ꤵ�줿ʸ����null�ξ���null���֤���
	 * 
	 * @param src String �Ѵ����븵��ʸ����
	 * @return String �Ѵ����ʸ����
	 */
	function convertKatakanaZenToHan($src) {
		if ($src == null ) {
			return null;
		}
		$str = mb_convert_kana($src, "kV", "SJIS");
		return $str;
	}

	/**
	 * ���ꤵ�줿ʸ�������ꤵ�줿�ޥåԥ󥰾���˴�Ť� �Ѵ�������̤�ʸ������֤��� ���ꤵ�줿ʸ����null�ξ���null���֤���
	 * 
	 * @param src String �Ѵ����븵��ʸ����
	 * @param convertMap
	 *            Map �Ѵ����оݤȤʤ�ʸ�����Ѵ���Υޥåԥ󥰾�����Ǽ���Ƥ���ޥå�
	 * @return String �Ѵ����ʸ����
	 */
	function convert($src, $convertMap) {
		if ($src == null) {
			return null;
		}
		$chars = $this->toChars($src);
		foreach ($chars as $c) {
			if (array_key_exists($c, $convertMap)) {
				$result .= $convertMap[$c];
			} else {
				$result .=$c;
			}
		}

		return $result;
	}

	function toChars($str) {
		
		$chars = array();
		for($i=0; $i<mb_strlen($str); $i++) {
			$out = mb_substr($str, $i, 1);
			$chars[] = $out;
			$intx= 0;
		}
		return $chars;
	}
}
	// �����
	$StringUtilInit = new StringUtil();
	$StringUtilInit = null;
?>