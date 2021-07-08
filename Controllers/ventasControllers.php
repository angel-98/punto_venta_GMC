<?php
    if($ajaxRequest){
        require_once "../Models/ventasModels.php";
    }else{
        require_once "./Models/ventasModels.php";
    }
 
    class ventasControllers extends ventasModels{

        public function add_controller(){
            $cliente=mainModel::decryption($_POST['cliente']);
            $cliente=mainModel::clean_chain($cliente);
            $fecha=mainModel::clean_chain($_POST['fecha']);
            $tipo_comprobante=mainModel::decryption($_POST['tipo_comprobante']);
            $tipo_comprobante=mainModel::clean_chain($tipo_comprobante);
            $serie_comprobante=mainModel::clean_chain($_POST['serie_comprobante']);
            $num_comprobante=mainModel::clean_chain($_POST['num_comprobante']);
            $impuesto=mainModel::clean_chain($_POST['impuesto']);
            $total_venta=mainModel::clean_chain($_POST['total_venta']);

            $query=mainModel::run_simple_query("SELECT venta_id  FROM venta");
               
            $number=($query->rowCount())+1;
            $codigo=mainModel::random_code("V",6,$number);
            session_start(['name'=>'STR']);

            $usuario = $_SESSION['id_user_str'];

            $dataVenta=[
                "Codigo"=>$codigo,
                "TipoC"=>$tipo_comprobante,
                "SerieC"=>$serie_comprobante,
                "NumC"=>$num_comprobante,
                "Fecha"=>$fecha,
                "Impuesto"=>$impuesto,
                "Total"=>$total_venta,
                "Usuario"=>$usuario,
                "Cliente"=>$cliente,
                "Estado"=>"1"
            ];
            $saveVenta=ventasModels::add_model($dataVenta);
            if ($saveVenta->rowCount()>=1){

                    $obtainID=ventasModels::last_sale_model();
                    $sale=$obtainID->fetch();
                    $obtainVOUCHER=ventasModels::last_voucher_model($tipo_comprobante); 
                    $voucher=$obtainVOUCHER->fetch();
                    $voucher_name = $voucher['comprobante'];
                    $sale_id = $sale['id'];
                    $product_id = $_POST['prod_id'];
                    $quanty = $_POST['cantidad'];
                    $price = $_POST['precio_venta'];
                    $discount = $_POST['descuento'];
                    $e = 0;
      
                    while ($e < count($product_id)) {
                        $saved=ventasModels::add_detail_model($quanty[$e],$price[$e],$discount[$e],$sale_id,$product_id[$e]);
                        while($quanty[$e] != 0){
                            $query_lote=ventasModels::consult_stock_model($product_id[$e]);
                            $lote = $query_lote->fetchAll();
                            foreach ($lote as $lote){
                                if($quanty[$e] < $lote['lote_cantUnitario']){
                                    $sale_history=ventasModels::add_record_model($sale_id,$quanty[$e],$lote['lote_fechaVencimiento'],$lote['lote_codigo'],$lote['lote_id_proveedor'],$product_id[$e]);
                                    ventasModels::subtract_stock_model($quanty[$e], $lote['lote_id']);
                                    $quanty[$e] = 0;
                                 }
                                 if($quanty[$e] == $lote['lote_cantUnitario']){
                                    $sale_history=ventasModels::add_record_model($sale_id,$quanty[$e],$lote['lote_fechaVencimiento'],$lote['lote_codigo'],$lote['lote_id_proveedor'],$product_id[$e]);
                                    ventasModels::delete_lote_model($lote['lote_id']);
                                    $quanty[$e] = 0;
                                 }
                                 if($quanty[$e] > $lote['lote_cantUnitario']){
                                    $sale_history=ventasModels::add_record_model($sale_id,$lote['lote_cantUnitario'],$lote['lote_fechaVencimiento'],$lote['lote_codigo'],$lote['lote_id_proveedor'],$product_id[$e]);
                                    ventasModels::delete_lote_model($lote['lote_id']);
                                    $quanty[$e] = $quanty[$e] - $lote['lote_cantUnitario'];
                                 }
                            }
                        }
                        $e=$e+1;
                    }   
                    if($saved->rowCount()>=1){ 
                        $alert=[
                            "Alert"=>"recharge",
                            "title"=>"Operacion exitosa",
                            "text"=>"Venta registrada exitosamente",
                            "icon"=>"success"
                        ];
                    }else{
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Ocurrió un error inesperado",
                            "text"=>"¡Error! No hemos podido registrar venta, en este momento",
                            "icon"=>"error"
                        ];
                    }
        
            }else {
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Ocurrió un error inesperado",
                        "text"=>"¡Error! No hemos podido registrar venta, en este momento",
                        "icon"=>"error"
                    ];
            }
            
            return json_encode(["alert"=>mainModel::sweet_alert($alert), "id"=>mainModel::encryption($sale_id), "comprobante"=>$voucher_name]);
        } 
        public function list_controller(){
            $query = ventasModels::list_model();
            $data=Array();
            while ($reg=$query->fetch()){

                $ticket = 'Ticket';
                
                $data[]=array(
                    "0"=>(($reg['venta_estado'])?'
                    <div class="btn-group"><button class="btn btn-default border-info btn-sm edit" title="Ver venta" id="'.mainModel::encryption($reg['venta_id']).'"><i class="fa fa-eye fa-xs"></i></button>'.' '.'
                    <button type="button" class="btn btn-default border-danger btn-sm anular" title="Anular venta" id="'.mainModel::encryption($reg['venta_id']).'"><i class="fa fa-ban fa-xs"></i></button>'.' '.'
                    <button type="button" class="btn btn-default border-primary btn-sm" title="Imprimir '.$reg['comprobante_nombre'].'" onclick="Print_voucher(\''.$reg['comprobante_nombre'].'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-print fa-xs"></i></button>':
                    '<div class="btn-group"><button class="btn btn-default border-info btn-sm edit" title="Ver venta" id="'.mainModel::encryption($reg['venta_id']).'"><i class="fa fa-eye fa-xs"></i></button>'.' '.'
                    <button type="button" class="btn btn-default border-primary btn-sm" title="Imprimir '.$reg['comprobante_nombre'].'" onclick="Print_voucher(\''.$reg['comprobante_nombre'].'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-print fa-xs"></i></button>').
                    (($reg['comprobante_nombre']=='Ticket')?'</div>':'<button type="button" class="btn btn-default border-green btn-sm" title="Imprimir '.$reg['comprobante_nombre'].' formato ticket" onclick="Print_voucher(\''.$ticket.'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-ticket-alt fa-xs"></i></button></div>'),
                    "1"=> date("d/m/Y", strtotime(substr($reg['venta_fecha'],0,10))),
                    "2"=>$reg['cliente_nombre'],
                    "3"=>$reg['usuario_nombre'], 
                    "4"=>$reg['comprobante_nombre'], 
                    "5"=>$reg['venta_serie'].'-'.$reg['venta_numComprobante'],
                    "6"=>$reg['venta_impuesto'],
                    "7"=>formatMoney($reg['venta_total']),
                    "8"=>($reg['venta_estado'])?'<span class="badge bg-green-400">Aceptado</span>':'<span class="badge bg-danger-400">Anulado</span>'
                );
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        } 
        public function list_prod_controller(){
            $query = ventasModels::list_prod_model();
            $data=Array();
            $fecha_actual = new DateTime(); 
            while ($reg=$query->fetch()) {
 
                $query2 = ventasModels::get_stock_model($reg['prod_id']);

                while ($obj=$query2->fetch()) {
                  
                    if(empty($obj['lote_stock'])){
                        $stock = '<span class="badge bg-danger-400">0</span>';
                        $cantidad = 0;
                    }else{
                        if($obj['lote_stock']>=15){
                            $stock = '<span class="badge bg-info-400">'.$obj['lote_stock'].'</span>';
                        }
                        if($obj['lote_stock']<15){
                            $stock = '<span class="badge bg-warning-400">'.$obj['lote_stock'].'</span>';
                        }
                        $cantidad = $obj['lote_stock'];
                    }
                }

                if($cantidad !== 0)
                {
                    $data[]=array(
                        "0"=>'<img src="'.$reg['prod_imagen'].'" width="40px">',
                        "1"=>$reg['prod_nombre'].' '.$reg['prod_concentracion'].' '.$reg['prod_adicional'],
                        "2"=>$stock,
                        "3"=>formatMoney($reg['prod_precioV']),
                        "4"=>$reg['lab_nombre'], 
                        "5"=>$reg['tipo_nombre'],
                        "6"=>$reg['present_nombre'],
                        "7"=>'<button id="btnAgregarP" type="button" class="btn btn-default border-green btn-sm" title="Aregar" name="'.$reg['prod_id'].'" onclick="addDetail('.$reg['prod_id'].',\''.$reg['prod_nombre'].'\',\''.$reg['prod_concentracion'].'\',\''.$reg['prod_adicional'].'\','.$reg['prod_precioV'].','.$cantidad.')"><span class="fa fa-plus fa-xs"></span></button>'
                    );
                } 
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        }  
        public function barcode_prod_controller(){ 
            $barcode = $_POST['barcode'];
            $resp = ventasModels::barcode_prod_model($barcode);
            $result = array();
            while($row = $resp->fetch())
            {
                
                $stock = ventasModels::get_stock_model($row['prod_id'])->fetch();
                
                $result[0] = array(
                    'id'=>$row['prod_id'],
                    'producto'=>$row['prod_nombre'],
                    'concentracion'=>$row['prod_concentracion'],
                    'adicional'=>$row['prod_adicional'],
                    'precio'=>$row['prod_precioV'],
                    'cantidad'=>$stock['lote_stock']
                );
            }
            echo json_encode($result);
        }
        public function cancel_sale_controller(){

            $venta_id=mainModel::decryption($_POST['venta_id']);
            $venta_id=mainModel::clean_chain($venta_id);
            $rspta=ventasModels::cancel_sale_model($venta_id);
            if ($rspta->rowCount()>=1) {
                $historial = mainModel::run_simple_query("SELECT *FROM historial_venta WHERE hv_id_venta='$venta_id'"); 
        
                while($hv = $historial->fetch()){
                    $lote_id = $hv['hv_id_lote'];
                    $lote=mainModel::run_simple_query("SELECT lote_codigo,lote_cantUnitario FROM lote WHERE lote_codigo='$lote_id'");
                    $ucant = $lote->fetch();
                    if ($lote->rowCount()!=1){ 
                        $data=[
                            "Codigo"=>$hv['hv_id_lote'],
                            "Quanty"=>$hv['hv_cantidad'],
                            "DateV"=>$hv['hv_fechaVencimiento'],
                            "Product"=>$hv['hv_id_producto'],
                            "Provider"=>$hv['hv_id_proveedor']
                        ];
                        ventasModels::add_lote_model($data);
                        ventasModels::delete_records_model($venta_id);
                    }
                    if ($lote->rowCount()>=1){
                        $cantidad = $hv['hv_cantidad'] + $ucant['lote_cantUnitario'];
                        ventasModels::increase_stock_model($cantidad,$lote_id);
                        ventasModels::delete_records_model($venta_id);
                    }
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Anulado",
                        "text"=>"Venta anulada exitoxamente",
                        "icon"=>"success"
                    ];
                }

            } else { 
                $alert=[
                    "Alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"¡Error! No hemos podido anular esta venta, en este momento",
                    "icon"=>"error"
                ];
            } 
            return mainModel::sweet_alert($alert);   
            /*  $validar_historial = mainModel::run_simple_query("SELECT *FROM historial_venta WHERE hv_id_venta='$venta_id'"); 
                $hv = $validar_historial->fetch();

                $lote=mainModel::run_simple_query("SELECT lote_codigo FROM lote WHERE lote_codigo='$hv['hv_id_lote']' and lote_id_producto ='hv_id_producto'");
                if ($lote->rowCount()>=1) {
                    $cantidad = 
                    $editar=ventasModels::increase_stock_model($tipo,$cantidad,$codigo,$fechav,$producto,$proveedor;
                    if ($editar->rowCount()>=1){ 
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Anulado",
                            "text"=>"Venta anulada exitoxamente",
                            "icon"=>"success"
                        ];
                    }
                }else{
                    $editar=ventasModels::increase_stock_model($tipo,$cantidad,$codigo,$fechav,$producto,$proveedor;
                    if ($editar->rowCount()>=1){ 
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Anulado",
                            "text"=>"Venta anulada exitoxamente",
                            "icon"=>"success"
                        ];
                    }
                }*/    
        } 
        public function show_controller(){
            $venta_id=mainModel::decryption($_POST['venta_id']);
            $venta_id=mainModel::clean_chain($venta_id);
            $query=ventasModels::show_model($venta_id);
            $rspta= $query->fetch(); 
            echo json_encode($rspta);  
        }  
        public function show_detail_controller(){
            session_start(['name'=>'STR']);
            $venta_id=mainModel::decryption($_GET['id']);
            $venta_id=mainModel::clean_chain($venta_id);
            $query=ventasModels::show_detail_model($venta_id);
            $query2=ventasModels::show_model($venta_id);
            $rspta= $query2->fetch();
            $subtotal=0;

            echo ' 
            <thead class="thead-light">
                <th >DESCRIPCIÓN</th>
                <th class="text-center">CANTIDAD</th>
                <th class="text-center">PRECIO UNI.</th>
                <th class="text-center">DESCUENTO</th>
                <th class="text-center" >IMPORTE</th>
           </thead>';
           $i=1;

            while ($rows=$query->fetch()) {
                $monto_actual = $rows['detalleVenta_cantidad']*$rows['detalleVenta_precioV'];
                $descuento_actual = ($rows['detalleVenta_descuento']*$monto_actual)/100;
                $importe = $monto_actual - $descuento_actual;
                echo '
                <tr class="filas">
                    <td>'.$rows['prod_nombre'].' '.$rows['prod_concentracion'].' '.$rows['prod_adicional'].'</td>
                    <td class="text-center">'.$rows['detalleVenta_cantidad'].'</td>
                    <td class="text-center">'.$_SESSION['simbolo_str'].formatMoney($rows['detalleVenta_precioV']).'</td>
                    <td class="text-center">'.formatMoney($rows['detalleVenta_descuento']).'%</td>
                    <td class="text-center">'.$_SESSION['simbolo_str'].formatMoney($importe).'</td>
                </tr>';
                $inp = 1+($rspta['venta_impuesto']/100) ;
                $subtotal=$rspta['venta_total']/$inp;
		        $igv=$rspta['venta_total']-$subtotal;
                $total = $rspta['venta_total'];

            }
            echo '
            <tfoot class="thead-light">
                <th>
                    <span>SUBTOTAL</span><br>
                    <span id="valor_impuesto">IGV '.$rspta['venta_impuesto'].'%</span><br>
                    <span>TOTAL</span>
                </th><th></th><th></th><th></th>
                <th>
                    <span id="total">'.$_SESSION['simbolo_str'].formatMoney($subtotal).'</span><br>
                    <span id="most_imp" maxlength="4">'.$_SESSION['simbolo_str'].formatMoney($igv).'</span><br>
                    <span id="most_total">'.$_SESSION['simbolo_str'].formatMoney($total).'</span>
                </th>
            </tfoot>
            ';
        }   
        public function select_cliente_controller(){
            $query=ventasModels::select_cliente_model();
            $datas= $query->fetchAll();
            echo '<option value="0">Seleccionar</option>';
            foreach ($datas as $rows ) {
                echo '<option value="'.mainModel::encryption($rows['cliente_id']).'">'.$rows['cliente_nombre'].'</option>';
            }
        }  
        public function select_comprobante_controller(){
            $query=ventasModels::select_comprobante_model();
            $datas= $query->fetchAll();
            foreach ($datas as $rows ) {
                echo '<option value="'.mainModel::encryption($rows['comprobante_id']).'">'.$rows['comprobante_nombre'].'</option>';
            }
        } 
        public function select_pago_controller(){
            $query=ventasModels::select_pago_model();
            $datas= $query->fetchAll();
            echo '<option >Seleccionar</option>';
            foreach ($datas as $rows ) {
                echo '<option value="'.$rows['pago_id'].'">'.$rows['pago_nombre'].'</option>';
            }
        }  

    }