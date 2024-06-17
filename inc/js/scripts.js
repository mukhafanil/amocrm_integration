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

    const modalBg = document.querySelectorAll('.modal__bg');
    modalBg.forEach(function(block) {
        block.addEventListener('click', function() {
            flag.toggle(() => {
                const modal = this.closest('.modal');

                fadeOut(modal);
            });
        });
    });

    const discountForm = document.querySelector('#discountForm');
    discountForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('/src/Api/sendToAmoCRM.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Лид успешно отправлен!');
                } else {
                    console.log('Ошибка при отправке лида.', data);
                }
            })
            .catch(error => console.error('Ошибка:', error));
    });

});