<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class clienteModels extends mainModel{

        protected function add_client_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO cliente(cliente_nombre,cliente_dni,cliente_celular, cliente_direccion,cliente_correo) VALUES (:Nombre,:Dni,:Celular,:Direccion,:Correo)");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Direccion",$data['Direccion']);
            $sql->bindParam(":Correo",$data['Correo']);
            $sql->execute();
            return $sql;
        }
        protected function update_client_model($data){
            $sql=mainModel::connect()->prepare("UPDATE cliente SET 
            cliente_nombre=:Nombre,
            cliente_dni=:Dni,
            cliente_celular=:Celular,
            cliente_direccion=:Direccion,
            cliente_correo=:Correo
            WHERE cliente_id=:Codigo");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Direccion",$data['Direccion']);
            $sql->bindParam(":Correo",$data['Correo']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function list_client_model(){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM cliente  ORDER BY cliente_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function delete_client_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM cliente WHERE cliente_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_client_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM cliente WHERE cliente_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }

    }