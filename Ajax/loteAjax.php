<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/loteControllers.php";
    $insLote = new loteControllers(); 
    switch ($_GET["op"]){
        case 'save':
            echo $insLote->add_lote_controller(); 
        break;
        case 'update':
            echo $insLote->update_prod_controller();     
        break;
        case 'list':
            echo $insLote->list_lote_controller();     
        break;
        case 'lote':
            echo $insLote->riesgo_lote_controller();     
        break;
        case 'delete':
            echo $insLote->delete_lote_controller();     
        break;
        case 'show':
            echo $insLote->show_lote_controller();     
        break;
    } 