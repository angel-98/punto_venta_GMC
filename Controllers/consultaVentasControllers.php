<?php
    if($ajaxRequest){
        require_once "../Models/consultaVentasModels.php";
    }else{
        require_once "./Models/consultaVentasModels.php";
    }
 
    class consultaVentasControllers extends consultaVentasModels{

        public function list_controller(){
            session_start(['name'=>'STR']);
            $query = consultaVentasModels::list_model();
            $data=Array();
            while ($reg=$query->fetch()){

                $ticket = 'Ticket';
                
                $data[]=array(
                    "0"=>(($reg['venta_estado'])?'
                    <div class="btn-group"><button class="btn btn-default border-info btn-sm edit" title="Ver venta" id="'.mainModel::encryption($reg['venta_id']).'"><i class="fa fa-eye fa-xs"></i></button>'.' '.'
                    <button type="button" class="btn btn-default border-primary btn-sm" title="Imprimir '.$reg['comprobante_nombre'].'" onclick="Print_voucher(\''.$reg['comprobante_nombre'].'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-print fa-xs"></i></button>':
                    '<div class="btn-group"><button class="btn btn-default border-info btn-sm edit" title="Ver venta" id="'.mainModel::encryption($reg['venta_id']).'"><i class="fa fa-eye fa-xs"></i></button>'.' '.'
                    <button type="button" class="btn btn-default border-primary btn-sm" title="Imprimir '.$reg['comprobante_nombre'].'" onclick="Print_voucher(\''.$reg['comprobante_nombre'].'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-print fa-xs"></i></button>').
                    (($reg['comprobante_nombre']=='Ticket')?'</div>':'<button type="button" class="btn btn-default border-green btn-sm" title="Imprimir '.$reg['comprobante_nombre'].' formato ticket" onclick="Print_voucher(\''.$ticket.'\',\''.mainModel::encryption($reg['venta_id']).'\')"><i class="fa fa-ticket-alt fa-xs"></i></button></div>'),
                    "1"=> date("d/m/Y", strtotime(substr($reg['venta_fecha'],0,10))),
                    "2"=>limitar_cadena($reg['cliente_nombre'],20,"..."),
                    "3"=>$reg['comprobante_nombre'], 
                    "4"=>$reg['venta_serie'].'-'.$reg['venta_numComprobante'],
                    "5"=>$reg['venta_impuesto'],
                    "6"=>formatMoney($reg['venta_total']),
                    "7"=>($reg['venta_estado'])?'<span class="badge bg-green-400">Aceptado</span>':'<span class="badge bg-danger-400">Anulado</span>'
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