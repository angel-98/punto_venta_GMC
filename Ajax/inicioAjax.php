<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/inicioControllers.php";
    $insInicio = new inicioControllers(); 
    switch ($_GET["op"]){
        case 'count':
            echo $insInicio->count_items_controller(); 
        break;
        case 'statistics':
            echo $insInicio->sales_statistics_controller();     
        break;
        case 'recently':
            echo $insInicio->recently_product_controller();     
        break; 
        case 'sales':
            echo $insInicio->selled_product_controller();     
        break; 
        case 'products':
            echo $insInicio->most_selled_products_controller();     
        break; 
    } 