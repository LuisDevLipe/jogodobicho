const navbar = document.querySelector('.main-navigation');
console.log(navbar)
const toggle = document.querySelector('.toggle');
console.log(toggle)

window.addEventListener('load', () => {
    if (window.innerWidth < 768) {
        navbar.classList.add('mobile');
    } else {
        navbar.classList.remove('mobile');
    }
})

window.matchMedia('(max-width: 768px)').addEventListener('change', (e) => {
    if (e.matches) {
        navbar.classList.add('mobile');
    } else {
        navbar.classList.remove('mobile');
    }
});

window.addEventListener('resize',() => {
    if (window.innerWidth < 768) {
        navbar.classList.add('mobile');
    }
    else {
        navbar.classList.remove('mobile');
    }
})

toggle.addEventListener('click', () => {
    if(navbar.classList.contains('closed')) {
        navbar.classList.replace('closed', 'opened');
    } else {
        navbar.classList.replace('opened', 'closed');
    }
})