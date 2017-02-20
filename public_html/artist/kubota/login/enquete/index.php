<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

//ini_set('display_errors','on');
//error_reporting(E_ALL);

class Controller extends DefaultController {
	var $units = null;
	var $errors = null;
	
	function init() {
		parent::init();
		$this->__defaultAction = 'input';
		$this->__defaultActionFile = $_SERVER['DOCUMENT_ROOT'] . '/../lib0904/simple/DefaultAction.php';
		$this->__defaultActionClass = 'DefaultAction';

		$this->units["presents"] = array(
			1 => array(
				"name" => "ŽµŽ×ŽÊŽÝŽÅŽÄŽÍŽ¿Ž­ ŽÄŽ¾ŽÉŽ®Ž¥ŽµŽ¥Ž¤Ž¥ŽÆŽ¤ NYŽÅŽÚŽ»Žº A<br>[URBAN OUTFITTERSŽÀŽÞŽ¤ô¦Ž¿Ž¤Ž¿Ž¤ŽßŽ¥Ž¥ê§ŽÃŽ¥Ž¯]Ž¡Ž¡2ŽÌŽ¾ŽÍŽÍ",
				"value" => ""
			),
			2 => array(
				"name" => "ŽµŽ×ŽÊŽÝŽÅŽÄŽÍŽ¿Ž­ ŽÄŽ¾ŽÉŽ®Ž¥ŽµŽ¥Ž¤Ž¥ŽÆŽ¤ NYŽÅŽÚŽ»Žº B<br>[URBAN OUTFITTERSŽ¥ŽÎŽ¡Ž¼Ž¥ŽÈ]Ž¡Ž¡3ŽÌŽ¾ŽÍŽÍ",
				"value" => ""
			),
			3 => array(
				"name" => "ŽÊŽ¸Ž¸ŽËŽËŽÜŽ¡ŽÖŽ´ŽÌŽ¯Ž¤ŽÊŽÏŽÀŽÍŽ­Žµ,Ž­Ž¶Ž¡Ž×ŽÄŽ¾ŽÉŽ®Ž¥ŽµŽ¥Ž¤Ž¥ŽÆŽ¤ô£Ž¡1ŽÌŽ¾ŽÍŽÍ",
				"value" => "Ž¢Ž¨Ž¥ŽµŽ¥Ž¤Ž¥Ž¤ŽÏŽ½ò¶Ž©Ž¤ŽÎŽ¤ŽßŽ¤ŽÈŽ¤ŽÊŽ¤ô¦ŽÞŽ¤Ž¹"
			),
			4 => array(
				"name" => "ŽµŽ×ŽÊŽÝŽÅŽÄŽÍŽ¿Ž­ ŽÄŽ¾ŽÉŽ®Ž¥ŽÏŽ¥Ž¬Ž¥Ž­Ž¡Ž¡1ŽÌŽ¾ŽÍŽÍ",
				"value" => ""
			));
	
		$this->auth();
	}

	function input(){}

	function confirm(){
		$this->errors = $this->dataValidation();
		if(count($this->errors))
			return "input";
	}

	function process(){
		$this->errors = $this->dataValidation();
		if(count($this->errors))
			return "input";

		$m = parse_ini_file(dirname(__FILE__).'/mail.ini', true);
		$mail = new SimpleMail();

		$mail->setFrom($m['admin']['fromMail'],$m['admin']['fromName']);
		$mail->setSubject($m['admin']['subject']);
		$mail->setBody(
			dirname(__FILE__).'/mail.html' ,
			array("data" => $this->data,"units"=>$this->units) );

		$mail->setTo($m['admin']['toMail']);
		$mail->send();

		$mail->setSubject($m['customer']['subject']);
		$mail->setTo($this->data['mail'],$this->data['name'] . " Ž¤ŽµŽ¤");
		$mail->send();

		$this->data = null;
		$this->redirectToAction('complete');
	}

	function complete(){}

	function dataValidation(){
		$keys = array(
			"enq1" => array("emp"),
			"enq2" => array("emp"),
			"enq3" => array(),
			"name" => array("emp"),
			"mail" => array("emp","mail"),
			"no" => array("emp","^[0-9]{8}$"),
			"present_id" => array("empR"),
		);

		return $this->validationExec($this->data , $keys);
	}

	function auth(){
		session_start();

		if(!$_SESSION["loginID"]){
			$this->redirectToURL('../');
			exit();
		}
	}


	function validationExec($data , $keys , $errorMessages=null , $errors=null){
		$d = $data;
		$errorMessagesD = array(
			'emp' => 'ŽÆŽÎŽÏŽ¤Ž¤ŽªŽ´ô¦Ž¤Ž¤Ž·Ž¤ŽÞŽ¤Ž¹Ž¡Ž£',
			'empR' => 'ŽÁŽªŽÂŽ¤Ž¤ŽªŽ´ô¦Ž¤Ž¤Ž·Ž¤ŽÞŽ¤Ž¹Ž¡Ž£',
			'empS' => 'ŽÁŽªŽÂŽ¤Ž¤ŽªŽ´ô¦Ž¤Ž¤Ž·Ž¤ŽÞŽ¤Ž¹Ž¡Ž£',
			'num' => 'ŽÈŽ¾Ž³ŽÑŽ¿Ž»Ž¤ŽÇŽÆŽÎŽÏŽ¤Ž·Ž¤ŽÆŽ¤Ž¯Ž¤ŽÀŽ¤ŽµŽ¤Ž¤Ž¡Ž£',
			'cmp' => 'Ž³ŽÎŽÇŽ§ŽÆŽÎŽÏŽ¤ŽÈŽ°ŽÃŽ×Ž¤Ž·Ž¤ŽÆŽ¤Ž¤Ž¤ŽÞŽ¤Ž»Ž¤Ž¡Ž£ŽÆŽÎŽÏŽ¤Ž¤Ž´Ž³ŽÎŽÇŽ§Ž¤Ž¯Ž¤ŽÀŽ¤ŽµŽ¤Ž¤Ž¡Ž£',
			'mail' => 'Ž·ŽÁŽ¼Ž°Ž¤Ž³ŽÎŽÇŽ§Ž¤Ž·Ž¤ŽÆŽ¤Ž¯Ž¤ŽÀŽ¤ŽµŽ¤Ž¤Ž¡Ž£',
			'reg' => 'Ž·ŽÁŽ¼Ž°Ž¤Ž³ŽÎŽÇŽ§Ž¤Ž·Ž¤ŽÆŽ¤Ž¯Ž¤ŽÀŽ¤ŽµŽ¤Ž¤Ž¡Ž£'
		);
		if(count ($errorMessages))
			$errorMessagesD = array_merge($errorMessagesD, $errorMessages);
		$errorMessages = $errorMessagesD;

		$errors = array();
		foreach($keys as $name => $key){
			foreach ($key as $validation){
				switch ($validation) {
					case "emp":
						if(empty ($d[$name])){
							$errors[$name] = $errorMessages[$validation];
							break 2;
						}
						break;
					case "empR":
						if(empty ($d[$name])){
							$errors[$name] = $errorMessages[$validation];
							break 2;
						}
						break;
					case "mail":
						if(!preg_match('/^(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*")(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|"[^\\\x80-\xff\n\015"]*(?:\\[^\x80-\xff][^\\\x80-\xff\n\015"]*)*"))*@(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\])(?:\.(?:[^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff]+(?![^(\040)<>@,;:".\\\[\]\000-\037\x80-\xff])|\[(?:[^\\\x80-\xff\n\015\[\]]|\\[^\x80-\xff])*\]))*$/', $d[$name])){
							$errors[$name] = $errorMessages[$validation];
							break 2;
						}
						break;
					default:
						if(!mb_ereg_match($validation, $d[$name])){
							$errors[$name] = $errorMessages["reg"];
							break 2;
						}
						break;
				}
			}
		}

		return $errors;
	}
}

$controller = new Controller();
$controller->run();
?>