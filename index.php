<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Добро пожаловать на наш сайт цитат! Здесь вы найдете вдохновляющие и мотивирующие цитаты, которые поднимут вам настроение и помогут вам в повседневной жизни. Погрузитесь в мир мудрых слов и делитесь ими с другими.">
  <link rel="stylesheet" href="./index.css" />
  <link rel="stylesheet" href="./assets/css/nulling-style.css" />
  <link rel="stylesheet" href="./assets/css/utils.css" />
  <link rel="icon" type="image/png" href="./assets/images/logo.png" sizes="20x20">
  <title>Цитаты на все случаи жизни</title>
</head>

<body>

  <?php
  $page = 'main';
  include 'header.php'
    ?>
  <main>
    <div class="quotes-block">
      <?php
      include 'controller.php';

      $controller = Controller::getInstance();

      $controller->get_main_page();
      ?>
    </div>
  </main>
  <?php
  include 'footer.php'
    ?>
  <script src="./assets/js/index.js"></script>
</body>

</html>