<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/laboratorioControllers.php";
    $insLab = new laboratorioControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['lab_id'])) {
                echo $insLab->add_lab_controller(); 
            }else{
                echo $insLab->update_lab_controller(); 
            }
        break;
        case 'list':
            echo $insLab->list_lab_controller();     
        break;
        case 'delete':
            echo $insLab->delete_lab_controller();     
        break;
        case 'show':
            echo $insLab->show_lab_controller();     
        break;
    }  