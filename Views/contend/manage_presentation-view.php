<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?>
<!-- Vista Prsentacion -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar presentación</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">presentación</li>
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
                            <i class="fa fa-list mr-1"></i>Lista de presentaciones
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <button type="button" class="btn btn-default border-green btn-sm" onclick="showform(true)" id="btnShows"><i class="fas fa-plus fa-xs"></i> Nueva presentación</button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_presentacion" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th style="width:8%;">Acción</th>
                                <th>Presentación</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="formulario_presentacion" class="card-body p-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?= base_url(); ?>/Ajax/presentacionAjax.php?op=saveandedit" name="form" id="form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="label-control">Presentación <small> (*)</small></label>
                                                <input type="text" class="form-control" name="presentacion" id="presentacion" placeholder="Nombre de la presentacion">
                                                <input type="text" class="form-control" name="present_id" id="present_id">
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
<!-- /.Vista Prsentacion -->
<script src="<?= media(); ?>/funciones/presentacion.js"></script>