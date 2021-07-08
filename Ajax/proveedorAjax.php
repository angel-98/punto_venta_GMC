<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/proveedorControllers.php";
    $insProvee = new proveedorControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['proved_id'])) {
                echo $insProvee->add_provee_controller(); 
            }else{
                echo $insProvee->update_provee_controller(); 
            }
        break; 
        case 'list':
            echo $insProvee->list_provee_controller();     
        break;
        case 'delete':
            echo $insProvee->delete_provee_controller();     
        break;
        case 'show':
            echo $insProvee->show_provee_controller();     
        break;
    }