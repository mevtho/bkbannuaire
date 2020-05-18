<?php
require_once ("CVilleDBQueries.php");
require_once ("CGroupeDBQueries.php");

class CImpression  {		
	public function show () {
		$villes=CVilleDBQueries::getList();
		$groupes=CGroupeDBQueries::getList("", CGroupeDBQueries::$IDS_ONLY);
		$outputs=array("html"=>"Page web",
					   "csv"=>"Fichier Excel, format csv");
		
		include("view_impression.php");
	}
	
	public function getContacts ($_vars){
		$where = "idContact in ".$_vars['ids'];
		$contacts=CContactDBQueries::getList ($where, CContactDBQueries::$IDS_ONLY);
		
		return $contacts;
	}
	
	public function SearchArrayResult($_vars) {
		$sep="";
		$where="";
		
		foreach ($_vars as $k => $v) {
			$c="";
			if (!strlen($v))
				continue;
			
			if ($k == "idContact")			$c=$k."=".$v;
			if ($k == "nomContact") 		$c=$k." like '".fudb($v)."%'";
			if ($k == "prenomContact") 		$c=$k." like '".fdb($v)."%'";
			if ($k == "sexeContact")		$c=(($v!="All")?($k."='".$v[0]."'"):"");
			if ($k == "anneeNaissance") 	$c="dateNaissance like '".$v."%'";	
			if ($k == "numLicence")  		$c=$k." like '".$v."%'";
			if ($k == "idVille")  			$c=($v!="-1")?"ville_idVille=".(int)$v:"";
			
			if (strlen($c)) {
				$where.=$sep.$c;
				$sep=" AND ";
			}
		}
				
		//echo $where;
		$res=CContactDBQueries::getList ($where, CContactDBQueries::$IDS_ONLY);
		
		$idGroupe = (int)$_vars['idGroupe'];
		if ($idGroupe >= 1) {
			$groupe=CGroupeDBQueries::get($idGroupe);
			
			$ret=array();
			for ($i=0; $i<count($res);++$i)
				if (in_array($idGroupe,$res[$i]->getGroupes()) || $groupe->isResponsable($res[$i]))
					$ret[]=$res[$i];
			return $ret;
		}

		return $res;
	}
}

?>