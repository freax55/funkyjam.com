<?php
/**
 * PAYGENT B2B MODULE
 * CSVTokenizer.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

/**
 * CSV�ǡ����β��ϥ��饹��<BR>
 * ����ʬ��ʸ����ǡ����򡢹��ܥꥹ�ȡ�ʸ��������ˤ��Ѵ����롣<BR>
 * �Ϥ�ʸ������ˡ��ǡ����Ȥ��ưϤ�ʸ������Ѥ��������ϡ��Ϥ�ʸ��2�Ĥǡ�
 * 1�ĤΰϤ�ʸ���ǡ����Ȥߤʤ���<BR>
 * �Ϥ�ʸ�������¸�ߤ��롢���ڤ�ʸ���ϡ����ڤ�ʸ���Ȥ��Ƥߤʤ���<BR>
 * ���ڤ�ʸ����ľ���ʸ�������Ϥ�ʸ�����ɤ����ǰϤ�ʸ�������뤫�ɤ�����Ƚ�Ǥ��롣<BR>
 * �ǡ��������ڤ�ʸ�����Ϥ�ʸ���ʳ���;�פ�ʸ��
 * �ʶ��ڤ�ʸ��������Υ��ڡ��������֤ʤɤ�ˤϤߤȤ�ʤ���
 * @version $Revision: 1.3 $
 * @author $Author: t-mori $
 */


	/** �ǥե���Ȥι��ܶ��ڤ�ʸ�� */
	define("CSVTokenizer__DEF_SEPARATOR", ',');
	/** �ǥե���Ȥι��ܥǡ����Ϥ�ʸ�� */
	define("CSVTokenizer__DEF_ITEM_ENVELOPE", '"');
	/** ���ܥǡ����Ϥ�ʸ��(�Ϥ߼��Τʤ�) */
	define("CSVTokenizer__NO_ITEM_ENVELOPE", chr(0));

class CSVTokenizer {

	/** ���ܶ��ڤ�ʸ�� */
	var $separator = null;
	/** ���ܥǡ����Ϥ�ʸ�� */
	var $itemEnvelope = null;

	/** �����оݥǡ��� */
	var $line;
	/** �����ɤ߽Ф����ϰ��� */
	var $currentPos;
	/** �ǽ��ɹ��߰��� */
	var $maxPos;

	/**
	 * ���󥹥ȥ饯��
	 * @param separator ���ܶ��ڤ�ʸ��
	 * @param envelope ���ܥǡ����Ϥ�ʸ��
	 */
	function CSVTokenizer($separator = ',', 
		$envelope = '"') {
		$this->separator = $separator;
		$this->itemEnvelope = $envelope;
	}

	/**
	 * CSV�ǡ���ʸ���󤫤���ܥǡ��������������롣
	 * @param value �����о�ʸ�����1��ʬ�Υǡ�����
	 * @return        �ǡ�������
	 */
	function parseCSVData($value) {
		if (isset($value) == false) {
			return array();
		}
		$this->line = $value;
		$this->maxPos = strlen($this->line);
		$this->currentPos = 0;

		// ���ܥǡ������Ǽ����
		$items = array();
		// �Ϥ�ʸ�����꡿�ʤ��ξ���Ƚ��ե饰
		$existEnvelope = false;

		while ($this->currentPos <= $this->maxPos) {
			/* �ǡ������ڤ���֤�������� */
			$endPos = $this->getEndPosition($this->currentPos);

			/* ������ʬ�Υǡ������ɤ߼�� */
			$temp = substr($this->line, $this->currentPos, $endPos - $this->currentPos);
			$work = "";
			// ���ܥǡ����ʤ��ξ��
			if (strlen($temp) == 0) {
				$work = "";
			} else {
				// �Ϥ�ʸ�������뤫�����å�����
				if ($this->itemEnvelope != null
					&& $temp{0} == $this->itemEnvelope) {
					$existEnvelope = true;
				}

				$isData = false;
				for ($i = 0; $i < strlen($temp);) {
					$chrTmp = $temp{$i};
					if ($existEnvelope == true
						&& $temp{$i} == $this->itemEnvelope) {
						$i++;
						if ($isData == true) {
							if (($i < strlen($temp))
								&& ($this->itemEnvelope != null
									&& $temp{$i}
										== $this->itemEnvelope)) {
								/* �Ϥ�ʸ��������³���Ƹ��줿�Ȥ��ϡ�
								 * ʸ���ǡ����Ȥ��Ƽ������� */
								$work .= $temp{$i++};
							} else {
								$isData = !$isData;
							}
						} else {
							$isData = !$isData;
						}
					} else {
						$work .= $temp{$i++};
					}
				}
			}
			/* ������ʬ�Υǡ�������Ͽ���� */
			$items[] = $work;

			/* �����ɼ���֤ι��� */
			$this->currentPos = $endPos + 1;
		}
		return $items;
	}

	/**
	 *    �ǡ������ڤ���֤��֤���
	 *    @param        start    �������ϰ���
	 *    @return        ���ǡ����ζ��ڤ���֤��֤�
	 */
	function getEndPosition($start) {
		// ʸ����ʸ���󳰤ξ���Ƚ��ե饰
		$state = false;
		// �Ϥ�ʸ�����꡿�ʤ��ξ���Ƚ��ե饰
		$existEnvelope = false;
		// �ɤ߹����ʸ��
		$ch = null;
		// ���ڤ����
		$end = 0;

		if ($start >= $this->maxPos) {
			return $start;
		}

		// �Ϥ�ʸ����̵ͭȽ��
		if ($this->itemEnvelope != null
			&& $this->line{$start} == $this->itemEnvelope) {
			$existEnvelope = true;
		}

		$end = $start;

		while ($end < $this->maxPos) {
			// ��ʸ���ɤ߹���
			$ch = $this->line{$end};
			// ʸ����Ƚ��
			if ($state == false
				&& $this->separator != null
				&& $ch == $this->separator) {
				// ʸ������ζ��ڤ�ʸ���Ǥʤ���С��ǡ������ڤ�
				break;
			} else if (
				$existEnvelope == true && $ch == $this->itemEnvelope) {
				// �Ϥ�ʸ�������줿�顢ʸ����ʸ���󳰤ξ���Ƚ���ȿž
				if ($state) {
					$state = false;
				} else {
					$state = true;
				}
			}
			// ʸ�����֤Υ�����ȥ��å�
			$end++;
		}
		return $end;
	}

	/**
	 * ʸ������˥���ޤ�¸�ߤ������""�ǰϤࡣ
	 * @param str �Ѵ��о�ʸ����
	 * @return �Ѵ����ʸ����
	 */
	function cnvKnmString($str) {
		if (isset($str) == false) {
			return null;
		}
		for ($i = 0; $i < strlen($str); ++$i) {
			if ($str{$i} == CSVTokenizer__DEF_SEPARATOR) {

				return "\"" . $str . "\"";
			}
		}

		return $str;
	}
}

?>
