<!-- Vista Reportes -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Reportes de ventas</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">Reportes</li>
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card ">
            <div class="card-header " style="cursor: move;">
                <h3 class="card-title text-secundary">
                    <i class="fas fa-chart-bar mr-1"></i>Gráfico de ventas
                </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <select class="form-control" onChange="mostrarResultados(this.value);">
                            <?php
                                $ano = date("Y");
                                for($i=2000;$i<$ano+1;$i++){
                                    if($i == $ano){
                                        echo '<option value="'.$i.'" selected>Año '.$i.'</option>';
                                    }else{
                                        echo '<option value="'.$i.'">Año '.$i.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
              <div class="result"><canvas id="sales"></canvas></div>
            </div>
        </div>
      </div>
    </div>
    <!-- Vendedores -->
    <div class="row">
      <div class="col-lg-6">
            <div class="card">
               <div class="card-header">
                   <h3 class="card-title"><i class="fa fa-dollar-sign mr-1"></i>VENTAS MENSUALES POR VENDEDOR</h3>
               </div>
               <div class="card-body p-0">
                  <canvas id="employee" class="report-chart" height="40"></canvas>
               </div>
           </div>
      </div>
      <div class="col-lg-6">
            <?php 
              setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
              $year=strftime("%Y");
            ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fa fa-chart-pie mr-1"></i>Resumen del año, <?= $year?></h3>
          </div>
          <div class="card-body p-0">
            <div id="year_summary"></div>

          </div>
        </div>
      </div>
    </div>
    <!-- Resumen del año -->
    <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-users mr-1"></i>Ventas diarias por vendedor
                </h3>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover m-0">
                    <thead>
                      <tr>
                        <th>PERFIL</th>
                        <th>VENDEDOR</th>
                        <th>IDENTIFICACIÓN</th>
                        <th>CARGO</th>
                        <th>CANTIDAD</th>
                        <th>MONTO</th>
                      </tr>
                    </thead>
                    <tbody id="sales_seller">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
</section> 
<!-- /.Vista Reportes -->
<script src="<?= media(); ?>/funciones/reporte_ventas.js"></script>