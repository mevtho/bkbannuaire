<?php

require_once ("CAccesDB.php");
require_once ("utils.php");
require_once ("CVille.php");

class CVilleDBQueries {
	public static function get ($_id) {
		$villeList=self::getList("idVille=".$_id);
		return isset($villeList[0])?$villeList[0]:null;
	}
	
	public static function getList ($_w="") {
		$acces=CAccesDB::getDBAcces();
		$sql="select * from ".TABLE_VILLE.(strlen($_w)?" where ".$_w:"")." order by nomVille ASC, cpVille ASC";
		$res=$acces->query($sql);
		$resultList=Array();
		while ($row=$acces->fetch_assoc($res)) {
			$resultList[]=new CVille($row['idVille'], $row['cpVille'], $row['nomVille']);
		}
		return $resultList;
	}
	
	public static function put ($_ville) {
		if ($_ville->getIdVille()==-1)
			self::create($_ville);
		else 
			self::update($_ville);
	}
	
	public static function create ($_ville) {
		$acces=CAccesDB::getDBAcces();
		$sql="insert into ".TABLE_VILLE." (cpVille, nomVille) values (".$_ville->getCPVille().", '".normalize($_ville->getNomVille())."')";
		return $acces->query($sql);
	}

	public static function update ($_ville) {
		$acces=CAccesDB::getDBAcces();
		$sql="update ".TABLE_VILLE." set cpVille=".$_ville->getCPVille().", nomVille='".normalize($_ville->getNomVille())."' where idVille=".$_ville->getIdVille();
		return $acces->query($sql);
	}
	
	public static function delete ($_ville) {
		if ($_ville==null) return;
		
		$acces=CAccesDB::getDBAcces();
		$sql="delete from ".TABLE_VILLE." where idVille=".$_ville->getIdVille();	
		return $acces->query($sql);
	}
}

?>