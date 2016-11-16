<?php
require_once dirname(__FILE__) . '/Mail_mimeDecode-1.5.1/mimeDecode.php';
require_once dirname(__FILE__) . '/XML_RPC-1.5.3/RPC.php';

/**
 *
 * @author Deg
 */
class mailTriggerPostMT {
	var $data;
	var $subject;
	var $body;
	var $from;

	function mailTriggerPostMT() {
	}

	/**
	 * Check representative
	 *
	 * @param Array $persons
	 * @return boolean
	 */
	function checkPerson($persons) {
		if(isset($persons)) {
		} else {
			return false;
		}
		
		$mail = $this->from;
//		if(array_key_exists($mail, $persons)) {
//			return true;
//		}
		foreach($persons as $key => $value) {
			if(preg_match('/' . $key . '/', $mail)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * メール分割
	 * 
	 * @param String $filename
	 */
	function mailDecode($filename = "php://stdin") {
		$params = array();
		$params['include_bodies'] = true;
		$params['decode_bodies']  = true;
		$params['decode_headers'] = true;
		$params['input'] = file_get_contents($filename);
		$params['crlf'] = "\r\n";
		
		$type = array(
			'jpeg' => 'jpg',
			'gif' => 'gif',
			'png' => 'png',
		);

		$data = Mail_mimeDecode::decode($params);
		
		$subject = $data->headers['subject'];
		$subject = mb_convert_encoding($subject, 'UTF-8', 'JIS');
		$subject = htmlspecialchars($subject);
		
		// マルチパートメールの場合とそうでない場合、本文の場所が異なる。
		if($data->parts) {
			$body = $data->parts[0]->body;
		} else {
			$body = $data->body;
		}
		$body = mb_convert_encoding($body, 'UTF-8', 'JIS');
		
		// XML-RPCの場合空白行がなくなってしまうので空文字を一文字入れる。
		$body = preg_replace("/(\r\n)|\r/u", "\n", $body);
		$body = preg_replace("/^\n/um", " \n", $body);

		$from = $data->headers['from'];

		/**
		 * 画像処理
		 */
		if(isset($data->parts[1])) {
			$imageBinary = $data->parts[1]->body;
			$imageType = $type[$data->parts[1]->ctype_secondary];
		}

		$this->data = $data;
		$this->subject = $subject;
		$this->body = $body;
		$this->from = $from;
		$this->imageBinary = $imageBinary;
		$this->imageType = $imageType;
	}

	/**
	 * XML-RPC 投稿
	 * 
	 * @param String $domain
	 * @param String $path
	 * @param String $blogid
	 * @param String $username
	 * @param String $password
	 * @return Mixed
	 */
	function postMT($domain, $path, $blogid, $username, $password) {
		if(isset($domain)) {
		} else {
			return false;
		}
		if(isset($path)) {
		} else {
			return false;
		}
		if(isset($blogid)) {
		} else {
			return false;
		}
		if(isset($username)) {
		} else {
			return false;
		}
		if(isset($password)) {
		} else {
			return false;
		}
		
		
		$client = new XML_RPC_Client($path, 'http://' . $domain);

		/**
		 * 記事投稿
		 */
		$message = new XML_RPC_MESSAGE(
			'metaWeblog.newPost',
			array(
				$this->_xml_rpc_value($blogid),
				$this->_xml_rpc_value($username),
				$this->_xml_rpc_value($password),
				$this->_xml_rpc_value(
					array(
						'title' => $this->_xml_rpc_value($this->subject),
						'description' => $this->_xml_rpc_value($this->body),
						'mt_convert_breaks' => $this->_xml_rpc_value(0)
					)
				),
				$this->_xml_rpc_value(1)
			)
		);
		$postId = $client->send($message);
		$res = XML_RPC_decode($postId->value());
		$imageName = $res;
		
		
		/**
		 * 画像投稿
		 */
		$message = new XML_RPC_MESSAGE(
			'metaWeblog.newMediaObject',
			array(
				$this->_xml_rpc_value($blogid),
				$this->_xml_rpc_value($username),
				$this->_xml_rpc_value($password),
				$this->_xml_rpc_value(
					array(
						'bits' => $this->_xml_rpc_value($this->imageBinary, 'base64'),
						'name' => $this->_xml_rpc_value('images/' . $imageName . '.' . $this->imageType)
					)
				)
			)
		);
		$result = $client->send($message);
	}

	/**
	 * The value of the XML-RPC format
	 * 
	 * @param Mixed $value
	 * @return Mixed
	 */
	function _xml_rpc_value($value, $type = null) {
		if(isset($value)) {
		} else {
			return false;
		}
		
		if(isset($type)) {
			return new XML_RPC_Value($value, $type);
		} elseif(is_array($value)) {
			return new XML_RPC_Value($value, 'struct');
		} elseif(is_string($value)) {
			return new XML_RPC_Value($value, 'string');
		} elseif(is_numeric($value)) {
			return new XML_RPC_Value($value, 'boolean');
		}
		return false;
	}
}
?>
