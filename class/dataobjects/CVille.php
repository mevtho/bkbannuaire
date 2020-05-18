<?php

class CVille {
	private $idVille;
	private $cpVille;
	private $nomVille;

	public function __construct($_idVille=-1, $_cpVille=0, $_nomVille="") {
		$this->idVille=$_idVille;
		$this->cpVille=$_cpVille;
		$this->nomVille=$_nomVille;
	}
		
	public function setIdVille ($_idVille) {
		$this->idVille=$_idVille;	
	}
		
	public function setCPVille ($_cpVille) {
		$this->cpVille=$_cpVille;
	}
	
	public function setNomVille ($_nomVille) {
		$this->nomVille=$_nomVille;
	}
	
	public function getIdVille () {
		return $this->idVille;	
	}
		
	public function getCPVille () {
		return $this->cpVille;
	}
	
	public function getNomVille () {
		return $this->nomVille;
	}
}

?>