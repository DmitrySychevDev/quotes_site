<?php
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $putData = file_get_contents("php://input");
    $putParams = $putParams = json_decode($putData, true);


    include '../controller.php';
    $controller = Controller::getInstance();

    $id = $putParams['id'];

    if ($id) {
        $controller->incrementRating($id);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Тута Ожидался целочисленный идентификатор',
        );

        header('Content-Type: application/json');
        http_response_code(400);

        echo json_encode($response);

    }

    exit();
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        header('Location: http://localhost/quotient/rating/');
        exit();
    }

}



?>