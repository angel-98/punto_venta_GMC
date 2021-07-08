<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/clienteControllers.php";
    $insCliente = new clienteControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['cliente_id'])) {
                echo $insCliente->add_client_controller(); 
            }else{
                echo $insCliente->update_client_controller(); 
            }
        break; 
        case 'list':
            echo $insCliente->list_client_controller();     
        break;
        case 'delete':
            echo $insCliente->delete_client_controller();     
        break;
        case 'show':
            echo $insCliente->show_client_controller();     
        break;
    }