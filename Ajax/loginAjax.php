<?php
    $ajaxRequest=true;
    require_once "../Core/generalConfig.php";
	require_once "../Helpers/Helpers.php";
        if (isset($_GET['Token'])) {
            require_once "../Controllers/loginControllers.php";
            $logout= new loginControllers();
            echo $logout->logout_controller();
        }else{
            session_start(['name'=>'STR']);
            session_destroy();
            echo '<script> window.location.href="'.base_url().'/login/"</script>';
        } 