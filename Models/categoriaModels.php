<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class categoriaModels extends mainModel{

        protected function add_cate_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO tipo_producto(tipo_codigo,tipo_nombre) VALUES (:Code,:Category)");
            $sql->bindParam(":Code",$data['Code']);
            $sql->bindParam(":Category",$data['Category']);
            $sql->execute();
            return $sql; 
        }
        protected function update_cate_model($data){
            $query=mainModel::connect()->prepare("UPDATE tipo_producto SET tipo_nombre=:Category WHERE tipo_id=:Code");
            $query->bindParam(":Category",$data['Category']);
            $query->bindParam(":Code",$data['Code']);
            $query->execute();
            return $query;
        }
        protected function list_cate_model(){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM tipo_producto  ORDER BY tipo_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function delete_cate_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM tipo_producto WHERE tipo_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_cate_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT * FROM tipo_producto  WHERE tipo_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
    }
