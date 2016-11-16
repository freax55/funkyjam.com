<?php
/**
 * PAYGENT B2B MODULE
 * CSVWriter.php
 * 
 * Copyright (C) 2007 by PAYGENT Co., Ltd.
 * All rights reserved.
 */

/**
 * CSVWriter CSV�����ǥե��������Ϥ��롣
 * ������ˡ��<br />
 * <pre><code>
 * // writer���֥������Ȥ��롣�ǥե���Ȥ�Shift_JIS���󥳡���
 * CSVWriter writer = null;
 * try {
 *     writer = new CSVWriter(
 *         "c:\\temp\\test.txt", CSVWriter.ENCODING_SJIS);
 *     writer.open();
 *     List list = new ArrayList();
 *     list.add("1");
 *     list.add("abc");
 *     list.add("");
 *     list.add(",");
 *     list.add("�ˤۤ�");
 *     writer.writeOneLine(list);
 *     list.remove(0);
 *     list.add(0, "2");
 *     writer.writeOneLine(list);
 * } finally {
 *     writer.close();
 * }
 * </code></pre>
 * @version $Revision: 1.4 $
 * @author $Author: t-mori $
 */

	/** �ե����������Encoding Shift_JIS */
	define("CSVWriter__ENCODING_SJIS", "Shift_JIS");
	/** �ե����������Encoding EUC-JP */
	define("CSVWriter__ENCODING_EUC", "EUC_JP");
	/** �ե����������Encoding MS932 */
	define("CSVWriter__ENCODING_MS932", "SJIS-win");	//"Windows-31J";
	    /** �ե�������ϻ��β��ԥ����� \r\n */
	define("CSVWriter__WINDOWS_NEWLINE", "\r\n");
	    /** �ե�������ϻ��β��ԥ����� \n */
	define("CSVWriter__UNIX_NEWLINE", "\n");
	    /** �ե�������ϻ��β��ԥ����� \r */
	define("CSVWriter__MAC_NEWLINE", "\r");

class CSVWriter {

    var $csvFile;
    var $filePath;
    var $encoding;
    var $envelop;
    var $newLine = CSVWriter__WINDOWS_NEWLINE;

    /**
     * ���󥹥ȥ饯�������󥳡��ɵڤӹ��ܥǡ����Ϥ�ʸ���λ����Ԥ�Writer��������롣
     * @param filePath �ե�����ѥ�
     * @param encoding �ե�����Υ��󥳡���
     * @param envelop ���ܥǡ����Ϥ�ʸ��
     */
    function CSVWriter($filePath, $encoding = CSVWriter__ENCODING_MS932, $envelop = CSVTokenizer__DEF_ITEM_ENVELOPE) {
        $this->filePath = $filePath;
        $this->encoding = $encoding;
        $this->envelop = $envelop;
    }

    /**
     * ���ϥե�����򳫤���
     * �ե�������Ϥ���ǽ�ʾ��֤ˤ��롣
      * @return boolean TRUE:������FALSE������
     */
    function open() {

        $this->csvFile = fopen($this->filePath, "w");
        if ($this->csvFile == false) {
			$this->csvFile = null;
			trigger_error("cannot open file " . $this->filePath . " to write", E_USER_NOTICE);
			return false;        	
        }
        
        // �����å����󥳡��ǥ���
        if (mb_convert_encoding("���󥳡���", $this->encoding) === false){
			trigger_error("Unsupported Encoding " . $this->encoding . ".", E_USER_NOTICE);
			return false;        	
        }
        return true;
    }

    /**
     * ���ϥե�������Ĥ��롣
     * ���٥ե����������������Open����Ԥ����ȡ�
     */
    function close() {
        if ($this->csvFile != null) {
            fclose($this->csvFile);
            $this->csvFile = null;
        }
    }

    /**
     * ���ԥ����ɤ����ꤹ�롣̤����ξ�硢\n�ǽ��Ϥ��롣
     * @param newLine ���ԥ����ɤ�ʸ����
     */
    function setNewLine($newLine) {
        $this->newLine = $newLine;
    }

    /**
     * �ե��������ʬ�񤭹��ࡣ�����˲��ԥ����ɤ��ɲä��롣
     * List�ξ�硢List����Ȥ�CSV�����ΰ�Ԥ��Ѵ��������Ϥ�Ԥ���
     * @param line ���ʬ��ʸ����(String)����������(array)
     * @return �񤭹��᤿��true��
     */
    function writeOneLine($line) {

		if (is_string($line)) {
	        if ($this->csvFile == null) {
	            trigger_error("File not open.", E_USER_NOTICE);
	            return false;
	        }
	        $encLine = $line;
		
	        if (fwrite($this->csvFile, $line) === false) {
	        	trigger_error("File can not write.", E_USER_NOTICE);
	            return false;
	        }
	        fwrite($this->csvFile, $this->newLine);
	        flush($this->csvFile);
	        return true;
		} 
		else if (is_array($line)) {
	        $strLine = "";
	
	        // List to CSVString
	        $bFirstLine = true;
	        foreach($line as $i => $data) {
				if ($bFirstLine) {
					$bFirstLine = false;
				} else {
					$strLine .= ",";
				}
	
	            if ($this->envelop != CSVTokenizer__NO_ITEM_ENVELOPE) {
	                $strLine .= $this->envelop;
	            }
	            $strLine .= $this->cnvKnmString($data);
	            if ($this->envelop != CSVTokenizer__NO_ITEM_ENVELOPE) {
	                $strLine .= $this->envelop;
	            }
	        }
	
	        return $this->writeOneLine($strLine);
		}
    }

    /**
     * ʸ������˥���ޤ�¸�ߤ������""�ǰϤࡣ
     * ʸ������˥��֥륯�����ơ������¸�ߤ�����ϥ��֥륯�����ơ������ǥ��������פ���
     * ���֥륯�����ơ������ǰϤࡣ
     * @param str �Ѵ��о�ʸ����
     * @return �Ѵ����ʸ����
     */
    function cnvKnmString($str) {
        if ($str == null) {
            return null;
        }
        $flg = false;
        $buf = "";
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str{$i} == $this->envelop) {
                $buf .= $this->envelop;
                $flg = true;
            }
            if ($str{$i} == CSVTokenizer__DEF_SEPARATOR) {
                $flg = true;
            }
            $buf .= $str{$i};
        }
        return $buf;
    }
}

?>