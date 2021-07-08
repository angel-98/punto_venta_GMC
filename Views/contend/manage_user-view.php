<?php
    if ($_SESSION['type_str']!=="Administrador") {
        echo $lc->force_logoff_controller();
    }
?>
<!-- Vista Usuario -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Gestionar usuario</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">usuario</li>
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
                            <i class="fa fa-list mr-1"></i>Lista de usuarios
                        </h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" >
                                <button type="button" class="btn btn-default border-green btn-sm" onclick="showform(true)" id="btnShows"><i class="fas fa-plus fa-xs"></i> Nuevo usuario</button>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_usuario" class="card-body p-10">
                        <table id="tablaRespuesta" class="table table-bordered table-hover m-0">
                            <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Nacimiento</th>
                                <th>Profesión</th>
                                <th>Cargo</th>
                                <th>Celular</th>
                                <th>Genero</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div id="formulario_usuario" class="card-body p-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?= base_url(); ?>/Ajax/usuarioAjax.php?op=saveandedit" name="form" id="form" method="post" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Nombre<small> (*)</small></label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del usuario">
                                                <input type="text" class="form-control" name="usuario_id" id="usuario_id">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Apellido<small> (*)</small></label>
                                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido del usuario">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Identificación<small> (*)</small></label>
                                                <input type="text" class="form-control" name="dni" id="dni" placeholder="Identificación" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Nacimiento<small> (*)</small></label>
                                                <input type="text" class="form-control" name="fnacimiento" id="fnacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="label-control">Celular<small> (*)</small></label>
                                                <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="label-control">Profesión<small> (*)</small></label>
                                                <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesión">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Genero<small> (*)</small></label>
                                                <select name="genero" id="genero" class="form-control">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="label-control">Cargo<small> (*)</small></label>
                                                <select name="cargo" id="cargo" class="form-control">
                                                    <option value="Administrador">Administrador</option>
                                                    <option value="Técnico">Técnico</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="label-control">Usuario<small> (*)</small></label>
                                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 hide_pass">
                                            <div class="form-group">
                                                <label for="" class="label-control">Contraseña<small> (*)</small></label>
                                                <input type="password" class="form-control" name="clave" id="clave"
                                                placeholder="Contraseña">
                                                <input type="text" class="form-control" name="imagen" id="imagen">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 ">
                                            <div class="form-group">
                                                <label for="" class="label-control">Descripción<small> (*)</small></label>
                                                <textarea class="form-control" rows="3" placeholder="Descripción ..." name="descripcion" id="descripcion"style="margin-top: 0px; margin-bottom: 0px; height: 69px;"></textarea>
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
<!-- /.Vista Usuario -->
<script src="<?= media(); ?>/funciones/usuario.js"></script>