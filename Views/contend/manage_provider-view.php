<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?> 
<!-- Vista Proveedores -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar proveedor</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">Proveedor</li>
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
                            <i class="fa fa-list mr-1"></i>Lista de proveedors
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <button type="button" class="btn btn-default border-green btn-sm" onclick="showform(true)" id="btnShows"><i class="fas fa-plus fa-xs"></i> Nuevo proveedor</button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_proveedor" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Identificación</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="formulario_proveedor" class="card-body p-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?= base_url(); ?>/Ajax/proveedorAjax.php?op=saveandedit" name="form" id="form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="label-control">Nombre <small> (*)</small></label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del proveedor">
                                                <input type="text" class="form-control" name="proved_id" id="proved_id">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="label-control">Tipo de documento <small> (*)</small></label>
                                                <select name="tipo_documento" id="tipo_documento" class="form-control select2">
                                                    <option value="DNI">DNI</option>
                                                    <option value="RUC">RUC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="label-control">Num. Docum<small> (*)</small></label>
                                                <input type="text" class="form-control" name="num_documento" id="num_documento" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="15" placeholder="Documento">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="label-control">Dirección<small> (*)</small></label>
                                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label class="label-control">Celular <small> (*)</small></label>
                                                <input type="text" class="form-control" name="celular" id="celular" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9" placeholder="Celular">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 ">
                                            <div class="form-group">
                                                <label class="label-control">Correo <small> (*)</small></label>
                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
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
<!-- /.Vista Proveedores -->
<script src="<?= media(); ?>/funciones/proveedor.js"></script>