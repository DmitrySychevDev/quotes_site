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
        include(__DIR__ . "/../../config.php");


        $controller = Controller::getInstance();

        $page = 'quotes';
        include("./sidebar.php");

        $isNew = $id === "new";
        $category = array();
        if (!$isNew) {
            $category = $controller->get_category_item_by_id($id)[0];
        }

        ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <h2 class="heading">Добавление категории</h2>
                <form class="form" method="POST" enctype="multipart/form-data" id="categoryForm" <?php if (!$isNew) {
                    echo 'data-category-id="' . $category["id"] . '"';
                } ?>>
                    <div>
                        <label class="form-label label">Категория цитаты</label>
                        <select name="category" class="form-select" aria-placeholder="Выберите категорию цитаты"
                            required>
                            <?php
                            $controller->get_category_unit_options();
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="form-label label">Название категории</label>
                        <input type="text" class="form-control" placeholder="Введите название категории" <?php if (!$isNew) {
                            echo 'value="' . $category['name'] . '"';
                        } ?> name="name" required />
                    </div>
                    <div>
                        <label class="form-label label">Описание категории</label>
                        <textarea class="form-control textarea" id="exampleFormControlTextarea1" name="description"
                            rows="3" placeholder="Введите описание категории" required><?php
                            if (!$isNew) {
                                echo $category["description"];
                            } ?></textarea>
                    </div>
                    <?php
                    if (!$isNew && $category['image']) {
                        echo '<div>
                    <h4 class="form-label label">Текущее изображение</h3>
                    <div><img class="item-image" src="' . $BASE_URL . '/assets/images/' . $category['image'] . '"/></div>
                </div>';
                    } ?>
                    <div class="mb-3">
                        <label for="formFile" class="form-label label" name="image">Выберите изображение
                            категории</label>
                        <input name="image" class="form-control" type="file" id="formFile" accept=".jpg">
                    </div>
                    <div class="submit-wrapper">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
                <div class="quotes-container"></div>
            </div>
        </div>
    </div>
    <?php
    if ($isNew) {
        echo '<script src="/admin/assets/js/categories.js"></script>';
    } else {
        echo '<script src="/admin/assets/js/categoryEdit.js"></script>';
    }
    ?>
</body>

</html>