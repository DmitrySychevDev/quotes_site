<?php

require_once __DIR__ . '/router.php';


get('/admin', './index.php');
get('/admin/categories', 'categories/index.php');
get('/admin/authors', '/authors/index.php');
post('/admin/author/delete', '/authors/delete.php');
post('/admin/quote/delete', '/delete.php');
post('/admin/categories/delete', '/categories/delete.php');
get('/admin/quotes/$id', '/editQuotes.php');
post('/admin/quotes/add', '/addQuote.php');
get('/admin/categories/$id', '/categories/editCategory.php');
post('/admin/categories/add', '/categories/addCategory.php');
get('/admin/authors/$id', '/authors/editAuthor.php');
post('/admin/authors/add', '/authors/addAuthor.php');
post('/admin/quotes/edit', './editQuoteRequest.php');
post('/admin/categories/edit', './categories/editCategoryRequest.php');
post('/admin/authors/edit', './authors/editAuthorRequest.php');

any('/404', './views/404.php');
