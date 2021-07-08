<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/ventasControllers.php";
    $insSales = new ventasControllers(); 
    switch ($_GET["op"]){
        case 'add':
             echo $insSales->add_controller(); 
        break;
        case 'list':
            echo $insSales->list_controller();     
        break;
        case 'listProduct':
            echo $insSales->list_prod_controller();     
        break;
        case 'anular':
            echo $insSales->cancel_sale_controller();     
        break;
        case 'show': 
            echo $insSales->show_controller();     
        break;
        case 'showDetail':
            echo $insSales->show_detail_controller();     
        break;
        case 'selectCliente':
            echo $insSales->select_cliente_controller();     
        break;
        case 'selectComprobante':
            echo $insSales->select_comprobante_controller();     
        break;
        case 'selectPago':
            echo $insSales->select_pago_controller();     
        break;
        case 'barcode':
            echo $insSales->barcode_prod_controller();     
        break;

    }