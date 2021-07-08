<!-- Vista Catalogo -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar producto</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">producto</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-list mr-1"></i>Catalogo de productos
                        </h3>
                    </div>
                    <div class="card-body p-10">
                        <div class="container-fluid mb-4 p-0">
                            <div class="input-group">
                                <input class="form-control form-control-navbar" type="text" placeholder="Buscar producto.." id="buscar_producto">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button">
                                        <i class="fas fa-search fa-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="producto" class="row d-flex align-items-stretch"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- /.Vista Catalogo -->
<script src="<?= media(); ?>/funciones/catalogo.js"></script>