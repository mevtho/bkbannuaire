<?php

class CLicence {
	private $numLicence;
	private $mutation;
	private $surclassement;
	private $dateQualification;
	private $brule;
	
	public function __construct($_numLicence=null, $_mutation=false, $_surclassement=false, $_dateQualification=null, $_brule=false) {
		$this->numLicence=$_numLicence;
		$this->mutation=$_mutation;
		$this->surclassement=$_surclassement;
		$this->dateQualification=($_dateQualification == "")?"0000-00-00":$_dateQualification;
		$this->brule=$_brule;
	}
	
	public function setNumLicence ($_numLicence) {
		$this->numLicence=$_numLicence;
	}

	public function setMutation ($_mutation) {
		$this->mutation=$_mutation;
	}
	
	public function setSurclassement ($_surclassement) {
		$this->surclassement=$_surclassement;
	}
	
	public function setDateQualification ($_date) {
		$this->dateQualification=$_date;
	}

	public function setBrulure ($_brule) {
		$this->brule=$_brule;
	}
	
	public function getNumLicence () {
		return $this->numLicence;
	}

	public function getMutation () {
		return $this->mutation;
	}
	
	public function getSurclassement () {
		return $this->surclassement;
	}
	
	public function getDateQualification () {
		return $this->dateQualification;
	}

	public function getBrulure () {
		return $this->brule;
	}
}

?>