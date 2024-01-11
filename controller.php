<?php
class Controller
{
    private $model;
    private $view;
    private $conn;

    private $adminView;
    private static $instance;

    private function __construct()
    {
        include 'config.php';
        include 'db.php';
        include 'model.php';
        include 'view.php';
        include __DIR__ .'/admin/views/view.php';
        ini_set('display_errors', 0);

        $db = new Database($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

        $this->conn = $db->connect();
        $this->model = new Model($this->conn);
        $this->view = new View();
        $this->adminView = new AdminView();  
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
        $data = $this->model->get_categories();
        $this->view->render_categories($data);
    }

    public function get_categories_page_for_admin()
    {
        $data = $this->model->get_categories();
        $this->adminView->render_categories_data($data);
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

    public function get_quotes_for_admin(){
        $data = $this->model->get_quotes();

        $this->adminView->render_quotes_info($data);
    }


    public function get_authors_page()
    {
        $data = $this->model->get_authors();
        $this->view->render_authors($data);
    }

    public function delete_author($id){
        ini_set('display_errors', 1);

        $isDeleted = $this->model->delete_author($id);
        if($isDeleted){
            http_response_code(400);
            echo json_encode(['message' => 'Автор не был удален']);
            return;
        }

        http_response_code(200);
        echo json_encode(['message' => 'Автор был успешно удален']);
    }

    public function delete_quote($id){
        $isDeleted = $this->model->delete_quote($id);
        if($isDeleted){
            http_response_code(400);
            echo json_encode(['message' => 'Цитата не была удалена']);
            return;
        }

        http_response_code(200);
        echo json_encode(['message' => 'Цитата была успешно удалена']);
    }

    public function delete_category($id){
        $isDeleted = $this->model->delete_category($id);
        if($isDeleted){
            http_response_code(400);
            echo json_encode(['message' => 'Категория не была удалена']);
            return;
        }

        http_response_code(200);
        echo json_encode(['message' => 'Категория была успешно удалена']);
    }

    public function get_authors_options($selectedId = null){
        $data = $this->model->get_authors();
        $this->adminView->render_authors_options($data,$selectedId);
    }

    public function get_categories_options($selectedId = null){
        $data = $this->model->get_category_items();
        $this->adminView->render_categories_options($data,$selectedId);
    }

    public function get_category_unit_options($selectedId = null){
        $data = $this->model->get_categories_unit();
        if(isset($selectedId)){
            $selectedId = $this->model->get_categories_unit_id_by_category_item($selectedId);
        }
        $this->adminView->render_categories_unit_options($data,$selectedId);
    }

    public function add_quote($category, $author, $text){
        $isAdded = $this->model->add_quote($category, $author, $text);

        if($isAdded){
            http_response_code(200);
            echo json_encode(['message' => 'Цитата была успешно добавленна']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Цитата не была добавленна']);
    }

    public function add_category($name, $description, $category, $image){
        $isAdded = $this->model->add_category($name, $description, $category, $image);
        if($isAdded){
            http_response_code(200);
            echo json_encode(['message' => 'Категория была успешно добавленна']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Категория не была добавленна']);
    }  

    public function add_author($name, $description, $image){
        $isAdded = $this->model->add_author($name, $description, $image);
        if($isAdded){
            http_response_code(200);
            echo json_encode(['message' => 'Автор был успешно добавлен']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Автор не был добавлен']);
    }  

    
    public function get_authors_page_for_admin(){
        $data = $this->model->get_authors();
        $this->adminView->render_authors_data($data);
    }

    public function get_quote_by_id($id){
        $data = $this->model->get_quote_by_id($id);
        return $data;
    } 

    public function get_author_by_id($id){
        $data = $this->model->get_author_by_id($id);
        return $data;
    }

    public function get_category_item_by_id($id){
        $data = $this->model->get_category_item_by_id($id);
        return $data;
    } 


    public function edit_quote($quoteId,$category, $author, $text){
        $isEdited = $this->model->update_quote($quoteId,$category, $author, $text);
        if($isEdited){
            http_response_code(200);
            echo json_encode(['message' => 'Цитата была изменена']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Цитата не была изменена']);
    }

    public function edit_category($id,$name, $description, $category, $image){
        $isEdited = $this->model->update_category($id,$name,$description,$category, $image);
        if($isEdited){
            http_response_code(200);
            echo json_encode(['message' => 'Категория была изменена']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Категория не была изменена']);
    }

    public function edit_author($id,$name, $description, $image){
        $isEdited = $this->model->update_author($id,$name, $description, $image);
        if($isEdited){
            http_response_code(200);
            echo json_encode(['message' => 'Автор был изменен']);
            return;
        }

        http_response_code(400);
        echo json_encode(['message' => 'Автор не был изменен']);
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