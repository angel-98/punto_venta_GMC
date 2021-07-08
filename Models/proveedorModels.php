<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class proveedorModels extends mainModel{

        protected function add_provee_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO proveedor(proved_codigo,proved_nombre, proved_tipoDocumento,proved_numDocumento,proved_celular,proved_correo,proved_direccion) VALUES (:Codigo,:Nombre,:Tipo,:Numero,:Celular,:Correo,:Direccion)");
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Tipo",$data['Tipo']);
            $sql->bindParam(":Numero",$data['Numero']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Correo",$data['Correo']);
            $sql->bindParam(":Direccion",$data['Direccion']);
            $sql->execute();
            return $sql;
        }
        protected function update_provee_model($data){
            $sql=mainModel::connect()->prepare("UPDATE proveedor SET 
            proved_nombre=:Nombre,
            proved_tipoDocumento=:Tipo,
            proved_numDocumento=:Numero,
            proved_celular=:Celular,
            proved_correo=:Correo,
            proved_direccion=:Direccion
            WHERE proved_id=:Codigo");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Tipo",$data['Tipo']);
            $sql->bindParam(":Numero",$data['Numero']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Correo",$data['Correo']);
            $sql->bindParam(":Direccion",$data['Direccion']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function list_provee_model(){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM proveedor  ORDER BY proved_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function delete_provee_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM proveedor WHERE proved_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_provee_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM proveedor WHERE proved_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }

    }