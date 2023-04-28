const nom = document.querySelector('#nom');
const pa = document.querySelector('#pa');
const pv = document.querySelector('#pv');
const pvmin = document.querySelector('#pvmin');
const quantite = document.querySelector('#quantite');
const quantiteMin = document.querySelector('#quantitemin');
const description = document.querySelector('#description');
const nomVide = document.querySelector('#nomVide');
const paVide = document.querySelector('#paVide');
const pvVide = document.querySelector('#pvVide');
const pvminVide = document.querySelector('#pvminVide');
const quantiteVide = document.querySelector('#quantiteVide');
const quantiteMinVide = document.querySelector('#quantiteminVide');
const typeForm = document.querySelector('#typeFormulaire');
const btn = document.querySelector('#envoi');

const messageVide = 'Veuillez remplir ce champs svp'
const messageComplete = valeur => {
    valeur.textContent = messageVide;
    valeur.style.color = 'red';
  }

  const enleveMessage = valeur => {
    valeur.textContent = '';
    valeur.style.color = 'balck';
  }

  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "classProduct.php?q=" + str);
    xmlhttp.send();
    }
  }

  btn.addEventListener('click', () => {
    if (nom.value == '') {
      messageComplete(nomVide);
      return;
    } else {
      enleveMessage(nomVide)
    }

    if (pa.value == '') {
      messageComplete(paVide);
      return;
    } else {
        enleveMessage(paVide)
    }

    if (pv.value == '') {
      messageComplete(pvVide);
      return;
    } else {
      enleveMessage(pvVide)
    }

    if (pvmin.value == '') {
      messageComplete(pvminVide);
      return;
    } else {
      enleveMessage(pvminVide)
    }

    if (quantite.value == '') {
      messageComplete(quantiteVide);
      return;
    } else {
      enleveMessage(quantiteVide)
    }

    if (quantiteMin.value == '') {
      messageComplete(quantiteMinVide);
      return;
    } else {
      enleveMessage(quantiteMinVide)
    }

    let take;

    if (typeForm.value == 'update') {
        take = nom.value+"::"+pa.value+"::"+pv.value+"::"+pvmin.value+"::"+quantite.value+"::"+quantiteMin.value+"::"+description.value+"::update";
    } else {
        take = nom.value+"::"+pa.value+"::"+pv.value+"::"+pvmin.value+"::"+quantite.value+"::"+quantiteMin.value+"::"+description.value+"::add";
    }

    showHint(take);
  
    nom.value =""; 
    pa.value = "";
    pv.value = "";
    pvmin.value = "";
    quantite.value = "";
    quantiteMin.value = "";
    description.value = "";
    
    
  })
