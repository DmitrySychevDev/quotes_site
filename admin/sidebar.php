<?php
  include ('../config.php')
?>
<aside class="d-flex flex-column flex-shrink-0 p-3 sidebar" style="width: 280px">
  <a href="<?php echo $BASE_URL.'/'?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <span class="fs-4 sidebar-header">Quotient</span>
  </a>
  <hr />
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="<?php echo $BASE_URL.'/admin'?>" class="nav-link sidebar-link <?php echo $page === 'quotes' ? ' active' : ''; ?>" aria-current="page"> Цитаты </a>
    </li>
    <li>
      <a href="<?php echo $BASE_URL.'/admin/categories/'?>" class="nav-link sidebar-link  <?php echo $page === 'categories' ? ' active' : ''; ?>"> Категории </a>
    </li>
    <li>
      <a href="<?php echo $BASE_URL.'/admin/authors/'?>/" class="nav-link sidebar-link <?php echo $page === 'authors' ? ' active' : ''; ?>"> Авторы </a>
    </li>
  </ul>
  <hr />
</aside>
