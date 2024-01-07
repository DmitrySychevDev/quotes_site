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
          echo ' <li class="quetes-list__quete">
          <div class="quetes-list__item-wrapper">
            <p>
            ' . $quote['quote'] . '
            </p>
            <div class="rating-btn-wrapper">
              <button class="ratting-btn" id="btn-' . $quote['id'] . '">
                <img src="'.$this-> BASE_URL. '/admin/assets/icons/cross.svg" alt="trash" />
              </button>
            </div>
          </div>
        </li>';
        }
    }
}
?>