<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$phone = $_POST['phone'];
$site = $_SERVER['HTTP_HOST'];

$mail = new PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    // Настройки вашей почты
    $mail->Host       = $_ENV['SMTP_DOMAIN']; // SMTP сервера GMAIL
    $mail->Username   = $_ENV['SMTP_LOGIN']; // Логин на почте
    $mail->Password   = $_ENV['SMTP_PASS']; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom($_ENV['SMTP_LOGIN'], 'Заявка Фаниль Мухамадиев'); // Адрес самой почты и имя отправителя
    // Получатель письма
    $mail->addAddress('order@salesgenerator.pro');  // Ещё один, если нужен

    // -----------------------
    // Само письмо
    // -----------------------
    $mail->isHTML(true);

    $mail->Subject = 'Заявка Фаниль Мухамадиев';
    $mail->Body    = "
        <b>Сайт:</b> $site <br>
        <b>Форма: Скидка</b> <br>
        <b>Контактный телефон:</b> $phone<br>";

// Проверяем отравленность сообщения
    if ($mail->send()) {
        echo json_encode([
            'success' => true,
            'message' => 'Заявка успешно отправлена на почту!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Сообщение не было отправлено. Неверно указаны настройки вашей почты'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}"
    ]);
}