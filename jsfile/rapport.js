const toute_vente = document.querySelector('#toute-vente');
const paye_cache = document.querySelector('#paye-cache');
const vente_dette = document.querySelector('#vente-dette');
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

const toute_vente2 = document.querySelector('#toute-vente2');
const paye_cache2 = document.querySelector('#paye-cache2');
const vente_dette2 = document.querySelector('#vente-dette2');
const toutes_sortie2 = document.querySelector('#toutes-sortie2');
const trie_charge2 = document.querySelector('#trie-charge2');
const trie_dette2 = document.querySelector('#trie-dette2');
const trie_depenses2 = document.querySelector('#trie-depenses2');
const trie_inutile2 = document.querySelector('#trie-inutile2');
const bonus_perte2 = document.querySelector('#bonusPerte2');
const approvisionnement2 = document.querySelector('#approvisionnement2');
const paiements2 = document.querySelector('#paiements2');
const paiements_client2 = document.querySelector('#paiements-client2');
const paiements_facture2 = document.querySelector('#paiements-facture2');
const clients_facture = document.querySelector('#toutes-facture');
const clients_facture_2dates = document.querySelector('#facture-2-dates');
const clients_facture_dette = document.querySelector('#facture-dette');
const resume = document.querySelector('#resume');

const date1 = document.querySelector('#date1');
const date2 = document.querySelector('#date2');
const input = document.querySelector('#input');

const contDate1 = document.querySelector('#cont-date1');
const contDate2 = document.querySelector('#cont-date2');
const contInput = document.querySelector('#cont-input');
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
  contInput.style.display = 'none';
  btn.style.display = 'none'
});

function uneDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function unInput(message, part) {
    enleveMessage(paragrapheP);
    contInput.style.display = 'flex';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function deuxDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'flex';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

function InputEtDeuxDate(message, part) {
    enleveMessage(paragrapheP);
    contDate1.style.display = 'flex';
    contDate2.style.display = 'flex';
    contInput.style.display = 'flex';
    btn.style.display = 'block';
    paragraphe(paragrapheP, message);
    type.value = part;
}

toute_vente.addEventListener('click', () => {
  uneDate('toutes les vente sur une date', 'toute_vente');
});

toute_vente2.addEventListener('click', () => {
    deuxDate('toutes les vente entre 2 date', 'toute_vente2');
  });

paye_cache.addEventListener('click', () => {
  uneDate('toutes les vente payé sur une date', 'paye_cache');
});

paye_cache2.addEventListener('click', () => {
    deuxDate('toutes les vente payé entre 2 date', 'paye_cache2');
  });

vente_dette.addEventListener('click', () => {
  uneDate('toutes les vente en dette sur une date', 'vente_dette');
});

vente_dette2.addEventListener('click', () => {
    deuxDate('toutes les vente en dette entre 2 date', 'vente_dette2');
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


paiements_facture.addEventListener('click', () => {
    unInput('tous les paiements sur une facture', 'paiements_facture');
    //input.list = 'dataFacture'
});

paiements_facture2.addEventListener('click', () => {
    InputEtDeuxDate('tous les paiements sur une facture entre 2 dates', 'paiements_facture2');
});

paiements_client.addEventListener('click', () => {
    unInput('tous les paiements d un client', 'paiements_client2');
});

paiements_client2.addEventListener('click', () => {
    InputEtDeuxDate('tous les paiements d un client entre 2', 'paiements_client');
});

clients_facture.addEventListener('click', () => {
    unInput('voir toutes les factures d un client', 'clients_facture');
});

clients_facture_dette.addEventListener('click', () => {
    InputEtDeuxDate('voir toutes les factures d un client non payé', 'clients_facture_dette');
});

clients_facture_2dates.addEventListener('click', () => {
    InputEtDeuxDate('voir toutes les factures d un client entre 2 dates', 'clients_facture_2dates');
});