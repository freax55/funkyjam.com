<?php
require_once('confirm.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../lib0904/util/mail/SimpleMail.php');

class ProcessAction extends Action {
	function execute(){
		$db = new DatabaseConnector($this->_db);
		
		$sql = "select coalesce(max(serial),0)+1 from backstage where place_code={$this->data["place"]};";
		$this->data["serial"] = $db->valQuery($sql);
		$f = $this->data;
		

		$sql = "INSERT INTO
			backstage (
				place,
				place_code,
				serial,
				member_no,
				mail,
				name,
				zip,
				pref_city,
				address,
				other_address,
				tel,
				c_stamp
			) VALUES (
				'{$this->units["places"][$f['place']]}',
				{$f['place']},
				'{$f['serial']}',
				'{$f['member_no']}',
				'{$f['mail']}',
				'{$f['last_name']} {$f['first_name']}',
				'{$f['zip1']}{$f['zip2']}',
				'{$f['pref_city']}',
				'{$f['address']}',
				'{$f['other_address']}',
				'{$f['tel1']}{$f['tel2']}{$f['tel3']}',
				current_timestamp
			);";
		$db->exQuery($sql);

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
		$mail->setTo($this->data['mail'],$this->data['last_name'] . " ‚³‚Ü");
		$mail->send();

		$this->data = null;
		$this->__controller->redirectToURL("?action=complete");

		return false;
	}
}
?>