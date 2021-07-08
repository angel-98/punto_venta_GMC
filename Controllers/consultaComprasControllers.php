<?php
    if($ajaxRequest){
        require_once "../Models/consultaComprasModels.php";
    }else{
        require_once "./Models/consultaComprasModels.php";
    }
 
    class consultaComprasControllers extends consultaComprasModels{

        public function list_controller(){
            session_start(['name'=>'STR']);
            $query = consultaComprasModels::list_model();
            $data=Array();
            while ($reg=$query->fetch()){
                $data[]=array(
                    "0"=>'<div class="btn-group"><button class="btn btn-default btn-sm border-info edit" title="Ver venta" id="'.mainModel::encryption($reg['compra_id']).'"><i class="fa fa-eye fa-xs"></i></button></div>',
                    "1"=>date("d/m/Y", strtotime($reg['compra_fecha'])),
                    "2"=>$reg['proved_nombre'],
                    "3"=>$reg['compra_tipoComprobante'], 
                    "4"=>$reg['compra_serie'].'-'.$reg['compra_numComprobante'],
                    "5"=>$_SESSION['simbolo_str'].formatMoney($reg['compra_total']),
                    "6"=>($reg['compra_estado'])?'<span class="badge bg-green-400">Aceptado</span>':'<span class="badge bg-danger-400">Anulado</span>'
                );
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        } 
 
    } 