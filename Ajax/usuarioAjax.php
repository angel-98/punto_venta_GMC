<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/usuarioControllers.php";
    $insUsuario = new usuarioControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['usuario_id'])) {
                echo $insUsuario->add_user_controller(); 
            }else{
                echo $insUsuario->update_user_controller(); 
            }
        break; 
        case 'perfil':
            echo $insUsuario->update_perfil_controller();     
        break;
        case 'password':
            echo $insUsuario->update_password_controller();     
        break;
        case 'imagen':
            echo $insUsuario->update_imagen_controller();     
        break;
        case 'list':
            echo $insUsuario->list_user_controller();     
        break;
        case 'activate':
            echo $insUsuario->activate_user_controller();     
        break;
        case 'deactivate':
            echo $insUsuario->deactivate_user_controller();     
        break;
        case 'delete':
            echo $insUsuario->delete_user_controller();     
        break;
        case 'show':
            echo $insUsuario->show_user_controller();     
        break;
    }