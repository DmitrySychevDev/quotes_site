<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Получите идентификатор цитаты из запроса

    include(__DIR__ . "/../controller.php");

    $postData = file_get_contents("php://input");
    $postParams = $putParams = json_decode($postData, true);

    $quoteId = $postParams['quoteId'];

    if ($quoteId && is_numeric($quoteId)) {

        $controller = Controller::getInstance();
        $controller->delete_quote($quoteId);
    } else {
        http_response_code(400);
    }

} else {
    // Неверный метод запроса
    http_response_code(405);
    echo 'Метод не поддерживается';
}