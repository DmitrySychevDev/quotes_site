<?php
include(__DIR__ . "/../../controller.php");

$controller = Controller::getInstance();
header('Content-Type: application/json');


// Получаем данные из формы
$categoryId = $_POST['categoryId']; // Новый параметр
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];

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
if ($categoryId && $name && $description && $category) {
    // Обновление данных в базе данных
    $controller->edit_category($categoryId, $name, $description, $category, isset($imageFileName) ? $imageFileName : null);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Некорректные параметры']);
}
?>