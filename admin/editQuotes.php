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
        include(__DIR__ . "/../controller.php");

        $controller = Controller::getInstance();

        $page = 'quotes';
        include("./sidebar.php");

        $isNew = $id === "new";
        $quote = array();
        if (!$isNew) {
            $quote = $controller->get_quote_by_id($id)[0];
        }
        ?>
        <div class="page-content">
            <h2 class="heading">Добавление цитаты</h2>
            <form class="form" method="POST" id="quoteForm" <?php if (!$isNew) {
                echo 'data-quote-id="' . $quote["id"] . '"';
            } ?>>
                <div>
                    <label class="form-label label">Категория цитаты</label>
                    <select name="category" class="form-select" aria-placeholder="Выберите категорию цитаты" required>
                        <?php
                        if ($isNew) {
                            $controller->get_categories_options();
                        } else {
                            $controller->get_categories_options($quote['fk_kategory_item_id']);

                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="form-label label">Автор цитаты</label>
                    <select name="author" class="form-select" aria-placeholder="Выберите автора цитаты" required>
                        <?php
                        if ($isNew) {
                            $controller->get_authors_options();
                        } else {
                            $controller->get_authors_options($quote['fk_author_id']);

                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label class="form-label label">Текст цитаты</label>
                    <textarea name="text" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"
                        placeholder="Введите текст цитаты" required><?php
                        if (!$isNew) {
                            echo $quote["quote"];
                        } ?></textarea>
                </div>
                <div class="submit-wrapper">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
            <div class="quotes-container"></div>
        </div>
    </div>
    <?php
    if ($isNew) {
        echo '<script src="/admin/assets/js/quotes.js"></script>';
    } else {
        echo '<script src="/admin/assets/js/quoteEdit.js"></script>';
    }
    ?>
</body>

</html>