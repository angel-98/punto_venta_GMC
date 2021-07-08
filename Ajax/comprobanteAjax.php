<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/comprobanteControllers.php";
    $insComprobante = new comprobanteControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['comprobante_id'])) {
                echo $insComprobante->add_voucher_controller(); 
            }else{
                echo $insComprobante->update_voucher_controller(); 
            }
        break;
        case 'list':
            echo $insComprobante->list_voucher_controller();     
        break;
        case 'activate':
            echo $insComprobante->activate_voucher_controller();     
        break;
        case 'deactivate':
            echo $insComprobante->deactivate_voucher_controller();     
        break;
        case 'delete':
            echo $insComprobante->delete_voucher_controller();     
        break;
        case 'show':
            echo $insComprobante->show_voucher_controller();     
        break;
    }  