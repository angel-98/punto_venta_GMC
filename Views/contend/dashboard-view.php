<!-- Vista Dashboard -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Inicio</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">Panel de control</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <!-- Cantidades -->
    <div class="row" id="count"></div>
    <!-- Estadistica -->
    <div class="row" id="statistics"></div>
    <!-- Lotes en riesgo -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-cubes mr-1"></i>Lotes en riesgo
            </h3>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover m-0">
                <thead>
                  <tr>
                      <th>Codigo</th>
                      <th>Producto</th>
                      <th>Stock</th>
                      <th>Laboratorio</th>
                      <th>Presentación</th>
                      <th>Proveedor</th>
                      <th>Mes</th>
                      <th>Dia</th>
                  </tr>
                </thead>
                <tbody id="lote">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Productos -->
    <div class="row">
      <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-pills mr-1"></i>Productos agregados recientemente</h3>
            </div>
            <div class="card-body p-0">
              <ul id="recently" class="products-list product-list-in-card pl-2 pr-2"></ul>
            </div>
          </div>
        </div>
      <div class="col-lg-6" id="products"></div>
    </div>
  </div>
</section> 
<!-- /.Vista Dashboard -->
<script src="<?= media(); ?>/funciones/inicio.js"></script>