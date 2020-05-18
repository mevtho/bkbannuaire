<?php

require_once ("CAccesDB.php");
require_once ("utils.php");
require_once ("CGroupe.php");
require_once ("CContactDBQueries.php");

class CGroupeDBQueries {
	private static $MASK_LENGTH = 2;
	public static $IDS_ONLY = 0;				// 00
	public static $DETAILS_RESPONSABLE = 1; 	// 01
	public static $DETAILS_MEMBRES = 2;		 	// 10
	
	public static function get ($_id, $_opt=null) {
		if ($_opt===null) 
			$_opt = self::$DETAILS_RESPONSABLE | self::$DETAILS_MEMBRES;
		$groupeList=self::getList("idGroupe=".$_id, $_opt);
		return isset($groupeList[0])?$groupeList[0]:null;
	}
	
	public static function getList ($_w="",$_opt=0) {
		$acces=CAccesDB::getDBAcces();
		$opt=str_pad(decbin($_opt), self::$MASK_LENGTH, '0', STR_PAD_LEFT);

		$sql="select * from ".TABLE_GROUPE.(strlen($_w)?" where ".$_w:"")." order by nomGroupe ASC";
		$res=$acces->query($sql);
		$resultList=Array();

		while ($row=$acces->fetch_assoc($res)) {
			$responsable=null;
			if (!is_null($row['idResponsable'])) {
				$responsable=($opt[self::$MASK_LENGTH-1]=="1")
								? CContactDBQueries::get($row['idResponsable'], CContactDBQueries::$IDS_ONLY )
								: $row['idResponsable'];				
			}
			
			$sql2="select mg.* from ".TABLE_MEMBRE_GROUPE." mg, ".TABLE_CONTACT." where groupe_idGroupe=".$row['idGroupe']." and contact_idContact = idContact order by nomContact asc, prenomContact asc";
            $res2=$acces->query($sql2);
			$membres=array();
			while ($row2=$acces->fetch_assoc($res2)) {
				$membres[]=($opt[self::$MASK_LENGTH-2]=="1")
							? CContactDBQueries::get($row2['contact_idContact'], CContactDBQueries::$IDS_ONLY)
							: $row2['contact_idContact'];
			}			
			$resultList[]=new CGroupe($row['idGroupe'], $row['nomGroupe'], $responsable, $membres);
		}
		
		return $resultList;
	}
	
	public static function put ($_groupe) {
		if ($_groupe->getIdGroupe()==-1)
			self::create($_groupe);
		else 
			self::update($_groupe);
	}
	
	public static function create ($_groupe) {
		$acces=CAccesDB::getDBAcces();
		$idResponsable=($_groupe->getResponsable() instanceof CContact)
						? $_groupe->getResponsable()->getId()
						: $_groupe->getResponsable();
		$sql="insert into ".TABLE_GROUPE." (nomGroupe, idResponsable) values ('".normalize($_groupe->getNomGroupe())."', ".(($idResponsable==-1)?"NULL":$idResponsable).")";
		return $acces->query($sql);
	}

	public static function update ($_groupe) {
		$acces=CAccesDB::getDBAcces();
		$idResponsable=($_groupe->getResponsable() instanceof CContact)
						? $_groupe->getResponsable()->getId()
						: $_groupe->getResponsable();
		$sql="update ".TABLE_GROUPE." set nomGroupe='".normalize($_groupe->getNomGroupe())."', idResponsable=".(($idResponsable==-1)?"NULL":$idResponsable)." where idGroupe=".$_groupe->getIdGroupe();
		return $acces->query($sql);
	}
	
	public static function delete ($_groupe) {
		if ($_groupe==null) return;
		
		$acces=CAccesDB::getDBAcces();
		$sql=array();
		$sql[]="START TRANSACTION";
		$sql[]="delete from ".TABLE_MEMBRE_GROUPE." where Groupe_idGroupe=".$_groupe->getIdGroupe();
		$sql[]="delete from ".TABLE_GROUPE." where idGroupe=".$_groupe->getIdGroupe();
		$sql[]="COMMIT";
		
		foreach ($sql as $q)
		 	if (!$acces->query($q)) {
		 		$acces->query("ROLLBACK");
		 		return false;
		 	}
		 	
		return true;
	}
}

?>