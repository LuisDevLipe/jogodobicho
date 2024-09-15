const acessibility_toggle = document.querySelector('.icon');
const acessibility_div = document.getElementById('acessibilidade');
acessibility_toggle.addEventListener('click', () => {
    acessibility_div.classList.toggle('opened');
});