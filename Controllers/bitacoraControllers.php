<?php
if ($ajaxRequest) {
    require_once "../Core/mainModel.php";
}else{
    require_once "./Core/mainModel.php";
}

class bitacoraControllers extends mainModel{

    public function list_controller_log($records){

        $records=mainModel::clean_chain($records);

        $data=mainModel::run_simple_query("SELECT * FROM bitacora JOIN usuario on usuario_id = bitacora_id_usuario where bitacora_id_usuario='".$_SESSION['id_user_str']."' ORDER BY bitacora_id DESC LIMIT $records");

        while ($rows=$data->fetch()) { 
            $fullName = $rows['usuario_nombre'].' '.$rows['usuario_apellido'];
            echo '
            <div class="time-label" style="font-size: 13px;">
                <span class="bg-primary">'.obtenerFechaEnLetra($rows['bitacora_fecha']).'</span>
              </div>
            <div>
                <div class="timeline-perfil">
                    <img src="'.$rows['usuario_perfil'].'" alt="user-picture" >
                </div>
                <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> Fin : '.$rows['bitacora_horaFin'].'</span>
                    <span class="time"><i class="far fa-clock"></i> Inicio : '.$rows['bitacora_horaInicio'].'</span>
                    <h3 class="timeline-header"><a href="#" class="text-secundary">'.$fullName.'</a> <small>('.$rows['bitacora_tipoUsuario'].')</small></h3>
                </div>
            </div>';
        }

        
    }
}