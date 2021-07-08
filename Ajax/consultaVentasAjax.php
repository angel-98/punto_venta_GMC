<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/consultaVentasControllers.php";
    $insConsulta = new consultaVentasControllers(); 
    switch ($_GET["op"]){
        case 'list':
            echo $insConsulta->list_controller(); 
        break;
    } 