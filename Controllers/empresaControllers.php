<?php
    if($ajaxRequest){
        require_once "../Models/empresaModels.php";
    }else{
        require_once "./Models/empresaModels.php";
    }
 
    class empresaControllers extends empresaModels{

        public function update_empresa_controller(){

            $empresa_id=mainModel::clean_chain($_POST['empresa_id']);
            $nombre=mainModel::clean_chain($_POST['nombre']); 
            $ruc=mainModel::clean_chain($_POST['ruc']); 
            $celular=mainModel::clean_chain($_POST['celular']); 
            $direccion=mainModel::clean_chain($_POST['direccion']); 
            $correo=mainModel::clean_chain($_POST['correo']); 
            $nombre_impuesto=mainModel::clean_chain($_POST['nombre_impuesto']); 
            $monto_impuesto=mainModel::clean_chain($_POST['monto_impuesto']); 
            $moneda=mainModel::clean_chain($_POST['moneda']); 
            $simbolo=mainModel::clean_chain($_POST['simbolo']); 

            $nuevo_nombre = ucwords(strtolower($nombre));
            $nuevo_nombre_impuesto = strtoupper($nombre_impuesto);
            $nuevo_nombre_moneda = strtoupper($moneda);
            $dataEmpresa=[ 
                "Nombre"=>$nuevo_nombre,
                "Ruc"=>$ruc,
                "Celular"=>$celular,
                "Direccion"=>$direccion,
                "Correo"=>$correo,
                "Impuesto"=>$nuevo_nombre_impuesto,
                "ImpuestoValor"=>$monto_impuesto,
                "Moneda"=>$nuevo_nombre_moneda,
                "Simbolo"=>$simbolo,
                "Codigo"=>$empresa_id
            ];
            if (empresaModels::update_empresa_model($dataEmpresa)) {
                session_start(['name'=>'STR']);
                $_SESSION['company_str'] = $nombre;
                $_SESSION['simbolo_str'] = $simbolo;
                $_SESSION['tax_str'] = $nuevo_nombre_impuesto;
                $_SESSION['money_str'] = $nuevo_nombre_moneda;
                $alert=[
                    "Alert"=>"recharge",
                    "title"=>"Operacion exitosa",
                    "text"=>"Datos actualizados exitosamente",
                    "icon"=>"success"
                ];
                }else {
                $alert=[
                    "Alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"¡Error! No hemos podido actualizar empresa, en este momento",
                    "icon"=>"error"
                ];
            }
            return mainModel::sweet_alert($alert);
        }
        public function add_logo_controller(){

            $id_logo_pro=mainModel::clean_chain($_POST['id_logo_pro']);

            $nombre_empresa=$_POST['nombre_empresa'];

            if (!file_exists($_FILES['photo']['tmp_name'])|| !is_uploaded_file($_FILES['photo']['tmp_name'])){
                $ruta = "../Assets/images/iconos/logo.png";
            
            }else{
                $ext=explode(".", $_FILES["photo"]["name"]);
                if ($_FILES['photo']['type']=="image/jpg" || $_FILES['photo']['type']=="image/jpeg" || $_FILES['photo']['type']=="image/png") {

                    $nombre_fichero = "../Assets/uploads/empresa/".$nombre_empresa;

                    if (!file_exists($nombre_fichero)) {
                        mkdir($nombre_fichero, 0700);
                    }

                    $imagen = round(microtime(true)).'.'. end($ext);
                    $ruta = "../Assets/uploads/empresa/".$nombre_empresa."/".$imagen;
                    move_uploaded_file($_FILES["photo"]["tmp_name"], $ruta);
                } 
            }
            $data=[
                "Logo"=>$ruta,
                "Codigo"=>$id_logo_pro
            ];
            $guardar=empresaModels::update_logo_model($data);
                if($guardar->rowCount()>=1) {
                    session_start(['name'=>'STR']);
                    $_SESSION['logotype_str'] = $ruta;
                    $alert=[
                        "Alert"=>"recharge",
                        "title"=>"Operacion exitosa",
                        "text"=>"Logo actualizada exitosamente",
                        "icon"=>"success"
                    ];
                }else {
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Ocurrió un error inesperado",
                        "text"=>"¡Error! No hemos podido registrar Logo, en este momento",
                        "icon"=>"error"
                    ];
                }
            return mainModel::sweet_alert($alert);
        }
        public function list_empresa_controller(){
            $query = empresaModels::list_empresa_model();
            $data=Array();
            while ($reg=$query->fetch()) {
                $data[]=array(
                    "0"=>                  
                    '<div class="btn-group"><button title="Actualizar" class="btn btn-default border-info btn-sm edit" title="Edit" id="'.mainModel::encryption($reg['empresa_id']).'">
                    <i class="fa fa-edit fa-xs"></i>
                    </button>'.' '.' 
                    <button type="button" class="btn btn-default border-primary btn-sm editLogo" data-toggle="modal" 
                    id="'.mainModel::encryption($reg['empresa_id']).'">
                    <i class="fa fa-image fa-xs"></i>
                    </button></div>',
                    "1"=>"<img class='table-avatar' src='".$reg['empresa_logo']."' width='40px'>",
                    "2"=>$reg['empresa_nombre'],
                    "3"=>$reg['empresa_ruc'],
                    "4"=>$reg['empresa_celular'],
                    "5"=>$reg['empresa_direccion'],
                    "6"=>$reg['empresa_impuesto']." ".$reg['empresa_impuestoValor']."%",
                    "7"=>$reg['empresa_moneda']."-".$reg['empresa_simbolo']
                );
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        }  
        public function show_empresa_controller(){
            $empresa_id=mainModel::decryption($_POST['empresa_id']);
            $empresa_id=mainModel::clean_chain($empresa_id);
            $query=empresaModels::show_empresa_model($empresa_id);
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }     
        public function mostrar_serie_controller(){
            $tipo_comprobante=mainModel::decryption($_POST['tipo_comprobante']);
            $tipo_comprobante=mainModel::clean_chain($tipo_comprobante);
            $query=empresaModels::mostrar_serie_model($tipo_comprobante);
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }  
        public function mostrar_numero_controller(){
            $tipo_comprobante=mainModel::decryption($_GET['tipo_comprobante']);
            $tipo_comprobante=mainModel::clean_chain($tipo_comprobante);
            $query=empresaModels::mostrar_numero_model($tipo_comprobante);
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }  
        public function mostrar_impuesto_controller(){
            $query=empresaModels::mostrar_impuesto_model();
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }
        public function nombre_impuesto_controller(){
            $query=empresaModels::nombre_impuesto_model();
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }   
        public function mostrar_simbolo_controller(){
            $query=empresaModels::mostrar_simbolo_model();
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }    
    }