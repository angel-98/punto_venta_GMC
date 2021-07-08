<!-- Vista Ventas -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar salidas</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">Ventas por fechas</li>
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
                            <i class="fa fa-list mr-1"></i>Ventas por fechas
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <button type="button" id="print" class="btn btn-default border-primary btn-sm">
									<i class="fas fa-print fa-xs"></i> Imprimir
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_ventas" class="card-body p-10">
                            <div class="row">
								 <div class="col-sm-6 col-md-8">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <input type="date" style="font-size:13px;" id="txtF1" name="txtF1" class="form-control input-sm" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            <div class="input-group-append">
                                                                <span class="btn btn-default" type="button" >
                                                                    <i class="fas fa-calendar-alt fa-xs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <input type="date" style="font-size:13px;" id="txtF2" name="txtF2" class="form-control input-sm" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                            <div class="input-group-append">
                                                                <span class="btn btn-default" type="button">
                                                                    <i class="fas fa-calendar-alt fa-xs"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="col-sm-4">
													<button style="margin-top: 0px;line-height: 1.9 !important;" id="btnConsultar"
													type="button" class="btn border-info btn-sm" onclick="clt();">
													<i class="fa fa-search"></i> Consultar</button>
												</div>
											</div>
										</div>
							   	  </div>
							</div>
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Comprobante</th>
                                <th>Transacciòn</th>
                                <th>Impuesto</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div id="ajaxAnswer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- /.Vista Ventas -->
<!--Modal Detalle de Venta  -->               
<div class="modal fade" id="detalle_venta" tabindex="-1" role="dialog" aria-labelledby="detalle_ventaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h6 class="modal-title">Vista de la venta</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="form-group">
                            <label for="" class="label-control">Cliente<small> (*)</small></label>
                            <input class="form-control" type="hidden" name="idventam" id="idventam">
                            <input class="form-control" type="text" name="cliente" id="cliente" maxlength="7" readonly="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="" class="label-control">Fecha<small> (*)</small></label>         
                            <div class="input-group">
                                <input type="text" class="form-control" name="fecha_horam" id="fecha_horam" readonly="">
                                <div class="input-group-append">
                                    <span class="btn bg-info-400">
                                            <i class="fas fa-calendar fa-xs"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="" class="label-control">Comprobante<small> (*)</small></label>
                            <input class="form-control" type="text" name="tipo_comprobantem" id="tipo_comprobantem" maxlength="7" readonly="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label for="" class="label-control">Serie<small> (*)</small></label>
                            <input class="form-control" type="text" name="serie_comprobantem" id="serie_comprobantem" maxlength="7" readonly="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <div class="form-group">
                            <label for="" class="label-control">Número<small> (*)</small></label>
                            <input class="form-control" type="text" name="num_comprobantem" id="num_comprobantem" maxlength="10" readonly="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group">
                            <label for="" class="label-control">Impuesto<small> (%)</small></label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="impuestom" id="impuestom" readonly="">
                                <div class="input-group-append">
                                    <span class="btn bg-info-400">
                                        <i class="fa fa-percentage fa-xs"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="detallesm"  class="table table-hover table-bordered" style="width:100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Modal Detalle de Venta-->            
<script src="<?= media(); ?>/funciones/consulta_ventas.js"></script>