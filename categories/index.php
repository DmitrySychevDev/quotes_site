<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Исследуйте различные категории цитат на нашем цитатном сайте. На странице категории вы найдете подборки цитат, относящихся к определенным темам или областям жизни. Углубитесь в разные сферы знаний и вдохновитесь мудрыми и волнующими словами.">
  <link rel="stylesheet" href="../assets/css/nulling-style.css" />
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="../assets/css/utils.css" />
  <link rel="icon" type="image/png" href="../assets/images/logo.png" sizes="20x20">
  <title>Категории</title>
</head>

<body>
  <?php
  $page = "kategories";
  include "header.php";
  ?>
  <main>
    <section class="categories">
      <?php
      include 'controller.php';
      $controller = Controller::getInstance();
      $controller->get_categories_page();
      ?>
    </section>
  </main>
  <?php
  include "footer.php";
  ?>
  <script src="../assets/js/index.js"></script>
</body>

</html>