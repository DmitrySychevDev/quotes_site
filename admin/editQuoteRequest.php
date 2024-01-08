<?php
include(__DIR__ . "/../controller.php");

$controller = Controller::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $postData = file_get_contents("php://input");
    $postParams = $putParams = json_decode($postData, true);

    $quoteId = $postParams['quoteId'];
    $category = $postParams['category'];
    $author = $postParams['author'];
    $text = $postParams['text'];

    if ($category && $author && $text && $quoteId) {
        echo 'here';
        $controller->edit_quote($quoteId,$category, $author, $text);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Некорректные параметры']);
    }
}
?>