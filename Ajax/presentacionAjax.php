<?php
    $ajaxRequest=true; 
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
    require_once "../Controllers/presentacionControllers.php";
    $insPresent = new presentacionControllers(); 
    switch ($_GET["op"]){
        case 'saveandedit':
            if (empty($_POST['present_id'])) {
                echo $insPresent->add_present_controller(); 
            }else{
                echo $insPresent->update_present_controller(); 
            }
        break;
        case 'list':
            echo $insPresent->list_present_controller();     
        break;
        case 'delete':
            echo $insPresent->delete_present_controller();     
        break;
        case 'show':
            echo $insPresent->show_present_controller();     
        break;
    } 