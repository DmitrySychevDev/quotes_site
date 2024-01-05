<?php
class Controller
{
    private $model;
    private $view;
    private $conn;
    private static $instance;

    private function __construct()
    {
        include 'config.php';
        include 'db.php';
        include 'model.php';
        include 'view.php';

        ini_set('display_errors', 0);
        $db = new Database($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

        $this->conn = $db->connect();
        $this->model = new Model($this->conn);
        $this->view = new View();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Controller();
        }

        return self::$instance;
    }

    public function get_main_page()
    {
        $data = $this->model->get_main_data();
        $this->view->render_main_data($data);
    }

    public function get_categories_page()
    {
        $data = $this->model->get_kategories();
        $this->view->render_categories($data);
    }

    public function get_rating_page_data($quantity)
    {
        if ($quantity === null) {
            $quantity = 5;
        } else {
            $quantity = intval($quantity);
        }
        $data = $this->model->get_rating($quantity);
        $this->view->render_quotes_rating($data);

    }


    public function get_authors_page()
    {
        $data = $this->model->get_authors();
        $this->view->render_authors($data);
    }

    public function getAuthorDetails($id)
    {
        $data = $this->model->getAuthorData($id);
        $this->view->renderAuthorInfo($data);
    }

    public function getCategoryDetails($id)
    {
        $data = $this->model->getCategoryData($id);
        $this->view->renderCategoryInfo($data);
    }

    public function incrementRating($id)
    {
        if (!is_numeric($id)) {
            $response = array(
                'status' => 'error',
                'message' => 'Ожидался целочисленный идентификатор',
            );

            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode($response);
            return;
        }
        $this->model->updateRating($id);
    }
}
?>