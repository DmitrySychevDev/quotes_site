<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="/admin/assets/styles/style.css" rel="stylesheet" />
    <link href="/admin/assets/styles/quotesForm.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="page-wrapper">
        <?php
        include(__DIR__ . "/../../controller.php");

        $controller = Controller::getInstance();

        $page = 'quotes';
        include("./sidebar.php");



        ?>
        <div class="page-content">
            <h2 class="heading">Добавление категории</h2>
            <form class="form" method="POST" enctype="multipart/form-data" id="categoryForm">
                <div>
                    <label class="form-label label">Категория цитаты</label>
                    <select name="category" class="form-select" aria-placeholder="Выберите категорию цитаты" required>
                        <?php
                        $controller->get_category_unit_options();
                        ?>
                    </select>
                </div>
                <div>
                    <label class="form-label label">Название категории</label>
                    <input type="text" class="form-control" placeholder="Введите название категории" name="name" required />
                </div>
                <div>
                    <label class="form-label label">Описание категории</label>
                    <textarea class="form-control textarea" id="exampleFormControlTextarea1" name="description" rows="3"
                        placeholder="Введите текст цитаты" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label label" name="image">Выберите файл формата .jpg</label>
                    <input name="image" class="form-control" type="file" id="formFile" accept=".jpg" required>
                </div>
                <div class="submit-wrapper">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
            <div class="quotes-container"></div>
        </div>
    </div>
    <script src="/admin/assets/js/categories.js"></script>

</body>

</html>