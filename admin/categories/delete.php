<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Получите идентификатор цитаты из запроса

    include(__DIR__ . "/../../controller.php");

    $postData = file_get_contents("php://input");
    $postParams = $putParams = json_decode($postData, true);

    $categoryId = $postParams['categoryId'];

    if ($categoryId && is_numeric($categoryId)) {

        $controller = Controller::getInstance();
        $controller->delete_category($categoryId);
    } else {
        http_response_code(400);
    }

} else {
    // Неверный метод запроса
    http_response_code(405);
    echo 'Метод не поддерживается';
}