'use strict'

const menuWrap = document.querySelector('.menuWrap');
const openButton = document.querySelector('.open');
const closeButton = document.querySelector('.close')

openButton.addEventListener("click", function () {
    menuVisibility() ;
});

closeButton.addEventListener("click", function () {
    menuVisibility() ;
});

function menuVisibility() {
    if (menuWrap.classList.contains('visible')) {
        menuWrap.classList.remove('visible');
        console.log('動いてるよ！')
    } else {
        menuWrap.classList.add('visible');
    };
};