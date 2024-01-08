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

    private function execute_insert($sql, $params = array())
    {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Обработка ошибки подготовки запроса
            return false;
        }

        if (!empty($params)) {
            $types = ''; // Строка для хранения типов параметров
            $bindParams = array();

            foreach ($params as $param) {
                $types .= 's'; // Всегда приводим к строке
                $bindParams[] = $param; // Просто добавляем параметры
            }

            array_unshift($bindParams, $types);
            call_user_func_array(array($stmt, 'bind_param'), $bindParams);
        }

        $result = $stmt->execute();

        if ($result === false) {
            // Обработка ошибки выполнения запроса
            $error = $stmt->error;
            $sqlstate = $stmt->sqlstate;
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    private function execute_delete($sql, $params = array())
    {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Обработка ошибки подготовки запроса
            return false;
        }

        if (!empty($params)) {
            $types = ''; // Строка для хранения типов параметров
            $bindParams = array();

            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i'; // 'i' для integer
                } elseif (is_float($param)) {
                    $types .= 'd'; // 'd' для double/float
                } else {
                    $types .= 's'; // 's' для string
                }

                $bindParams[] = &$param; // Создание массива для bind_param
            }

            array_unshift($bindParams, $types);
            call_user_func_array(array($stmt, 'bind_param'), $bindParams);
        }

        $result = $stmt->execute();

        if ($result === false) {
            // Обработка ошибки выполнения запроса

            return false;
        }


        $stmt->close();
        return true;
    }

    private function get_rows_from_sql($sql, $params = array())
    {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            // Обработка ошибки подготовки запроса
            return false;
        }

        if (!empty($params)) {
            $types = ''; // Строка для хранения типов параметров
            $bindParams = array();

            foreach ($params as $param) {
                $types .= 's'; // Всегда приводим к строке
                $bindParams[] = $param; // Просто добавляем параметры
            }

            array_unshift($bindParams, $types);
            call_user_func_array(array($stmt, 'bind_param'), $bindParams);
        }

        $result = $stmt->execute();

        if ($result === false) {
            // Обработка ошибки выполнения запроса
            $stmt->close();
            return false;
        }

        $result = $stmt->get_result();

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $stmt->close();
        return $data;
    }

    public function get_main_data()
    {
        $sql = 'SELECT ki.name AS category_name, ki.image AS category_image, 
        ( SELECT q.quote FROM quote AS q WHERE q.fk_kategory_item_id = ki.id LIMIT 1 ) AS category_quote 
        FROM kategory AS k JOIN kategory_item AS ki ON k.id = ki.fk_kategory_id WHERE k.id = ?';

        $params = array(3);

        $data = $this->get_rows_from_sql($sql, $params);



        foreach ($data as &$value) {
            $value['category_image'] = $this->BASE_URL . '/assets/images/' . $value['category_image'];
        }

        unset($value);


        return $data;
    }

    public function get_quotes()
    {
        $sql = 'SELECT * FROM quote';
        $data = $this->get_rows_from_sql($sql);
        return $data;
    }

    public function get_categories_unit()
    {
        $sql = 'SELECT * FROM kategory;';
        $data = $this->get_rows_from_sql($sql);
        return $data;
    }

    public function get_categories()
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
        $sql = 'SELECT q.id, q.quote AS quote, q.rating, a.name AS author FROM quote as q JOIN author as a ON a.id=q.fk_author_id ORDER BY q.rating  DESC LIMIT ? ;';
        $params = array($quantity);
        return $this->get_rows_from_sql($sql, $params);
    }

    public function get_authors()
    {
        $sql = 'SELECT * FROM author';

        $data = $this->get_rows_from_sql($sql);

        foreach ($data as &$value) {
            $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'];
        }
        unset($value);

        return $data;
    }

    public function getAuthorData($id)
    {
        $sql = "SELECT author.name, author.description, author.image, quote.quote
        FROM author
        JOIN quote ON author.id = quote.fk_author_id
        WHERE author.id = ? ;";

        $params = array($id);
        $data = $this->get_rows_from_sql($sql, $params);
        if (!empty($data)) {
            foreach ($data as &$value) {
                $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'];
            }
            unset($value);
        } else {
            $sql = "SELECT author.name, author.description, author.image
        FROM author
        WHERE author.id = ?";
            $params = array($id);
            $data = $this->get_rows_from_sql($sql, $params);


            if (!empty($data)) {
                $data[0]['image'] = $this->BASE_URL . '/assets/images/' . $data[0]['image'];
            }

            return $data[0];
        }
        return $data;

    }

    public function get_quote_by_id($id)
    {
        $sql = 'SELECT * FROM quote WHERE id = ? ;';
        $params = array($id);
        $data = $this->get_rows_from_sql($sql, $params);
        return $data;
    }

    public function update_quote($id, $category, $author, $text)
    {
        $sql = "UPDATE quote
        SET  fk_kategory_item_id =? , fk_author_id =?, quote = ?
        WHERE id = ?";
        $params = array($category, $author, $text,$id);
        $this->execute_insert($sql, $params);
        return true;


    }

    public function getCategoryData($id)
    {
        $sql = "SELECT 	kategory_item.name,	kategory_item.description,	kategory_item.image, quote.quote
        FROM 	kategory_item
        JOIN quote ON kategory_item.id = quote.fk_kategory_item_id
        WHERE kategory_item.id = ? ";

        $params = array($id);
        $data = $this->get_rows_from_sql($sql, $params);
        if (!empty($data)) {
            foreach ($data as &$value) {
                $value['image'] = $this->BASE_URL . '/assets/images/' . $value['image'];
            }
            unset($value);
            return $data;
        } else {
            $sql = "SELECT 	kategory_item.name,	kategory_item.description,	kategory_item.image
                    FROM 	kategory_item
                    WHERE kategory_item.id = ?";
            $params = array($id);

            $data = $this->get_rows_from_sql($sql, $params);
            if (!empty($data)) {
                $data[0]['image'] = $this->BASE_URL . '/assets/images/' . $data[0]['image'];
            }

            return $data[0];
        }

    }

    public function get_category_items()
    {
        $sql = 'SELECT * FROM kategory_item;';
        $data = $this->get_rows_from_sql($sql);
        return $data;
    }

    public function delete_author($id)
    {
        $sql = 'DELETE FROM author WHERE id = ? ;';
        $params = array($id);
        $this->execute_delete($sql, $params);
        return $this->conn->affected_rows > 0;

    }

    public function delete_quote($id)
    {
        $sql = 'DELETE FROM quote WHERE id = ? ;';
        $params = array($id);
        $this->execute_delete($sql, $params);
        return $this->conn->affected_rows > 0;

    }

    public function add_quote($category, $author, $text)
    {
        $text = (string) $text;
        $author = (int) $author;
        $category = (int) $category;
        $sql = 'INSERT INTO `quote` (`quote`, `fk_author_id`, `fk_kategory_item_id`) VALUES (?, ? , ?);';
        $params = array($text, $author, $category);
        $this->execute_insert($sql, $params);
        return true;
    }

    public function add_category($name, $description, $category, $image)
    {
        $sql = 'INSERT INTO `kategory_item` (`name`, `description`, `fk_kategory_id`, `image`) VALUES (?, ?,?, ?);';
        $params = array($name, $description, $category, $image);
        $this->execute_insert($sql, $params);
        return true;
    }
    public function add_author($name, $description, $image)
    {
        $sql = 'INSERT INTO `author` (`name`, `description`, `image`) VALUES (?,?, ?);';
        $params = array($name, $description, $image);
        $this->execute_insert($sql, $params);
        return true;
    }

    public function delete_category($id)
    {
        $sql = 'DELETE FROM kategory_item WHERE id = ? ;';
        $params = array($id);
        $this->execute_delete($sql, $params);
        return $this->conn->affected_rows > 0;

    }

    public function updateRating($id)
    {
        $sql = 'SELECT * FROM quote WHERE id= ? ;';

        $params = array($id);
        $quote = $this->get_rows_from_sql($sql, $params);

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