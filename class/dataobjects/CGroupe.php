<?php

class CGroupe {
	private $idGroupe;
	private $nomGroupe;
	private $responsable;

	private $membres;
	
	public function  __construct($_idGroupe=-1, $_nomGroupe="", $_responsable=null, $_membres=Array()) {
		$this->idGroupe=$_idGroupe;
		$this->nomGroupe=$_nomGroupe;
		$this->responsable=$_responsable;
			
		$this->membres=$_membres;
	}
	
	public function setIdGroupe ($_idGroupe) {
		$this->idGroupe=$_idGroupe;
	}
	
	public function setNomGroupe ($_nomGroupe) {
		$this->nomGroupe=$_nomGroupe;
	}
	
	public function setResponsable ($_responsable) {
		$this->responsable=$_responsable;
	}
	
	public function setMembres ($_membres) {
		$this->membres=$_membres;
	}
	
	public function addMembres ($_membre) {
		$this->membres[]=$_membre;
	}
		
	public function getIdGroupe () {
		return $this->idGroupe;
	}
	
	public function getNomGroupe () {
		return $this->nomGroupe;
	}
	
	public function getResponsable () {
		return $this->responsable;
	}
	
	public function getMembres () {
		return $this->membres;
	}
	
	public function isResponsable($_contact) {
		if ($this->getResponsable() == null)
			return false;
		else
			return $_contact->getIdContact() == $this->getResponsable()->getIdContact();
	}
}

?>