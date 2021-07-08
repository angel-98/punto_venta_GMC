<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class reporteComprasModels extends mainModel{

        protected function count_day_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(compra_id) as total FROM compra WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_comprasd_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(compra_total),0) as total FROM compra WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_month_model(){
            $query=mainModel::connect()->prepare("SELECT COUNT(compra_id) as total FROM compra where YEAR(compra_fecha) = YEAR (NOW()) AND MONTH(compra_fecha) = MONTH (NOW()) AND compra_estado='1'");
            $query->execute();
            return $query;
        }
        protected function count_comprasm_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(compra_total),0) as total FROM compra WHERE YEAR(compra_fecha) = YEAR (NOW()) AND MONTH(compra_fecha) = MONTH (NOW()) AND compra_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_year_model(){ 
            $sql=mainModel::connect()->prepare("SELECT COUNT(compra_id) as total FROM compra where YEAR(compra_fecha) = YEAR (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql;
        }
        protected function count_comprasy_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(compra_total),0) as total FROM compra WHERE YEAR(compra_fecha) = YEAR (NOW()) AND compra_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_day_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleCompra_cantidad)-SUM(prod_precioC*detalleCompra_cantidad) as total FROM compra 
            JOIN detalle_compra on compra_id = detalleCompra_id_compra
            JOIN producto on detalleCompra_id_producto = prod_id WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_month_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleCompra_cantidad)-SUM(prod_precioC*detalleCompra_cantidad) as total FROM compra 
            JOIN detalle_compra on compra_id = detalleCompra_id_compra
            JOIN producto on detalleCompra_id_producto = prod_id WHERE YEAR(compra_fecha) = YEAR (NOW()) AND MONTH(compra_fecha) = MONTH (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_year_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleCompra_cantidad)-SUM(prod_precioC*detalleCompra_cantidad) as total FROM compra 
            JOIN detalle_compra on compra_id = detalleCompra_id_compra
            JOIN producto on detalleCompra_id_producto = prod_id WHERE YEAR(compra_fecha) = YEAR (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function purchases_statistics_model($year,$month){ 
            $sql=mainModel::connect()->prepare("SELECT SUM(compra_total) AS total FROM compra WHERE compra_estado='1' AND year(compra_fecha) = '$year' AND  MONTH(compra_fecha) = '$month' LIMIT 1");
            $sql->execute();
            return $sql; 
        }
        protected function year_summary_model(){ 
            $sql=mainModel::connect()->prepare("SELECT DATE_FORMAT(compra_fecha,'%M') AS fecha, SUM(compra_total) AS total FROM compra
            GROUP BY MONTH(compra_fecha) ORDER BY compra_fecha DESC LIMIT 0,12");
            $sql->execute();
            return $sql;
        } 

    }