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

        <div class="modal" id="discountModal">
            <button class="modal__close modal-close">
                <svg class="modal-close__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.00006 1L19 18.9999M18.9999 1L1 18.9999" stroke="#FF1B88" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <div class="modal-container">test</div>
        </div>
    </main>

    <script src="./inc/js/scripts.js" type="module"></script>

</body>
</html>