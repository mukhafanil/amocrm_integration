<?php
use Fanil\Amocrm\Api\AmoCRMIntegration;

$firstName = 'Фаниль';
$lastName = 'Мухамадиев';
$title = 'Заявка '.$firstName.' '.$lastName;
$phone = '+79876543210';

$result = (new AmoCRMIntegration())->sendLead($title, $firstName, $lastName, $phone);

if ($result) {
    dump($result);
    echo 'Лид успешно отправлен!';
} else {
    dump($result);
    echo 'Произошла ошибка при отправке лида.';
}