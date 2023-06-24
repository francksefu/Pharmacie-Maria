/**
 * This file help and manage the ajax for all update file  for datalist
 */
const check_datalist = document.querySelector('#check-datalist');
const formName = check_datalist.value;
const identifiant = document.querySelector('#identifiantM');
const enve = document.querySelector('#envoi');
function showHint1(str) {
    if (str.length == 0) {
      document.getElementById("dataBesoin").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("dataBesoin").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "datalist.php?q=" + str);
    xmlhttp.send();
    }
}

window.addEventListener('load', () => {
    showHint1(formName);
})

identifiant.addEventListener('change', () => {
    showHint1(formName);
})

identifiant.addEventListener('focus', () => {
    showHint1(formName);
})