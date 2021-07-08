<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/empresaControllers.php";
    $insEmpresa = new empresaControllers(); 
    switch ($_GET["op"]){
        case 'update':
            echo $insEmpresa->update_empresa_controller(); 
        break;
        case 'addLogo':
            echo $insEmpresa->add_logo_controller(); 
        break;
        case 'list':
            echo $insEmpresa->list_empresa_controller();     
        break;
        case 'mostrar_serie':
            echo $insEmpresa->mostrar_serie_controller();     
        break;
        case 'mostrar_numero':
            echo $insEmpresa->mostrar_numero_controller();     
        break;
        case 'nombre_impuesto':
            echo $insEmpresa->nombre_impuesto_controller();     
        break;
        case 'mostrar_impuesto':
            echo $insEmpresa->mostrar_impuesto_controller();     
        break;
        case 'mostrar_simbolo':
            echo $insEmpresa->mostrar_simbolo_controller();     
        break;
        case 'show':
            echo $insEmpresa->show_empresa_controller();     
        break;
    }