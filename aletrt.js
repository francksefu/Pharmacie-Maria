const alerte = document.querySelector('#alerte');
const normal = document.querySelector('#normal');
const render = document.querySelector('#render');
const render_alerte = document.querySelector('#render-alerte');

alerte.addEventListener('click', () => {
    render.style.display = 'none';
    render_alerte.style.display = 'block';
});

normal.addEventListener('click', () => {
    render.style.display = 'block';
    render_alerte.style.display = 'normal';
});