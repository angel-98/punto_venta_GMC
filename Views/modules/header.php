<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>/product_catalog/"><i class="fas fa-pills"></i>
          Catalogo
        </a>
      </li>
      <li class="nav-item" id="cat-carrito" style="display:none;">
        <a class="nav-link" data-toggle="modal" data-target="#cart" href="#"><i class="fas fa-shopping-basket"></i>
        <span id="cantidadc" class="badge badge-danger navbar-badge">0</span>
        </a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <?php
                if($_SESSION['image_str'] != ""){
                    echo ' <img src="'.$_SESSION['image_str'].'" width="25"/>';
                }else{
                    echo ' <img src="'.media().'/images/pordefecto/sin-image.png" width="25" />';
                }
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?= base_url() ?>/profile/" class="dropdown-item">
            <i class="fa fa-user-circle mr-4"></i> Mi cuenta
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url() ?>/about/" class="dropdown-item">
            <i class="fa fa-info-circle mr-4"></i> Acerca de
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo $lc->encryption($_SESSION['token_str']);?>" id="btn-exit-system" class="dropdown-item">
            <i class="fa fa-power-off mr-4"></i> Cerrar Sesión
          </a>
      </li>
    </ul>
</nav>
<!-- /.navbar -->