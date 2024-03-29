<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    include(__DIR__ . "/../../controller.php");

    $postData = file_get_contents("php://input");
    $postParams = $putParams = json_decode($postData, true);

    $authorId = $postParams['authorId'];

    if ($authorId && is_numeric($authorId)) {

        $controller = Controller::getInstance();
        $controller->delete_author($authorId);

    } else {
        http_response_code(400);
    }

} else {
    // Неверный метод запроса
    http_response_code(405);
    echo 'Метод не поддерживается';
}