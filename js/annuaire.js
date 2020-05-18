//    Constantes    //
var HOME=0;
var DETAILS_CONTACT=1;
var DETAILS_GROUPE=2;
var DETAILS_VILLE=3;
var LISTE_CONTACT=4;
var LISTE_GROUPE=5;
var LISTE_VILLE=6;
var SAISIE_CONTACT=7;
var SAISIE_GROUPE=8;
var SAISIE_VILLE=9;
var DELETE_CONTACT=10;
var DELETE_GROUPE=11;
var DELETE_VILLE=12;
var CHECK_CONTACT=13;
var CHECK_GROUPE=14;
var CHECK_VILLE=15;

var IMPRESSION=18;
/////////////////////

var checked;
var openedPopup;

dump = function (sObjName, sTab) {
	  //var Obj = eval (sObjName);
	  var Obj = sObjName;
	  //
	  if (sTab==null) sTab='';
	  if (typeof(Obj)!='object')
	    return sTab+sObjName+': '+typeof(Obj)+' = '+Obj+'\n';
	  else if (Obj.length!=null)
	    var sResult = sTab+sObjName+': array length '+Obj.length+'\n';
	  else
	    var sResult = sTab+sObjName+': object\n';
	  //
	  for (sProp in Obj)
	    sResult += dump (sObjName+'[\''+sProp+'\']', sTab+'  ');
	  return sResult;
	}

addDatePicker = function() {
	$(".date").datepicker({
		dateFormat: "dd/mm/yy"
	});
}

display = function (id) {
	$("ul#"+id).slideToggle();
}

checkInput = function(ex) {
	if (checked)
		return true;

	var url="json.php";

	var params="ex="+ex;

	var sel=$("input, select, textarea");
	for (i=0;i<sel.length; ++i) {
		if ( !(sel[i] instanceof HTMLInputElement)
			 || ( sel[i].type!="radio" && sel[i].type!="checkbox" )
			 || ( sel[i].checked ) )
			params=params+"&"+sel[i].name+"="+sel[i].value;
	}

	$.getJSON(url, params,
	          function(data){
				  if (data==true) {
					  checked=true;
					  $("form").submit();
				  }
				  else {
					  var errHTML="<div class=\"ui-widget\"><div class=\"ui-state-error ui-corner-all\" style=\"padding: 0pt 0.7em;\"><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: 0.3em;\"></span><strong>A corriger :</strong><br />";

					  $.each(data, function(i,input){
						  errHTML+=input+"<br />";
			          })

			          errHTML+="</div></div>";

					  $("div#error").html(errHTML);

					  $("div#error").show("clip");
				  }
	        });
	return false;
}

closeDialog = function () {
	  $("div#error").hide("clip");
}

dialog = function (ex) {
	$("#dialog").display="none";
	$("#dialog").html("<div align=\"center\"><img src=\"theme/images/ajax-loader.gif\" alt=\"chargement\" style=\"margin:auto\" /></div>");
	$("#dialog").dialog({
		bgiframe: true,
		modal: true,
		title: "Nouvelle commune",
		draggable: false,
		close: closeDialog,
		buttons: { "Ok": function() { ajaxPostVille(ex); } }
	});

}

refreshContactList = function (nom,id,text) {
	cont1="";
	cont2="";

	if (nom=="contact1") {
		cont1="selected";
	}
	else if (nom=="contact2") {
		cont2="selected";
	}
	$("#responsable1").prepend("<option value=\""+id+"\" "+cont1+">"+text+"</option>\n");
	$("#responsable2").prepend("<option value=\""+id+"\" "+cont2+">"+text+"</option>\n");
}

refreshVilleList = function (id, text) {
	$("#ville").prepend("<option value=\""+id+"\" selected>"+text+"</option>\n");
}

refreshGroupeList = function (id, text) {
	$("#groupe").prepend("<li class=\"new\"><input type=\"checkbox\" name=\"groupes[]\" value=\""+id+"\" checked />"+text+"</li>\n");
}

rafraichir = function (nom,id,text) {
	if (id==-1) return;
	switch (openedPopup) {
		case SAISIE_CONTACT:
			refreshContactList(nom,id,text);
			break;
		case SAISIE_VILLE:
			refreshVilleList(id,text);
			break;
		case SAISIE_GROUPE:
			refreshGroupeList(id,text);
			break;
		default: // Nothing to refresh
			break;
	}
}

popup = function (page, nom, what) {
	openedPopup=what;
	window.open (page, nom, config="toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, directories=no, status=no, width=800, height=400");
}

popup_close = function (id, text) {
	$("div.center").html("<div align=\"center\"><img src=\"theme/images/ajax-loader.gif\" alt=\"chargement\" style=\"margin:auto\" /></div>");
	window.opener.rafraichir(window.name, id, text);
	openedPopup=0;
	window.close();
}

select = function (to, from) {
	value=pform.idVille.options[pform.idVille.selectedIndex].value;
	for (i=0; i<form.idVille.options.length ; ++i) {
		if (form.idVille.options[i].value==value) {
			form.idVille.selectedIndex=i;
			return;
		}
	}
}

popupContactForm = function () {
	if (window.name=="contact1" || window.name=="contact2") {
		form=window.document.forms[0];
		pform=window.opener.document.forms[0];
		form.nomContact.value=pform.nomContact.value;
		form.adresseL1.value=pform.adresseL1.value;
		form.adresseL2.value=pform.adresseL2.value;
		form.tel1.value=pform.tel1.value;
		form.tel2.value=pform.tel2.value;
		form.email.value=pform.email.value;
		$("legend.titre").text($("legend.titre").text()+" responsable de "+pform.prenomContact.value+" "+pform.nomContact.value)
		select(form.idVille, pform.idVille);
	}
}

hovering = function() {
	$("li.barre_edition").hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);

	$("a.lnk_icon").hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	);
}

searchPanel = function() {
	$(document).ready(function(){
        $("#autocomplete").autoComplete("select");
	});
}

rechercher = function (theform) {
	var url="json.php";
	var params="ex="+IMPRESSION;

	var sep="";
	for (i = 0; i < theform.elements.length; i++) {
		obj=theform.elements[i];
		add = sep + obj.name + "=" + obj.value;
		if (obj.type=='radio') {
			if (!obj.checked)
				add="";
		}
		params += add;
		sep="&";
	}

	$("#results").html('<img src="theme/images/ajax-loader.gif" />');
	$("fieldset.results").show('highlight',{},7500);
	showFieldSet($("fieldset.results > legend"));

	$.getJSON(url, params,
	          function(data){
				  if (data.length == 0) {
					  $("#results").html('Aucun r�sultat pour les crit�res mentionn�s');
					  return;
				  }
				  $("#results").html('<ul class="liste_results">\n'+data+'\n</ul>\n');
				  var a = "<a onclick=\"removeLine($(this));\" class=\"a icon-del icons lnk_icon ui-widget ui-helper-clearfix ui-state-default ui-corner-all\">" +
							  "<span class=\"ui-icon ui-icon-close\" style=\"width:16px;\">&nbsp;</span>" +
						  "</a>" ;
				  $("li[rec]").append(a);
				  $("#results").append("<div style=\"text-align:right;\"><a onclick=\"showAll();\"class=\"a\" >Afficher Tous</a></div>");
        		  hovering();
			  });
}

removeLine = function (line) {
	line.parent().hide();
}

showAll = function () {
	$("li[rec]:hidden").show();
}

confirmer = function(url) {
	$.uiConfirm({
		  message : 'Valider la suppression de cette fiche.',
		  confirmed : function() { window.location=url; },
		  cancelled : function() { },
		  complete : function() { },
		  ok_text : 'oui',
		  cancel_text : 'non',
		  modal : true
	});
}

showFieldSet = function (legend) {
	legend.parent().children(".ctf").show('',{},1000);
}

populateIds = function () {
	var theids = "";
	var lis =$("li[rec]:visible");
	var sep="";
	for (i=0; i<lis.length; ++i) {
	    theids+=sep+lis.get(i).getAttribute('rec');
		sep=", ";
	}
	theids="("+theids+")";
	form=window.document.forms[1].ids.value=theids;
	return true;
}

$(document).ready(function(){
	checked=false;

	addDatePicker();

	hovering();

	popupContactForm();

	searchPanel();

	//	alert("Javascript successfully loaded");
});
