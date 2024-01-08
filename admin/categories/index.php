<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="/admin/assets/styles/style.css" rel="stylesheet" />
    <link href="/admin/categories/style.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="page-wrapper">
        <?php
        $page = 'categories';
        include(__DIR__ . "/../sidebar.php");
        ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="heading-wrapper">
                    <h2 class="heading">Список категорий</h2>
                    <div>
                        <a href="<?php echo $BASE_URL; ?>/admin/categories/new">
                            <button type="button" class="btn btn-outline-info btn-sm">
                                Добавить категорию
                            </button>
                        </a>
                    </div>
                </div>
                <form>
                    <div class="search-wrapper">
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="Поиск цитат" />
                        <button type="button" class="btn btn-primary">Поиск</button>
                    </div>
                </form>
                <div class="quotes-container">
                    <?php
                    include(__DIR__ . "/../../controller.php");
                    
                    $controller = Controller::getInstance();
                    $controller->get_categories_page_for_admin();
                    ?>

                </div>
            </div>
        </div>
        <script src="/admin/assets/js/categories.js"></script>

</body>

</html>