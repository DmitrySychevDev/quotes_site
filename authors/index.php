<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Исследуйте различных авторов цитат на нашем цитатном сайте. На странице авторов вы найдете цитаты, приписываемые конкретным авторам. Узнайте мнения и мудрые мысли знаменитых личностей и вдохновитесь их словами.">
  <link rel="stylesheet" href="../assets/css/nulling-style.css" />
  <link rel="stylesheet" href="./styles.css" />
  <link rel="stylesheet" href="../assets/css/utils.css" />
  <link rel="icon" type="image/png" href="../assets/images/logo.png" sizes="20x20">
  <title>Авторы</title>
</head>

<body>
  <?php
  $page = 'authors';
  include "../header.php"
    ?>
  <main>

    <?php
    include '../controller.php';
    $controller = Controller::getInstance();
    $controller->get_authors_page();
    ?>
  </main>
  <?php
  include "../footer.php"
    ?>
  <script src="../assets/js/index.js"></script>
  <script src="../assets/js/authors.js"></script>
</body>

</html>