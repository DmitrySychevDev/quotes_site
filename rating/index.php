<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Исследуйте и открывайте самые высокооцененные цитаты на нашем цитатном сайте. Найдите вдохновение, мудрость и задумчивые слова от известных авторов и мыслителей. Просматривайте цитаты с самым высоким рейтингом и вдохновляйтесь для жизни, полной смысла.">
    <link rel="stylesheet" href="/assets/css/nulling-style.css" />
    <link rel="stylesheet" href="/assets/css/utils.css" />
    <link rel="stylesheet" href="/rating/styles.css" />
    <link rel="icon" type="image/png" href="/assets/images/logo.png" sizes="20x20">
    <title>Рейтинг</title>
</head>

<body>
    <?php
    $page = 'rating';

    $quantity = 5;

    if($q && is_numeric($q)){
        $quantity = $q;
    }

    if (!is_numeric($quantity)) {
        $page = "error";
        http_response_code(400);
    }
    include "header.php"
        ?>
    <main>
        <div class="quetes-rating">
            <ol class="quetes-rating__list" start="1">
                <?php
                if ($page !== 'error') {

                    include 'controller.php';

                    $controller = Controller::getInstance();
                    $controller->get_rating_page_data($quantity);
                }
                ?>
            </ol>
        </div>
    </main>
    <?php
    include "footer.php"
        ?>
    <script src="/assets/js/index.js"></script>
    <script src="/assets/js/rating.js"></script>
</body>

</html>