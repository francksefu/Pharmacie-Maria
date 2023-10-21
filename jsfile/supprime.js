const input = document.querySelector('#supprimons');
const fichier = document.querySelector("#type");
const ide= input.value.split("::");
const valeur = input.value
const btn = document.querySelector("#btn");
const cross = document.querySelector('#cross');
const del = document.querySelector('#del');

function showHint(str, entre) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
        //console.log (this.responseText);
      }
      let nouveau = entre+"" +str
      
    xmlhttp.open("GET", nouveau);
    xmlhttp.send();
    }
  }

  function showPaie(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "classPaiements.php?q=" + str);
    xmlhttp.send();
    }
  }

  function showvente(str, entre) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
        //console.log (this.responseText);
      }
      let nouveau = entre+"" +str
      
    xmlhttp.open("GET", nouveau);
    xmlhttp.send();
    }
  }

  cross.addEventListener('click', () => {
    input.value = "";
  })

  del.addEventListener('click', () => {
    document.querySelector('.montre-moi').style.display = 'flex';
  })
/**
 * if is data for besoin file do that :
 */

const search = document.querySelector('.search');
const small = document.querySelector('#txtHint');
btn.addEventListener('click', () => {
    if (fichier.value === "product") {
      showHint(input.value.split('::')[1]+"::delete", "classProduct.php?q=")
    }

    if (fichier.value === "product2") {
      showHint(input.value.split('::')[1]+"::delete", "classProduct.php?q=")
    }

    if(fichier.value === 'bonusperte') {
      showHint(input.value.split('::')[1]+"::delete", "classBonusPete.php?q=")
    }

    if(fichier.value === 'caisseout') {
      showHint(input.value.split('::')[1]+"::delete", "classCaisseout.php?q=")
    }

    if(document.querySelector("#type").value == 'persoPaie') {
      showHint(input.value.split('::')[1]+"::delete", "classPersoPaie.php?q=")
    }

    if(fichier.value === 'champs') {
      showHint(input.value.split('::')[1]+"::delete", "classChamps.php?q=")
    }

    if(fichier.value === 'depot') {
      showHint(input.value.split('::')[1]+"::delete", "classDepot.php?q=")
    }

    if(document.querySelector("#type").value == 'paiements') {
      showPaie(input.value.split('::')[1]+"::delete");
    }

    if(fichier.value === 'personnel') {
      showHint(input.value.split('::')[1]+"::delete", "classPersonnels.php?q=")
    }

    if(document.querySelector('#type').value == 'datapersonnel') {
      showHint(input.value.split('::')[1]+"::delete", "classDataPersonnel.php?q=")
    }

    if(document.querySelector("#type").value === 'vente1') {
      showvente(input.value.split('::')[1]+"__:delete", "classTraitementVente.php?q=")
    }

    if(document.querySelector("#type").value === 'approv1') {
      showvente(input.value.split('::')[1]+"__:delete", "classApprov.php?q=")
    }

    if(fichier.value === 'perte-occaz') {
      showHint(input.value.split('::')[1]+"::delete", "classPerteOccaz.php?q=")
    }

    input.value = "";
    document.querySelector('.montre-moi').style.display = "none";
});

window.addEventListener('load', () => {
  document.querySelector('.montre-moi').style.display = "none";
})