<?php
include(__DIR__ . "/../../controller.php");

$controller = Controller::getInstance();
header('Content-Type: application/json');


// Получаем данные из формы
$authorId = $_POST['authorId']; // Новый параметр
$name = $_POST['name'];
$description = $_POST['description'];

$uploadDirectory = __DIR__ . '/../../assets/images/';
$allowedExtensions = ['jpg', 'jpeg', 'png'];

// Обработка изображения, если оно присутствует в запросе
if (isset($_FILES['image'])) {
    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $imageFileName = uniqid() . '.jpg'; // Генерируем уникальное имя файла
        $targetFilePath = $uploadDirectory . $imageFileName;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Недопустимый тип файла. Поддерживаются только JPG, JPEG и PNG.']);
        exit;
    }
}

// Проверка наличия всех необходимых данных
if ($authorId && $name && $description) {
    // Обновление данных в базе данных
    $controller->edit_author($authorId, $name, $description, isset($imageFileName) ? $imageFileName : null);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Некорректные параметры']);
}
?>