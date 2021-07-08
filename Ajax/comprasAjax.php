<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/comprasControllers.php";
    $insPurchases = new comprasControllers(); 
    switch ($_GET["op"]){
        case 'add':
             echo $insPurchases->add_controller(); 
        break;
        case 'list':
            echo $insPurchases->list_controller();     
        break;
        case 'listProduct':
            echo $insPurchases->list_prod_controller();     
        break;
        case 'anular':
            echo $insPurchases->cancel_purchase_controller();     
        break;
        case 'show':
            echo $insPurchases->show_controller();     
        break;
        case 'showDetail':
            echo $insPurchases->show_detail_controller();     
        break;
        case 'selectPoveedor':
            echo $insPurchases->select_provider_controller();     
        break;
       
    }