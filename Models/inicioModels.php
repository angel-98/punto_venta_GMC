<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class inicioModels extends mainModel{

        protected function count_ventas_model(){
            $sql=mainModel::connect()->prepare("SELECT IFNULL(SUM(venta_total),0) as total FROM venta WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado=1");
            $sql->execute();
            return $sql; 
        }
        protected function count_dayv_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(venta_id) as total FROM venta WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profitsv_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_preciov*detalleVenta_cantidad)-SUM(prod_precioC*detalleVenta_cantidad) as total FROM venta 
            JOIN detalle_venta on venta_id = detalleVenta_id_venta
            JOIN producto on detalleVenta_id_producto = prod_id WHERE DATE(venta_fecha)=DATE (NOW()) AND venta_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_compras_model(){
            $query=mainModel::connect()->prepare("SELECT IFNULL(SUM(compra_total),0) as total FROM compra WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado=1");
            $query->execute();
            return $query;
        }
        protected function count_dayc_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(compra_id) as total FROM compra WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_profitsc_model(){
            $sql=mainModel::connect()->prepare("SELECT SUM(prod_precioV*detalleCompra_cantidad)-SUM(prod_precioC*detalleCompra_cantidad)as total FROM compra 
            JOIN detalle_compra on compra_id = detalleCompra_id_compra
            JOIN producto on detalleCompra_id_producto = prod_id WHERE DATE(compra_fecha)=DATE (NOW()) AND compra_estado='1'");
            $sql->execute();
            return $sql; 
        }
        protected function count_usuarios_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT COUNT(usuario_id) as usuarios FROM usuario WHERE  usuario_codigo!='$code' AND usuario_id!='1'");
            $sql->execute();
            return $sql;
        }
        protected function count_productos_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(prod_id) as productos FROM producto");
            $sql->execute();
            return $sql;
        }
        protected function count_categorias_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(tipo_id) as categorias FROM tipo_producto");
            $sql->execute();
            return $sql;
        }
        protected function count_clientes_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(cliente_id) as clientes FROM cliente");
            $sql->execute();
            return $sql;
        }
        protected function count_comprobantes_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(comprobante_id) as comprobantes FROM comprobante");
            $sql->execute();
            return $sql;
        }
        protected function count_proveedores_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(proved_id) as proveedores FROM proveedor");
            $sql->execute();
            return $sql;
        }
        protected function count_laboratorios_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(lab_id) as laboratorios FROM laboratorio");
            $sql->execute();
            return $sql;
        }
        protected function count_presentaciones_model(){
            $sql=mainModel::connect()->prepare("SELECT COUNT(present_id) as presentaciones FROM presentacion");
            $sql->execute();
            return $sql;
        }
        protected function get_sales_model($day,$month,$year){
            $sql=mainModel::connect()->prepare("SELECT SUM(venta_total) as total FROM venta
            WHERE venta_estado='1' AND DAY(venta_fecha)='$day' AND MONTH(venta_fecha)='$month' AND YEAR(venta_fecha)='$year' ");
            $sql->execute();
            return $sql;  
        }  
        protected function get_purchases_model($day,$month,$year){
            $sql=mainModel::connect()->prepare("SELECT SUM(compra_total) as total FROM compra 
            WHERE compra_estado='1' AND DAY(compra_fecha)='$day' AND MONTH(compra_fecha)='$month' AND YEAR(compra_fecha)='$year'");
            $sql->execute();
            return $sql; 
        }  
        protected function recently_product_model(){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM producto join presentacion on prod_id_present = present_id  ORDER BY prod_id  DESC LIMIT 6");
            $sql->execute();
            return $sql;
        } 
        protected function most_selled_products_model(){
            $sql=mainModel::connect()->prepare("SELECT prod_nombre AS producto,COUNT(detalleVenta_id_producto) AS cantidad FROM detalle_venta 
			JOIN venta ON detalleVenta_id_venta = venta_id 
            JOIN producto ON detalleVenta_id_producto = prod_id 
            where venta_estado='1'
            GROUP BY prod_nombre DESC LIMIT 0,9");
            $sql->execute();
            return $sql; 
        }

    }
