<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class presentacionModels extends mainModel{

        protected function add_present_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO presentacion(present_codigo,present_nombre) VALUES (:Code,:Presentacion)");
            $sql->bindParam(":Code",$data['Code']);
            $sql->bindParam(":Presentacion",$data['Presentacion']);
            $sql->execute();
            return $sql; 
        }
        protected function update_present_model($data){
            $query=mainModel::connect()->prepare("UPDATE presentacion SET present_nombre=:Presentacion WHERE present_id=:Code");
            $query->bindParam(":Presentacion",$data['Presentacion']);
            $query->bindParam(":Code",$data['Code']);
            $query->execute();
            return $query;
        }
        protected function list_present_model(){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM presentacion  ORDER BY present_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function delete_present_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM presentacion WHERE present_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_present_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM presentacion  WHERE present_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
    }