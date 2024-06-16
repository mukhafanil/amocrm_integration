import {Flag, fadeIn, fadeOut} from './utilities.js';

document.addEventListener('DOMContentLoaded', () => {
    const flag = new Flag();

    const openModalButtons = document.querySelectorAll('.open-modal');
    openModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            flag.toggle(() => {
                const modalSelector = this.dataset.modal;
                const modal = document.querySelector(modalSelector);

                fadeIn(modal, 'block');
            });
        });
    });

    const closeModalButtons = document.querySelectorAll('.modal-close');
    closeModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            flag.toggle(() => {
                const modal = this.closest('.modal');

                fadeOut(modal);
            });
        });
    });

});