<?php

require_once ("IForm.php");
require_once ("CContact.php");
require_once ("CLicence.php");
require_once ("CCommunication.php");

require_once ("CContactDBQueries.php");
require_once ("CVilleDBQueries.php");
require_once ("CGroupeDBQueries.php");

class CFormContact implements IForm {

	public function showForm ($_id=-1) {
		$contact=CContactDBQueries::get($_id, CContactDBQueries::$IDS_ONLY);
		$villes=CVilleDBQueries::getList();
		$contacts=CContactDBQueries::getList("idContact!=".$_id, CContactDBQueries::$IDS_ONLY);
		$groupes=CGroupeDBQueries::getList("", CGroupeDBQueries::$IDS_ONLY);

		if (is_null($contact))
			$contact=CContact::getBlank();

		$action=($contact->getIdContact()==-1)?"Nouveau":"Edition";

		require_once ("form_contact.php");
	}

	public function processForm ($_vars) {
		$licence=new CLicence($_vars['numLicence'],
							 (int)isset($_vars['mutation']),
							 (int)isset($_vars['surclassement']),
							 strtodate($_vars['dateQualification']),
							 (int)isset($_vars['brulure']));

		$ville=CVilleDBQueries::get($_vars['idVille']);
        if ($ville==null)
            $ville=new CVille();
		$adresse=new CAdresse($_vars['adresseL1'], $_vars['adresseL2'], $ville);
		$communication=new CCommunication($adresse, $_vars['tel1'], $_vars['tel2'], $_vars['email']);

		$groupes=(isset($_vars['groupes'])?$_vars['groupes']:array());

		$_vars['idResponsable1']=($_vars['idResponsable1']==-1)?"NULL":$_vars['idResponsable1'];
		$_vars['idResponsable2']=($_vars['idResponsable2']==-1)?"NULL":$_vars['idResponsable2'];

		$contact=new CContact($_vars['idContact'], $_vars['nomContact'], $_vars['prenomContact'],
							  $_vars['sexeContact'], strtodate($_vars['dateNaissance']), $licence, $_vars['idResponsable1'],
							  $_vars['idResponsable2'],$communication,$groupes, $_vars['notes']);

		CContactDBQueries::put($contact);
	}

	public function checkInput ($_vars) {
		$return = array();

		if (strlen($_vars['nomContact'])==0) {
			$return[]="Nom contact : Le nom du contact doit être spécifié.";
		}

		if (strlen($_vars['prenomContact'])==0) {
			$return[]="Prénom contact : Le prénom du contact doit être spécifié.";
		}

		if (strlen($_vars['dateNaissance'])>0) {
			$l=array(31,28,31,30,31,30,31,31,30,31,30,31); // jour par mois
			$date=explode("/", $_vars['dateNaissance']);
			if (count($date)!=3 || strlen($date[2])!=4 ) {
				$return[]="Date de naissance : Format de date jj/mm/aaaa";
			}
			else {
				$l[2-1]=(((int)$date[2])%4==0)?$l[2]+1:$l[2];
				if ( (int)$date[1]>12 || (int)$date<=0 ) { // Mois
					$return[]="Date de naissance : Le mois doit être compris entre 1 et 12";
				}
				else if ((int)$date[0]>$l[((int)$date[1])-1] || (int)$date<=0 ) { // Jour
					$return[]="Date de naissance : Il y a ".$l[((int)$date[1])-1]." jours au cours du mois ".$date[1];
				}
			}
		}

		if (strlen($_vars['numLicence'])>10) {
			$return[]="Numéro licence : Le numéro de licence est limité à 10 caractères.";
		}

		if (strlen($_vars['dateQualification'])>0) {
			$l=array(31,28,31,30,31,30,31,31,30,31,30,31); // jour par mois
			$date=explode("/", $_vars['dateQualification']);
			if (count($date)!=3 || strlen($date[2])!=4 ) {
				$return[]="Date de qualification : Format de date jj/mm/aaaa";
			}
			else {
				$l[2-1]=(((int)$date[2])%4==0)?$l[2]+1:$l[2];
				if ( (int)$date[1]>12 || (int)$date<=0 ) { // Mois
					$return[]="Date de qualification : Le mois doit être compris entre 1 et 12";
				}
				else if ((int)$date[0]>$l[((int)$date[1])-1] || (int)$date<=0 ) { // Jour
					$return[]="Date de qualification : Il y a ".$l[((int)$date[1])-1]." jours au cours du mois ".$date[1];
				}
			}
		}

		if (strlen($_vars['adresseL1'])>120) {
			$return[]="Adresse ligne 1 : La ligne saisie est trop longue.";
		}

		if (strlen($_vars['adresseL2'])>120) {
			$return[]="Adresse ligne 2 : La ligne saisie est trop longue.";
		}

		if (strlen($_vars['tel2'])!=0 && strlen($_vars['tel2'])!=10) {
			$return[]="Téléphone 2 : Un numéro de téléphone est composé de 10 chiffres.";
		}

		if (strlen($_vars['tel1'])!=0 && strlen($_vars['tel1'])!=10) {
			$return[]="Téléphone 1 : Un numéro de téléphone est composé de 10 chiffres.";
		}

		if (strlen($_vars['email'])!=0 && !filter_var($_vars['email'], FILTER_VALIDATE_EMAIL)) {
			$return[]="E-mail : Adresse invalide.";
		}

		if (strlen($_vars['notes']) > 300) {
			$return[]="Notes : 300 caractères maximum.";
		}

		return ((empty($return))?true:$return);
	}

	public function cloneForm ($_id=-1) {
		if ($_id==-1) {
			$this->showForm();
			return;
		}

		$contact=CContactDBQueries::get($_id,CContactDBQueries::$IDS_ONLY);

        if (is_null($contact)) {
			showForm();
			return;
		}

		$villes=CVilleDBQueries::getList();
		$contacts=CContactDBQueries::getList("", CContactDBQueries::$IDS_ONLY);
		$groupes=CGroupeDBQueries::getList("", CGroupeDBQueries::$IDS_ONLY);

		$contact->setIdContact(-1);
		$contact->setPrenomContact("");
		$contact->setDateNaissance("");
		$contact->setLicence(new CLicence("",false,false,"",false));

		$action="Nouveau";

		require_once ("form_contact.php");
	}
}

?>
