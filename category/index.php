<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Информация о конкретной категории цитат - описание, тематика, известные цитаты и высказывания. Узнайте больше о цитатах в этой категории и найдите вдохновение.">
    <link rel="stylesheet" href="/assets/css/nulling-style.css" />
    <link rel="stylesheet" href="/category/style.css" />
    <link rel="stylesheet" href="/assets/css/utils.css" />
    <link rel="icon" type="image/png" href="/assets/images/logo.png" sizes="20x20">
    <title>Категория</title>
</head>

<body>
    <?php
    $page = 'kategory';
    if ($id) {
        $id = $id;
        if (!is_numeric($id)) {
            $page = "error";
            http_response_code(400);
        }
    } else {
        $page = "error";
        http_response_code(400);
    }
    include "header.php"
        ?>
    <main>
        <div class="authors-container">
            <?php
            if ($page !== "error") {
                include 'controller.php';

                $controller = Controller::getInstance();
                $controller->getCategoryDetails($id);
            }
            ?>
        </div>
    </main>
    <?php
    include "footer.php"
        ?>
    <script src="/assets/js/index.js"></script>
    <script src="/assets/js/authors.js"></script>

</body>

</html>