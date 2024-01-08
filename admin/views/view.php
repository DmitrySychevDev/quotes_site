<?php class AdminView
{

    private $BASE_URL;

    public function __construct()
    {
        include 'config.php';
        $this->BASE_URL = $BASE_URL;
    }

    public function render_quotes_info($data)
    {
        foreach ($data as $quote) {
            echo ' <li class="quetes-list__quete" data-quote-id="' . $quote['id'] . '">
          <div class="quetes-list__item-wrapper ">
            <p class="quote__text">
            ' . $quote['quote'] . '
            </p>
            <div class="rating-btn-wrapper">
              <button class="ratting-btn" id="btn-' . $quote['id'] . '" data-quote-id="' . $quote['id'] . '">
                <img src="' . $this->BASE_URL . '/admin/assets/icons/cross.svg" alt="trash" />
              </button>
            </div>
          </div>
        </li>';
        }
    }

    public function render_categories_data($data)
    {
        foreach ($data as $category) {
            echo '  <ol class="quetes-rating__list" start="1">
            <h3>' . $category['category'] . '</h3>';
            foreach ($category['items'] as $categoriesItem) {
                echo '<li class="quetes-list__quete" data-category-id="' . $categoriesItem['id'] . '">
                <div class="quetes-list__item-wrapper">
                  <p>' . $categoriesItem['name'] . '</p>
                  <div class="rating-btn-wrapper">
                    <button class="ratting-btn" id="btn-' . $categoriesItem['id'] . '" data-category-id="' . $categoriesItem['id'] . '">
                      <img src="' . $this->BASE_URL . '/admin/assets/icons/cross.svg" alt="trash" />
                    </button>
                  </div>
                </div>
              </li>';
            }

            echo '</ol>';
        }
    }

    public function render_authors_options($data){
        foreach ($data as $author) {
            echo '<option value="'.$author['id'].'">'.$author['name'].'</option>';
        }

    }

    public function render_categories_options($data){
        foreach ($data as $category) {
            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
        }

    }

    public function render_categories_unit_options($data){
        foreach ($data as $category) {
            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
        }

    }

    public function render_authors_data($data)
    {
        foreach ($data as $author) {
            echo '
            <li class="quetes-list__quete author-block" data-author-id="' . $author['id'] . '">
            <div class="quetes-list__item-wrapper author-container">
              <p class="author__name">' . $author['name'] . '</p>
              <div class="rating-btn-wrapper">
                <button class="ratting-btn" id="btn-' . $author['id'] . '" data-author-id="' . $author['id'] . '">
                  <img src="' . $this->BASE_URL . '/admin/assets/icons/cross.svg" alt="trash" />
                </button>
              </div>
            </div>
          </li>';
        }
    }
}
?>