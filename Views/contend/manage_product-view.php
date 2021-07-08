<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?>
<!-- Vista Producto -->
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
                            <i class="fa fa-list mr-1"></i>Lista de productos
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm">
                                <button type="button" id="print" class="btn btn-default border-primary btn-sm mr-2">
									<i class="fas fa-print fa-xs"></i> Imprimir
                                </button> 
                                <button type="button" class="btn btn-default border-green btn-sm" onclick="showform(true)" id="btnShows">
                                    <i class="fas fa-plus fa-xs"></i> Nuevo producto
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_productos" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Producto</th>
                                <th>Concentración</th>
                                <th>Adicional</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Laboratorio</th>
                                <th>Categoria</th>
                                <th>Presentación</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="formulario_productos" class="card-body p-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?= base_url(); ?>/Ajax/productoAjax.php?op=saveandedit" name="form" id="form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Producto<small> (*)</small></label>
                                                <input type="text" class="form-control" name="producto" id="producto" placeholder="Nombre del producto">
                                                <input type="text" class="form-control" name="prod_id" id="prod_id">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Codigo<small> (*)</small></label>
                                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Escanear codigo" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Concentración<small> (*)</small></label>
                                                <input type="text" class="form-control" name="concentracion" id="concentracion" placeholder="Concentración">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Adiconal<small> (*)</small></label>
                                                <input type="text" class="form-control" name="adicional" id="adicional" placeholder="Adicional">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label for="" class="label-control">Precio compra<small> (*)</small></label>
                                                <input type="number" class="form-control" name="precioC" id="precioC" step="any" min="0" value="0" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <label  class="label-control">Precio venta<small> (*)</small></label>
                                                <input type="number" class="form-control" name="precioV" id="precioV" step="any" min="0" value="0" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <div class="form-group text-right">
                                                <label>
                                                    <input type="checkbox" class="minimal porcentaje">Utilizar porcentajes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-group">
                                                <input type="number" name="porcentaje_prod" id="porcentaje_prod" class="form-control input-lg nuevoPorcentaje" min="0" value="40" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Laboratorio<small> (*)</small></label>
                                                <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4"> 
                                            <div class="form-group">
                                                <label for="" class="label-control">Categoria<small> (*)</small></label>
                                                <select name="categoria" id="categoria" class="form-control select2" style="width: 100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label class="label-control">Presentación<small> </small></label>
                                                <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%;">
                                                </select> 
                                            </div>
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
<!-- /.Vista Producto -->
<!-- Modal Imagen  -->               
<div class="modal fade" id="imagen">
    <div class="modal-dialog modal-sm">
        <form action="<?= base_url(); ?>/Ajax/productoAjax.php?op=addImagen" name="formImagen" id="formImagen" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 id="image_titulo" class="modal-title" ></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <img id="image_actual" src="" class="img-thumbnail" id="photoView" style="width: 100%;height:200px">
                                <label class="photoLabel" for="photo">
                                    <i class="far fa-image"></i>
                                        Cambiar Imagen 
                                </label>
                                <input type="file" id="photo" class="photo" name="photo">
                                <input type="text" id="id_logo_pro" name="id_logo_pro">
                                <input type="text" id="nombre_producto" name="nombre_producto">
                                <input type="text" id="avatar" name="avatar">
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
        <div id="msjImagen"></div>
    </div>
</div>
<!-- /.Modal Imagen -->
<!-- Modal Lote  -->               
<div class="modal fade" id="lote">
    <div class="modal-dialog modal-default">
         <form action="<?= base_url(); ?>/Ajax/loteAjax.php?op=save" name="formLote" id="formLote" method="post" autocomplete="off">
             <div class="modal-content">
                <div class="modal-header">
                    <h6 id="titleP" class="modal-title"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="" class="label-control">Proveedor<small> (*)</small></label>
                                <select name="proveedor" id="proveedor" class="form-control select2" style="width: 100%;">
                                 </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="" class="label-control">Stock<small> (*)</small></label>
                                <input type="number" class="form-control" name="stock" id="stock" value="1">
                                <input type="hidden" class="form-control" name="lote_id_product" id="lote_id_product">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="" class="label-control">Fecha de vencimiento<small> (*)</small></label>
                                <input type="date" class="form-control" name="fechaV" id="fechaV">
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
<script src="<?= media(); ?>/funciones/producto.js"></script>