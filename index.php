<?php
    require_once('./vendor/autoload.php');
    //require_once('./src/api/sendToAmoCRM.php');
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./inc/css/style.css?v=<?=filemtime('./inc/css/style.css');?>">

    <title>AmoCRM integration</title>
</head>
<body>

    <main>
        <button class="button open-modal" data-modal="#discountModal">Кликни</button>

        <div class="modal discount" id="discountModal">
            <button class="modal__close modal-close">
                <svg class="modal-close__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.00006 1L19 18.9999M18.9999 1L1 18.9999" stroke="#FF1B88" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <div class="modal__container">
                <div class="discount__header">
                    <div class="modal__title discount__title">
                        <span class="discount__title-text1">Дарим скидку 200 рублей <br></span>
                        <span>на первый визит до 7 апреля</span>
                    </div>
                </div>
                <div class="discount__body">
                    <div class="discount__left">
                        <div class="discount__puncts puncts">
                            <div class="puncts__title">А также:</div>
                            <div class="puncts__list">
                                <div class="puncts__item">
                                    <img class="puncts__icon" src="./inc/img/arrow.svg" alt="arrow">
                                    <div class="puncts__text">участие в розыгрыше SPA для двоих;</div>
                                </div>
                                <div class="puncts__item">
                                    <img class="puncts__icon" src="./inc/img/arrow.svg" alt="arrow">
                                    <div class="puncts__text">программу лояльности с экономией до 10%;</div>
                                </div>
                                <div class="puncts__item">
                                    <img class="puncts__icon" src="./inc/img/arrow.svg" alt="arrow">
                                    <div class="puncts__text">беспроигрышную лотерею в студии <br>с бесплатными процедурами.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="discount__right">
                        <img class="discount__image" src="./inc/img/discount.jpg" alt="discount">
                    </div>
                </div>

                <form>
                    <input type="text" name="phone">
                    <button type="submit">отправить</button>
                </form>

            </div>
        </div>
    </main>

    <script src="./inc/js/scripts.js" type="module"></script>

</body>
</html>