<?php

ob_start();
if (strlen(session_id())<1) 
session_start(['name' => 'STR']);

if(!isset($_SESSION['token_str'])){
  echo "Debe ingresar al sistema correctamente para visualizar el reporte";
}else{

if ($_SESSION['type_str']=="Administrador" OR $_SESSION['type_str']=="Técnico") {
    $ajaxRequest=true;
    
	  require_once 'ClassTicket.php'; 
	 
    require_once "../Core/generalConfig.php";
    require_once "../Helpers/Helpers.php";
    
    $id=decryption(isset($_GET['id']) ? $_GET['id'] : ''); 

    //obtenemos los datos de la cabecera de la venta actual
    require_once "../Models/empresaModels.php";

    $empresa = new empresaModels(); 

    //$rsptav=$venta->show_model($_GET["id"]);
    $insEmpresa = $empresa->datos_empresa_model();

    //recorremos todos los valores que obtengamos
    $regE  = $insEmpresa->fetchObject();

    //establecemos los datos de la empresa
    $empresa=$regE->empresa_nombre;
    $logo=$regE->empresa_logo;
    $ruc=$regE->empresa_ruc;
    $direccion=$regE->empresa_direccion;
    $telefono=$regE->empresa_celular;
   

    //obtenemos los datos de la cabecera de la venta actual
    require_once "../Models/ventasModels.php";

    $ventas = new ventasModels(); 
    //$rsptav=$venta->show_model($_GET["id"]);
    $insVentas = $ventas->ventacabecera($id);

    //recorremos todos los valores que obtengamos
    $regv  = $insVentas->fetchObject();
	try
	{


        $pdf = new TICKET('P','mm',array(84,297));
        $pdf->AddPage();



		$pdf->SetFont('Arial', '', 12);
		$pdf->SetAutoPageBreak(true,1);

	
        $pdf->Image($logo , 29,1, 30, 20,'png');

        $pdf->setXY(6,22);
        $pdf->MultiCell(73, 4.2, strtoupper($empresa), 0,'C',0 ,1);
    
        $pdf->setXY(6,35);
        $pdf->SetFont('Arial', '', 6.9);
        $pdf->MultiCell(73, 4.2, $telefono, 0,'C',0 ,1);
    
        $get_YD = $pdf->GetY();
    
        $pdf->setXY(6,31);
        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(73, 4.2, 'R.U.C '.$ruc, 0,'C',0 ,1);
    
        $pdf->setXY(6,$get_YD);
		$pdf->MultiCell(73, 4.2,utf8_decode($direccion), 0,'C',0 ,1);
		$pdf->setXY(6,$get_YD+4);
		$pdf->MultiCell(73, 4.2,strtoupper(utf8_decode($regv->comprobante_nombre." : ".$regv->venta_serie."-".$regv->venta_numComprobante)), 0,'C',0 ,1);
		
		$get_YH = $pdf->GetY();

		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(6, $get_YH + 2 , '------------------------------------------------------------------');
		$pdf->SetFont('Arial', 'B', 8.5);
		$pdf->Text(5.8, $get_YH  + 5, 'Transc : '.$regv->venta_codigo);
		//$pdf->Text(55, $get_YH + 5, 'Caja No.: 1');
		$pdf->Text(6, $get_YH + 10, 'Fecha : '.substr(date("d/m/Y", strtotime($regv->venta_fecha)),0,10));
		//$pdf->Text(4, $get_YH + 15, 'No. Ticket : '.$numero_comprobante);
		$pdf->Text(6, $get_YH  + 15, 'Cliente : '.$regv->cliente_nombre);
		$pdf->Text(45, $get_YH  + 5, 'Cajero : '.substr($regv->trabajador, 0,15));
		$pdf->SetFont('Arial', '', 9.2);
		$pdf->Text(6, $get_YH + 18, '------------------------------------------------------------------');

		$pdf->SetXY(5,$get_YH + 19);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Cell(13,4,'Cant.',0,0,'L',1);
		$pdf->Cell(28,4,'Descripcion',0,0,'L',1);
		$pdf->Cell(16,4,'Precio',0,0,'L',1);
		$pdf->Cell(12,4,'Total',0,0,'L',1);
		$pdf->SetFont('Arial','',8.5);
		$pdf->Text(6, $get_YH + 24, '-----------------------------------------------------------------------');
		$pdf->Ln(6);
        $item = 0;

        $insVentaDetalle = $ventas->ventadetalles($id);
        while($row=$insVentaDetalle->fetchObject()){ 
				$monto_actual = $row->detalleVenta_cantidad*$row->detalleVenta_precioV;
				$descuento_actual = ($row->detalleVenta_descuento*$monto_actual)/100;
				$subtotal = $monto_actual - $descuento_actual;

				$item = $item + 1;
				 $pdf->setX(5.1);
				 $pdf->Cell(13,4,$row->detalleVenta_cantidad,0,0,'L'); 
				 $pdf->Cell(28,4,strtoupper(limitar_cadena(utf8_decode($row->prod_nombre),100,"...")),0,0,'L',1);
				 $pdf->Cell(16,4,$row->detalleVenta_precioV,0,0,'L',1);
				 $pdf->Cell(8,4,formatMoney($subtotal),0,0,'L',1);
                 $pdf->Ln(4.5);

                 $get_Y = $pdf->GetY();
                
		
		}
		$inp = 1+($regv->venta_impuesto/100) ;
		$total=$regv->venta_total/$inp;
		$igv=$regv->venta_total-$total;
		$pdf->Text(6, $get_Y+1, '-----------------------------------------------------------------------');
		$pdf->SetFont('Arial','B',8.5);
		$pdf->Text(6,$get_Y + 5,'SUBTOTAL :');
		$pdf->Text(55,$get_Y + 5,formatMoney($total));
		$pdf->Text(6,$get_Y + 10,$regE->empresa_impuesto.' ('.$regv->venta_impuesto.') :');
		$pdf->Text(55,$get_Y + 10,formatMoney($igv));
		$pdf->Text(6,$get_Y + 15,'TOTAL PAGAR :');
		$pdf->Text(55,$get_Y + 15,formatMoney($regv->venta_total));
		$pdf->Text(6, $get_Y+18, '-----------------------------------------------------------------------');

		require_once "Letras.php";

		$V=new EnLetras(); 

		$V->substituir_un_mil_por_mil = true;

		$con_letra=strtoupper($V->ValorEnLetras($regv->venta_total,$_SESSION['money_str'])); 

		$pdf->SetFont('Arial','BI',7.5);
		$pdf->Text(6, $get_Y+23, 'SON : '.$con_letra);
		$pdf->Text(6, $get_Y+28, 'PRECIO EN : '.$_SESSION['money_str']);
		$pdf->SetFont('Arial','B',8);
	
		$pdf->SetFillColor(0,0,0);
		$pdf->Code39(5,$get_Y+33,$regv->venta_serie."-".$regv->venta_numComprobante,0.90,5);
		$pdf->Text(20, $get_Y+45, 'GRACIAS POR SU COMPRA');

	$pdf->Output('','Ticket_'.$regv->comprobante_nombre.'.pdf',true);
	} catch (Exception $e) {

		$pdf->Text(22.8, 5, 'ERROR AL IMPRIMIR TICKET');
		$pdf->Output('I','Ticket_ERROR.pdf',true);

	}
}else{
    echo "No tiene permiso para visualizar el reporte";
}
    
} 
ob_end_flush();