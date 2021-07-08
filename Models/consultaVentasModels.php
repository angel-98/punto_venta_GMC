<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class consultaVentasModels extends mainModel{

        protected function list_model(){ 
            if(!empty($_GET['fi']) && !empty($_GET['ff'])){
                $inicio = $_GET['fi'];
                $fin = $_GET['ff'];
                $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,cliente_nombre,usuario_nombre,venta_estado FROM venta
                join comprobante on venta_id_comprobante = comprobante_id
                join cliente on venta_id_cliente = cliente_id
                join usuario on venta_id_usuario = usuario_id
                WHERE DATE(venta_fecha) >= '$inicio' AND DATE(venta_fecha) <= '$fin'");
            }else{
                $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,cliente_nombre,usuario_nombre,venta_estado FROM venta
                join comprobante on venta_id_comprobante = comprobante_id
                join cliente on venta_id_cliente = cliente_id
                join usuario on venta_id_usuario = usuario_id
                ORDER BY venta_id DESC");
            }
            $sql->execute();
            return $sql;
        }

    }