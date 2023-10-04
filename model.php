<?php
class Model
{
    private $conn;
    private $BASE_URL;

    public function __construct($connection)
    {
        include 'config.php';
        $this->conn = $connection;
        $this->BASE_URL = $BASE_URL;
    }

    private function get_rows_from_sql($sql)
    {
        $result = $this->conn->query($sql);
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;

    }

    public function get_main_data()
    {
        $sql = 'SELECT ki.name AS category_name, ki.image AS category_image, 
        ( SELECT q.quote FROM quote AS q WHERE q.fk_kategory_item_id = ki.id LIMIT 1 ) AS category_quote 
        FROM kategory AS k JOIN kategory_item AS ki ON k.id = ki.fk_kategory_id WHERE k.id = 3';

        $data = $this->get_rows_from_sql($sql);

        foreach ($data as &$value) {
            $value['category_image'] = $this->BASE_URL . '/assets/images/' . $value['category_image'] . '.jpg';
        }
        unset($value);

        return $data;
    }

    public function get_kategories()
    {
        $sql = 'SELECT k.name AS category_name, ki.name AS category_item_name, ki.id AS category_item_id
        FROM kategory AS k
        JOIN kategory_item AS ki ON k.id = ki.fk_kategory_id        
       ';
        $data = $this->get_rows_from_sql($sql);
        $newArray = [];

        foreach ($data as $item) {
            $categoryName = $item["category_name"];
            $categoryItemName = $item["category_item_name"];
            $categoryItemId = $item["category_item_id"];

            // Проверка наличия категории в новом массиве
            $categoryExists = false;
            foreach ($newArray as &$category) {
                if ($category["category"] === $categoryName) {
                    $categoryExists = true;
                    $category["items"][] = [
                        "id" => $categoryItemId,
                        "name" => $categoryItemName
                    ];
                    break;
                }
            }

            // Если категория отсутствует, добавляем ее в новый массив
            if (!$categoryExists) {
                $newArray[] = [
                    "category" => $categoryName,
                    "items" => [
                        [
                            "id" => $categoryItemId,
                            "name" => $categoryItemName
                        ]
                    ]
                ];
            }
        }

        return $newArray;

    }

    public function get_rating($quantity)
    {
        $sql = 'SELECT q.id, q.quote AS quote, q.rating, a.name AS author FROM quote as q JOIN author as a ON a.id=q.fk_author_id ORDER BY q.rating  DESC LIMIT ' . $quantity . ';';
        return $this->get_rows_from_sql($sql);
    }

    public function get_authors()
    {
        $sql = 'SELECT * FROM author';

        $data = $this->get_rows_from_sql($sql);

        foreach ($data as &$value) {
            $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'] . '.jpg';
        }
        unset($value);

        return $data;
    }

    public function getAuthorData($id)
    {
        $sql = "SELECT author.name, author.description, author.image, quote.quote
        FROM author
        JOIN quote ON author.id = quote.fk_author_id
        WHERE author.id =" . $id;
        $data = $this->get_rows_from_sql($sql);
        if (!empty($data)) {
            foreach ($data as &$value) {
                $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'] . '.jpg';
            }
            unset($value);
        } else {
            $sql = "SELECT author.name, author.description, author.image
        FROM author
        WHERE author.id =" . $id;


            if (!empty($data)) {
                $data[0]['image'] = $this->BASE_URL . '/assets/images/' . $data[0]['image'] . '.jpg';
            }

            return $data[0];
        }
        return $data;

    }

    public function getCategoryData($id)
    {
        $sql = "SELECT 	kategory_item.name,	kategory_item.description,	kategory_item.image, quote.quote
        FROM 	kategory_item
        JOIN quote ON kategory_item.id = quote.fk_kategory_item_id
        WHERE kategory_item.id =" . $id;
        $data = $this->get_rows_from_sql($sql);
        if (!empty($data)) {
            foreach ($data as &$value) {
                $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'] . '.jpg';
            }
            unset($value);
            return $data;
        } else {
            $sql = "SELECT 	kategory_item.name,	kategory_item.description,	kategory_item.image
                    FROM 	kategory_item
                    WHERE kategory_item.id =" . $id;

            $data = $this->get_rows_from_sql($sql);
            if (!empty($data)) {
                $data[0]['image'] = $this->BASE_URL . '/assets/images/' . $data[0]['image'] . '.jpg';
            }

            return $data[0];
        }



    }

    public function updateRating($id)
    {
        $sql = 'SELECT * FROM quote WHERE id=' . $id;
        $quote = $this->get_rows_from_sql($sql);

        if (empty($quote)) {
            $response = array(
                'status' => 'error',
                'message' => 'Указан неверный id цитаты',
            );

            // Установка заголовков для указания типа содержимого JSON
            header('Content-Type: application/json');

            // Преобразование массива в JSON формат и вывод в качестве ответа
            echo json_encode($response);
        } else {
            $sql = 'UPDATE quote SET rating=rating+1 WHERE id=' . $id;

            $result = $this->conn->query($sql);
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Запись успешно обновлена.',
                );
                header('Content-Type: application/json');
                echo json_encode($response);

            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Запись не была обновленна обновлена.',
                );


                header('Content-Type: application/json');
                http_response_code(400);


                echo json_encode($response);
            }

        }

    }

}
?>