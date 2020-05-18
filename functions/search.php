<?php

require_once("CContactDBQueries.php");

function display_contacts ($_contacts) {
        $contacts=$_contacts;
        switch (count($contacts)) {
            case 1 :
                require_once("CViewContact.php");
                $c=new CViewContact();
                $c->show($contacts[0]);
                break;
            default : 
                require_once("CViewListContact.php");
                $c=new CViewListContact();
                $c->show($contacts);
                break;            
        }
}


function apply_search ($_vars) {
    
    if (isset($_vars['id']) && strlen($_vars['id']) ) {
        $w=$_vars['id'][0];
	$i=substr($_vars['id'],1);

        switch($w) {
            case 'c':
                display_contacts(CContactDBQueries::getList("idContact=".$i,CContactDBQueries::$DETAILS_GROUPES | CContactDBQueries::$DETAILS_RESPONSABLE));
                break;
            case 'g':
                   require_once("CViewGroupe.php");
                $details=new CViewGroupe();
                $details->display($i);
                break;
        }
    }
    else {
        $q=$_vars['q'];
        display_contacts(CContactDBQueries::getList("prenomContact like '".$q."%' or nomContact like '".$q."%'",CContactDBQueries::$DETAILS_GROUPES | CContactDBQueries::$DETAILS_RESPONSABLE));
    }
}


?>
