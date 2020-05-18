<?php

class CAdresse {
	private $adresseL1;
	private $adresseL2;
	private $ville;
	
	public function __construct($_adresseL1=null, $_adresseL2=null, $_ville=null) {
		$this->adresseL1=$_adresseL1;
		$this->adresseL2=$_adresseL2;
		$this->ville=$_ville;
	}
	
	public function setAdresseL1 ($_adresseL1) {
		$this->adresseL1=$_adresseL1;
	}

	public function setAdresseL2 ($_adresseL2) {
		$this->adresseL2=$_adresseL2;
	}

	public function setVille ($_ville) {
		$this->ville=$_ville;
	}
	
	public function getAdresseL1 () {
		return $this->adresseL1;
	}

	public function getAdresseL2 () {
		return $this->adresseL2;
	}

	public function getVille () {
		return $this->ville;
	}
	
	
}

?>