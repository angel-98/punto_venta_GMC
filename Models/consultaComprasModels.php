<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class consultaComprasModels extends mainModel{

        protected function list_model(){ 
            if(!empty($_GET['fi']) && !empty($_GET['ff'])){
                $inicio = $_GET['fi'];
                $fin = $_GET['ff'];
                $sql=mainModel::connect()->prepare("SELECT c.compra_id,c.compra_fecha,c.compra_total,c.compra_estado,c.compra_tipoComprobante,c.compra_numComprobante,c.compra_serie,u.usuario_nombre,p.proved_nombre
                FROM compra c 
                INNER JOIN usuario u ON c.compra_id_usuario = u.usuario_id 
                INNER JOIN proveedor p ON c.compra_id_proveedor = p.proved_id
                WHERE DATE(compra_fecha) >= '$inicio' AND DATE(compra_fecha) <= '$fin'");
            }else{
                $sql=mainModel::connect()->prepare("SELECT c.compra_id,c.compra_fecha,c.compra_total,c.compra_estado,c.compra_tipoComprobante,c.compra_numComprobante,c.compra_serie,u.usuario_nombre,p.proved_nombre
                FROM compra c 
                INNER JOIN usuario u ON c.compra_id_usuario = u.usuario_id 
                INNER JOIN proveedor p ON c.compra_id_proveedor = p.proved_id
                ORDER BY compra_id DESC");
            }
            $sql->execute();
            return $sql;
        }

    }