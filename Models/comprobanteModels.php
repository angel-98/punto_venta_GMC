<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class comprobanteModels extends mainModel{

        protected function add_voucher_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO comprobante(comprobante_nombre, comprobante_letraSerie, comprobante_serie,comprobante_numero,comprobante_estado) VALUES (:Nombre,:LetraSerie,:Serie,:Numero,:Estado)");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":LetraSerie",$data['LetraSerie']);
            $sql->bindParam(":Serie",$data['Serie']);
            $sql->bindParam(":Numero",$data['Numero']);
            $sql->bindParam(":Estado",$data['Estado']);
            $sql->execute();
            return $sql; 
        }
        protected function update_voucher_model($data){
            $sql=mainModel::connect()->prepare("UPDATE comprobante SET 
            comprobante_nombre=:Nombre,
            comprobante_letraSerie=:LetraSerie,
            comprobante_serie=:Serie,
            comprobante_numero=:Numero
            WHERE comprobante_id=:Codigo");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":LetraSerie",$data['LetraSerie']);
            $sql->bindParam(":Serie",$data['Serie']);
            $sql->bindParam(":Numero",$data['Numero']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function list_voucher_model(){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM comprobante  ORDER BY comprobante_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function activate_voucher_model($code){ 
            $sql=mainModel::connect()->prepare("UPDATE comprobante SET comprobante_estado='1' WHERE comprobante_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function deactivate_voucher_model($code){ 
            $sql=mainModel::connect()->prepare("UPDATE comprobante SET comprobante_estado='0' WHERE comprobante_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function delete_voucher_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM comprobante WHERE comprobante_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_voucher_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM comprobante  WHERE comprobante_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
    }
