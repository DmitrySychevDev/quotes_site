<?php

require_once __DIR__ . '/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'index.php');
get('/authors', 'authors/index.php');
get('/categories', 'categories/index.php');
get('/rating/quantity/$q', 'rating/index.php');
get('/author/$id', 'author/index.php');
put('/addRating','addRating/index.php' );
get('/category/$id','category/index.php');

// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', 'views/404.php');
