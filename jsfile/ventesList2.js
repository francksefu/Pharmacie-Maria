const voir = document.querySelectorAll('.voir');
const inp = document.querySelector('#moi');
const container = document.querySelector('#superieur');
const croix = document.querySelector('#croix');

function showHint(str) {
    if (str.length == 0) {
      document.getElementById("container").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("container").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "classVenteListe2.php?q=" + str);
    xmlhttp.send();
    }
  }
  croix.addEventListener('click', () => {
    container.style.display = 'none';
    document.querySelector('main').style.filter = 'blur(0px)';
});

for (let i = 0; i < voir.length; i += 1) {
    
    let valeur = '';
    voir[i].addEventListener('click', () => {
        container.style.display = 'block';
        let tab = voir[i].id.split('');
        tab.shift();
        valeur = tab.join('');
        showHint(valeur);
        document.querySelector('main').style.filter = 'blur(10px)';
        
    });
}

window.addEventListener('load', () => {
    container.style.display = 'none';
})



