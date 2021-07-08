<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/reporteVentasControllers.php";
    $insReporte = new reporteVentasControllers(); 
    switch ($_GET["op"]){
        case 'count':
            echo $insReporte->count_items_controller(); 
        break;
        case 'statistics':
            echo $insReporte->sales_statistics_controller();     
        break;
        case 'seller':
            echo $insReporte->seller_controller();     
        break; 
        case 'saleSeller':
            echo $insReporte->sale_seller_controller();     
        break; 
        case 'ra':
            echo $insReporte->year_summary_controller();     
        break; 
    } 