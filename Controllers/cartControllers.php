<?php
class CartController
{
    public function addProduct()
    {
        session_start();
        $array = $_SESSION['products'];
        $array = $_POST['product'];
        $_SESSION['products'][] = $array;
    }
    public function cleanCart()
    {
        session_start();
        $_SESSION['products'] = array();
    }
    public function addTocart() 
    {
        session_start();
        $productos = $_SESSION['products'];
        return json_encode($productos);
    }
    function remove(){
        session_start();
        $array = $_SESSION['products'];
        unset($_SESSION['products']);
        $productos = array();
        for ($i=0; $i < count($array); $i++) { 
            if($_POST['element'] !== $array[$i])
            {
                $productos[$i] =  $array[$i];
            }
        }
        foreach ($productos as $key => $value) {
            if(empty($value)) unset($productos[$key]);
        }
        $_SESSION['products'] = array_merge($productos);
    }
}
