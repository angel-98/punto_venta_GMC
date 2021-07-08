<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?>
<!-- Vista Lote -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar lote</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">lote</li>
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
                            <i class="fa fa-list mr-1"></i>Lista de lotes
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button type="button" id="print" class="btn btn-default border-primary btn-sm mr-2">
									<i class="fas fa-print fa-xs"></i> Imprimir
                                </button> 
                            </div>
                        </div>
                    </div>
                    <div id="tabla_lotes" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Concentración</th> 
                                <th>Adicional</th>
                                <th>Stock</th>
                                <th>Vencimiento</th>
                                <th>Laboratorio</th>
                                <th>Categoria</th>
                                <th>Presentación</th>
                                <th>Proveedor</th>
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
<!-- Vista Lote -->
<!-- Modal Lote -->               
<div class="modal fade" id="loteEdit">
    <div class="modal-dialog modal-default">
         <form action="<?= base_url(); ?>/Ajax/loteAjax.php?op=update" name="form" id="form" method="post" autocomplete="off">
             <div class="modal-content">
                <div class="modal-header">
                    <h6 id="lote_title" class="modal-title"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="" class="label-control">Nuevo stock<small> (*)</small></label>
                                <input type="number" class="form-control" name="stock" id="stock">
                                <input type="text" class="form-control" name="lote_id" id="lote_id">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-default border-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
        <div id="msjLote"></div>
    </div>
</div>
<!-- /.Modal Lote -->
<script src="<?= media(); ?>/funciones/lote.js"></script>