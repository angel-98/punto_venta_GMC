<?php
$ajaxRequest=true; 
require_once "../Core/generalConfig.php";
require_once "../Helpers/Helpers.php";
require_once "../Controllers/cartControllers.php";
$insProducto = new CartController(); 

switch ($_GET['op']) {
    case 'add':
        echo $insProducto->addProduct();
        break;
    case 'clean':
        echo $insProducto->cleanCart();
        break;
    case 'list':
        echo $insProducto->addTocart();
        break;
    case 'remove':
        echo $insProducto->remove();
        break;
}