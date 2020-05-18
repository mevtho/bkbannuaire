<?php

class CCommunication {
	private $adresse;
	private $tel1;
	private $tel2;
	private $email;

	public function  __construct($_adresse=null, $_tel1=null, $_tel2=null, $_email=null) {
		$this->adresse=$_adresse;
		$this->tel1=$_tel1;
		$this->tel2=$_tel2;
		$this->email=$_email;
	}

	public function setAdresse ($_adresse) {
		$this->adresse=$_adresse;
	}

	public function setTel2 ($_tel2) {
		$this->tel2=$_tel2;
	}

	public function setTel1 ($_tel1) {
		$this->tel1=$_tel1;
	}

	public function setEmail ($_email) {
		$this->email=$_email;
	}

	public function getAdresse () {
		return $this->adresse;
	}

	public function getTel2 () {
		return $this->tel2;
	}

	public function getTel1 () {
		return $this->tel1;
	}

	public function getEmail () {
		return $this->email;
	}
}

?>
