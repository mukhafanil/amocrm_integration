import Inputmask from "./inputmask.es6.js";
import {Flag, fadeIn, fadeOut} from './utilities.js';

document.addEventListener('DOMContentLoaded', () => {
    const flag = new Flag();

    setPhoneMask();

    function setPhoneMask() {
        let inputPhone = document.querySelector('#discountPhone');
        let im = new Inputmask("+7 (999) 999-99-99", {
            oncomplete: function() {
                inputPhone.setCustomValidity('');
            },
            onincomplete: function() {
                inputPhone.setCustomValidity('Введите полный номер телефона');
            }
        });
        im.mask(inputPhone);
    }

    const openModalButtons = document.querySelectorAll('.open-modal');
    openModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            flag.toggle(() => {
                const modalSelector = this.dataset.modal;
                const modal = document.querySelector(modalSelector);

                fadeIn(modal, 'flex');
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
                    resultSuccess();
                } else {
                    console.log('Ошибка при отправке лида.', data);
                }
            })
            .catch(error => console.error('Ошибка:', error));
    });

    function resultSuccess() {
        discountForm.reset();

        const discountModal = document.querySelector('#discountModal');
        setTimeout(() => fadeOut(discountModal), 200);

        const successModal = document.querySelector('#successModal');
        fadeIn(successModal, 'flex');
        setTimeout(() => fadeOut(successModal), 3500);
    }

});