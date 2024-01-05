<?php class View
{
  private $BASE_URL;

  public function __construct()
  {
    include 'config.php';
    $this->BASE_URL = $BASE_URL;
  }
  public function render_main_data($data)
  {
    foreach ($data as $value) {
      echo ' <div class="quotes-block__quote">
            <div class="quote__img" style="background-image: url(' . $value['category_image'] . ');' . '">
            </div>
            <div class="quote__text">
              <p>
                "' . $value['category_quote'] . '"
              </p>
              <br />
              <p class="quete__text_author">' . $value['category_name'] . '</p>
            </div>
          </div>';
    }
  }

  public function render_categories($data)
  {
    foreach ($data as $category) {
      echo ' <div class="cadegories__item">
            <h3 class="cadegories__item-title">' . $category['category'] . '</h3>
            <div class="cadegories__item-links">';
      foreach ($category['items'] as $cadegoriesItem) {
        echo '<div class="categories-links__link">
                <a href="' . $this->BASE_URL . '/category/' . $cadegoriesItem['id'] . '" title="' . $cadegoriesItem['name'] . '">' . $cadegoriesItem['name'] . '</a>
              </div>';
      }

      echo '
              </div>
          </div>';
    }
  }

  public function render_quotes_rating($data)
  {
    foreach ($data as $quote) {
      echo ' <li class="quetes-list__quete">
          <div class="quetes-list__item-wrapper">
            <p>"' . $quote['quote'] . '" - ' . $quote['author'] . '</p> 
            <div class="rating-btn-wrapper">
              <button class="ratting-btn" id="btn-' . $quote['id'] . '"> <img src="' . $this->BASE_URL . '/assets/images/' . 'favorite.svg" alt="fivorite"> </button>
            </div>
            </div>
          </li>';
    }
  }

  public function render_authors($data)
  {
    foreach ($data as $author) {
      echo '<div class="author-block">
            <div class="author-block__img">
              <img src="' . $author['image'] . '" alt="uthor"/>
            </div>
            <div class="author-block__text">
              <h2 class="text__title"><a href="' . $this->BASE_URL . '/author/' . $author['id'] . '" title="' . $author['name'] . '">' . $author['name'] . '</a>' . '</h2>
              <p class="text__description">
               ' . $author['description'] . '
              </p>
            </div>
          </div>';
    }
  }

  public function renderAuthorInfo($author)
  {
    if (!empty($author)) {
      if ($author[0]['quote']) {
        echo '<section class="authors-container">
    <div class="author-block">
      <div class="author-block__img">
        <img src="' . $author[0]['image'] . '" alt="author"/>
      </div>
      <div class="author-block__text">
        <h2 class="text__title">' . $author[0]['name'] . '</h2>
        <p class="text__description">' . $author[0]['description'] . '</p>
      </div>
    </div>
  </section>';

        echo '<article class="quetes-rating">
    <ol class="quetes-rating__list" start="1">';

        foreach ($author as $quote) {
          echo '<li class="quetes-list__quote">
      "' . $quote['quote'] . '"
    </li>';
        }

        echo '</ol>
</article>';
      } else {
        echo '<section class="authors-container">
      <div class="author-block">
        <div class="author-block__img">
          <img src="' . $author['image'] . '"  alt="author"/>
        </div>
        <div class="author-block__text">
          <h2 class="text__title">' . $author['name'] . '</h2>
          <p class="text__description">' . $author['description'] . '</p>
        </div>
      </div>
    </section>';

        echo '<article class="quetes-rating">
      <p>Цитаты этого автора еще не добавленны</p>';

        echo '
  </article>';
      }
    } else {
      echo '<article class="quetes-rating">
      <h2 class="header-block__title">Не удалось найти автора</h2>
      </article>';

    }

    echo '</ol>
</article>';
  }


  public function renderCategoryInfo($category)
  {
    if (!empty($category)) {
      if ($category[0]['quote']) {
        echo '<section class="authors-container">
    <div class="author-block">
      <div class="author-block__img">
        <img src="' . $category[0]['image'] . '" alt="category" />
      </div>
      <div class="author-block__text">
        <h2 class="text__title">' . $category[0]['name'] . '</h2>
        <p class="text__description">' . $category[0]['description'] . '</p>
      </div>
    </div>
  </section>';

        echo '<div class="quetes-rating">
    <ol class="quetes-rating__list" start="1">';

        foreach ($category as $quote) {
          echo '<li class="quetes-list__quote">
      "' . $quote['quote'] . '"
    </li>';
        }

        echo '</ol>
</div>';
      } else {
        echo '<section class="authors-container">
      <div class="author-block">
        <div class="author-block__img">
          <img src="' . $category['image'] . '" alt="category">
        </div>
        <div class="author-block__text">
          <h2 class="text__title">' . $category['name'] . '</h2>
          <p class="text__description">' . $category['description'] . '</p>
        </div>
      </div>
    </section>';

        echo '<div class="quetes-rating">
      <p>Цитаты для этой категории еще не добавленны</p>';

        echo '
  </div>';
      }
    } else {
      echo '<div class="quetes-rating">
      <h2 class="header-block__title">Не удалось найти категорию</h2>
      </div>';

    }
  }

} ?>