const imprimeChamps = document.querySelector('#imprimer');
const dataBesoinChamps = document.querySelector('#dataBesoin');

function showHint(str) {
    if (str.length == 0) {
      //document.getElementById("container").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("dataBesoin").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "imprime_actualise.php?q=" + str);
    xmlhttp.send();
    }
}

window.addEventListener('load', () => {
    showHint('premier');
});

imprimeChamps.addEventListener('focus', () => {
    showHint('premier');
});