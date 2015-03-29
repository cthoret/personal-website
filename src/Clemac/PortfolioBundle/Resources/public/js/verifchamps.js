/////////////////////////////////     Fonnction de vérification de formulaire        ///////////////////////////////////
var verification=true;


function verifContact() {
	verification=true;
	form = document.contact;
	verificationDeChamp(form.nom, "nom");
	verificationDeChamp(form.prenom, "prenom");
	verificationDeChampMail(form.email, "mail");
	verificationDeChamp(form.sujet, "sujet");
	verificationDeChamp(form.message, "message");
	finVerif();
	return verification;
}

/////////////////////////////////     Fonnction de vérification spécifique           ///////////////////////////////////

function bonmail(mailteste){
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	if(reg.test(mailteste)) {
		return(true);
	}
	else {
		return(false);
	}
}

var erreur=false;
var verifFini=false;
function afficheErreur(texte) {
	var p = document.getElementById('erreur');
	if (erreur==false) {
	var pChild = p.childNodes;
		if (erreur==false && pChild[0]!=null) {
			var nbChild = pChild.length;
			for (var i=0; i<nbChild; i++) {
				p.removeChild(pChild[0]);
			}
		}
		var text = document.createTextNode("Champ incomplet ");
		p.appendChild(text);
		erreur=true;
		var text = document.createTextNode(texte);
		p.appendChild(text);
	}
	else {
		var text = document.createTextNode(", "+texte);
		p.appendChild(text);
	};
}

function finVerif() {
	if (verification == false) {
		var p = document.getElementById('erreur');
		p.appendChild(document.createTextNode(" incomplete."));
	}
	erreur=false;
	verifFini=true;
}


function isset (variable) {
  alert (typeof variable != 'undefined');
}

function verificationDeChamp( leChamp, texte) {
	if (leChamp.value == "" || leChamp.value == leChamp.getAttribute("title")) {
		afficheErreur(texte);
		verification=false;
	}
}
function verificationDeRadio( leChamp, texte) {
	var chekied = false;
	for (var i=0; i<leChamp.length; i++) {
		//sex[0].checked==false
		if (leChamp[i].checked==true) {
			chekied = true;
		}
	}
	if (chekied == false) {
		afficheErreur(texte);
		verification=false;
	}
}
function verificationDeChampMail( leChamp, texte) {
	if (leChamp.value == "" || leChamp.value == leChamp.getAttribute("title")) {
		afficheErreur(texte);
		verification=false;
	}
	else if (bonmail(leChamp.value)==false) {
		afficheErreur(texte);
		verification=false;
	}
}

////////
function verificationJour() {
	var leChamp = document.getElementsByName("jours[]");
	var texte = "Jour(s) souscrit(s)";
	var jours = new Array("Lundi","Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
	
	var chekied = false;
	var caseCoche = new Array();
	for (var i=0; i<leChamp.length; i++) {
		//sex[0].checked==false
		if (leChamp[i].checked==true) {
			chekied = true;
			caseCoche.push(i);
		}
	}
	
	if (chekied == false) {
		afficheErreur(texte);
		verification=false;
	}
	else {
		var chekied2;
		for (var i=0; i<caseCoche.length; i++) {
			chekied2 = false;
			//alert("heur"+caseCoche[i]);
			for (var j=0; j<2; j++) {
				//alert(document.getElementsByName("heur"+caseCoche[i])[j].checked);
				if (document.getElementsByName("heur"+caseCoche[i]+"[]")[j].checked==true) {
					chekied2 = true;
				}
			}
			if (chekied2 == false) {
				afficheErreur(texte+" le "+jours[caseCoche[i]]);
				verification=false;
			}
		}
	}
}
