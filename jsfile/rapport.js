const toute_vente = document.querySelector('#toute-vente');
const paye_cache = document.querySelector('#paye-cache');
const vente_dette = document.querySelector('#vente-dette');
const vente_sortie = document.querySelector('#vente-sortie');
const vente_personnel = document.querySelector('#vente-personnel');
const vente_personnel_facture = document.querySelector('#vente-personnel-facture');

const toute_vente_facture = document.querySelector('#toute-vente-facture');
const paye_cache_facture = document.querySelector('#paye-cache-facture');
const vente_dette_facture = document.querySelector('#vente-dette-facture');

const toutes_sortie = document.querySelector('#toutes-sortie');
const trie_dette = document.querySelector('#trie-dette');
const trie_charge = document.querySelector('#trie-charge');
const trie_depenses = document.querySelector('#trie-depenses');
const trie_inutile = document.querySelector('#trie-inutile');
const bonus_perte = document.querySelector('#bonusOuPerte');
const approvisionnement = document.querySelector('#approv');
const paiements = document.querySelector('#paiements');
const paiements_client = document.querySelector('#paiements-client');
const paiements_facture = document.querySelector('#paiements-facture');

//Prediction

const prediction_periode = document.querySelector('#prediction-periode')

const toute_vente2 = document.querySelector('#toute-vente2');
const paye_cache2 = document.querySelector('#paye-cache2');
const vente_dette2 = document.querySelector('#vente-dette2');
const vente_sortie2 = document.querySelector('#vente-sortie2');


const toute_vente2_facture = document.querySelector('#toute-vente2-facture');
const paye_cache2_facture = document.querySelector('#paye-cache2-facture');
const vente_dette2_facture = document.querySelector('#vente-dette2-facture');

const toute_vente2_tableau = document.querySelector('#toute-vente2-tableau');

const toutes_sortie2 = document.querySelector('#toutes-sortie2');
const trie_charge2 = document.querySelector('#trie-charge2');
const trie_dette2 = document.querySelector('#trie-dette2');
const trie_depenses2 = document.querySelector('#trie-depenses2');
const trie_inutile2 = document.querySelector('#trie-inutile2');
const bonus_perte2 = document.querySelector('#bonusOuPerte2');
const approvisionnement2 = document.querySelector('#approvisionnement2');
const paiements2 = document.querySelector('#paiements2');
const paiements_client2 = document.querySelector('#paiements-client2');
const paiements_personnel = document.querySelector('#paiements-personnel');
const paiements_par_personnel = document.querySelector('#paiements-par-personnel');

const clients_facture = document.querySelector('#toutes-facture');
const clients_facture_2dates = document.querySelector('#facture-2-dates');
const clients_facture_dette = document.querySelector('#facture-dette');
const resume = document.querySelector('#resume');

const perte_journaliere = document.querySelector('#perte-journaliere');
const perte_periode = document.querySelector('#perte-periode');

const resume_journaliere = document.querySelector('#resume-journaliere');
const resume_periode = document.querySelector('#resume-periode');

const paiements_par_mois_annee = document.querySelector('#paiements-par-mois-annee');
const paiements_par_mois_annee_par_personnel = document.querySelector('#paiements-par-mois-annee-par-personnel');

const date1 = document.querySelector('#date1');
const date2 = document.querySelector('#date2');
const input1 = document.querySelector('#input-1');
const input2 = document.querySelector('#input-2');
const input3 = document.querySelector('#input-3');
const input6 = document.querySelector('#input-6');


const contDate1 = document.querySelector('#cont-date1');
const contDate2 = document.querySelector('#cont-date2');
const contInput1 = document.querySelector('#cont-input1');
const contInput2 = document.querySelector('#cont-input2');
const contInput3 = document.querySelector('#cont-input3');
const contInput4 = document.querySelector('#cont-input4');
const contInput5 = document.querySelector('#cont-input5');
const contInput6 = document.querySelector('#cont-input6');

const type = document.querySelector('#type');
const paragrapheP = document.querySelector('#paragraphe');
const btn = document.querySelector('#envoi');
const enleveMessage = valeur => {
    valeur.textContent = '';
    valeur.style.color = 'balck';
}

const paragraphe = (valeur, messageE) => {
  valeur.textContent = messageE;
}

window.addEventListener('load', () => {
  contDate1.style.display = 'none';
  contDate2.style.display = 'none';
  contInput1.style.display = 'none';
  contInput2.style.display = 'none';
  contInput3.style.display = 'none';
  contInput4.style.display = 'none';
  contInput5.style.display = 'none';
  contInput6.style.display = 'none';
  btn.style.display = 'none'
});

function uneDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'none';
    contInput1.style.display = 'none';
    contInput2.style.display = 'none';
    contInput3.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function personnelMois(message, part) {
  enleveMessage(paragrapheP);
  contDate1.style.display = 'none';
  contDate2.style.display = 'none';
  contInput1.style.display = 'none';
  contInput2.style.display = 'none';
  contInput3.style.display = 'none';
  contInput4.style.display = 'flex';
  contInput5.style.display = 'flex';
  contInput6.style.display = 'none';
  btn.style.display = 'block';
  paragraphe(paragrapheP, message);
  type.value = part;
}

function personnelMoisPersonnel(message, part) {
  enleveMessage(paragrapheP);
  contDate1.style.display = 'none';
  contDate2.style.display = 'none';
  contInput1.style.display = 'none';
  contInput2.style.display = 'none';
  contInput3.style.display = 'none';
  contInput4.style.display = 'flex';
  contInput5.style.display = 'flex';
  contInput6.style.display = 'flex';
  btn.style.display = 'block';
  paragraphe(paragrapheP, message);
  type.value = part;
}

function personnelInput(message, part) {
    enleveMessage(paragrapheP);
    contInput1.style.display = 'flex';
    contInput2.style.display = 'none';
    contInput3.style.display = 'none';
    contDate1.style.display = 'none';
    contDate2.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function personnelpaie(message, part) {
  enleveMessage(paragrapheP);
  contInput1.style.display = 'none';
  contInput2.style.display = 'none';
  contInput3.style.display = 'none';
  contDate1.style.display = 'none';
  contDate2.style.display = 'none';
  contInput4.style.display = 'none';
  contInput5.style.display = 'none';
  contInput6.style.display = 'flex';
  btn.style.display = 'block';
  paragraphe(paragrapheP, message);
  type.value = part;
}

function factureInput(message, part) {
    enleveMessage(paragrapheP);
    contInput2.style.display = 'flex';
    contDate1.style.display = 'none';
    contDate2.style.display = 'none';
    contInput1.style.display = 'none';
    contInput3.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function deuxDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'flex';
    contInput1.style.display = 'none';
    contInput2.style.display = 'none';
    contInput3.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function ventePersonnel(message, part) {
  enleveMessage(paragrapheP);
  contDate1.style.display = 'flex';
  contDate2.style.display = 'flex';
  contInput1.style.display = 'none';
  contInput2.style.display = 'none';
  contInput3.style.display = 'none';
  contInput4.style.display = 'none';
  contInput5.style.display = 'none';
  contInput6.style.display = 'flex';
  btn.style.display = 'block';
  paragraphe(paragrapheP, message);
  type.value = part;
}

function InputEtDeuxDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'flex';
    contInput1.style.display = 'flex';
    contInput2.style.display = 'none';
    contInput3.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function InputEtDeuxDateFacture(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'flex';
    contInput2.style.display = 'flex';
    contInput3.style.display = 'none';
    contInput4.style.display = 'none';
    contInput5.style.display = 'none';
    contInput6.style.display = 'none';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

toute_vente.addEventListener('click', () => {
  uneDate('toutes les vente sur une date', 'toute_vente');
});

toute_vente_facture.addEventListener('click', () => {
  uneDate('toutes les vente sur une date : affichage facture', 'toute_vente_facture');
});

toute_vente2.addEventListener('click', () => {
  deuxDate('toutes les vente entre 2 date', 'toute_vente2');
});

toute_vente2_facture.addEventListener('click', () => {
  deuxDate('toutes les vente entre 2 date : afichage facture', 'toute_vente2_facture');
});

toute_vente2_tableau.addEventListener('click', () => {
  deuxDate('toutes les vente entre 2 date : afichage facture', 'toute_vente2_tableau');
});

paye_cache.addEventListener('click', () => {
  uneDate('toutes les vente payé sur une date', 'paye_cache');
});

paye_cache_facture.addEventListener('click', () => {
  uneDate('toutes les vente payé sur une date: affichage facture', 'paye_cache_facture');
});


btn.addEventListener('click', () => {
  if(type.value == 'approvisionnements' || type.value == 'approvisionnements2' || type.value == 'resume-journaliere' || type.value == 'resume-periode' || type.value == 'prediction-journaliere' || type.value == 'prediction-periode') {
    document.forms[0].action = 'thinkApprov.php';
  } else {
    document.forms[0].action = 'think.php';
  }
  document.forms[0].submit();
})

paye_cache2.addEventListener('click', () => {
  deuxDate('toutes les vente payé entre 2 date', 'paye_cache2');
});

paye_cache2_facture.addEventListener('click', () => {
  deuxDate('toutes les vente payé entre 2 date : affichage facture', 'paye_cache2_facture');
});


vente_dette.addEventListener('click', () => {
  uneDate('toutes les vente en dette sur une date', 'vente_dette');
});

vente_dette_facture.addEventListener('click', () => {
  uneDate('toutes les vente en dette sur une date : affichage facture', 'vente_dette_facture');
});


vente_dette2.addEventListener('click', () => {
  deuxDate('toutes les vente en dette entre 2 date', 'vente_dette2');
});

vente_dette2_facture.addEventListener('click', () => {
  deuxDate('toutes les vente en dette entre 2 date : affichage facture', 'vente_dette2_facture');
});


vente_sortie.addEventListener('click', () => {
  uneDate('toutes les vente et les sortie sur une date', 'vente_sortie');
});

vente_sortie2.addEventListener('click', () => {
  deuxDate('toutes les vente et les sortie entre 2 date', 'vente_sortie2');
});

toutes_sortie.addEventListener('click', () => {
  uneDate('toutes les sortie sur une date', 'toutes_sortie');
});

toutes_sortie2.addEventListener('click', () => {
    deuxDate('toutes les sortie entre 2 date', 'toutes_sortie2');
  });

trie_dette.addEventListener('click', () => {
    uneDate('toutes les sortie sur une date trie par dette', 'trie_dette');
});

trie_dette2.addEventListener('click', () => {
    deuxDate('toutes les sortie entre 2 date trie par dette', 'trie_dette2');
});

trie_charge.addEventListener('click', () => {
    uneDate('toutes les sortie sur une date trié par charge', 'trie_charge');
});

trie_charge2.addEventListener('click', () => {
    deuxDate('toutes les sortie entre 2 dates trié par charge', 'trie_charge2');
});

trie_depenses.addEventListener('click', () => {
  uneDate('toutes les sortie sur une date trié par depense', 'trie_depenses');
});

trie_depenses2.addEventListener('click', () => {
    deuxDate('toutes les sortie entre 2 date trié par depense', 'trie_depenses2');
  });

trie_inutile.addEventListener('click', () => {
    uneDate('toutes les sortie inutile sur une date', 'trie_inutile');
  });

  trie_inutile2.addEventListener('click', () => {
    deuxDate('toutes les sortie inutile sur une date', 'trie_inutile2');
  });

bonus_perte.addEventListener('click', () => {
    uneDate('tous les bonus et perte sur une date', 'bonus_perte');
});

bonus_perte2.addEventListener('click', () => {
    deuxDate('tous les bonus et perte entre 2 date', 'bonus_perte2');
});

approvisionnement.addEventListener('click', () => {
    uneDate('tous les approvisionnements sur une date ', 'approvisionnements');
});

approvisionnement2.addEventListener('click', () => {
    deuxDate('tous les approvisionnements entre 2 date ', 'approvisionnements2');
});


paiements.addEventListener('click', () => {
    uneDate('tous les paiements sur une date', 'paiements');
});

paiements2.addEventListener('click', () => {
    deuxDate('tous les paiements entre 2 date', 'paiements2');
});

resume_journaliere.addEventListener('click', () => {
  uneDate('Resume journaliere', 'resume-journaliere');
});

resume_periode.addEventListener('click', () => {
  deuxDate('Resume sur une periode : ', 'resume-periode');
});

perte_journaliere.addEventListener('click', () => {
  uneDate('Perte occasionnee journaliere', 'perte-journaliere');
});

perte_periode.addEventListener('click', () => {
  deuxDate('Perte occasionnee sur une periode : ', 'perte-periode');
});

paiements_facture.addEventListener('click', () => {
    factureInput('tous les paiements sur une facture', 'paiements_facture');
});

paiements_client.addEventListener('click', () => {
    personnelInput('tous les paiements d un client', 'paiements_client');
});

paiements_client2.addEventListener('click', () => {
    InputEtDeuxDate('tous les paiements d un client entre 2', 'paiements_client2');
});

clients_facture.addEventListener('click', () => {
    personnelInput('voir toutes les factures d un client', 'clients_facture');
});

clients_facture_dette.addEventListener('click', () => {
    personnelInput('voir toutes les factures d un client non payé', 'clients_facture_dette');
});

clients_facture_2dates.addEventListener('click', () => {
    InputEtDeuxDate('voir toutes les factures d un client entre 2 dates', 'clients_facture_2dates');
});

paiements_par_personnel.addEventListener('click', () => {
  personnelpaie('voir tous les paiements d un personnel', 'paiements-par-personnel');
});

paiements_personnel.addEventListener('click', () => {
  deuxDate('tous les paiements du personnels entre 2 date', 'paiements-personnel');
});

prediction_periode.addEventListener('click', () => {
  deuxDate('entre une periode et le produit pour lequelle vous voulez faire une prediction ', 'prediction-periode');
  contInput3.style.display = 'flex';
})

paiements_par_mois_annee_par_personnel.addEventListener('click', () => {
  personnelMoisPersonnel('choisissez le mois, l année et le nom dont vous voulez voir les paiements que vous avez donne au personnel', 'paiements-par-mois-annee-par-personnel');
});

paiements_par_mois_annee.addEventListener('click', () => {
  personnelMois('choisissez le mois et l année dont vous voulez voir les paiements que vous avez donné au personnel', 'paiements-par-mois-annee');
});

vente_personnel.addEventListener('click', () => {
  ventePersonnel('Choisissez le nom d un personnel et completez les dates auxquells vous voulez voir les ventes qu il a fait', 'vente-personnel');
});

vente_personnel_facture.addEventListener('click', () => {
  ventePersonnel('Choisissez le nom d un personnel et completez les dates auxquells vous voulez voir les ventes qu il a fait', 'vente-personnel-facture');
});


