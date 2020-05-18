<?php
function strtodate ($_str) {
    if(!strlen($_str)) return "";
    $str=explode("/",$_str);
    return $str[2]."-".$str[1]."-".$str[0];
}

function datetostr ($_dat) {
    if(!strlen($_dat) || $_dat=="0000-00-00") return "";
    $dat=explode("-",$_dat);
    return $dat[2]."/".$dat[1]."/".$dat[0];
}

function strinttophone ($_int,$_sep="-") {
	$phone="";
	for ($i=0; $i<strlen($_int); ++$i) {
		if ( $i!=0 && $i%2==0 )
			$phone.=$_sep;
		$phone.=$_int[$i];
	}
	return $phone;
}

function phonetostrint ($_phone, $_sep="-") {
	return (int)str_replace($_sep,"",$_phone);
}

function cp ($_cp) {
    return (((int)$_cp!=0)?str_pad($_cp, 5, "0", STR_PAD_LEFT):"");    
}

function last_modified_id () {
	global $id, $_SERVER;
	
	if (strtolower($_SERVER['REQUEST_METHOD'])=="get") {
		return -1;
	}
	
	if ($id==-1) {
		$dbAcces=CAccesDB::getDBAcces();
		return $dbAcces->last_insert_id(); 
	}
	else {
		return $id;
	}	
}

function normalize ($_str) {
	return addslashes(strip_tags($_str));
}

function normalize_read ($_str) {
	return stripslashes($_str);
}

function fdb ($_str) {
    $str=explode("-", $_str);
    for ($i=0; $i<count($str); ++$i) { 
        $str[$i]=ucwords(strtolower(normalize($str[$i])));
    }
	return implode("-",$str);
}

function fudb ($_str) {
	return ucwords(strtoupper(normalize($_str)));
}

?>
