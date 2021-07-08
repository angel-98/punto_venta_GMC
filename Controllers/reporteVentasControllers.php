<?php
    if($ajaxRequest){
        require_once "../Models/reporteVentasModels.php";
    }else{
        require_once "./Models/reporteVentasModels.php";
    }
 
    class reporteVentasControllers extends reporteVentasModels{

        public function count_items_controller(){
            session_start(['name'=>'STR']);
            $day=reporteVentasModels::count_day_model();
            $d= $day->fetch();
            $count_day = $d['total'];
 
            $month=reporteVentasModels::count_month_model();
            $m= $month->fetch();
            $count_month = $m['total'];

            $year=reporteVentasModels::count_year_model();
            $y= $year->fetch();
            $count_year = $y['total'];

            $gan_d=reporteVentasModels::count_profits_day_model();
            $gd= $gan_d->fetch();
            $count_gd = $gd['total'];
            if($count_gd==Null){
                $count_gd =0;
            }

            $gan_m=reporteVentasModels::count_profits_month_model();
            $gm= $gan_m->fetch();
            $count_gm = $gm['total'];
            if($count_gm==Null){
                $count_gm =0;
            }

            $gan_y=reporteVentasModels::count_profits_year_model();
            $gy= $gan_y->fetch();
            $count_gy = $gy['total'];
            if($count_gy==Null){
                $count_gy =0;
            }

            $ventasd=reporteVentasModels::count_ventasd_model();
            $d= $ventasd->fetch();
            $count_ventasd = $d['total'];

            $ventasm=reporteVentasModels::count_ventasm_model();
            $m= $ventasm->fetch();
            $count_ventasm = $m['total'];

            $ventasy=reporteVentasModels::count_ventasy_model();
            $y= $ventasy->fetch();
            $count_ventasy = $y['total'];
            echo 
            '
            <div class="col-12 col-sm-12 col-md-4">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3 class="text-center">'.$count_day.'</h3>
                        <p class="m-0">Total: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_ventasd).'</span></p>
                        <p class="m-0">Ganancia: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_gd).'</span></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-calendar"></i>
                    </div>
                     <a  class="small-box-footer" style="background: rgba(54, 162, 235,0.85);color:#fff !important;">DIARIO</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3 class="text-center">'.$count_month.'</h3>
                        <p class="m-0">Total: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_ventasm).'</span></p>
                        <p class="m-0">Ganancia: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_gm).'</span></p>
                    </div>
                    <div class="icon ">
                        <i class="ion ion-calendar"></i>
                    </div>
                     <a  class="small-box-footer" style="background: rgba(54, 162, 235,0.85);color:#fff !important;">MENSUAL</a>
                </div>
            </div>
                <!-- ./col -->
            <div class="col-12 col-sm-12 col-md-4">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3 class="text-center">'.$count_year.'</h3>
                        <p class="m-0">Total: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_ventasy).'</span></p>
                        <p class="m-0">Ganancia: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].formatMoney($count_gy).'</span></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-calendar-outline"></i>
                    </div>
                     <a  class="small-box-footer" style="background: rgba(54, 162, 235,0.85);color:#fff !important;">ANUAL</a>
                </div>
            </div>
            ';
        }
        public function sales_statistics_controller(){
            $year=$_POST['year'];
            $total = array();
            for($i=0; $i<12; $i++){
                $month = $i+1;
                $sql=reporteVentasModels::sales_statistics_model($year,$month);
                $total[$i] = 0;
                foreach ($sql as $key)
                { 
                    $total[$i] = ($key['total'] == null)? 0 : $key['total']; 
                }
            }
            return json_encode($total);	
        }
        public function seller_controller(){
            $array = array();
            $sql = reporteVentasModels::show_users_model();
            while ($employee = $sql->fetch()){
                $array[]= $employee;
           }
           return json_encode($array);	
        }
        public function sale_seller_controller(){
            session_start(['name'=>'STR']);
            $query=reporteVentasModels::sales_seller_model();
            $data=Array();
            while ($reg=$query->fetch()) {
 
                $data[]=array(
                    "perfil"=>$reg['perfil'],
                    "vendedor"=>$reg['trabajador'],
                    "dni"=>$reg['dni'],
                    "cargo"=>$reg['cargo'],
                    "ventas"=>$reg['ventas'],
                    "ganancias"=>$_SESSION['simbolo_str'].formatMoney($reg['total'])
                );
            }
            $jasonstring = json_encode($data);
            echo $jasonstring;
        }
        public function year_summary_controller(){
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $ventas = reporteVentasModels::year_summary_model();

            echo " 
            <div id='grafico_resumenventas'></div>

            <script type='text/javascript'>
                $('#grafico_resumenventas').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: ''
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                          pie: {
                            showInLegend:true,
                              allowPointSelect: true,
                              cursor: 'pointer',
                              dataLabels: {
                                  enabled: true,
                                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                              }
                          }
                    },
                    series: [{
                        name: 'Porcentaje',
                        colorByPoint: true,
                        data: [
                    ";
                        while ($rspt=$ventas->fetch()){
                            $mes= $output["fecha"]=$meses[date("n", strtotime($rspt["fecha"]))-1];
                            $p = $output["total"]=$rspt["total"];
                        echo " 
                    
                            ['".$mes."', ".$p."],
                            
                        
                        ";
                        } 
                    echo' 
                            ]
                        }]
                });
            </script>
                    ';
        } 
    } 