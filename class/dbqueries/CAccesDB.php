<?php

class CAccesDB {
	private static $instance;
	private $dbconn;
	
	private function __construct ($_user = "", $_password = "", $_host = "", $_dbname = "") {
		$this->dbconn=mysqli_connect($_host, $_user, $_password)
			or die("Impossible de se connecter : " . mysqli_error());
    		mysqli_select_db($this->dbconn, $_dbname)
    			or die("Impossible de se s�lectionner la base de donn�es : " . mysqli_error());
	}
	
	public static function createAcces ($_user = "", $_password = "", $_host = "", $_dbname = "") {
		if (!isset(self::$instance))
			self::$instance=new CAccesDB($_user, $_password, $_host, $_dbname);
	}
	
	public static function getDBAcces () {
		if (isset(self::$instance)) {
			return self::$instance;
		}
		else {
			die("Aucune connexion n'est �tablie");
		}
	}

	public function query ($_sql="") {
		/*echo $_sql."<br>\n";
		echo ($this->error());*/
		return mysqli_query( $this->dbconn, $_sql);
	}
	
	public function fetch_assoc ($_res) {
        	return mysqli_fetch_assoc($_res);
	}
	
	public function error () {
		return mysqli_error($this->dbconn);
	}
	
	public function __destruct () {
		mysqli_close($this->dbconn);
	}	
	
	public function last_insert_id () {
        static $ret=0;
        $val=mysqli_insert_id($this->dbconn);
        if ($val!=$ret && $val!=0)
            $ret=$val;
        return $ret;
	}
	
}

?>
