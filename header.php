<?php

include "config.php";
ini_set('display_errors', 0);

function renderLinks($pageParam, $BASE_URL)
{
  echo '<div class="navbar__links" id="menu">';
  echo '<div class="navbar_link' . ($pageParam === 'main' ? ' navbar__link_active' : '') . '">';
  echo '<a href="'.$BASE_URL.'/'.'" title="Главная страница">Главная</a>';
  echo '</div>';
  echo '<div class="navbar_link' . ($pageParam === 'kategories' || $pageParam === "kategory" ? ' navbar__link_active' : '') . '">';
  echo '<a  href="'.$BASE_URL.'/categories'.'" title="Страница категорий">Категории</a>';
  echo '</div>';
  echo '<div class="navbar_link' . ($pageParam === 'rating' ? ' navbar__link_active' : '') . '">';
  echo '<a href="'.$BASE_URL.'/rating/quantity/5'.'" title="Страница рейтинга">Рейтинг</a>';
  echo '</div>';
  echo '<div class="navbar_link' . ($pageParam === 'authors' || $pageParam === "author" ? ' navbar__link_active' : '') . '">';
  echo '<a href="'.$BASE_URL.'/authors'.'" title="Страница авторов">Авторы</a>';
  echo '</div>';
  echo '</div>';
}

$title = 'Invalid page';

switch ($page) {
  case 'main':
    $title = 'Цитаты на все случаи жизни';
    break;
  case 'kategories':
    $title = 'Категории цитат';
    break;
  case 'rating':
    $title = 'Рейтинг цитат';
    break;
  case 'authors':
    $title = 'Авторы';
    break;
  case 'author':
    $title = 'Авторы';
    break;
  case 'kategory':
    $title = "Категории";
    break;
  case 'error':
    $title = "Не удалось получить данные";
    break;
}

echo '<header>';
echo '<div class="header">';
echo '<div class="header__title">';
echo '<div class="header__logo">';
echo '<img src="' . $BASE_URL . '/assets/images/logo.png"' . ' alt="logo"/>';
echo ' </div>';
echo '<h1 class="header__title">Quotient</h1>';
echo '</div>';
echo '<nav class="navbar">';
echo '<button class="logo_image--burger">
<img
  class="logo_image--burger__open"
  src="' . $BASE_URL . '/assets/images/burger.svg"
  alt="burger"
/>
<img
  class="logo_image--burger__close"
  src="' . $BASE_URL . '/assets/images/close.png"' . '
  alt="close"
/>
</button>';
renderLinks($page,$BASE_URL);
echo '</nav>
     </div>';
echo '
        <div class="header-block">';
if ($page === "rating") {
  echo '  <div class="header-block__header-select-group">';
}
echo '<h1 class="header-block__title">' . $title . '</h1>';
if ($page === "rating") {
  echo '<select id="number-select">
        <option value="5">Первые 5</option>
        <option value="10">Первые 10</option>
        <option value="100">Первые 100</option>
      </select>
    </div>';
}

if ($page !== "kategories" && $page !== "main" && $page !== "author" && $page !== 'kategory' && $page !== 'error') {
  echo '<div class="header-block__search">
         <input type="text" placeholder="Поиск" class="search__input" id="search_input_' . $page . '" />
         <button class="search__button" id="search__button__' . $page . '">Поиск</button>
       </div>';
}
echo '</div>';

echo '<div class="search-deascription">
<p id="descritption-info_text">
</p>
<div id="descritption-info__clear">Очистить поиск</div>
';

echo '</div>
   </header>';
?>