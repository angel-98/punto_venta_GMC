<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/reporteComprasControllers.php";
    $insReporte = new reporteComprasControllers(); 
    switch ($_GET["op"]){
        case 'count':
            echo $insReporte->count_items_controller(); 
        break;
        case 'statistics':
            echo $insReporte->purchases_statistics_controller();     
        break;
        case 'ra':
            echo $insReporte->year_summary_controller();     
        break; 
    } 