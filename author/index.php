<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/nulling-style.css" />
    <link rel="stylesheet" href="/author/style.css" />
    <link rel="stylesheet" href="/assets/css/utils.css" />
    <link rel="icon" type="image/png" href="/assets/images/logo.png" sizes="20x20">
    <meta name="description"
        content="Информация о конкретном авторе - биография, достижения, цитаты и мудрые высказывания. Узнайте больше о жизни и вкладе этого автора в мир цитат.">
    <title>Автор</title>
</head>

<body>
    <?php
    $page = 'author';
    if ($id) {
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
            include 'controller.php';
            if ($page !== "error") {

                $controller = Controller::getInstance();
                $controller->getAuthorDetails($id);
            }
            ?>
        </div>
    </main>
    <?php
    include "footer.php"
        ?>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/authors.js"></script>

</body>

</html>