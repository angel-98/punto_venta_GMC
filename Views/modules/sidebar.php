  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>/dashboard/" class="brand-link">
      <img src="<?= $_SESSION['logotype_str'] ?>" alt="<?= $_SESSION['company_str'] ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light logotype-title"><?= limitar_cadena($_SESSION['company_str'],16,".") ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
          if ($_SESSION['type_str']=="Administrador"): 
        ?>
          <!-- Inicio--->
          <li class="nav-item">
            <a href="<?= base_url(); ?>/dashboard/" class="nav-link <?php if($current[0]=="dashboard") echo"active"; ?>">
              <i class="nav-icon fa fa-tachometer-alt"></i><p> Inicio</p>
            </a>
          </li>
          <!-- Mantenimiento compras--->
          <li class="nav-item has-treeview <?php if($current[0]=="manage_purchases" || $current[0]=="manage_provider" || $current[0]=="consult_purchases") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="manage_purchases" || $current[0]=="manage_provider" || $current[0]=="consult_purchases") echo"active"; ?>">
              <i class="nav-icon fa fa-truck"></i>
              <p>
                Ingresos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_purchases/" class="nav-link  <?php if($current[0]=="manage_purchases") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_provider/" class="nav-link  <?php if($current[0]=="manage_provider") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/consult_purchases/" class="nav-link <?php if($current[0]=="consult_purchases") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Consultar ingresos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Mantenimiento ventas--->
          <li class="nav-item has-treeview <?php if($current[0]=="register_sale" || $current[0]=="sales_list" || $current[0]=="manage_clients" || $current[0]=="consult_sales") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="register_sale" || $current[0]=="sales_list" || $current[0]=="manage_clients" || $current[0]=="consult_sales") echo"active"; ?>">
              <i class="nav-icon fa fa-shopping-cart"></i><p>Salidas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/register_sale/" class="nav-link <?php if($current[0]=="register_sale") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p>Punto de  venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/sales_list/" class="nav-link <?php if($current[0]=="sales_list") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Salidas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_clients/" class="nav-link <?php if($current[0]=="manage_clients") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/consult_sales/" class="nav-link <?php if($current[0]=="consult_sales") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Consultar salidas</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Mantenimiento Almacen--->
          <li class="nav-item has-treeview <?php if($current[0]=="manage_product" || $current[0]=="manage_category" || $current[0]=="manage_lote") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="manage_product" || $current[0]=="manage_category" || $current[0]=="manage_lote") echo"active"; ?>">
              <i class="nav-icon fa fa-capsules"></i><p>Almacen
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_product/" class="nav-link <?php if($current[0]=="manage_product") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p>Productos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_lote/" class="nav-link <?php if($current[0]=="manage_lote") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Lotes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_category/" class="nav-link <?php if($current[0]=="manage_category") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Tipo</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Mantenimiento Atributos--->
          <li class="nav-item has-treeview <?php if($current[0]=="manage_presentation" || $current[0]=="manage_laboratory") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="manage_presentation" || $current[0]=="manage_laboratory") echo"active"; ?>">
              <i class="nav-icon fa fa-flask"></i><p>Atributos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_presentation/" class="nav-link <?php if($current[0]=="manage_presentation") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p>Presentación</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_laboratory/" class="nav-link <?php if($current[0]=="manage_laboratory") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Laboratorios</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Mantenimiento Usuarios--->
          <li class="nav-item">
            <a href="<?= base_url(); ?>/manage_user/" class="nav-link <?php if($current[0]=="manage_user") echo"active"; ?>">
              <i class="nav-icon fa fa-users"></i><p> Usuarios</p>
            </a>
          </li>
          <!-- Reportes--->
          <li class="nav-item has-treeview <?php if($current[0]=="sales_reports" || $current[0]=="purchases_reports") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="sales_reports" || $current[0]=="purchases_reports" ) echo"active"; ?>">
              <i class="nav-icon fa fa-chart-line"></i><p>Graficos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/sales_reports/" class="nav-link <?php if($current[0]=="sales_reports") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p> Grafico de ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/purchases_reports/" class="nav-link <?php if($current[0]=="purchases_reports") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p> Grafico de compras</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Configuración--->
          <li class="nav-item has-treeview <?php if($current[0]=="manage_company" || $current[0]=="manage_voucher" || $current[0]=="manage_payments") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="manage_company" || $current[0]=="manage_voucher" || $current[0]=="manage_payments") echo"active"; ?>">
              <i class="nav-icon fa fa-cogs"></i><p>Configuraciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_company/" class="nav-link <?php if($current[0]=="manage_company") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p>Datos generales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/manage_voucher/" class="nav-link <?php if($current[0]=="manage_voucher") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Comprobantes</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
          else:
          ?>
          <!-- Inicio--->
          <li class="nav-item">
            <a href="<?= base_url(); ?>/dashboard/" class="nav-link <?php if($current[0]=="dashboard") echo"active"; ?>">
              <i class="nav-icon fa fa-tachometer-alt"></i><p> Inicio</p>
            </a>
          </li>
          <!-- Mantenimiento ventas--->
          <li class="nav-item has-treeview <?php if($current[0]=="register_sale" || $current[0]=="sales_list") echo"menu-open"; ?>">
            <a href="#" class="nav-link <?php if($current[0]=="register_sale" || $current[0]=="sales_list") echo"active"; ?>">
              <i class="nav-icon fa fa-shopping-cart"></i><p>Ventas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>/register_sale/" class="nav-link <?php if($current[0]=="register_sale") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i> <p>Nueva venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>/sales_list/" class="nav-link <?php if($current[0]=="sales_list") echo"active"; ?>">
                  <i class="far fa-circle nav-icon"></i><p>Ventas</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Mantenimiento Clientes--->
          <li class="nav-item">
            <a href="<?= base_url(); ?>/manage_clients/" class="nav-link <?php if($current[0]=="manage_clients") echo"active"; ?>">
              <i class="nav-icon fa fa-users"></i><p> Clientes</p>
            </a>
          </li>
          <!-- Mantenimiento Clientes--->
          <li class="nav-item">
            <a href="<?= base_url(); ?>/product_catalog/" class="nav-link <?php if($current[0]=="product_catalog") echo"active"; ?>">
              <i class="nav-icon fa fa-capsules"></i><p> Catalogo</p>
            </a>
          </li>
          <?php
          endif;
          ?>
        </ul>
      </nav>
    </div>
  </aside>
 