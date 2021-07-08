<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class laboratorioModels extends mainModel{

        protected function add_lab_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO laboratorio(lab_codigo,lab_nombre) VALUES (:Code,:Laboratorio)");
            $sql->bindParam(":Code",$data['Code']);
            $sql->bindParam(":Laboratorio",$data['Laboratorio']);
            $sql->execute();
            return $sql; 
        }
        protected function update_lab_model($data){
            $query=mainModel::connect()->prepare("UPDATE laboratorio SET lab_nombre=:Laboratorio WHERE lab_id=:Code");
            $query->bindParam(":Laboratorio",$data['Laboratorio']);
            $query->bindParam(":Code",$data['Code']);
            $query->execute();
            return $query;
        }
        protected function list_lab_model(){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM laboratorio  ORDER BY lab_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function delete_lab_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM laboratorio WHERE lab_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_lab_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM laboratorio  WHERE lab_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
    }