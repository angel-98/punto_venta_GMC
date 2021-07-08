<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?>
<!-- Vista Compras -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar compra</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">Compra</li>
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
                            <i class="fa fa-list mr-1"></i>Lista de compras
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <button type="button" id="print" class="btn btn-default border-primary btn-sm mr-2">
									<i class="fas fa-print fa-xs"></i> Imprimir
                                </button> 
                                <button type="button" class="btn btn-default border-green btn-sm" onclick="showform(true)" id="btnShows">
                                    <i class="fas fa-plus fa-xs"></i> Nueva compra
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_compras" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>Usuario</th>
                                <th>Comprobante</th>
                                <th>Transacciòn</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="formulario_compras" class="card-body p-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?= base_url(); ?>/Ajax/comprasAjax.php?op=add" name="form" id="form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-group">
                                                <label for="" class="label-control">Proveedor<small> (*)</small></label>
                                                <input type="hidden" name="compra_id" id="compra_id">
                                                <select name="proveedor" class="form-control select2" style="width: 100%;" id="proveedor"></select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <?php $current_date=date("Y-m-d"); ?>
                                            <div class="form-group">
                                                <label for="" class="label-control">Fecha<small> (*)</small></label>         
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="fecha" id="fecha" value="<?= $current_date ?>">
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
                                                <label for="" class="label-control">Tipo de comprobante<small> (*)</small></label>
                                                <select name="tipo_documento" class="form-control select2" id="tipo_documento">
                                                    <option value="Boleta">Boleta</option>
                                                    <option value="Factura">Factura</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="form-group">
                                                <label for="" class="label-control">Serie<small> (*)</small></label>
                                                <input type="text" class="form-control" name="num_serie" id="num_serie" placeholder="Número de serie">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-3">
                                            <div class="form-group">
                                                <label for="" class="label-control">Número<small> (*)</small></label>
                                                <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Número de boleta o factura" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label for="" class="label-control">Impuesto<small> (*)</small></label>
                                                <div class="input-group">
                                                    <input class="form-control form-control-navbar" type="number"  min="0"  placeholder="0" value="0" name="igv" id="igv" onchange="modifySubtotals()" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                                    <div class="input-group-append">
                                                        <button class="btn bg-info-400" type="button">
                                                            <i class="fa fa-percentage fa-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <button id="btnBuscar" type="button" class="btn btn-default border-info btn-icon-split btn-sm" data-toggle="modal" data-target="#lista_productos">
                                                    <span class="icon">
                                                        <i class="fa fa-search fa-xs"></i>
                                                    </span>
                                                    <span class="text">Buscar producto</span>
                                                </button> 
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="table-responsive">
                                                <table id="tableDetails"  class="table table-hover table-bordered" style="width:100%" cellspacing="0">
                                                    <thead class="bg-info-400">
                                                        <tr>
                                                            <th>ACCIÓN</th>
                                                            <th>DESCRIPCIÓN</th>
                                                            <th class="text-center">CANT.UND</th>
                                                            <th class="text-center">PRECIO UNI.</th>
                                                            <th class="text-center" >LOTE</th>
                                                            <th class="text-center" >IMPORTE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>   
                                        <div class="col-xs-12 col-sm-12 ">
                                            <ul class="nav nav-pills flex-column table-sale">
                                                <li class="nav-item" style="border-top:1px solid rgba(0,0,0,.125);">
                                                    <a class="nav-link">
                                                    <label>SUBTOTAL</label> 
                                                    <span id="total" class="badge bg-info-400 float-right">
                                                        0.00
                                                    </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link">
                                                    <label id="valor_impuesto">IGV  0%</label>
                                                    <span id="most_imp" class="badge bg-green-400 float-right">
                                                        0.00
                                                    </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item" style="border-bottom:1px solid rgba(0,0,0,.125);">
                                                    <a class="nav-link">
                                                    <label>TOTAL</label> 
                                                    <span id="most_total" class="badge bg-danger-400 float-right">
                                                        0.00
                                                    </span>
                                                    <input type="hidden" step="0.01" name="total_buy" id="total_buy">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>            
                                        <div class="col-xs-12 col-sm-12 mt-3">
                                            <button type="submit" id="btnRegistrar" class="btn btn-default border-primary btn-sm">Guardar cambios</button>
                                            <button type="button" id="btnCancel" class="btn btn-default border-danger btn-sm" onclick="hideform()" id="btnHide">Cancelar</button>
                                        </div>
                                    </div>         
                                </form>
                                <div id="ajaxAnswer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- /.Vista Compras -->
<!-- Modal Productos  -->             
<div class="modal fade" id="lista_productos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h6 class="modal-title">Lista de productos</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <table id="productos" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Laboratorio</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Presentación</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="content">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 
<!-- /.Modal Productos -->
<!-- Modal Detalle de compra  -->               
<div class="modal fade" id="detalle_compra" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h6 class="modal-title">Vista de la compra</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <div class="form-group">
                            <label for="" class="label-control">Proveedor<small> (*)</small></label>
                            <input class="form-control" type="hidden" name="idcompra" id="idcompra">
                            <input class="form-control" type="text" name="proveedorm" id="proveedorm" maxlength="7" readonly="">
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
<!-- /.Modal Detalle de compra -->             
<script src="<?= media(); ?>/funciones/compras.js"></script> 