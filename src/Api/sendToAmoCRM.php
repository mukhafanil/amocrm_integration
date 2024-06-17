<?php
require_once __DIR__.'/../../vendor/autoload.php';
use Fanil\Amocrm\Api\AmoCRMIntegration;

header('Content-Type: application/json');

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone']) ) {
    $firstName = 'Фаниль';
    $lastName = 'Мухамадиев';
    $title = 'Заявка '.$firstName.' '.$lastName;
    $phone = $_POST['phone'];

    $result = ( new AmoCRMIntegration() )->sendLead($title, $firstName, $lastName, $phone);

    if ($result['error']) {
        echo json_encode([
            'success' => false,
            'errorCode' => $result['errorCode'],
            'errorMessage' => $result['errorMessage']
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'Лид успешно отправлен!'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Некорректные данные или метод запроса'
    ]);
}