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
        $page = 'quotes';
        include("./sidebar.php");
        ?>
        <div class="page-content-wrapper">
            <div class="page-content">

                <div class="heading-wrapper">
                    <h2 class="heading">Авторы цитат</h2>
                    <div>
                        <a href="/authors/new/">
                            <button type="button" class="btn btn-outline-info btn-sm">
                                Добавить автора
                            </button>
                        </a>
                    </div>
                </div>
                <form>
                    <div class="search-wrapper">
                        <input type="text" class="form-control" id="search_input_authors" placeholder="Поиск авторов" />
                        <button type="button" id="search__button__authors" class="btn btn-primary">Поиск</button>
                    </div>

                </form>
                <div class="quotes-container">
                    <div class="search-deascription">
                        <p id="descritption-info_text">
                        </p>

                        <div id="descritption-info__clear">Очистить поиск</div>
                    </div>
                    <ol class="quetes-rating__list authors-container" start="1">
                        <?php
                        include(__DIR__ . "/../../controller.php");

                        $controller = Controller::getInstance();
                        $controller->get_authors_page_for_admin();
                        ?>
                    </ol>
                </div>
            </div>
            <script src="/admin/assets/js/authors.js"></script>
</body>

</html>