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

        $page = 'authors';
        include("./sidebar.php");

        $isNew = $id === "new";
        $author = array();
        if (!$isNew) {
            $author = $controller->get_author_by_id($id)[0];
        }

        ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <h2 class="heading">Добавление Автора</h2>
                <form class="form" method="POST" enctype="multipart/form-data" id="authorForm" <?php if (!$isNew) {
                    echo 'data-author-id="' . $author["id"] . '"';
                } ?>>
                    <div>
                        <label class="form-label label">Имя автора</label>
                        <input type="text" class="form-control" placeholder="Введите имя автора" <?php if (!$isNew) {
                            echo 'value="' . $author['name'] . '"';
                        } ?> name="name" required />
                    </div>
                    <div>
                        <label class="form-label label">Описание категории</label>
                        <textarea class="form-control textarea" id="exampleFormControlTextarea1" name="description"
                            rows="3" placeholder="Введите описание автора" required><?php if (!$isNew) {
                                echo $author['description'];
                            } ?></textarea>
                    </div>
                    <?php
                    if (!$isNew && $author['image']) {
                        echo '<div>
                    <h4 class="form-label label">Текущее изображение</h3>
                    <div><img class="item-image" src="' . $BASE_URL . '/assets/images/' . $author['image'] . '"/></div>
                </div>';
                    } ?>
                    <div class="mb-3">
                        <label for="formFile" class="form-label label" name="image">Выберите изображение автора</label>
                        <input name="image" class="form-control" type="file" id="formFile" accept=".jpg, .png, .jpeg">
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
        echo '<script src="/admin/assets/js/authors.js"></script>';
    } else {
        echo '<script src="/admin/assets/js/authorEdit.js"></script>';
    }
    ?>

</body>

</html>