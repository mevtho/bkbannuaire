<?php

require_once("CCommunication.php");
require_once("CAdresse.php");
require_once("CLicence.php");
require_once("CVille.php");


class CContact {
	private $idContact;
	private $nomContact;
	private $prenomContact;
	private $dateNaissance;
	private $sexeContact;
	
	private $responsable1;
	private $responsable2;
	
	private $licence;
	
	private $communication;
	
	private $groupes;
	
	private $notes;
	
	public function __construct($_idContact=-1, $_nomContact="", $_prenomContact="", $_sexeContact="M", $_dateNaissance=null, $_licence=null, $_responsable1=null, $_responsable2=null, $_communication=null, $_groupes=Array(), $_notes="") {
		$this->idContact=$_idContact;
		$this->nomContact=$_nomContact;
		$this->prenomContact=$_prenomContact;
		$this->sexeContact=$_sexeContact;
		$this->dateNaissance=$_dateNaissance;
		$this->licence=$_licence;
		$this->responsable1=$_responsable1;
		$this->responsable2=$_responsable2;
		$this->communication=$_communication;
		$this->groupes=$_groupes;
		$this->notes=$_notes;
	}

	public function setIdContact($_idContact) {
		$this->idContact=$_idContact;
	}
	
	public function setNomContact($_nom) {
		$this->nomContact=$_nom;
	}
	
	public function setPrenomContact($_prenom) {
		$this->prenomContact=$_prenom;
	}
	
	public function setSexeContact($_sexe) {
		$this->sexeContact=$_sexe;
	}
	
	public function setDateNaissance($_dateNaissance) {
		$this->dateNaissance=$_dateNaissance;
	}	
	
	public function setLicence($_licence) {
		$this->licence=$_licence;
	}
	
	public function setResponsable1($_contact) {
		$this->responsable1=$_contact;
	}

	public function setResponsable2($_contact) {
		$this->responsable2=$_contact;
	}
	
	public function setCommunication ($_communication) {
		$this->communication=$_communication;
	}

	public function setGroupes ($_groupes) {
		$this->groupes=$_groupes;
	}
	
	public function addGroupe ($_groupe) {
		$this->groupes[]=$_groupe;
	}

	public function setNotes ($_notes) {
		$this->notes=$_notes;
	}
	
	public function getIdContact() {
		return $this->idContact;
	}
	
	public function getNomContact() {
		return $this->nomContact;
	}
	
	public function getPrenomContact() {
		return $this->prenomContact;
	}
	
	public function getSexeContact() {
		return $this->sexeContact;
	}
	
	public function getDateNaissance() {
		return $this->dateNaissance;
	}	
	
	public function getLicence() {
		return $this->licence;
	}
	
	public function getResponsable1() {
		return $this->responsable1;
	}

	public function getResponsable2() {
		return $this->responsable2;
	}
	
	public function getCommunication () {
		return $this->communication;
	}

	public function getGroupes () {
		return $this->groupes;
	}	

	public function getNotes () {
		return $this->notes;
	}	
	
	public static function getBlank() {
		return new CContact(-1,"","","M","",new CLicence(),"","",new CCommunication(new CAdresse("","",new CVille())), array(), "");
	}
}

?>