<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class ventasModels extends mainModel{

        protected function add_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO venta(venta_codigo,venta_id_comprobante, venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total, venta_id_usuario,venta_id_cliente,venta_estado) VALUES (:Codigo,:TipoC,:SerieC,:NumC,:Fecha,:Impuesto,:Total,:Usuario,:Cliente,:Estado)");
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->bindParam(":TipoC",$data['TipoC']);
            $sql->bindParam(":SerieC",$data['SerieC']);
            $sql->bindParam(":NumC",$data['NumC']);
            $sql->bindParam(":Fecha",$data['Fecha']);
            $sql->bindParam(":Impuesto",$data['Impuesto']);
            $sql->bindParam(":Total",$data['Total']);
            $sql->bindParam(":Usuario",$data['Usuario']);
            $sql->bindParam(":Cliente",$data['Cliente']);
            $sql->bindParam(":Estado",$data['Estado']);
            $sql->execute();
            return $sql;
        }
        protected function add_detail_model($cantidad,$precioC,$descuento,$venta,$producto){
            $sql=mainModel::connect()->prepare("INSERT INTO detalle_venta(detalleVenta_cantidad, detalleVenta_precioV,detalleVenta_descuento,detalleVenta_id_venta,detalleVenta_id_producto) VALUES (:Cantidad,:PrecioV,:Descuento,:Venta,:Producto)");
            $sql->bindParam(":Cantidad",$cantidad);
            $sql->bindParam(":PrecioV",$precioC);
            $sql->bindParam(":Descuento",$descuento);
            $sql->bindParam(":Venta",$venta);
            $sql->bindParam(":Producto",$producto);
            $sql->execute();
            return $sql; 
        }
        protected function add_record_model($venta,$cantidad,$fecha,$lote,$proveedor,$producto){
            $sql=mainModel::connect()->prepare("INSERT INTO historial_venta(hv_id_venta,hv_cantidad,hv_fechaVencimiento,hv_id_lote,hv_id_proveedor,hv_id_producto) VALUES (:Venta,:Cantidad,:Fecha,:Lote,:Proveedor,:Producto)");
            $sql->bindParam(":Venta",$venta);
            $sql->bindParam(":Cantidad",$cantidad);
            $sql->bindParam(":Fecha",$fecha);
            $sql->bindParam(":Lote",$lote);
            $sql->bindParam(":Proveedor",$proveedor);
            $sql->bindParam(":Producto",$producto);
            $sql->execute();
            return $sql; 
        }
        protected function consult_stock_model($codigo){
            $sql=mainModel::connect()->prepare("SELECT * FROM lote WHERE lote_fechaVencimiento = (SELECT MIN(lote_fechaVencimiento) FROM lote  WHERE lote_id_producto=:Codigo) AND lote_id_producto=:Codigo");
            $sql->bindParam(":Codigo",$codigo);
            $sql->execute();
            return $sql;
        }
        protected function last_sale_model(){
            $query=mainModel::connect()->prepare("SELECT MAX(venta_id) as id  from venta");
            $query->execute();
            return $query; 
        }
        protected function last_voucher_model($id){
            $query=mainModel::connect()->prepare("SELECT comprobante_nombre as comprobante from comprobante WHERE comprobante_id='$id'");
            $query->execute();
            return $query; 
        }
        protected function list_model(){ 
            $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,cliente_nombre,usuario_nombre,venta_estado FROM venta
            join comprobante on venta_id_comprobante = comprobante_id
            join cliente on venta_id_cliente = cliente_id
            join usuario on venta_id_usuario = usuario_id
            ORDER BY venta_id DESC ");
            $sql->execute();
            return $sql;
        }
        protected function list_prod_model(){ 
            $sql=mainModel::connect()->prepare("SELECT p.prod_id,p.prod_imagen,p.prod_adicional,p.prod_nombre,p.prod_concentracion, p.prod_precioV,l.lab_nombre,tp.tipo_nombre,pre.present_nombre 
            FROM producto p 
            INNER JOIN laboratorio l ON p.prod_id_lab = l.lab_id 
            INNER JOIN tipo_producto tp ON p.prod_id_tipo = tp.tipo_id 
            INNER JOIN presentacion pre ON p.prod_id_present = pre.present_id 
            ORDER BY p.prod_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function cancel_sale_model($code){ 
            $sql=mainModel::connect()->prepare("UPDATE venta SET venta_estado='0' WHERE venta_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function show_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,date(venta_fecha)as venta_fecha,venta_impuesto,venta_total,cliente_nombre FROM venta
            join comprobante on venta_id_comprobante = comprobante_id
            join cliente on venta_id_cliente = cliente_id 
            WHERE venta_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function show_detail_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT detalleVenta_id,detalleVenta_cantidad,detalleVenta_precioV,detalleVenta_descuento,prod_nombre,prod_concentracion,prod_adicional FROM detalle_venta 
            join producto on detalleVenta_id_producto = prod_id 
            WHERE detalleVenta_id_venta=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function barcode_prod_model($barcode){
            $sql=mainModel::connect()->prepare("SELECT * FROM producto WHERE prod_codigo=:Barcode");
            $sql->bindParam("Barcode",$barcode);
            $sql->execute();
            return $sql;
        }
        protected function select_cliente_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM cliente");
            $query->execute();
            return $query; 
        }
        protected function select_comprobante_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM comprobante WHERE comprobante_estado='1'");
            $query->execute();
            return $query; 
        }
        protected function select_pago_model(){
            $query=mainModel::connect()->prepare("SELECT * FROM pago");
            $query->execute();
            return $query; 
        }
        protected function get_stock_model($code){
            $sql=mainModel::connect()->prepare("SELECT SUM(lote_cantUnitario) as lote_stock FROM lote WHERE lote_id_producto=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql; 
        }
        protected function subtract_stock_model($cantidad, $id){
            $sql = mainModel::connect()->prepare("UPDATE lote SET lote_cantUnitario=lote_cantUnitario-:Cantidad  WHERE lote_id=:Id");
            $sql->bindParam("Cantidad",$cantidad);
            $sql->bindParam("Id",$id);
            $sql->execute();
            return $sql; 
        }
        protected function increase_stock_model($cantidad,$codigo){
           
            $sql=mainModel::connect()->prepare("UPDATE lote SET lote_cantUnitario=:Cantidad WHERE lote_codigo=:Codigo");
            $sql->bindParam("Cantidad",$cantidad);
            $sql->bindParam("Codigo",$codigo);
               
      
            $sql->execute();
            return $sql;
        }
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
        protected function delete_records_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM historial_venta WHERE hv_id_venta =:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function delete_lote_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM lote WHERE lote_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        } 
        /* ===========REPORTES========= */ 
        public function ventacabecera($code){ 
            $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_codigo,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,venta_estado,usuario_nombre as trabajador,cliente_nombre,cliente_dni,cliente_celular,cliente_direccion,cliente_correo FROM venta
            join comprobante on venta_id_comprobante = comprobante_id
            join cliente on venta_id_cliente = cliente_id 
            join usuario on venta_id_usuario = usuario_id
            WHERE venta_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        public function ventadetalles($code){ 
            $sql=mainModel::connect()->prepare("SELECT detalleVenta_id,detalleVenta_cantidad,detalleVenta_precioV,detalleVenta_descuento,prod_codigoin,prod_nombre,prod_concentracion,prod_adicional,(detalleVenta_cantidad*detalleVenta_precioV-detalleVenta_descuento) AS subtotal FROM detalle_venta 
            join producto on detalleVenta_id_producto = prod_id 
            WHERE detalleVenta_id_venta=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        } 
        public function venta_fecha($date,$date2){ 
            $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,cliente_nombre,usuario_nombre,venta_estado FROM venta
            join comprobante on venta_id_comprobante = comprobante_id
            join cliente on venta_id_cliente = cliente_id
            join usuario on venta_id_usuario = usuario_id
            WHERE DATE(venta_fecha) >= '$date' AND DATE(venta_fecha) <= '$date2' AND venta_estado='1' ORDER BY venta_id DESC");
             $sql->execute();
            $count = $sql->rowCount();

            if($count > 0)
            {
                return $sql->fetchAll();
            }
  
        } 
        public function reporte_ventas_model(){ 
            $sql=mainModel::connect()->prepare("SELECT venta_id,comprobante_nombre,venta_serie,venta_numComprobante,venta_fecha,venta_impuesto,venta_total,cliente_nombre,usuario_nombre,venta_estado FROM venta
            join comprobante on venta_id_comprobante = comprobante_id
            join cliente on venta_id_cliente = cliente_id
            join usuario on venta_id_usuario = usuario_id
            ORDER BY venta_id DESC");
            $sql->execute();
            return $sql;
        }
        public function cantidad_productos_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT COUNt(detalleVenta_id_producto) as total FROM detalle_venta where detalleVenta_id_venta=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
    }