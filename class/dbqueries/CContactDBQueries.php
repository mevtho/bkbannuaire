<?php

require_once ("CAccesDB.php");
require_once ("utils.php");
require_once ("CContact.php");
require_once ("CVilleDBQueries.php");
require_once ("CGroupeDBQueries.php");

class CContactDBQueries {
	private static $MASK_LENGTH = 2;
	public static $IDS_ONLY = 0;				// 00
	public static $DETAILS_RESPONSABLE = 1; 	// 01
	public static $DETAILS_GROUPES = 2; 		// 10

	public static function get ($_id, $_opt=null) {
		if ($_opt===null)
			$_opt = self::$DETAILS_RESPONSABLE | self::$DETAILS_GROUPES;
		$contactList=self::getList("idContact=".$_id, $_opt);
		return isset($contactList[0])?$contactList[0]:null;
	}

	public static function getList ($_w="", $_opt=0) {
		$acces=CAccesDB::getDBAcces();
		$opt=str_pad(decbin($_opt), self::$MASK_LENGTH, '0', STR_PAD_LEFT);

		$sql = "select * from ".TABLE_CONTACT." as contact".(strlen($_w)?" where ".$_w:"").
				" order by contact.nomContact asc, contact.prenomContact asc";
		$res=$acces->query($sql);

		$resultList=Array();

		while ($row=$acces->fetch_assoc($res)) {
			$licence=new CLicence($row['numLicence'], $row['mutation'], $row['surclassement'],
								  $row['dateQualification']);

			/* Added 16/08/2013 : Brulure joueur */
			if (array_key_exists('brulure', $row))
				$licence->setBrulure($row['brulure']);
			/* */

			$ville=(((int)$row['ville_idVille'])!=0)? CVilleDBQueries::get($row['ville_idVille']):null;

			$communication=new CCommunication(new CAdresse(normalize_read($row['adresseL1']),normalize_read($row['adresseL2']),$ville),
											  $row['tel1'], $row['tel2'], $row['email']);

			$responsable1=($opt[self::$MASK_LENGTH-1]=="1" && isset ($row['idResponsable1']))?CContactDBQueries::get($row['idResponsable1'], CContactDBQueries::$IDS_ONLY):$row['idResponsable1'];
			$responsable2=($opt[self::$MASK_LENGTH-1]=="1" && isset ($row['idResponsable2']))?CContactDBQueries::get($row['idResponsable2'], CContactDBQueries::$IDS_ONLY):$row['idResponsable2'];

			$sql2="select * from ".TABLE_MEMBRE_GROUPE." as membre_groupe where contact_idContact=".$row['idContact'];
			$res2=$acces->query($sql2);

			$groupes=array();

			while ($row2=$acces->fetch_assoc($res2)) {
				$groupes[]=($opt[self::$MASK_LENGTH-2]=="1")
							? CGroupeDBQueries::get($row2['groupe_idGroupe'], CGroupeDBQueries::$IDS_ONLY)
							: $row2['groupe_idGroupe'];
			}

			$notes=$row['notes'];

			$contact=new CContact($row['idContact'], normalize_read($row['nomContact']), normalize_read($row['prenomContact']),
								  $row['sexeContact'], $row['dateNaissance'],$licence,$responsable1,
								  $responsable2, $communication, $groupes, $notes);
			$resultList[]=$contact;

		}

		return $resultList;
	}

	public static function put ($_contact) {
		if ($_contact->getIdContact()==-1)
			self::create($_contact);
		else
			self::update($_contact);
	}

	public static function create ($_contact) {
		$acces=CAccesDB::getDBAcces();

		$idResponsable1=($_contact->getResponsable1() instanceof CContact)
						? $_contact->getResponsable1()->getId()
						: $_contact->getResponsable1();
		$idResponsable2=($_contact->getResponsable2() instanceof CContact)
						? $_contact->getResponsable2()->getId()
						: $_contact->getResponsable2();
		$notes = htmlentities($_contact->getNotes(), ENT_COMPAT | ENT_QUOTES | ENT_IGNORE | ENT_HTML401, "ISO8859-15" );

		$sql="insert into ".TABLE_CONTACT." (nomContact, prenomContact,
											 sexeContact, dateNaissance,
											 idResponsable1, idResponsable2,
											 numLicence, mutation,
											 surclassement, dateQualification, brulure,
											 adresseL1, adresseL2,
											 ville_idVille, tel1,
											 tel2, email, notes)
											 values (
											 '".fudb($_contact->getNomContact())."',
											 '".fdb($_contact->getPrenomContact())."',
											 '".$_contact->getSexeContact()."',
											 '".$_contact->getDateNaissance()."',
											 ".$idResponsable1.",
											 ".$idResponsable2.",
											 '".$_contact->getLicence()->getNumLicence()."',
											 '".$_contact->getLicence()->getMutation()."',
											 '".$_contact->getLicence()->getSurclassement()."',
											 '".$_contact->getLicence()->getDateQualification()."',
											 '".$_contact->getLicence()->getBrulure()."',
											 '".fdb($_contact->getCommunication()->getAdresse()->getAdresseL1())."',
											 '".fdb($_contact->getCommunication()->getAdresse()->getAdresseL2())."',
											 '".$_contact->getCommunication()->getAdresse()->getVille()->getIdVille()."',
											 '".$_contact->getCommunication()->getTel1()."',
											 '".$_contact->getCommunication()->getTel2()."',
											 '".$_contact->getCommunication()->getEmail()."',
											 '".$notes."'
											 )";

		$acces->query($sql);
        $_contact->setIdContact($acces->last_insert_id());

		self::createMembership($_contact);
	}

	public static function update ($_contact) {
		$acces=CAccesDB::getDBAcces();

		$idResponsable1=($_contact->getResponsable1() instanceof CContact)
						? $_contact->getResponsable1()->getId()
						: $_contact->getResponsable1();
		$idResponsable2=($_contact->getResponsable2() instanceof CContact)
						? $_contact->getResponsable2()->getId()
						: $_contact->getResponsable2();
		$notes = htmlentities($_contact->getNotes(), ENT_COMPAT | ENT_QUOTES | ENT_IGNORE | ENT_HTML401, "ISO8859-15" );

		$sql="update ".TABLE_CONTACT.
			 " set nomContact='".fudb($_contact->getNomContact())."',
			 prenomContact='".fdb($_contact->getPrenomContact())."',
			 sexeContact='".$_contact->getSexeContact()."',
			 dateNaissance='".$_contact->getDateNaissance()."',
			 idResponsable1=".$idResponsable1.",
			 idResponsable2=".$idResponsable2.",
			 numLicence='".$_contact->getLicence()->getNumLicence()."',
			 mutation='".$_contact->getLicence()->getMutation()."',
			 surclassement='".$_contact->getLicence()->getSurclassement()."',
			 brulure='".$_contact->getLicence()->getBrulure()."',
			 dateQualification='".$_contact->getLicence()->getDateQualification()."',
			 adresseL1='".fdb($_contact->getCommunication()->getAdresse()->getAdresseL1())."',
			 adresseL2='".fdb($_contact->getCommunication()->getAdresse()->getAdresseL2())."',
			 ville_idVille='".$_contact->getCommunication()->getAdresse()->getVille()->getIdVille()."',
			 tel1='".$_contact->getCommunication()->getTel1()."',
			 tel2='".$_contact->getCommunication()->getTel2()."', 
			 email='".$_contact->getCommunication()->getEmail()."',
			 notes='".$notes."'
			 where idContact=".$_contact->getIdContact();

		$acces->query($sql);

		self::deleteMembership($_contact);
		self::createMembership($_contact);
	}

	public static function delete ($_contact) {
		if ($_contact==null) return;

		$acces=CAccesDB::getDBAcces();
		$sql=array();
		$sql[]="START TRANSACTION";
		$sql[]="update ".TABLE_GROUPE." set idResponsable=null where idResponsable=".$_contact->getIdContact();
		$sql[]="update ".TABLE_CONTACT." set idResponsable1=null where idResponsable1=".$_contact->getIdContact();
		$sql[]="update ".TABLE_CONTACT." set idResponsable2=null where idResponsable2=".$_contact->getIdContact();
		$sql[]="delete from ".TABLE_MEMBRE_GROUPE." where Contact_idContact=".$_contact->getIdContact();
		$sql[]="delete from ".TABLE_CONTACT." where idContact=".$_contact->getIdContact();
		$sql[]="COMMIT";

		foreach ($sql as $q)
		 	if (!$acces->query($q)) {
		 		$acces->query("ROLLBACK");
		 		return false;
		 	}

		return true;
	}

	private static function deleteMembership ($_contact) {
		$acces=CAccesDB::getDBAcces();
		$sql="delete from ".TABLE_MEMBRE_GROUPE." where contact_idContact=".$_contact->getIdContact();
		return $acces->query($sql);
	}

	private static function createMembership ($_contact) {
		$acces=CAccesDB::getDBAcces();
		$groupes="";

		if (count($_contact->getGroupes())==0)
			return;

		foreach ($_contact->getGroupes() as $groupe) {
			$idGroupe=($groupe instanceof CGroupe)?$groupe->getIdGroupe():$groupe;
			$groupes.="(".$groupe.",".$_contact->getIdContact()."),";
		}
		$sql="insert into ".TABLE_MEMBRE_GROUPE." (groupe_idGroupe, contact_idContact)
			values ".substr($groupes,0,strlen($groupes)-1);

		return $acces->query($sql);
	}

}

?>
