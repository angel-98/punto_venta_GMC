<?php
    if($ajaxRequest){
        require_once "../Models/inicioModels.php";
    }else{
        require_once "./Models/inicioModels.php";
    }
 
    class inicioControllers extends inicioModels{

        public function count_items_controller(){
            session_start(['name'=>'STR']);
            $code =$_SESSION['code_user_str'];

            $ventas=inicioModels::count_ventas_model();
            $v= $ventas->fetch();
            $count_ventas = $v['total'];

            $day_v=inicioModels::count_dayv_model();
            $dv= $day_v->fetch();
            $count_dayv = $dv['total'];

            $gan_v=inicioModels::count_profitsv_model();
            $gv= $gan_v->fetch();
            $count_gv = $gv['total'];
            if($count_gv==Null){
                $count_gv =0;
            }

            $compras=inicioModels::count_compras_model();
            $c= $compras->fetch();
            $count_compras = $c['total'];

            $day_c=inicioModels::count_dayc_model();
            $dc= $day_c->fetch();
            $count_dayc = $dc['total'];

            $gan_c=inicioModels::count_profitsc_model();
            $gc= $gan_c->fetch();
            $count_gc = $gc['total'];
            if($count_gc==Null){
                $count_gc =0;
            }

            $user=inicioModels::count_usuarios_model($code);
            $u= $user->fetch();
            $count_usuarios = $u['usuarios'];

            $productos=inicioModels::count_productos_model();
            $p= $productos->fetch();
            $count_productos = $p['productos'];
  
            $categorias=inicioModels::count_categorias_model();
            $c= $categorias->fetch();
            $count_categorias = $c['categorias'];

            $clientes=inicioModels::count_clientes_model();
            $cli= $clientes->fetch();
            $count_clientes = $cli['clientes'];

            $comprobantes=inicioModels::count_comprobantes_model();
            $comp= $comprobantes->fetch();
            $count_comprobantes = $comp['comprobantes'];

            $proveedores=inicioModels::count_proveedores_model();
            $pree= $proveedores->fetch();
            $count_proveedores = $pree['proveedores'];

            $laboratorios=inicioModels::count_laboratorios_model();
            $lab= $laboratorios->fetch();
            $count_laboratorios = $lab['laboratorios'];

            $presentaciones=inicioModels::count_presentaciones_model();
            $present= $presentaciones->fetch();
            $count_presentaciones = $present['presentaciones'];
            echo 
            '
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_usuarios.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Empleados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_productos.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Productos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clipboard"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_categorias.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-pricetags"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_clientes.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Clientes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_comprobantes.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Comprobantes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_proveedores.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Proveedores</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-briefcase"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_laboratorios.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Laboratorios</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-funnel"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>'.$count_presentaciones.'</h3>
                        <p style="font-weight: 700 !important;text-transform: uppercase;">Presentaciones</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-pint"></i>
                    </div>
                
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3 class="text-center"><sup style="font-size: 13px">'.$_SESSION['simbolo_str'].' </sup>
                        '.formatMoney($count_ventas).'</h3>
                        <p class="m-0">Ventas: <span style="font-weight: 700 !important;">'.$count_dayv.'</span></p>
                        <p class="m-0">Ganancias: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].$count_gv.'</span></p>
                    </div>
                    <div class="icon" style="color: rgba(37, 144, 62,0.85);">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a  class="small-box-footer" style="background: rgba(0, 123, 255,0.85);color:#fff !important;">VENTAS</a>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3 class="text-center"><sup style="font-size: 13px">'.$_SESSION['simbolo_str'].' </sup>
                        '.formatMoney($count_compras).'</h3>
                        <p class="m-0">Compras: <span style="font-weight: 700 !important;">'.$count_dayc.'</span></p>
                        <p class="m-0">Ganancias: <span style="font-weight: 700 !important;">'.$_SESSION['simbolo_str'].$count_gc.'</span></p>
                    </div>
                    <div class="icon" style="color: rgba(15, 57, 83,0.85);">
                        <i class="ion ion-ios-cart"></i>
                    </div>
                    <a  class="small-box-footer" style="background: rgba(0, 123, 255,0.85);color:#fff !important;">COMPRAS</a>
                </div>
            </div>
            ';
        }
        public function sales_statistics_controller(){
            setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
            $date=strftime("%B, %Y");
            $month_current=date("m");
            $year_current=date("Y");

            $days_array = array();
            $sales = array();
            $purchases = array();
            $total_days = get_total_day_in_month($year_current,$month_current) + 1;
            for ($i=1; $i < $total_days; $i++) {
              $from = date('Y-m-d',strtotime($year_current.'-'.$month_current.'-'.$i));
              $day = date('d', strtotime($from));
              $month = date('m', strtotime($from));
              $year = date('Y', strtotime($from));
              $query_sales = inicioModels::get_sales_model($day,$month,$year)->fetch();
              $query_purchases = inicioModels::get_purchases_model($day,$month,$year)->fetch(); 
              $days_array[] = 'DIA : ' . $i;
      
              $sales[] =  number_format($query_sales['total']);
              $purchases[] = number_format($query_purchases['total']);
      
            }
            echo 
            ' 
            <section class="col-lg-12">
                <div class="card ">
                    <div class="card-header" style="cursor: move;">
                        <h3 class="card-title text-secundary">
                            <i class="fas fa-dollar-sign mr-1"></i>VENTAS VS COMPRAS &rarr; '.$date.'
                        </h3>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="sales-vs-purchases" class="report-chart" height="40"></canvas>
                    </div>
                </div>
            </section>
            <script>
                var chartColors = {
                    red: "rgb(255, 99, 132)",
                    orange: "rgb(255, 159, 64)",
                    yellow: "rgb(255, 205, 86)",
                    green: "rgb(37, 144, 62)",
                    blue: "rgb(54, 162, 235)",
                    purple: "rgb(153, 102, 255)",
                    grey: "rgb(231,233,237)" 
                };
                var color = Chart.helpers.color;
                var labels = '.json_encode($days_array).';
                var sales = '.json_encode($sales).';
                var purchases = '.json_encode($purchases).';
                var ctx = document.getElementById("sales-vs-purchases");
                ctx.height = 80;
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "VENTAS",
                                backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
                                borderColor: chartColors.blue,
                                borderWidth: "1",
                                fill: false,
                                data: sales
                            },
                            {
                                label: "COMPRAS",
                                backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
                                borderColor: chartColors.green,
                                borderWidth: "1",
                                fill: false,
                                data: purchases
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: "index",
                            intersect: false
                        },
                        hover: {
                            mode: "nearest",
                            intersect: true
                        },
                        barPercentage: 0.5
                    }
                });
            </script>
            ';
        }
        public function recently_product_controller(){
            session_start(['name'=>'STR']);
            $query=inicioModels::recently_product_model();
            $data=Array();
            while ($reg=$query->fetch()) {
 
                $data[]=array(
                    "codigo"=>$reg['prod_codigoin'],
                    "producto"=>$reg['prod_nombre'],
                    "descripcion"=>$reg['prod_concentracion'].' '.$reg['prod_adicional'],
                    "precio"=>$_SESSION['simbolo_str'].formatMoney($reg['prod_precioV']),
                    "presentacion"=>$reg['present_nombre'],
                    "imagen"=>$reg['prod_imagen']
  
                );
            }
            $jasonstring = json_encode($data);
            echo $jasonstring;
        } 
        public function most_selled_products_controller(){

            $products = inicioModels::most_selled_products_model();

            echo " 
            <div class=card>
                <div class='card-header'>
                    <h3 class='card-title'><i class='fa fa-chart-pie mr-1'></i>9 productos mas vendidos</h3>
                </div>
                <div class='card-body p-0'>
                    <div id='most_selled_products'></div>
                </div>
            </div>
            <script type='text/javascript'>
                $('#most_selled_products').highcharts({
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
                        while ($rspt=$products->fetch()){
                        echo " 
                    
                            ['".$rspt['producto']."', ".$rspt['cantidad']."],
                            
                        
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