const voir = document.querySelectorAll('.voir');
//const inp = document.querySelector('#moi');
const container = document.querySelector('#superieur');
const croix = document.querySelector('#croix');
const take = document.querySelector("#container");
//const image = document.querySelector('#image');

for (let i = 0; i < voir.length; i += 1) {
    
    let valeur = '';
    voir[i].addEventListener('click', () => {
        container.style.display = 'block';
        let tab = voir[i].id;
        valeur = tab;
        // mettre sur la ligne en dessus le lien des
        //image.src = tab+'.png';
        let source = tab+'.png';
        take.innerHTML = `<img id="image" src=${source} class="img-fluid m-0" alt="produit">`
        document.querySelector('main').style.filter = 'blur(10px)';
    });
}
croix.addEventListener('click', () => {
    container.style.display = 'none';
    document.querySelector('main').style.filter = 'blur(0px)';
});
window.addEventListener('load', () => {
    container.style.display = 'none';
})