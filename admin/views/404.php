<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "config.php";
    echo ' <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="' . $BASE_URL . '/assets/css/nulling-style.css" />
    <link rel="stylesheet" href="' . $BASE_URL . '/assets/css/utils.css" />
    <link rel="stylesheet" href="' . $BASE_URL . '/styles.css" />
    <link rel="icon" type="image/png" href="' . $BASE_URL . '/assets/images/logo.png" sizes="20x20">
    <title>Ошибка</title>';
    ?>
</head>

<body>
    <?php
    $page = 'error';
    include "../header.php"
        ?>
    <main></main>
    <?php
    include "../footer.php";
    http_response_code(404);
    ?>

</body>

</html>