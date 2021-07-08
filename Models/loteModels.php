<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class loteModels extends mainModel{

        protected function add_lote_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO lote(lote_codigo,lote_cantUnitario,lote_fechaVencimiento, lote_id_producto,lote_id_proveedor) VALUES (:Codigo,:Quanty,:DateV,:Product,:Provider)");
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->bindParam(":Quanty",$data['Quanty']);
            $sql->bindParam(":DateV",$data['DateV']);
            $sql->bindParam(":Product",$data['Product']);
            $sql->bindParam(":Provider",$data['Provider']);
            $sql->execute();
            return $sql;
        }
        protected function update_lote_model($data){
            $sql=mainModel::connect()->prepare("UPDATE lote SET  lote_cantUnitario=:Quanty WHERE lote_id=:Code");
            $sql->bindParam(":Quanty",$data['Quanty']);
            $sql->bindParam(":Code",$data['Code']);
            $sql->execute();
            return $sql;
        }
        protected function list_lote_model(){ 
            $sql=mainModel::connect()->prepare("SELECT lote_id,lote_codigo,lote_cantUnitario,lote_fechaVencimiento,prod_adicional,prod_concentracion,prod_nombre,lab_nombre,tipo_nombre,present_nombre,proved_nombre,prod_imagen FROM lote 
            join proveedor on lote_id_proveedor = proved_id
            join producto on lote_id_producto = prod_id
            join laboratorio on prod_id_lab = lab_id
            join tipo_producto on prod_id_tipo = tipo_id
            join presentacion on prod_id_present = present_id order by prod_nombre");
            $sql->execute();
            return $sql; 
        }
        protected function riesgo_lote_model(){ 
            $sql=mainModel::connect()->prepare("SELECT lote_id,lote_codigo,lote_cantUnitario,lote_fechaVencimiento,prod_nombre,lab_nombre,present_nombre,proved_nombre FROM lote 
            join proveedor on lote_id_proveedor = proved_id
            join producto on lote_id_producto = prod_id
            join laboratorio on prod_id_lab = lab_id
            join presentacion on prod_id_present = present_id order by prod_nombre limit 7");
            $sql->execute();
            return $sql; 
        }
        protected function delete_lote_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM lote WHERE lote_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_lote_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT lote_id,prod_nombre,lote_cantUnitario FROM lote 
            join producto on lote_id_producto = prod_id WHERE lote_id=:Code");
             $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql; 
        }
        /* REPORTES*/
        public function report_lote_model(){ 
            $sql=mainModel::connect()->prepare("SELECT lote_id,lote_codigo,lote_cantUnitario,lote_fechaVencimiento,prod_adicional,prod_concentracion,prod_nombre,lab_nombre,tipo_nombre,present_nombre,proved_nombre,prod_imagen FROM lote 
            join proveedor on lote_id_proveedor = proved_id
            join producto on lote_id_producto = prod_id
            join laboratorio on prod_id_lab = lab_id
            join tipo_producto on prod_id_tipo = tipo_id
            join presentacion on prod_id_present = present_id order by prod_nombre");
            $sql->execute();
            return $sql; 
        } 

    }