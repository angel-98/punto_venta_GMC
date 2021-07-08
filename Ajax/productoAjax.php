<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/productoControllers.php";
    $insProducto = new productoControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['prod_id'])) {
                echo $insProducto->add_prod_controller(); 
            }else{
                echo $insProducto->update_prod_controller(); 
            }
        break; 
        case 'addImagen':
            echo $insProducto->add_imagen_controller();      
        break;
        case 'list':
            echo $insProducto->list_prod_controller();      
        break;
        case 'cata':
            echo $insProducto->list_catalog_controller();      
        break;
        case 'delete':
            echo $insProducto->delete_prod_controller();     
        break;
        case 'show':
            echo $insProducto->show_prod_controller();     
        break;
        case 'selectP':
            echo $insProducto->select_provider_controller();     
        break;
        case 'selectL':
            echo $insProducto->select_laboratory_controller();     
        break;
        case 'selectC':
            echo $insProducto->select_category_controller();     
        break;
        case 'selectPre':
            echo $insProducto->select_presentation_controller();     
        break;
    }