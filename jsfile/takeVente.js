const identifiant = document.querySelector('#identifiantM');
const montant = document.querySelector('#montant');
const reste = document.querySelector('#reste');
const total = document.querySelector('#total');
const cdf = document.querySelector('#cdf');
const chilling = document.querySelector('#chilling');
const rwandais = document.querySelector('#rwandais');
const nomClient = document.querySelector('#nomClient');
const personnel = document.querySelector('#personnel');
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
const clientVide = document.querySelector('#clientVide');
const montantVide = document.querySelector('#montantVide');
const personnelVide = document.querySelector('#personnelVide');
const btn = document.querySelector('#envoi');
const content = document.querySelector('tbody');
const changer = document.querySelector('#change');
const quantiteGrand = document.querySelector('#quantiteGrand');
const state = document.querySelector('#state');
const ajoutons = document.querySelector('#ajoutons');
container = [];
const update = document.querySelector('#M-add');
const add = document.querySelector('#add');
const typeForm = document.querySelector('#typeForm');

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

  const messageFormat = (valeur) => {
    valeur.textContent = 'Veuillez verifier entre les champs Quantite ou  prixV unitaire, vous avez inserer une voyelle ou un mauvais format';
    valeur.style.color = 'red';
  }

  function chercheDernierIdVentes(str) {
    if (str.length == 0) {
      document.getElementById("operation").value = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("operation").value = this.responseText;
      }
    xmlhttp.open("GET", "classFindIdVente.php?q=" +str);
    xmlhttp.send();
    }
  }


  let operation = 0;
  let operationUpdate = '';
  if (typeForm.value == 'update') {
    identifiant.addEventListener('change', () => {
      const tabObj = identifiant.value.split('__:');
      let clientUpdate = '';
      let personnelUpdate = '';
      for (let p = 0; p < tabObj.length - 1; p += 1) {
        const tabElement = tabObj[p].split('::');
        let detailUpdate = "ID::"+tabElement[3]+"::"+tabElement[4]+"::"+tabElement[5]+"::"+tabElement[6]+"::"+tabElement[7]+"::"+tabElement[8]+"::"+tabElement[9]+"::"+tabElement[10]+"::"+tabElement[11]+"::"+tabElement[12]+"::"+tabElement[13];
         operationUpdate = tabElement[0];
        clientUpdate = "ID::"+tabElement[1]+"::"+tabElement[2];
        personnelUpdate = "ID::"+tabElement[20]+"::"+tabElement[21]+"::"+tabElement[22];
        const obj = { 
          produit: tabElement[5],
          quantite: tabElement[14],
          pvu: tabElement[15],
          detail: detailUpdate
        };

        container.push(obj);
        dateVente.value = tabElement[16];
        montant.value = tabElement[18];
        total.value = tabElement[17];
      }
      nomClient.value = clientUpdate;
      personnel.value = personnelUpdate;
      rendons();
    });
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
  chercheDernierIdVentes('find');
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

  if ((/[a-zA-Z]/).test(pvu.value)) {
    messageFormat(pvuVide);
    return;
  } else {
    enleveMessage(pvuVide);
  }

  if ((/[a-zA-Z]/).test(quantite.value)) {
    messageFormat(quantiteVide);
    return;
  } else {
    enleveMessage(quantiteVide);
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

  function render () {
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
    </tr> `;
    }
    total.value = somme;
    let tabChange = changer.value.split('::');
    chilling.value = tabChange[3] * somme / tabChange[7];
    rwandais.value = tabChange[5] * somme / tabChange[7];
    cdf.value =  somme / tabChange[7];
    montant.value = total.value;
    reste.value = total.value - montant.value;
  }

  render();

  produit.value = "";
  quantite.value = "";
  pvu.value = "";
  qstock.value = "";
}

function render () {
    total.value = somme;
    let tabChange = changer.value.split('::');
    chilling.value = tabChange[3] * somme / tabChange[7];
    rwandais.value = tabChange[5] * somme / tabChange[7];
    cdf.value =  somme / tabChange[7];
    montant.value = total.value;
    reste.value = total.value - montant.value;
  }

window.addEventListener('click', () => {
    if ( content.innerHTML != '') {
        const modifieur = document.querySelectorAll('.modifieur');
        for (let i = 0; i < modifieur.length; i += 1) {
          modifieur[i].addEventListener('click', () => {
          update.style.display = 'block';
          add.style.display = 'none';
          modifieur[i].parentNode.parentNode.style.backgroundColor = 'beige';
          document.querySelector('#produit').value = container[i].detail;
          document.querySelector('#quantite').value = container[i].quantite;
          pvu.value = container[i].pvu;
          state.value = i;
         });
        }
        const supprimeur = document.querySelectorAll('.supprimeur');
        for (let i = 0; i < supprimeur.length; i += 1) {
          supprimeur[i].addEventListener('click', () => {
          container.splice(i, 1);
          content.innerHTML = '';
          let somme = 0;
          for (let j = 0; j < container.length; j += 1) {
            
            somme += container[j].quantite * container[j].pvu;
            content.innerHTML += `
            <tr class="trline" id="t${i}">
            <td>
                ${container[j].produit}
            </td>
            <td>${container[j].quantite}</td>
            <td>${container[j].pvu}</td>
            <td>${container[j].quantite * container[j].pvu}</td>
            <td >
                <div class="d-flex flex-row justify-content-center">
                    
                    <div class="p-2 m-2 bg-warning text-white rounded-3 supprimeur" id="d${j}">
                        <a href="#" class="text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                              </svg>
                        </a>
                    </div>
                    <div class="p-2 bg-primary m-2 text-white rounded-3 modifieur" id="u${j}">
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
          };
          total.value = somme;
        let tabChange = changer.value.split('::');
        chilling.value = tabChange[3] * somme / tabChange[7];
        rwandais.value = tabChange[5] * somme / tabChange[7];
        cdf.value =   somme / tabChange[7];
        montant.value = total.value;
        reste.value = total.value - montant.value;
          });
        }
        
    }
})



ajout.addEventListener('click', rendertable);
ajoutons.addEventListener('keydown', (event) => {
    if (event.isComposing || event.key === 'Enter') {
      if(state.value == '') {
        rendertable();
      } else {
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
        
          if ((/[a-zA-Z]/).test(pvu.value) || pvu.value * 1 == NaN) {
            messageFormat(pvuVide);
            return;
          } else {
            enleveMessage(pvuVide);
          }
        
          if ((/[a-zA-Z]/).test(quantite.value)) {
            messageFormat(quantiteVide);
            return;
          } else {
            enleveMessage(quantiteVide);
          }
          chercheDernierIdVentes('find');

        let j = state.value;
        container[j].detail = document.querySelector('#produit').value;
        container[j].quantite = document.querySelector('#quantite').value;
        container[j].pvu = pvu.value;
        container[j].produit = produit.value.split('::')[3];
        content.innerHTML = '';
        let somme = 0;
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
        };
        total.value = somme;
        let tabChange = changer.value.split('::');
        chilling.value = tabChange[3] * somme / tabChange[7];
        rwandais.value = tabChange[5] * somme / tabChange[7];
        cdf.value = somme / tabChange[7];
        montant.value = total.value;
        reste.value = total.value - montant.value;
        document.querySelector('#produit').value = "";
        quantite.value = "";
        pvu.value = "";
        update.style.display = 'none';
        add.style.display = 'block';
      }
    }

    /*if ((event.isComposing || event.key === 'Enter') && (update.style.display == 'block')) {
        
      }*/
});

montant.addEventListener('change', () => {
  reste.value = total.value - montant.value;
});

btn.addEventListener('click', () => {
  

});

window.addEventListener('load', () => {
    update.style.display = 'none';
    add.style.display = 'block';
});

function sendTable(str) {
  if (str.length == 0) {
    document.getElementById("txtHint1").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      feedback = this.responseText;
      document.getElementById("txtHint1").innerHTML = this.responseText;
    }
  xmlhttp.open("GET", "classTraitementVente.php?q=" + str);
  xmlhttp.send();
  }
}

btn.addEventListener('click', () => {
  if (nomClient.value == "") {
    messageComplete(clientVide, ' nom du client');
    return;
  } else {
    enleveMessage(clientVide);
  }

  if (montant.value == "") {
    messageComplete(montantVide, 'montant');
    return;
  } else {
    enleveMessage(montantVide);
  }

  if (personnel.value == "") {
    messageComplete(personnelVide, 'personnel');
    return;
  } else {
    enleveMessage(personnelVide);
  }

  if (container.length == 0) {
    messageComplete(clientVide, 'produit et table');
    return;
  } else {
    enleveMessage(clientVide);
  }

  let dette = '';
  if (montant.value == total.value) {
    dette = 'Non';
  } else {
    dette = 'Oui';
  }

  let etatFormulaire = '';
  if (identifiant.value == '') {
    etatFormulaire = 'add';
    chercheDernierIdVentes('find');
    operation = document.querySelector('#operation').value * 1 + 100000;
  } else {
    etatFormulaire = 'update';
    operation = operationUpdate;
  }
  let table = '';
  for (let k = 0; k < container.length; k += 1) {
    let idProduit = container[k].detail.split('::')[1];
    let idClient = nomClient.value.split('::')[1];
    let idPersonnel = personnel.value.split('::')[1];
    table += idProduit + '::' + idClient + '::'+container[k].quantite +'::'+container[k].pvu+'::'+dateVente.value+'::'+operation+'::'+dette+'::'+total.value+'::'+montant.value+'::'+idPersonnel+'::___:';
  }

  table += etatFormulaire;
  sendTable(table);
  container.splice(0, container.length);
  rendons();
  nomClient.value = "";
  
  identifiant.value = "";
});

//
function rendons() {
  content.innerHTML = '';
  let somme = 0;
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
  };
  total.value = somme;
  let tabChange = changer.value.split('::');
  chilling.value = tabChange[3] * somme / tabChange[7];
  rwandais.value = tabChange[5] * somme / tabChange[7];
  cdf.value = somme / tabChange[7];
  montant.value = total.value;
  reste.value = total.value - montant.value;
}