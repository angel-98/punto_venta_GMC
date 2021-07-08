<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class productoModels extends mainModel{

        protected function add_prod_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO producto(prod_codigo,prod_codigoin,prod_nombre,prod_concentracion,prod_adicional,prod_imagen, prod_precioC,prod_precioV,prod_porcentaje,prod_id_lab,prod_id_tipo,prod_id_present) VALUES (:Barras,:Codigo,:Nombre,:Concentracion,:Adicional,:Imagen,:PrecioC,:PrecioV,:Porcentaje,:Laboratorio,:Categoria,:Presentacion)");
            $sql->bindParam(":Barras",$data['Barras']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Concentracion",$data['Concentracion']);
            $sql->bindParam(":Adicional",$data['Adicional']);
            $sql->bindParam(":Imagen",$data['Imagen']);
            $sql->bindParam(":PrecioC",$data['PrecioC']);
            $sql->bindParam(":PrecioV",$data['PrecioV']);
            $sql->bindParam(":Porcentaje",$data['Porcentaje']);
            $sql->bindParam(":Laboratorio",$data['Laboratorio']);
            $sql->bindParam(":Categoria",$data['Categoria']);
            $sql->bindParam(":Presentacion",$data['Presentacion']);
            $sql->execute();
            return $sql;
        }
        protected function update_prod_model($data){
            $sql=mainModel::connect()->prepare("UPDATE producto SET 
            prod_codigo=:Barras,
            prod_nombre=:Nombre,
            prod_concentracion=:Concentracion,
            prod_adicional=:Adicional,
            prod_precioC=:PrecioC,
            prod_precioV=:PrecioV,
            prod_porcentaje=:Porcentaje,
            prod_id_lab=:Laboratorio,
            prod_id_tipo=:Categoria,
            prod_id_present=:Presentacion
            WHERE prod_id=:Codigo");
            $sql->bindParam(":Barras",$data['Barras']);
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Concentracion",$data['Concentracion']);
            $sql->bindParam(":Adicional",$data['Adicional']);
            $sql->bindParam(":PrecioC",$data['PrecioC']);
            $sql->bindParam(":PrecioV",$data['PrecioV']);
            $sql->bindParam(":Porcentaje",$data['Porcentaje']);
            $sql->bindParam(":Laboratorio",$data['Laboratorio']);
            $sql->bindParam(":Categoria",$data['Categoria']);
            $sql->bindParam(":Presentacion",$data['Presentacion']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function update_image_model($data){
            $sql=mainModel::connect()->prepare("UPDATE producto SET  prod_imagen=:Imagen WHERE prod_id=:Codigo");
            $sql->bindParam(":Imagen",$data['Imagen']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function list_prod_model(){ 
            $sql=mainModel::connect()->prepare("SELECT p.prod_id,p.prod_nombre,p.prod_concentracion,p.prod_adicional,p.prod_precioV,l.lab_nombre,tp.tipo_nombre,pre.present_nombre 
            FROM producto p 
            INNER JOIN laboratorio l ON p.prod_id_lab = l.lab_id 
            INNER JOIN tipo_producto tp ON p.prod_id_tipo = tp.tipo_id 
            INNER JOIN presentacion pre ON p.prod_id_present = pre.present_id 
            ORDER BY p.prod_id DESC ");
            $sql->execute();
            return $sql;
        }
        protected function list_catalog_model(){ 
            if (!empty($_POST['consulta'])) { 
                $search = $_POST['consulta'];
                $sql=mainModel::connect()->prepare("SELECT p.prod_id,p.prod_nombre,p.prod_imagen,p.prod_concentracion,p.prod_adicional,p.prod_precioV,l.lab_nombre,tp.tipo_nombre,pre.present_nombre 
                FROM producto p 
                INNER JOIN laboratorio l ON p.prod_id_lab = l.lab_id 
                INNER JOIN tipo_producto tp ON p.prod_id_tipo = tp.tipo_id 
                INNER JOIN presentacion pre ON p.prod_id_present = pre.present_id 
                WHERE p.prod_codigo = '$search' OR p.prod_nombre LIKE '%$search%'");
            }else{
                $sql=mainModel::connect()->prepare("SELECT p.prod_id,p.prod_nombre,p.prod_imagen,p.prod_concentracion,p.prod_adicional,p.prod_precioV,l.lab_nombre,tp.tipo_nombre,pre.present_nombre 
                FROM producto p 
                INNER JOIN laboratorio l ON p.prod_id_lab = l.lab_id 
                INNER JOIN tipo_producto tp ON p.prod_id_tipo = tp.tipo_id 
                INNER JOIN presentacion pre ON p.prod_id_present = pre.present_id");
            }
            $sql->execute();
            return $sql;
        }
        protected function delete_prod_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM producto WHERE prod_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function delete_lote_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM lote WHERE lote_id_producto=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_prod_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM producto WHERE prod_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function select_provider_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM proveedor");
            $query->execute();
            return $query; 
        }
        protected function select_laboratory_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM laboratorio");
            $query->execute();
            return $query; 
        }
        protected function select_category_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM tipo_producto");
            $query->execute();
            return $query; 
        }
        protected function select_presentation_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM presentacion");
            $query->execute();
            return $query; 
        }
        protected function get_stock_model($code){
            $sql=mainModel::connect()->prepare("SELECT SUM(lote_cantUnitario) as lote_stock FROM lote WHERE lote_id_producto=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql; 
        }
         /**  reporte **/
        public function reporte_productos_model(){ 
            $sql=mainModel::connect()->prepare("SELECT p.prod_id,p.prod_codigo,p.prod_codigoin,p.prod_nombre,p.prod_concentracion,p.prod_adicional,p.prod_precioC,p.prod_precioV,p.prod_imagen,l.lab_nombre,tp.tipo_nombre,pre.present_nombre 
            FROM producto p 
            INNER JOIN laboratorio l ON p.prod_id_lab = l.lab_id 
            INNER JOIN tipo_producto tp ON p.prod_id_tipo = tp.tipo_id 
            INNER JOIN presentacion pre ON p.prod_id_present = pre.present_id 
            ORDER BY p.prod_id DESC ");
            $sql->execute();
            return $sql;
        }
        public function product_stock_model($code){
            $sql=mainModel::connect()->prepare("SELECT SUM(lote_cantUnitario) as lote_stock FROM lote WHERE lote_id_producto=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql; 
        }

    }