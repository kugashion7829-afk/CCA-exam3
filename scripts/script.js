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

