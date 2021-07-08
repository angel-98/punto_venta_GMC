<?php
    if($ajaxRequest){
        require_once "../Models/comprasModels.php";
    }else{
        require_once "./Models/comprasModels.php";
    }
 
    class comprasControllers extends comprasModels{

        public function add_controller(){
            $proveedor=mainModel::clean_chain($_POST['proveedor']);
            $fecha=mainModel::clean_chain($_POST['fecha']);
            $num_documento=mainModel::clean_chain($_POST['num_documento']);
            $tipo_documento=mainModel::clean_chain($_POST['tipo_documento']);
            $num_serie=mainModel::clean_chain($_POST['num_serie']);
            $igv=mainModel::clean_chain($_POST['igv']);
            $total=mainModel::clean_chain($_POST['total_buy']);
 
                $query=mainModel::run_simple_query("SELECT compra_id FROM compra");
               
                $number=($query->rowCount())+1;
                $codigo=mainModel::random_code("CMP-",6,$number);
                session_start(['name'=>'STR']);

                $usuario = $_SESSION['id_user_str'];

                $dataCompra=[
                    "Codigo"=>$codigo,
                    "TipoC"=>$tipo_documento,
                    "SerieC"=>$num_serie,
                    "NumC"=>$num_documento,
                    "Fecha"=>$fecha,
                    "Impuesto"=>$igv,
                    "Total"=>$total,
                    "Proveedor"=>$proveedor,
                    "Usuario"=>$usuario,
                    "Estado"=>"1"
                ];
                $saveCompra=comprasModels::add_model($dataCompra);
                if ($saveCompra->rowCount()>=1){

                    $obtainID=mainModel::run_simple_query("SELECT MAX(compra_id) as id  from compra");
                    $purchase=$obtainID->fetch();
                    $purchase_id = $purchase['id'];
                    $product_id = $_POST['prod_id'];
                    $quanty = $_POST['quantity'];
                    $price = $_POST['purchase_price'];
                    $date = $_POST['fechaV']; 
                    $e = 0;

                    $query3=mainModel::run_simple_query("SELECT lote_id FROM lote");
                    $number=($query3->rowCount())+1;
                    
                    while ($e < count($product_id)) {
                        $codigo_lote=mainModel::random_code("00",6,$number);
                        $query4=mainModel::run_simple_query("SELECT prod_precioC,prod_precioV,prod_porcentaje FROM producto WHERE prod_id = '$product_id[$e]'");

                        while($rspt_prod=$query4->fetch()){
                            if( $price[$e] < $rspt_prod['prod_precioC']){
                                $new_price = ($price[$e]*$rspt_prod['prod_porcentaje']/100)+$price[$e];
                                comprasModels::update_price_product_model($price[$e],$new_price,$product_id[$e]);
                            }
                            if( $price[$e] >= $rspt_prod['prod_precioC']){
                                comprasModels::update_price_product_model($rspt_prod['prod_precioC'],$rspt_prod['prod_precioV'],$product_id[$e]);
                            }
                        }
                        $saved=comprasModels::add_detail_model($quanty[$e],$price[$e],$purchase_id,$product_id[$e]);
                        comprasModels::add_record_model($purchase_id,$product_id[$e],$codigo_lote,$date[$e]);
                        comprasModels::add_lote_model($codigo_lote,$quanty[$e],$date[$e],$product_id[$e],$proveedor);

                        $e=$e+1;
                    }   
                    if($saved->rowCount()>=1){
                        $alert=[
                            "Alert"=>"clean",
                            "title"=>"Operacion exitosa",
                            "text"=>"Compra registrada exitosamente",
                            "icon"=>"success"
                        ];
                    }else{
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Ocurrió un error inesperado",
                            "text"=>"¡Error! No hemos podido registrar compra, en este momento",
                            "icon"=>"error"
                        ];
                    }
                }else {
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Ocurrió un error inesperado",
                        "text"=>"¡Error! No hemos podido registrar compra, en este momento",
                        "icon"=>"error"
                    ];
                }
 
            return mainModel::sweet_alert($alert);
        }
        public function list_controller(){
            $query = comprasModels::list_model();
            $data=Array();
            while ($reg=$query->fetch()) {

                $data[]=array(
                    "0"=>($reg['compra_estado'])?'
                    <div class="btn-group"><button class="btn btn-default border-info btn-sm edit"   title="Ver compra" id="'.mainModel::encryption($reg['compra_id']).'"><i class="fa fa-eye fa-xs"></i></button>'.' '.'<button class="btn btn-default border-danger btn-sm anular" title="Anular compra" id="'.mainModel::encryption($reg['compra_id']).'"><i class="fa fa-ban fa-xs"></i></button></div>':'<div class="btn-group"><button class="btn btn-default border-info btn-sm edit"   title="Ver compra" id="'.mainModel::encryption($reg['compra_id']).'"><i class="fa fa-eye fa-xs"></i></button></div>',
                    "1"=>date("d/m/Y", strtotime($reg['compra_fecha'])),
                    "2"=>$reg['proved_nombre'],
                    "3"=>$reg['usuario_nombre'],
                    "4"=>$reg['compra_tipoComprobante'], 
                    "5"=>$reg['compra_serie'].'-'.$reg['compra_numComprobante'],
                    "6"=>formatMoney($reg['compra_total']),
                    "7"=>($reg['compra_estado'])?'<span class="badge bg-green-400">Aceptado</span>':'<span class="badge bg-danger-400">Anulado</span>'
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

            $query = comprasModels::list_prod_model();
            $data=Array();
            while ($reg=$query->fetch()) {
 
                $query2 = comprasModels::get_stock_model($reg['prod_id']);

                while ($obj=$query2->fetch()) {
                  
                    if(empty($obj['lote_stock'])){
                        $stock = '<span class="badge bg-danger-400">0</span>';
                    }else{
                        if($obj['lote_stock']>=15){
                            $stock = '<span class="badge bg-info-400">'.$obj['lote_stock'].'</span>';
                        }
                        if($obj['lote_stock']<15){
                            $stock = '<span class="badge bg-warning-400">'.$obj['lote_stock'].'</span>';
                        }
                    } 
                }
                $data[]=array(
                    "0"=>'<img src="'.$reg['prod_imagen'].'" width="40px">',
                    "1"=>$reg['prod_nombre'].' '.$reg['prod_concentracion'].' '.$reg['prod_adicional'],
                    "2"=>$stock,
                    "3"=>$reg['lab_nombre'], 
                    "4"=>$reg['tipo_nombre'],
                    "5"=>$reg['present_nombre'],
                    "6"=>'<button id="btnAgregarP" type="button" class="btn btn-default border-green btn-sm" name="'.$reg['prod_id'].'" onclick="addDetail('.$reg['prod_id'].',\''.$reg['prod_nombre'].'\',\''.$reg['prod_concentracion'].'\',\''.$reg['prod_adicional'].'\')"><span class="fa fa-plus fa-xs"></span></button>'
                );
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        }  
        public function cancel_purchase_controller(){

            $compra_id=mainModel::decryption($_POST['compra_id']);
            $compra_id=mainModel::clean_chain($compra_id);
            $rspta=comprasModels::cancel_purchase_model($compra_id);
            if ($rspta->rowCount()>=1) {   
                $historial = mainModel::run_simple_query("SELECT *FROM historial_compra WHERE hc_id_compra='$compra_id'"); 

                while($hv = $historial->fetch()){
                    $lote_id = $hv['hc_id_lote'];
                    $lote=mainModel::run_simple_query("SELECT lote_codigo FROM lote WHERE lote_codigo='$lote_id'");
                    
                    if ($lote->rowCount()>=1){
                        comprasModels::delete_lote_model($lote_id);
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Anulado",
                            "text"=>"Compra anulada exitoxamente",
                            "icon"=>"success"
                        ];
                     }
                }

            } else {
   
                $alert=[
                    "Alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"¡Error! No hemos podido anular esta compra, en este momento",
                    "icon"=>"error"
                ];
            } 
            return mainModel::sweet_alert($alert);       
        } 
        public function show_controller(){
            $compra_id=mainModel::decryption($_POST['compra_id']);
            $compra_id=mainModel::clean_chain($compra_id);
            $query=comprasModels::show_model($compra_id);
            $rspta= $query->fetch();
            echo json_encode($rspta);  
        }  
        public function show_detail_controller(){
            session_start(['name'=>'STR']);
            $compra_id=mainModel::decryption($_GET['id']);
            $compra_id=mainModel::clean_chain($compra_id);
            $query=comprasModels::show_detail_model($compra_id); 
            $query2=comprasModels::show_model($compra_id);
            $rspta= $query2->fetch();
            $subtotal=0;

            echo ' 
            <thead class="thead-light">
                <th >DESCRIPCIÓN</th>
                <th class="text-center">CANTIDAD</th>
                <th class="text-center">PRECIO UNI.</th>
                <th class="text-center">LOTE</th>
                <th class="text-center">VENCIMIENTO</th>
                <th class="text-center" >IMPORTE</th>
           </thead>';
           $i=1;

            while ($rows=$query->fetch()) {
                $query3=comprasModels::historial_producto_model($compra_id,$rows['detalleCompra_id_producto']);
                while($lote=$query3->fetch()){
                    $codigo_lote = $lote['hc_id_lote'];
                    $fecha_lote = date("d/m/Y", strtotime($lote['hc_fechaVe']));
                }
                echo '
                <tr class="filas">
                    <td>'.$rows['prod_nombre'].' '.$rows['prod_concentracion'].' '.$rows['prod_adicional'].'</td>
                    <td class="text-center">'.$rows['detalleCompra_cantidad'].'</td>
                    <td class="text-center">'.$_SESSION['simbolo_str'].formatMoney($rows['detalleCompra_precioC']).'</td>
                    <td class="text-center">'.$codigo_lote.'</td>
                    <td class="text-center">'.$fecha_lote.'</td>
                    <td class="text-center">'.$_SESSION['simbolo_str'].formatMoney($rows['detalleCompra_precioC']*$rows['detalleCompra_cantidad']).'</td>
                </tr>';
                $subtotal=$subtotal+($rows['detalleCompra_precioC']*$rows['detalleCompra_cantidad']);
                $igv =  $subtotal * $rspta['compra_impuesto']/100;
                $total = $subtotal + $igv;

            }
            echo '
            <tfoot class="thead-light">
                <th>
                    <span>SUBTOTAL</span><br>
                    <span id="valor_impuesto">IGV '.$rspta['compra_impuesto'].' %</span><br>
                    <span>TOTAL</span>
                </th><th colspan="4"></th>
                <th>
                    <span id="total">'.$_SESSION['simbolo_str'].formatMoney($subtotal).'</span><br>
                    <span id="most_imp" maxlength="4">'.$_SESSION['simbolo_str'].formatMoney($igv).'</span><br>
                    <span id="most_total">'.$_SESSION['simbolo_str'].formatMoney($total).'</span>
                </>
            </tfoot>
            
            ';
        }   
        public function select_provider_controller(){
            $query=comprasModels::select_provider_model();
            $datas= $query->fetchAll();
            echo '<option value="0">Seleccionar</option>';
            foreach ($datas as $rows ) {
                echo '<option value="' . $rows['proved_id'].'">'.$rows['proved_nombre'].'</option>';
            }
        }  

    }