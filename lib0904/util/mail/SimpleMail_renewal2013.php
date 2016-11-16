<?php	

require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/Renderer.php');

class Mail{
	var $subject;
	var $body;
	var $from;
	var $to;
	var $charset;
	
	function Mail($enc = 'UTF-8'){
		$this->charset = $enc;
	}
	
	/**
	 * Convert display encoding.
	 * @access private
	 * @return string
	 */
	function getDisp($str, $enc = 'UTF-8') {
		$str = mb_convert_encoding($str, $enc, 'JIS');

		return $str;
	}

	/**
	 * Convert mail body encoding.
	 * @access private
	 * @return string
	 */
	function encBody($str, $enc = 'SJIS') {
		$str = mb_convert_encoding($str, 'JIS', $enc);

		return $str;
	}

	/**
	 * Convert mail header encoding.
	 * @access private
	 * @return string
	 */
	function encHead($str, $enc = 'UTF-8') {
		$str = $this->encBody($str, $enc);
		$str = '=?iso-2022-jp?B?' . base64_encode($str) . '?=';

		return $str;
	}

	/**
	 * Send mail.
	 * @access private
	 */
	function send() {
		mail($this->to, $this->subject, $this->body, "From: " . $this->from);
	}

	function fold($str, $length = 70, $enc = 'UTF-8') {
		$str = str_replace("\r\n", "\n", $str);
		$str = str_replace("\r", "\n", $str);
		$lines = mb_split("\n", $str);
		
		foreach($lines as $key => $line) {
			$works = '';
			$pos = 0;
			while ($pos + $length < strlen($line)) {
				$works .= mb_strcut($line, $pos, $length, $enc) . "\n";
				$pos += $length;
			}
			$lines[$key] = $works . mb_strcut($line, $pos);
		}
		
		return implode("\n", $lines);
	}
	
	function setSubject($sub){
		$this->subject = $this->encHead($sub , $this->charset);
	}
	function setBody($body){
		$this->body = $this->encBody($body, $this->charset);
	}
	function setTo($toMail,$toName = false){
		if ($toName)
			$this->to = $this->encHead($toName, $this->charset) . '<' . $toMail . '>';
		else
			$this->to = $toMail;
	}
	function setFrom($fromMail , $fromName = false){
		if ($fromName)
			$this->from = $this->encHead($fromName, $this->charset) . '<' . $fromMail . '>';
		else
			$this->from = $fromMail;
	}
	
}

class SimpleMail extends Mail{
	var $vals;
	function SimpleMail($enc = 'UTF-8'){
		$this->charset = $enc;
	}
	function setVals($val){
		$this->vals = $vals;
	}
	function setBody($bodypath,$vals = false , $out_enc='SJIS'){
		$mail = new Renderer();
		$mail->template_dir = realpath($_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/..');

		if($vals)
			$mail->assign($vals);
		elseif($this->vals)
			$mail->assign($this->vals);

		$body = $mail->fetch($bodypath);

		$this->body = $this->encBody($body, $out_enc);
	}
}
?>