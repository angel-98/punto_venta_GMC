<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/categoriaControllers.php";
    $insCate = new categoriaControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['tipo_id'])) {
                echo $insCate->add_cate_controller(); 
            }else{
                echo $insCate->update_cate_controller(); 
            }
        break;
        case 'list':
            echo $insCate->list_cate_controller();     
        break;
        case 'delete':
            echo $insCate->delete_cate_controller();     
        break;
        case 'show':
            echo $insCate->show_cate_controller();     
        break;
    }        