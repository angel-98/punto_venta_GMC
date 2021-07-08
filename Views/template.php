<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Site Metas -->
    <title><?= TITLE ?></title>
    <!-- Site Icons -->
    <link rel="icon" type="image/png" href="<?= media(); ?>/images/iconos/favicon.ico" />
    <!-- Start Style  -->
    <?php include "./Views/modules/style.php"; ?>
    <!-- End Style   -->
</head>
    <?php

    $ajaxRequest = false;
    require_once "./Controllers/viewControllers.php";

    $template = new viewControllers();
    $viewsTe = $template->get_controller_views();

    if ($viewsTe == "login" || $viewsTe == "404") :
        if ($viewsTe == "login") {
            echo '<body class="hold-transition login-page">';
            require_once "./Views/contend/login-view.php";
        } else {
            echo'<body class="hold-transition bg-purple">';
            require_once "./Views/errors/404-view.php";
        } 
    else :
        //session_start(['name' => 'STR']);
        $_SESSION['products'] = array();
        require_once "./Controllers/loginControllers.php";
        $current = explode("/", $_GET['views']);

        $lc = new loginControllers();
        if (!isset($_SESSION['token_str']) || !isset($_SESSION['username_str'])) {
            echo $lc->force_logoff_controller();
        }

?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Start Header -->
        <?php include "./Views/modules/header.php"; ?>
        <!-- End Header -->
        <!-- Start Sidebar -->
        <?php include "./Views/modules/sidebar.php"; ?>
        <!-- End Sidebar -->
        <div class="content-wrapper">
            <!-- Start Body  -->
            <?php  require_once $viewsTe;  ?>
            <!-- End Body  -->
        </div>
        <!-- Start Footer -->
        <?php include "./Views/modules/footer.php"; ?>
        <!-- End Footer -->
    </div>
    <!-- Start Log out -->
     <?php include "./Views/modules/cartModal.php"; ?>
    <!-- End Log out -->
    <!-- Start Scripts -->
    <?php include "./Views/modules/script.php"; ?>
    <!-- /End Scripts -->
    <!-- Start Log out -->
    <?php include "./Views/modules/logout.php"; ?>
    <!-- End Log out -->
    <?php endif; ?>
</body>

</html>