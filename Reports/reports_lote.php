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
            require_once "../Models/loteModels.php";

            //Instanciamos un objeto
            $lote = new loteModels(); 

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
                        $this->Cell(115,10,strtoupper(utf8_decode("Reporte de lotes - ".$informacion["empresa_nombre"])),0,0,'C');
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

            $listado = $lote->report_lote_model();
            try {

                $pdf = new PDF('L','mm',array(216,330));
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Arial','',11);
                $pdf->SetTextColor(47, 47, 47);
                $pdf->SetDrawColor(47,47,47);
                $pdf->SetFillColor(232,232,232);
                $pdf->Cell(30,10,'CODIGO',0,0,'C',1);
                $pdf->Cell(100,10,'PRODUCTO',0,0,'L',1);
                $pdf->Cell(20,10,'CANTIDAD',0,0,'C',1);
                $pdf->Cell(35,10,utf8_decode('VENCIMIENTO'),0,0,'C',1);
                $pdf->Cell(50,10,utf8_decode('PRESENTACIÓN'),0,0,'L',1);
                $pdf->Cell(47,10,'PROVEEDOR',0,0,'L',1);
                $pdf->Cell(30,10,'ESTADO',0,0,'C',1);
                $pdf->Line(322,30,10,30);
                $pdf->Line(322,40,10,40);
                $pdf->Ln(12);

                $fecha_actual = new DateTime(); 

                if (is_array($listado) || is_object($listado))
                {
                    foreach ($listado as $row => $column) {
                        
                        $vencimiento = new DateTime($column["lote_fechaVencimiento"]);
                        $diferencia = $vencimiento->diff($fecha_actual);
                        $dia = $diferencia->days;
                        $verificado = $diferencia->invert;
                        if($verificado == 0){
                            $estado = 'Vencido';
                        }else{
                            if($dia > 90 ){
                                $estado = 'No vencido';
                            }
                            if($dia <= 90){
                                $estado = 'Por vencer';
                            }
                        }

                        $pdf->setX(9);
                        $pdf->SetDrawColor(47,47,47);
                        $pdf->SetFillColor(255,255,255);
                        $pdf->Cell(30,5,$column["lote_codigo"],0,0,'C',1);
                        $pdf->Cell(100,5,limitar_cadena(utf8_decode($column["prod_nombre"]." ".$column["prod_concentracion"]),40,".."),0,0,'L',1);
                        $pdf->Cell(20,5,$column["lote_cantUnitario"],0,0,'C',1);
                        $pdf->Cell(35,5,date("d/m/Y", strtotime($column["lote_fechaVencimiento"])),0,0,'C',1);
                        $pdf->Cell(50,5,limitar_cadena(utf8_decode($column["present_nombre"]),15,".."),0,0,'L',1);
                        $pdf->Cell(47,5,limitar_cadena(utf8_decode($column["proved_nombre"]),15,".."),0,0,'L',1);
                        $pdf->Cell(30,5,$estado,0,0,'C',1);

                        $pdf->Ln(6);
                        $get_Y = $pdf->GetY();
                    }

                    $pdf->Line(322,$get_Y+1,10,$get_Y+1);
                    $pdf->SetFont('Arial','B',11);
                   

                }
                $pdf->Output('I','reporte_de_lotes.pdf');

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