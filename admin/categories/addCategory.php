
<?php
include(__DIR__ . "/../../controller.php");

$controller = Controller::getInstance();

// Получаем данные из формы
$name = $_POST['name'];
$description = $_POST['description'];
$category = $_POST['category'];

$uploadDirectory = __DIR__ . '/../../assets/images/';
$imageFileName = uniqid() . '.jpg'; // Уникальное имя файла
$targetFilePath = $uploadDirectory . $imageFileName;

$allowedExtensions = ['jpg', 'jpeg', 'png'];

if (isset($_FILES['image'])) {
    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);

        if ($name && $description && $category && $imageFileName) {
            // Добавляем данные в базу данных
            $controller->add_category($name, $description, $category, $imageFileName);
        } else {
            echo json_encode(['message' => 'Некорректные параметры']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Недопустимый тип файла. Поддерживаются только JPG, JPEG и PNG.']);
    }
} else {
    echo json_encode(['message' => 'Файл не был загружен']);
}
?>