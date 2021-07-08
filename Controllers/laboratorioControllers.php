<?php
    if($ajaxRequest){
        require_once "../Models/laboratorioModels.php";
    }else{
        require_once "./Models/laboratorioModels.php";
    }
 
    class laboratorioControllers extends laboratorioModels{

        public function add_lab_controller(){
            $laboratorio=mainModel::clean_chain($_POST['laboratorio']); 
            $query1=mainModel::run_simple_query("SELECT lab_nombre FROM laboratorio WHERE lab_nombre='$laboratorio'");
            if ($query1->rowCount()>=1) {
                $alert=[
                    "Alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"¡Error! Nombre de laboratorio ya existente",
                    "icon"=>"error"
                ];
            }else{
                $query2=mainModel::run_simple_query("SELECT lab_id FROM laboratorio");
                $number=($query2->rowCount())+1;
                $code_lab=mainModel::random_code("LAB-",6,$number);
                $dataLaboratorio=[
                    "Code"=>$code_lab,
                    "Laboratorio"=>$laboratorio
                ];

                $saveLaboratorio=laboratorioModels::add_lab_model($dataLaboratorio);
                    if ($saveLaboratorio->rowCount()>=1) {
                            $alert=[
                                "Alert"=>"clean",
                                "title"=>"Operacion exitosa",
                                "text"=>"Laboratorio registrado exitosamente",
                                "icon"=>"success"
                            ];
                    } else {
                            $alert=[
                                "Alert"=>"simple",
                                "title"=>"Ocurrió un error inesperado",
                                "text"=>"¡Error! No hemos podido registrar categoría, en este momento",
                                "icon"=>"error"
                            ];
                    }
            }
            return mainModel::sweet_alert($alert);
        }
        public function update_lab_controller(){

            $lab_id=mainModel::clean_chain($_POST['lab_id']);
            $laboratorio=mainModel::clean_chain($_POST['laboratorio']); 

            $query1=mainModel::run_simple_query("SELECT lab_nombre FROM laboratorio WHERE lab_nombre='$laboratorio'");
            if ($query1->rowCount()>=1) {
                $alert=[
                    "Alert"=>"simple",
                    "title"=>"Ocurrió un error inesperado",
                    "text"=>"¡Error! Nombre de laboratorio ya existente",
                    "icon"=>"error"
                ];
                return mainModel::sweet_alert($alert);
                exit();
            }else{
                $dataLab=[
                    "Laboratorio"=>$laboratorio,
                    "Code"=>$lab_id
                ];
                if (laboratorioModels::update_lab_model($dataLab)) {
                    $alert=[
                        "Alert"=>"clean",
                        "title"=>"Operacion exitosa",
                        "text"=>"Datos actualizados exitosamente",
                        "icon"=>"success"
                    ];
                } else {
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Ocurrió un error inesperado",
                        "text"=>"¡Error! No hemos podido actualizar laboratorio, en este momento",
                        "icon"=>"error"
                    ];
                }
            }
       
            return mainModel::sweet_alert($alert);
        }
        public function list_lab_controller(){
            $query = laboratorioModels::list_lab_model();
            $data=Array();
            $i=1;
            while ($reg=$query->fetch()) {
                $data[]=array(
                    "0"=>
                    '<div class="btn-group"><button class="btn btn-default border-info btn-sm edit"   title="Actualizar" id="'.mainModel::encryption($reg['lab_id']).'">
                    <i class="fa fa-edit fa-xs"></i>
                    </button>'.' '.' 
                    <button type="button" class="btn btn-default border-danger btn-sm delete"   title="Eliminar" id="'.mainModel::encryption($reg['lab_id']).'">
                        <i class="fa fa-trash fa-xs"></i>
                    </button></div>',
                    "1"=>$reg['lab_nombre']
                );
                $i++; 
            }
            $results=array(
                     "sEcho"=>1,
                     "iTotalRecords"=>count($data),
                     "iTotalDisplayRecords"=>count($data),
                     "aaData"=>$data);
            echo json_encode($results);
        }  
        public function delete_lab_controller(){
            $lab_id=mainModel::decryption($_POST['lab_id']);
            $lab_id=mainModel::clean_chain($lab_id);
           
            $query=mainModel::run_simple_query("SELECT prod_id_lab  FROM producto WHERE prod_id_lab ='$lab_id'");
                if ($query->rowCount()==1){             
                    $alert=[
                        "Alert"=>"simple",
                        "title"=>"Ocurrió un error inesperado",
                        "text"=>"¡Error! Laboratorio asociado a un producto",
                        "icon"=>"error"
                    ];
                } else {
                
                    $category=laboratorioModels::delete_lab_model($lab_id);                 
                    if ($category->rowCount()>=1) {                 
                        $alert=[
                            "Alert"=>"clean",
                            "title"=>"Operacion exitosa",
                            "text"=>"Laboratorio eliminado exitosamente",
                            "icon"=>"success"
                        ];
                    } else {
                        $alert=[
                            "Alert"=>"simple",
                            "title"=>"Ocurrió un error inesperado",
                            "text"=>"¡Error! No hemos podido eliminar laboratorio, en este momento",
                            "icon"=>"error"
                        ];
                    }
                }
     
            return mainModel::sweet_alert($alert);
        }
        public function show_lab_controller(){
            $lab_id=mainModel::decryption($_POST['lab_id']);
            $lab_id=mainModel::clean_chain($lab_id);
            $query=laboratorioModels::show_lab_model($lab_id);
            $rspta= $query->fetch();
            echo json_encode($rspta); 
        }     
    }