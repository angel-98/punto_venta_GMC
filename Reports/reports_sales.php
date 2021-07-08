<?php
    session_start(['name' => 'STR']);
    if(!isset($_SESSION['token_str'])){
        echo "Usted no inicio sesión correctamente, por favor ingrese para visualizar el reporte.";
    }else{
        if ($_SESSION['type_str']=="Administrador") 
        {

            //Libreria
            require_once "../Assets/vendor/fpdf181/fpdf.php";

            //Datos generales
            require_once "../Core/generalConfig.php";
            require_once "../Helpers/Helpers.php";

            //Autorización
            $ajaxRequest=true; 

            //Modelo Compras
            require_once "../Models/ventasModels.php";

            //Instanciamos un objeto
            $ventas = new ventasModels(); 

            class PDF extends FPDF
            {
                //Header
                function Header()
                {
                    if ($this->page == 1)
                    {
                        //Autorización
                        $ajaxRequest=true; 

                        //Modelo Empresa
                        require_once "../Models/empresaModels.php";

                        //Instanciamos un objeto
                        $empresa = new empresaModels(); 

                        $informacion = $empresa->datos_empresa_model()->fetch();
                        // Logo
                        $this->Image($informacion["empresa_logo"],10,10,15);
                        $this->Image('../Assets/images/iconos/logo.png', 308, 10, 15); 
                        // Arial bold 15
                        $this->SetFont('Arial','B',16);
                        // Move to the right
                        $this->Cell(98);
                        // Title
                        $this->Cell(115,10,strtoupper(utf8_decode("Reporte de ventas - ".$informacion["empresa_nombre"])),0,0,'C');
                        // Line break
                        $this->Ln(20); 
                    }
                }
                //Footer
                function Footer()
                {
                    // Position at 1.5 cm from bottom
                    $this->SetY(-15);
                    // Arial italic 8
                    $this->SetFont('Arial','I',8);
                    // Page number
                    $this->Cell(275,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
                    $this->Cell(43.2,10,date('d/m/Y H:i:s'),0,0,'C');
                }
            }

            $listado = $ventas->reporte_ventas_model();
            try {

                $pdf = new PDF('L','mm',array(216,330));
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Arial','',11);
                $pdf->SetTextColor(47, 47, 47);
                $pdf->SetDrawColor(47,47,47);
                $pdf->SetFillColor(232,232,232);
                $pdf->Cell(35,10,utf8_decode('N° TRANSC.'),0,0,'C',1);
                $pdf->Cell(35,10,'COMPROBANTE',0,0,'C',1);
                $pdf->Cell(35,10,'IMPUESTO',0,0,'C',1);
                $pdf->Cell(40,10,'FECHA',0,0,'C',1);
                $pdf->Cell(90,10,'CLIENTE',0,0,'L',1);
                $pdf->Cell(25,10,'PRODUCTOS',0,0,'C',1);
                $pdf->Cell(22,10,'TOTAL',0,0,'C',1);
                $pdf->Cell(30,10,'ESTADO',0,0,'C',1);
                $pdf->Line(322,30,10,30);
                $pdf->Line(322,40,10,40);
                $pdf->Ln(12);
                $total = 0;
                if (is_array($listado) || is_object($listado))
                {
                    foreach ($listado as $row => $column) {
                        
                        $productos = $ventas->cantidad_productos_model($column["venta_id"]);
                        foreach ($productos as $row => $quanty) {
                            $cantidad = $quanty["total"];
                        }
                        if($column["venta_estado"]== "1"){
                            $estado = "Pagada";
                        }else{
                            $estado = "Anulada";
                        }

                        $pdf->setX(9);
                        $pdf->SetDrawColor(47,47,47);
                        $pdf->SetFillColor(255,255,255);
                        $pdf->Cell(35,5,$column["venta_serie"].'-'.$column["venta_numComprobante"],0,0,'C',1);
                        $pdf->Cell(35,5,$column["comprobante_nombre"],0,0,'C',1);
                        $pdf->Cell(35,5,formatMoney($column["venta_impuesto"]),0,0,'C',1);
                        $pdf->Cell(40,5, date("d/m/Y", strtotime($column["venta_fecha"])),0,0,'C',1);
                        $pdf->Cell(90,5,$column["cliente_nombre"],0,0,'L',1);
                        $pdf->Cell(25,5,$cantidad,0,0,'C',1);
                        $pdf->Cell(22,5,formatMoney($column["venta_total"]),0,0,'C',1);
                        $pdf->Cell(30,5,$estado,0,0,'C',1);
                        
                        $total = $total + $column["venta_total"];
                        $pdf->Ln(6);
                        $get_Y = $pdf->GetY();
                    }

                    $pdf->Line(322,$get_Y+1,10,$get_Y+1);
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Text(10,$get_Y + 10,'MONTO TOTAL : '.formatMoney($total));

                }
                $pdf->Output('I','reporte_de_ventas.pdf');

            } catch (Exception $e) {

                $pdf = new PDF();
                $pdf->AliasNbPages();
                $pdf->AddPage('L','Letter');
                $pdf->Text(50,50,'ERROR AL IMPRIMIR');
                $pdf->SetFont('Times','',12);
                $pdf->Output();

            }
        }
        else
        {
            echo "Usted no tiene los permisos necesarios para visualizar el reporte.";
        }
    }