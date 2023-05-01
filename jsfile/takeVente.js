const montant = document.querySelector('#montant');
const reste = document.querySelector('#reste');
const total = document.querySelector('#total');
const cdf = document.querySelector('#cdf');
const chilling = document.querySelector('#chilling');
const rwandais = document.querySelector('#rwandais');
const nomClient = document.querySelector('#nomClient');
const newClient = document.querySelector('#newClient');
const newPhone = document.querySelector('#newPhone');
const produit = document.querySelector('#produit');
const quantite = document.querySelector('#quantite');
const pvu = document.querySelector('#pvu');
const dateVente = document.querySelector('#date-vente');
const enleve = document.querySelector('#remove');
const ajout = document.querySelector('#add');
const qstock = document.querySelector('#qstock');
const produitVide = document.querySelector('#produitVide');
const quantiteVide = document.querySelector('#quantiteVide');
const pvuVide = document.querySelector('#pvuVide');
const btn = document.querySelector('#envoi');
const content = document.querySelector('tbody');
const changer = document.querySelector('#change');
const quantiteGrand = document.querySelector('#quantiteGrand');
const state = document.querySelector('#state');
const container = [];
const messageComplete = (valeur, champs) => {
    valeur.textContent = 'Veuillez remplir le champs '+champs+' svp';
    valeur.style.color = 'red';
  }

  const enleveMessage = valeur => {
    valeur.textContent = '';
    valeur.style.color = 'balck';
  }

  const message = (valeur) => {
    valeur.textContent = 'La quantite que vous voulez vendre est superieur a la quantite en stock, veuillez reapprovisionner avant d effectuer cette vente svp';
    valeur.style.color = 'red';
  }

  function chercheQuantiteStock(str) {
    if (str.length == 0) {
      document.getElementById("qstock").value = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("qstock").value = this.responseText;
      }
    xmlhttp.open("GET", "classVente.php?q=" + str);
    xmlhttp.send();
    }
  }

produit.addEventListener('change', () => {
  let tabValeur = produit.value.split('::');
  chercheQuantiteStock(tabValeur[1]);
  pvu.value = tabValeur[7];
});

enleve.addEventListener('click', () => {
  produit.value = "";
  quantite.value = "";
  pvu.value = "";
  qstock.value = "";
});

function rendertable() {
    let somme = 0;
  if (produit.value == "") {
    messageComplete(produitVide, 'produit');
    return;
  } else {
    enleveMessage(produitVide);
  }
    
  if (quantite.value == "") {
    messageComplete(quantiteVide, 'Quantite');
    return;
  } else {
    enleveMessage(quantiteVide);
  }
    
  if (pvu.value == "") {
    messageComplete(pvuVide, 'Prix de vente unitaire');
    return;
  } else {
    enleveMessage(pvuVide);
  }

  const tabValeur = produit.value.split('::');
  if (qstock.value*1 < quantite.value*1 ) {
    message(quantiteGrand);
    return;
  } else {
    enleveMessage(quantiteGrand);
  }
  const obj = { 
    produit: tabValeur[3],
    quantite: quantite.value,
    pvu: pvu.value,
    detail: produit.value
  };
  container.push(obj);
  

  content.innerHTML = '';
  for (let i = 0; i < container.length; i += 1) {
    somme += container[i].quantite * container[i].pvu;
    content.innerHTML += `
    <tr class="trline" id="t${i}">
    <td>
        ${container[i].produit}
    </td>
    <td>${container[i].quantite}</td>
    <td>${container[i].pvu}</td>
    <td>${container[i].quantite * container[i].pvu}</td>
    <td >
        <div class="d-flex flex-row justify-content-center">
            
            <div class="p-2 m-2 bg-warning text-white rounded-3 supprimeur" id="d${i}">
                <a href="#" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                </a>
            </div>
            <div class="p-2 bg-primary m-2 text-white rounded-3 modifieur" id="u${i}">
                <a href="#" class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                    </svg>
                </a>
            </div>  
        </div>
    </td>
  </tr> 
    `;
  }
  total.value = somme;
  let tabChange = changer.value.split('::');
  chilling.value = tabChange[3] * somme;
  rwandais.value = tabChange[5] * somme;
  cdf.value = tabChange[7] * somme;
  montant.value = total.value;
  reste.value = total.value - montant.value;
  produit.value = "";
  quantite.value = "";
  pvu.value = "";
  qstock.value = "";
}

ajout.addEventListener('click', rendertable);
window.addEventListener('keydown', (event) => {
    if (event.isComposing || event.key === 'Enter') {
      rendertable();
    }
});

montant.addEventListener('change', () => {
  reste.value = total.value - montant.value;
});

btn.addEventListener('click', () => {
  

});
