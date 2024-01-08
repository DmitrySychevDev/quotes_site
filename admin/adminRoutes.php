<?php

require_once __DIR__ . '/router.php';


// ##################################################
// ##################################################
// ##################################################

get('/admin', './index.php');
get('/admin/categories','categories/index.php');
get('/admin/authors','/authors/index.php');
post('/admin/author/delete','/authors/delete.php');
post('/admin/quote/delete','/delete.php');
post('/admin/categories/delete','/categories/delete.php');
get('/admin/quotes/$id', '/editQuotes.php');
post('/admin/quotes/add','/addQuote.php');
get('/admin/categories/$id','/categories/editCategory.php');
post('/admin/categories/add','/categories/addCategory.php');
// Static GET
// In the URL -> http://localhost
// The output -> Index
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404', './views/404.php');
