var tabla;
function init()
{
	list();
}
function list(){
	tabla=$('#tablaRespuesta').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				text:'<i class="fa fa-file-excel"></i> Excel',
				titleAttr: 'Exportar a Excel',
				title: company + ' - Reporte de Ventas',
			},
			{
				extend: 'csvHtml5',
				text:'<i class="fa fa-table"></i> CSV',
				titleAttr: 'Exportar a Csv',
				title: company + ' - Reporte de Ventas',
			},
			{	
				extend: 'pdfHtml5',
				text:'<i class="fa fa-file-pdf"></i> PDF',
				titleAttr: 'Exportar a PDF',
				title: company + ' - Reporte de Ventas',

			}
			,
			{
				extend: 'colvis',
				 text:'<i class="fa fa-eye"></i> Seleccionar campos',
				titleAttr: 'Selecciona los campos a exportar',

			}
		],
		"ajax":
		{
			url: base_url+"/Ajax/ventasAjax.php?op=list",
			type: "get",
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
$(document).on("click", ".anular", function () {
	var venta_id = $(this).attr("id");
	$.ajax({
	  url: base_url + "/Ajax/ventasAjax.php?op=anular",
	  method: "POST",
	  data: { venta_id: venta_id },
	  success: function (data) {
		  console.log(data)
		$("#ajaxAnswer").html(data);
		list();
	  },
	});
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '.edit', function(){
	var venta_id = $(this).attr("id");
	$.ajax({
		url: base_url + "/Ajax/ventasAjax.php?op=show",
		method:"POST",
		data:{venta_id:venta_id},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			$("#detalle_venta").modal('show');
			$("#cliente").val(data.cliente_nombre);
			$("#tipo_comprobantem").val(data.comprobante_nombre);
			$("#serie_comprobantem").val(data.venta_serie);
			$("#num_comprobantem").val(data.venta_numComprobante);
			$("#fecha_horam").val(data.venta_fecha);
			$("#impuestom").val(data.venta_impuesto);
			$("#idventam").val(data.venta_id);
	

		}
	});
	$.post(base_url + "/Ajax/ventasAjax.php?op=showDetail&id="+venta_id,function(r){
		$("#detallesm").html(r);
	});
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '#print', function(e){
	Print_Report('sales');
	e.preventDefault(); 
});
/*=============================================================================
=============================================================================*/
function Print_Report(Criterio)
{

    if(Criterio == 'sales')
    {
        window.open('../Reports/reports_sales.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else if (Criterio == 'purchases') {
        window.open('../Reports/reports_purchases.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else if (Criterio == 'product') {
        window.open('../Reports/reports_product.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else if (Criterio == 'lote') {
        window.open('../Reports/reports_lote.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else if (Criterio == 'Ticket') {
        window.open('../Reports/ticket.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else {
        window.open('../Reports/voucher.php',
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}

}
/*=============================================================================
=============================================================================*/
function Print_voucher(Criterio,id)
{

	if (Criterio == 'Ticket') {
        window.open('../Reports/ticket.php?id='+id,
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}
	else {
        window.open('../Reports/voucher.php?id='+id,
        'win2',
        'status=yes,toolbar=yes,scrollbars=yes,titlebar=yes,menubar=yes,'+
        'resizable=yes,width=800,height=800,directories=no,location=no'+
        'fullscreen=yes');
	}

}
/*=============================================================================
=============================================================================*/
init(); 