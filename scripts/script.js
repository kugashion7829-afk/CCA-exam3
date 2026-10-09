'use strict';

const menuWrap = document.querySelector('.menuWrap');
const openMenu = document.querySelector('.open');
const closeMenu = document.querySelector('.close');

function setMenuVisible(visible) {
    menuWrap.classList.toggle('visible', visible);
    menuWrap.inert = !visible;
    openMenu.setAttribute('aria-expanded', String(visible));
    if (visible) closeMenu.focus();
    else openMenu.focus();
}

if (menuWrap && openMenu && closeMenu) {
    openMenu.addEventListener('click', function () { setMenuVisible(true); });
    closeMenu.addEventListener('click', function () { setMenuVisible(false); });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && menuWrap.classList.contains('visible')) {
            setMenuVisible(false);
        }
    });
}
