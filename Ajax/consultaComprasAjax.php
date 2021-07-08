<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/consultaComprasControllers.php";
    $insConsulta = new consultaComprasControllers(); 
    switch ($_GET["op"]){
        case 'list':
            echo $insConsulta->list_controller(); 
        break;
    } 