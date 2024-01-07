<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="./assets/styles/style.css" rel="stylesheet" />
  <title>Document</title>
</head>

<body>
  <div class="page-wrapper">
    <?php
    $page = 'quotes';
    include("./sidebar.php");
    ?>
    <div class="page-content-wrapper">
      <div class="page-content">
        <div class="heading-wrapper">
          <h2 class="heading">Список цитат</h2>
          <div>
            <a href="/quotes/new/">
              <button type="button" class="btn btn-outline-info btn-sm">Добавить цитату</button>
            </a>
          </div>

        </div>
        <form>
          <div class="search-wrapper">
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поиск цитат" />
            <button type="button" class="btn btn-primary">Поиск</button>
          </div>
        </form>
        <div class="quotes-container">
          <ol class="quetes-rating__list" start="1">
            <?php
            include(__DIR__ . "/../controller.php");

            $controller = Controller::getInstance();
            echo 'test';
            $controller->get_quotes_for_admin();
            ?>
          </ol>
        </div>
      </div>
    </div>
</body>

</html>