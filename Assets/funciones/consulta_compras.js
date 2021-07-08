var tabla;
function init()
{
	list();
} 
/*=============================================================================
=============================================================================*/
function clt(){
	list();	
}
/*=============================================================================
=============================================================================*/
function list(){
    var fi = $("#txtF1").val();
    var ff = $("#txtF2").val();
	tabla=$('#tablaRespuesta').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [],
		"ajax":
		{
			url: base_url+"/Ajax/consultaComprasAjax.php?op=list",
            type: "get",
            data:{fi:fi, ff:ff},
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
        "paging": true,
        "lengthChange": false,
        "autoWidth": false,
        "responsive": true, 
		"bDestroy":true,
        "ordering": false,
        "searching": false,
        "info": false,
		"iDisplayLength":6,
		"order":[[0,"desc"]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
	}).DataTable();
}
/*=============================================================================
=============================================================================*/
$(document).on('click', '.edit', function(){
	var compra_id = $(this).attr("id");
	$.ajax({
		url: base_url + "/Ajax/comprasAjax.php?op=show",
		method:"POST",
		data:{compra_id:compra_id},
		dataType:"json",
		success:function(data) 
		{
			$("#detalle_compra").modal('show');
			$('#idcompra').val(data.compra_id);
			$('#proveedorm').val(data.proved_nombre);

			$('#fecha_horam').val(data.compra_fecha);
			$('#tipo_comprobantem').val(data.compra_tipoComprobante);
			$('#serie_comprobantem').val(data.compra_serie);
			$('#num_comprobantem').val(data.compra_numComprobante);
			$('#impuestom').val(data.compra_impuesto);


		}
	});
	$.post(base_url + "/Ajax/comprasAjax.php?op=showDetail&id="+compra_id,function(r){
		$("#detallesm").html(r);
	});
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '#print', function(e){
	Print_Report('purchases');
	e.preventDefault(); 
});
/*=============================================================================
=============================================================================*/
function Print_Report(Criterio)
{


  var fecha1 = $("#txtF1").val();
  var fecha2 = $("#txtF2").val();


   if(fecha1!="" && fecha2!="")
   {
       if(Criterio == 'purchases')
       {
            window.open('../Reports/Compras_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
           'win2',
           'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
           'resizable=yes,width=800,height=800,directories=no,location=no'+
           'fullscreen=yes');
       } 
       else if (Criterio == 'sales') {
            window.open('../Reports/Ventas_Fechas.php?fecha1='+fecha1+'&fecha2='+fecha2,
            'win2',
            'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
            'resizable=yes,width=800,height=800,directories=no,location=no'+
            'fullscreen=yes');
	    }

   } else {
	Swal.fire({
		title: 'Oops!',
		text: 'Debes seleccionar 2 fechas',
		icon: 'info',
		showConfirmButton: false,
		timer: 1500
	});	

   }
}
init(); 