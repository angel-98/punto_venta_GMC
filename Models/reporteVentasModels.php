<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class reporteVentasModels extends mainModel{

        protected function count_day_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(venta_id) as total FROM venta WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_ventasd_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(venta_total),0) as total FROM venta WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_month_model(){
            $query=mainModel::connect()->prepare("SELECT COUNT(venta_id) as total FROM venta where YEAR(venta_fecha) = YEAR (NOW()) AND MONTH(venta_fecha) = MONTH (NOW()) AND venta_estado='1'");
            $query->execute();
            return $query;
        }
        protected function count_ventasm_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(venta_total),0) as total FROM venta WHERE YEAR(venta_fecha) = YEAR (NOW()) AND MONTH(venta_fecha) = MONTH (NOW()) AND venta_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_year_model(){ 
            $sql=mainModel::connect()->prepare("SELECT COUNT(venta_id) as total FROM venta where YEAR(venta_fecha) = YEAR (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql;
        }
        protected function count_ventasy_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(venta_total),0) as total FROM venta WHERE YEAR(venta_fecha) = YEAR (NOW()) AND venta_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_day_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleVenta_cantidad)-SUM(prod_precioC*detalleVenta_cantidad) as total FROM venta 
            JOIN detalle_venta on venta_id = detalleVenta_id_venta
            JOIN producto on detalleVenta_id_producto = prod_id WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_month_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleVenta_cantidad)-SUM(prod_precioC*detalleVenta_cantidad) as total FROM venta 
            JOIN detalle_venta on venta_id = detalleVenta_id_venta
            JOIN producto on detalleVenta_id_producto = prod_id WHERE YEAR(venta_fecha) = YEAR (NOW()) AND MONTH(venta_fecha) = MONTH (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profits_year_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleVenta_cantidad)-SUM(prod_precioC*detalleVenta_cantidad) as total FROM venta 
            JOIN detalle_venta on venta_id = detalleVenta_id_venta
            JOIN producto on detalleVenta_id_producto = prod_id WHERE YEAR(venta_fecha) = YEAR (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_productos_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(prod_id) as productos FROM producto");
            $sql->execute();
            return $sql;
        }
        protected function sales_statistics_model($year,$month){ 
            $sql=mainModel::connect()->prepare("SELECT SUM(venta_total) AS total FROM venta WHERE venta_estado='1' AND year(venta_fecha) = '$year' AND  MONTH(venta_fecha) = '$month' LIMIT 1");
            $sql->execute();
            return $sql; 
        }
        protected function show_users_model(){ 
            $sql=mainModel::connect()->prepare("SELECT SUM(venta_total) as total,CONCAT(usuario_nombre,' , ',usuario_apellido)as trabajador FROM venta
            JOIN usuario ON venta_id_usuario =  usuario_id 
            WHERE  MONTH(venta_fecha) = MONTH(NOW()) AND YEAR(venta_fecha) = YEAR(NOW()) 
            GROUP BY usuario_id ORDER BY usuario_nombre");
            $sql->execute();
            return $sql;
        }  
        protected function sales_seller_model(){ 
            $sql=mainModel::connect()->prepare("SELECT usuario_perfil AS perfil,CONCAT(usuario_nombre,' , ',usuario_apellido) as trabajador,usuario_dni as dni,usuario_cargo as cargo,COUNT(venta_id) as ventas,SUM(venta_total)as total FROM venta
            join usuario on venta_id_usuario = usuario_id WHERE date(venta_fecha)=DATE (NOW()) AND venta_estado='1' group by usuario_nombre");
            $sql->execute();
            return $sql;
        }  
        protected function year_summary_model(){ 
            $sql=mainModel::connect()->prepare("SELECT DATE_FORMAT(venta_fecha,'%M') AS fecha, SUM(venta_total) AS total FROM venta
            GROUP BY MONTH(venta_fecha) ORDER BY venta_fecha DESC LIMIT 0,12");
            $sql->execute();
            return $sql;
        } 

    }