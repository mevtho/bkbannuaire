<?php

	abstract class COutput {
		public function generate ($_titre, $_contacts, $_display=array()) {
			$this->generateHeader($_titre);

			$this->generateContent($_contacts, $_display);

			$this->generateFooter ();
		}

		public abstract function generateHeader  ($_titre);
		public abstract function generateContent ($_contacts, $_display);
		public abstract function generateFooter  ();
	}


	class OutputHTML extends COutput  {

		public function generateHeader ($_titre) {
			echo "<html>
					<head>
						<title>".$_titre."</title>
					</head>
					<body>
						<h1>".$_titre."</h1>
						<hr>
				";
		}

		public function generateContent ($_contacts,  $_display) {
			echo "<table>\n";
			echo $this->getContentHeader($_display);
			foreach ($_contacts as $contact) {
				echo $this->getLine($contact, $_display);
			}
			echo "</table>\n";
		}

		public function getContentHeader ($_display) {
			$line="<tr>";

            if (array_key_exists("nomContact", $_display)) 					$line .= "<th>Nom</th>\n";
            if (array_key_exists("prenomContact", $_display)) 				$line .= "<th>Prenom</th>\n";
            if (array_key_exists("sexeContact", $_display)) 				$line .= "<th>Sexe</th>\n";
            if (array_key_exists("dateNaissanceContact", $_display)) 		$line .= "<th>Date de Naissance</th>\n";
            if (array_key_exists("responsable1Contact", $_display)) 		$line .= "<th>Responsable 1</th>\n";
            if (array_key_exists("responsable2Contact", $_display)) 		$line .= "<th>Responsable 2</th>\n";
            if (array_key_exists("numLicenceContact", $_display)) 			$line .= "<th># Licence</th>\n";
            if (array_key_exists("mutationContact", $_display)) 			$line .= "<th>M</th>\n";
            if (array_key_exists("surclassementContact", $_display))	 	$line .= "<th>S</th>\n";
            if (array_key_exists("dateQualificationContact", $_display))	$line .= "<th>Date de Qualification</th>\n";
            if (array_key_exists("adresseContact", $_display)) 				$line .= "<th>Adresse</th>\n";
            if (array_key_exists("villeContact", $_display)) 				$line .= "<th>Ville</th>\n";
            if (array_key_exists("tel1Contact", $_display)) 			$line .= "<th>Tél. 1</th>\n";
            if (array_key_exists("tel2Contact", $_display)) 			$line .= "<th>Tél. 2</th>\n";
            if (array_key_exists("emailContact", $_display)) 				$line .= "<th>Email</th>\n";

			$line.="</tr>";
			return $line;
		}

		public function getLine ($_contact, $_display) {
			$line = "<tr>";

            if (array_key_exists("nomContact", $_display)) 					$line .= "<td>".$_contact->getNomContact()."</td>\n";
            if (array_key_exists("prenomContact", $_display)) 				$line .= "<td>".$_contact->getPrenomContact()."</td>\n";
            if (array_key_exists("sexeContact", $_display)) 				$line .= "<td>".$_contact->getSexeContact()."</td>\n";
            if (array_key_exists("dateNaissanceContact", $_display)) 		$line .= "<td>".datetostr($_contact->getDateNaissance())."</td>\n";
            if (array_key_exists("responsable1Contact", $_display)) 		$line .= "<td>".$_contact->getResponsable1()."</td>\n";
            if (array_key_exists("responsable2Contact", $_display)) 		$line .= "<td>".$_contact->getResponsable2()."</td>\n";

            if ($_contact->getLicence() != null )
            {
                if (array_key_exists("numLicenceContact", $_display)) 			$line .= "<td>".$_contact->getLicence()->getNumLicence()."</td>\n";
                if (array_key_exists("mutationContact", $_display)) 			$line .= "<td>".(($_contact->getLicence()->getMutation())?"X":" ")."</td>\n";
                if (array_key_exists("surclassementContact", $_display))	 	$line .= "<td>".(($_contact->getLicence()->getSurclassement())?"X":" ")."</td>\n";
                if (array_key_exists("dateQualificationContact", $_display))	$line .= "<td>".datetostr($_contact->getLicence()->getDateQualification())."</td>\n";
            }
            else
            {
                if (array_key_exists("numLicenceContact", $_display)) 			$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("mutationContact", $_display)) 			$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("surclassementContact", $_display))	 	$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("dateQualificationContact", $_display))	$line .= "<td>&nbsp;</td>\n";
            }

            if ($_contact->getCommunication() != null )
            {
                if ($_contact->getCommunication()->getAdresse() != null )
                {
                    if (array_key_exists("adresseContact", $_display)) 				$line .= "<td>".$_contact->getCommunication()->getAdresse()->getAdresseL1().((strlen($_contact->getCommunication()->getAdresse()->getAdresseL1())>0)?", ":"").$_contact->getCommunication()->getAdresse()->getAdresseL2()."</td>\n";

                    if ($_contact->getCommunication()->getAdresse()->getVille() != null)
                        if (array_key_exists("villeContact", $_display)) 			$line .= "<td>".$_contact->getCommunication()->getAdresse()->getVille()->getCPVille()." ".$_contact->getCommunication()->getAdresse()->getVille()->getNomVille()."</td>\n";
                    else
                        if (array_key_exists("villeContact", $_display))            $line .= "<td>&nbsp;</td>\n";
                }
                else
                {
                    if (array_key_exists("adresseContact", $_display)) 				$line .= "<td>&nbsp;</td>\n";
                    if (array_key_exists("villeContact", $_display)) 				$line .= "<td>&nbsp;</td>\n";
                }
                if (array_key_exists("tel1Contact", $_display)) 			$line .= "<td>".strinttophone($_contact->getCommunication()->getTel1())."</td>\n";
                if (array_key_exists("tel2Contact", $_display)) 			$line .= "<td>".strinttophone($_contact->getCommunication()->getTel2())."</td>\n";
                if (array_key_exists("emailContact", $_display)) 				$line .= "<td>".$_contact->getCommunication()->getEmail()."</td>\n";
            }
            else
            {
                if (array_key_exists("adresseContact", $_display)) 				$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("villeContact", $_display)) 				$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("tel1Contact", $_display)) 			$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("tel2Contact", $_display)) 			$line .= "<td>&nbsp;</td>\n";
                if (array_key_exists("emailContact", $_display)) 				$line .= "<td>&nbsp;</td>\n";
            }

			$line .= "</tr>\n";
			return $line;
		}

		public function generateFooter () {
			echo "<br><br>
					<hr>Généré par bkbAnnuaire 2009, TM 2009
					</body><html>
			";
		}
	}

	class OutputXLSCSV extends COutput  {
        private $csv;
        private $sep="\t";
        private $titre;

        public function OutputXLSCSV () {
            $this->csv="";
            $this->titre="generation";
        }

        public function generate ($_titre, $_contacts, $_display=array()) {
            parent::generate($_titre, $_contacts, $_display);
        }

		public function generateHeader ($_titre) {
            if (strlen($_titre) > 0)
                $this->titre = str_replace(' ', '_', $_titre);
        }

		public function generateContent ($_contacts,  $_display) {
            $this->getContentHeader($_display);
			foreach ($_contacts as $contact) {
				$this->getLine($contact, $_display);
			}
		}

		public function getContentHeader ($_display) {
			$line="";

            $i=0;

            if (array_key_exists("nomContact", $_display)) 					$line.="Nom".$this->sep;
            if (array_key_exists("prenomContact", $_display)) 				$line.="Prénom".$this->sep;
            if (array_key_exists("sexeContact", $_display)) 				$line.="Sexe".$this->sep;
            if (array_key_exists("dateNaissanceContact", $_display)) 		$line.="Date de Naissance".$this->sep;
            if (array_key_exists("responsable1Contact", $_display)) 		$line.="Responsable 1".$this->sep;
            if (array_key_exists("responsable2Contact", $_display)) 		$line.="Responsable 2".$this->sep;
            if (array_key_exists("numLicenceContact", $_display)) 			$line.="# Licence".$this->sep;
            if (array_key_exists("mutationContact", $_display)) 			$line.="M".$this->sep;
            if (array_key_exists("surclassementContact", $_display))	 	$line.="S".$this->sep;
            if (array_key_exists("dateQualificationContact", $_display))	$line.="Date de Qualification".$this->sep;
            if (array_key_exists("adresseContact", $_display)) 				$line.="Adresse".$this->sep;
            if (array_key_exists("villeContact", $_display)) 				$line.="Ville".$this->sep;
            if (array_key_exists("tel1Contact", $_display)) 			$line.="Tél. 1".$this->sep;
            if (array_key_exists("tel2Contact", $_display)) 			$line.="Tél. 2".$this->sep;
            if (array_key_exists("emailContact", $_display)) 				$line.="Email".$this->sep;

            $this->csv = $this->csv.$line."\n";
		}

		public function getLine ($_contact, $_display) {
            $line="";
            $i=0;

            if (array_key_exists("nomContact", $_display)) 					$line.=$_contact->getNomContact().$this->sep;
            if (array_key_exists("prenomContact", $_display)) 				$line.=$_contact->getPrenomContact().$this->sep;
            if (array_key_exists("sexeContact", $_display)) 				$line.=$_contact->getSexeContact().$this->sep;
            if (array_key_exists("dateNaissanceContact", $_display)) 		$line.=datetostr($_contact->getDateNaissance()).$this->sep;
            if (array_key_exists("responsable1Contact", $_display)) 		$line.=$_contact->getResponsable1().$this->sep;
            if (array_key_exists("responsable2Contact", $_display)) 		$line.=$_contact->getResponsable2().$this->sep;

            if ($_contact->getLicence() != null )
            {
                if (array_key_exists("numLicenceContact", $_display)) 			$line.=$_contact->getLicence()->getNumLicence().$this->sep;
                if (array_key_exists("mutationContact", $_display)) 			$line.=(($_contact->getLicence()->getMutation())?"X":" ").$this->sep;
                if (array_key_exists("surclassementContact", $_display))	 	$line.=(($_contact->getLicence()->getSurclassement())?"X":" ").$this->sep;
                if (array_key_exists("dateQualificationContact", $_display))	$line.=datetostr($_contact->getLicence()->getDateQualification()).$this->sep;
            }
            else
            {
                if (array_key_exists("numLicenceContact", $_display)) 			$line .= $this->sep;
                if (array_key_exists("mutationContact", $_display)) 			$line .= $this->sep;
                if (array_key_exists("surclassementContact", $_display))	 	$line .= $this->sep;
                if (array_key_exists("dateQualificationContact", $_display))	$line .= $this->sep;
            }

            if ($_contact->getCommunication() != null )
            {
                if ($_contact->getCommunication()->getAdresse() != null )
                {
                    if (array_key_exists("adresseContact", $_display)) 				$line.=$_contact->getCommunication()->getAdresse()->getAdresseL1().", ".$_contact->getCommunication()->getAdresse()->getAdresseL2().$this->sep;

                    if ($_contact->getCommunication()->getAdresse()->getVille() != null)
                        if (array_key_exists("villeContact", $_display)) 			$line.=$_contact->getCommunication()->getAdresse()->getVille()->getCPVille()." ".$_contact->getCommunication()->getAdresse()->getVille()->getNomVille().$this->sep;
                    else
                        if (array_key_exists("villeContact", $_display))            $line .= $this->sep;
                }
                else
                {
                    if (array_key_exists("adresseContact", $_display)) 				$line .= $this->sep;
                    if (array_key_exists("villeContact", $_display)) 				$line .= $this->sep;
                }
                if (array_key_exists("tel1Contact", $_display)) 			$line.=strinttophone($_contact->getCommunication()->getTel1()).$this->sep;
                if (array_key_exists("tel2Contact", $_display)) 			$line.=strinttophone($_contact->getCommunication()->getTel2()).$this->sep;
                if (array_key_exists("emailContact", $_display)) 				$line.=$_contact->getCommunication()->getEmail().$this->sep;
            }
            else
            {
                if (array_key_exists("adresseContact", $_display)) 				$line .= $this->sep;
                if (array_key_exists("villeContact", $_display)) 				$line .= $this->sep;
                if (array_key_exists("tel1Contact", $_display)) 			$line .= $this->sep;
                if (array_key_exists("tel2Contact", $_display)) 			$line .= $this->sep;
                if (array_key_exists("emailContact", $_display)) 				$line .= $this->sep;
            }

            $this->csv = $this->csv.$line."\n";
		}

		public function generateFooter () {
            $this->csv .= $this->csv."\n"."Généré par bkbAnnuaire 2009, TM 2009"."\n";

            $this->EnvoieFichier();
        }

        private function EnvoieFichier() {
            header("Content-type: application/vnd.ms-excel");
		    header("Content-Disposition: attachment; filename=".$this->titre.".csv");
		    header("Pragma: no-cache");
		    header("Expires: 0");
            echo $this->csv;
        }

	}



?>
