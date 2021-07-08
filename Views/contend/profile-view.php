<!-- Vista Perfil -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h6 class="header-title">Mi perfil</h6>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item breadcrumb-title"><a href="<?= base_url() ?>/dashboard/">Inicio</a></li>
          <li class="breadcrumb-item active breadcrumb-title">perfil</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php
                    if ($_SESSION['image_str'] != "") {
                      echo ' <img src="' . $_SESSION['image_str'] . '" class="profile-user-img img-fluid img-circle" alt="'.$_SESSION['name_str'] . " " . $_SESSION['lastname_str'].'"/>';
                    }else{
                    ?>
                    <img src="<?= media(); ?>/images/pordefecto/sin-image.png" class="profile-user-img img-fluid img-circle" alt="<?= $_SESSION['name_str'] . " " . $_SESSION['lastname_str'] ?>"/>
                    <?php } ?>
                </div>
                <h3 class="profile-username text-center"><?= $_SESSION['name_str'] . " " . $_SESSION['lastname_str'] ?></h3>
                <p class="text-muted text-center">    
                  <?php
                    if($_SESSION['profession_str']!=""){
                      echo  $_SESSION['profession_str']; 
                    }else{
                      echo  "Sin profesión";
                    }
                  ?>
                </p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Edad:</b> <a class="float-right"><?= calcularedad($_SESSION['birthdate_str']) ?> años</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nacimiento:</b> <a class="float-right"><?= date("d/m/Y", strtotime($_SESSION['birthdate_str'])) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Identificación:</b> <a class="float-right"><?= $_SESSION['dni_str'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Cargo:</b> <a class="float-right"><?= $_SESSION['type_str'] ?></a>
                  </li>
                </ul>
                <a href="#" data-toggle="modal" id="<?php echo encryption($_SESSION['id_user_str']); ?>" class="btn btn-sm btn-primary btn-block porfile"><i class="fa fa-pencil-alt mr-1"></i> <b>Actualizar perfil</b></a>
                <a href="#" data-toggle="modal" id="<?php echo encryption($_SESSION['id_user_str']); ?>" class="btn btn-sm btn-danger btn-block password"><i class="fa fa-lock mr-1"></i><b>Cambiar contraseña</b></a>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sobre mi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-mobile mr-1"></i>Celular</strong>
                <p class="text-muted">
                  (+51) <?= $_SESSION['mobile_str'] ?>
                </p>
                <hr>

                <strong><i class="fas fa-briefcase mr-1"></i>Profesión</strong>

                <p class="text-muted"><?= $_SESSION['profession_str'] ?></p>

                <hr>
                <?php
                  if($_SESSION['gender_str'] == "Masculino"){
                    echo '<strong><i class="fa fa-male mr-1"></i>Sexo</strong>';
                  }else{
                    echo '<strong><i class="fa fa-female mr-1"></i>Sexo</strong>';
                  }
                ?>
                <p class="text-muted"><?= $_SESSION['gender_str'] ?></p>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i>Descripción</strong>
                <p class="text-muted"><?= $_SESSION['description_str'] ?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
                <h3 class="card-title">
                  <i class="fa fa-stream mr-1"></i>Timeline
                </h3>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="timeline">
                    <div class="timeline timeline-inverse">
                      <?php 
                        require_once "./Controllers/bitacoraControllers.php";
                        $InsBinnacle= new bitacoraControllers();

                        echo $InsBinnacle->list_controller_log(8);
                      ?>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section> 
<!-- /.Vista Perfil -->
<!-- Modal Perfil  -->               
<div class="modal fade" id="Modalperfil" >
    <div class="modal-dialog modal-lg">
         <form action="<?= base_url(); ?>/Ajax/usuarioAjax.php?op=perfil" name="formPerfil" id="formPerfil" method="post" autocomplete="off">
             <div class="modal-content">
                <div class="modal-header">
                    <h6 id="titleP" class="modal-title">Actualizar Perfil</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="" class="label-control">Nombre<small> (*)</small></label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                                <input type="text" name="usuario_id" id="usuario_id">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8"> 
                            <div class="form-group">
                                <label for="" class="label-control">Apellido<small> (*)</small></label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
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
                                <label for="" class="label-control">Identificación<small> (*)</small></label>
                                <input name="dni" id="dni" type="text" class="form-control" placeholder="Identificación"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label for="" class="label-control">Celular<small> (*)</small></label>
                                <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular"  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label for="" class="label-control">Profesión<small> (*)</small></label>
                                <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesion">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="" class="label-control">Usuario<small> (*)</small></label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="" class="label-control">Descripción<small> (*)</small></label>
                                <textArea type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción"></textArea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
        <div id="msjPerfil"></div>
    </div>
</div>
<!-- /.Modal Perfil -->     
<!-- Modal Contraseña  -->               
<div class="modal fade" id="Modalpassword" >
    <div class="modal-dialog modal-default">
         <form action="<?= base_url(); ?>/Ajax/usuarioAjax.php?op=password" name="formPassword" id="formPassword" method="post" autocomplete="off">
             <div class="modal-content">
                <div class="modal-header">
                    <h6 id="titleP" class="modal-title">Actualizar Contraseña</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label class="label-control">Contraseña antigua<small> (*)</small></label>
                                <input type="password" class="form-control" name="passwordOld" id="passwordOld" placeholder="Contraseña antigua">
                                <input type="text" name="usuario_idi" id="usuario_idi">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label class="label-control">Contraseña nueva<small> (*)</small></label>
                                <input name="passwordNew" id="passwordNew" type="password" class="form-control" placeholder="Contraseña nueva" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
        <div id="msjPassword"></div>
    </div>
</div>
<!-- /.Modal Contraseña -->   
<script src="<?= media(); ?>/funciones/perfil.js"></script>
