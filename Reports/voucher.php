<?php 
//activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id())<1) 
session_start(['name' => 'STR']);

if(!isset($_SESSION['token_str'])){
  echo "Debe ingresar al sistema correctamente para visualizar el reporte";
}else{

if ($_SESSION['type_str']=="Administrador" OR $_SESSION['type_str']=="Técnico") {

$ajaxRequest=true; 

//incluimos el archivo factura
require_once "../Core/generalConfig.php";
require_once "../Helpers/Helpers.php";

require_once "ClassVoucher.php";

$id=decryption($_GET['id']); 

//obtenemos los datos de la cabecera de la venta actual
require_once "../Models/empresaModels.php";

$empresa = new empresaModels(); 

//$rsptav=$venta->show_model($_GET["id"]);
$insEmpresa = $empresa->datos_empresa_model();

//recorremos todos los valores que obtengamos
$regE  = $insEmpresa->fetchObject();

//establecemos los datos de la empresa
$logo=$regE->empresa_logo;
$ext_logo="png";
$anulado = "../Assets/images/pordefecto/cancelado.png";
$ext_anulado="png";
$empresa=$regE->empresa_nombre;
$ruc=$regE->empresa_ruc;
$direccion=$regE->empresa_direccion;
$telefono=$regE->empresa_celular;
$email=$regE->empresa_correo;

//obtenemos los datos de la cabecera de la venta actual
require_once "../Models/ventasModels.php";

$ventas = new ventasModels(); 
//$rsptav=$venta->show_model($_GET["id"]);
$insVentas = $ventas->ventacabecera($id);

//recorremos todos los valores que obtengamos
$regv  = $insVentas->fetchObject();

//configuracion de la factura
$pdf = new PDF_Invoice('p','mm','A4');
$pdf->AddPage();
 
//Verificamos si el comprobante esta anulado
if($regv->venta_estado == "0"){
  $pdf->anulado($anulado,$ext_anulado);
}

//enviamos datos de la empresa al metodo addSociete de la clase factura
$pdf->addSociete(utf8_decode(strtoupper($empresa)),
                utf8_decode($direccion)."\n".
                utf8_decode($email)."\n".
                utf8_decode("Telf.  061 789456   /  Celular   +51 ".$telefono),
                $logo,$ext_logo);
                
$pdf->temporaire( "" );
$pdf->addComprobante($ruc,utf8_decode($regv->comprobante_nombre),$regv->venta_serie ."-". $regv->venta_numComprobante);

//enviamos los datos del cliente al metodo addClientAddresse de la clase factura

$pdf->addRazonSocial(utf8_decode($regv->cliente_nombre),
                    utf8_decode($regv->cliente_direccion), 
                    substr($regv->venta_fecha,0,10),
                    utf8_decode("DNI. ".$regv->cliente_dni),
                    utf8_decode("CELULAR. ".$regv->cliente_celular));

//establecemos las columnas que va tener lña seccion donde mostramos los detalles de la venta
$cols=array( "CODIGO"=>25,
	         utf8_decode("DESCRIPCIÓN")=>88,
	         "CANT"=>15,
	         "PRECIO"=>20,
	         "DSCTO"=>20,
	         "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"C",
             utf8_decode("DESCRIPCIÓN")=>"L",
             "CANT"=>"C",
             "PRECIO"=>"C",
             "DSCTO"=>"C",
             "SUBTOTAL"=>"C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols); 

//actualizamos el valor de la coordenada "y" quie sera la ubicacion desde donde empecemos a mostrar los datos 
$y=85;

//obtenemos todos los detalles del a venta actual
$insVentaDetalle = $ventas->ventadetalles($id);

while($regd=$insVentaDetalle->fetchObject()){
  $monto_actual = $regd->detalleVenta_cantidad*$regd->detalleVenta_precioV;
  $descuento_actual = ($regd->detalleVenta_descuento*$monto_actual)/100;
  $subtotal = $monto_actual - $descuento_actual;
  $line = array( "CODIGO"=>"$regd->prod_codigoin",
                 utf8_decode("DESCRIPCIÓN")=>strtoupper(limitar_cadena(utf8_decode("$regd->prod_nombre "." $regd->prod_concentracion "." $regd->prod_adicional"),40,"...")),
                 "CANT"=>"$regd->detalleVenta_cantidad",
                 "PRECIO"=>"$regd->detalleVenta_precioV",  
                 "DSCTO"=>"$regd->detalleVenta_descuento",         
                 "SUBTOTAL"=>formatMoney($subtotal));
  $size = $pdf->addLine( $y, $line ); 
  $y += $size +2; 

}  

/*aqui falta codigo de letras*/
require_once "Letras.php";
 
$total=$regv->venta_total; 
$V=new EnLetras(); 
$V->substituir_un_mil_por_mil = true;

 $con_letra=strtoupper($V->ValorEnLetras($total,$_SESSION['money_str'])); 
$pdf->addCadreTVAs("SON ".utf8_decode($con_letra));

//mostramos el impuesto
$pdf->addTVAs( $regv->venta_impuesto, $regv->venta_total,$regE->empresa_simbolo); 
$pdf->addCadreEurosFrancs("$regE->empresa_impuesto"." $regv->venta_impuesto %");
$pdf->Output($regv->comprobante_nombre.'-'.substr($regv->venta_fecha,0,10).'.pdf','i');

}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
