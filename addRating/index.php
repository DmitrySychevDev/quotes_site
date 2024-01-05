<?php

    $putData = file_get_contents("php://input");
    $putParams = $putParams = json_decode($putData, true);


    include 'controller.php';
    $controller = Controller::getInstance();

    $id = $putParams['id'];
    
    $response = array(
        'id' => $id,
    );

    if ($id) {
        $controller->incrementRating($id);
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Ожидался целочисленный идентификатор',
        );

        header('Content-Type: application/json');
        http_response_code(400);

        echo json_encode($response);
        exit();

    }

    

?>