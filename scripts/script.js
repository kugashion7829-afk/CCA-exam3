'use strict'

const menuWrap = document.querySelector('.menuWrap');
const openMenu = document.querySelector('.open');
const closeMenu = document.querySelector('.close');
const scrolled = document.querySelector('scrolled');

openMenu.addEventListener("click", function () {
    menuVisibility() ;
});

closeMenu.addEventListener("click", function () {
    menuVisibility() ;
});

window.addEventListener('scroll', function () {
    AttachedScroll()
})

function menuVisibility() {
    if (menuWrap.classList.contains('visible')) {
        menuWrap.classList.remove('visible');
        console.log('動いてるよ！')
    } else {
        menuWrap.classList.add('visible');
    };
};

function AttachedScroll() {
    scrolled.classList.toggle('scrolled', window.scrollY >= 200);
};

    const registerContainer = document.querySelectorAll('registerContainer');
    const inputRegister = document.getElementById('inputRegister');

    inputRegister.addEventListener('click', function (){
        if (registerContainer[6] !== registerContainer[7]) {
            inputRegister[6].classList.add('difference');
            inputRegister[7].classList.add('difference');
        }
    })