var tabla;
function init()
{
	showform(false);
	listar();
	hidden();
}
/*=============================================================================
=============================================================================*/
function showform(flag)
{
	clean();
	if(flag){
        $("#tabla_comprobante").hide();
		$('#btnShows').hide();
		$('.card-title').html('<i class="fa fa-file-pdf mr-1"></i>Registrar comprobante');
        $("#formulario_comprobante").show();
	}else{
		$('#btnShows').show();
		$('.card-title').html('<i class="fa fa-list mr-1"></i>Lista de comprobantes');
		$("#tabla_comprobante").show();
		$("#formulario_comprobante").hide();
	}
}
/*=============================================================================
=============================================================================*/
function hidden()
{
	$('#comprobante_id').hide();
}
/*=============================================================================
=============================================================================*/
function clean()
{
    $('#form')[0].reset();
}
/*=============================================================================
=============================================================================*/
function hideform()
{
	clean();
	showform(false);
}
/*=============================================================================
=============================================================================*/
function listar(){
	tabla=$('#tablaRespuesta').dataTable({
		"aProcessing": true,
		"aServerSide": true,
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				text:'<i class="fa fa-file-excel"></i> Excel',
				titleAttr: 'Exportar a Excel',
				title: company + ' - Reporte de Comprobantes',
			},
			{
				extend: 'csvHtml5',
				text:'<i class="fa fa-table"></i> CSV',
				titleAttr: 'Exportar a Csv',
				title: company + ' - Reporte de Comprobantes',
			},
			{	
				extend: 'pdfHtml5',
				text:'<i class="fa fa-file-pdf"></i> PDF',
				titleAttr: 'Exportar a PDF',
				title: company + ' - Reporte de Comprobantes',

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
			url:base_url+'/Ajax/comprobanteAjax.php?op=list',
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
$(document).on('submit', '#form', function(e){
	e.preventDefault();  

    var nombre = $('#nombre').val();
    var letraSerie = $('#letraSerie').val();
    var serie = $('#serie').val();
    var numeroSerie = $('#numeroSerie').val();

	if(nombre != '' && letraSerie != '' && serie != '' && numeroSerie != ''){

		var form=$($("#form")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#form")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#ajaxAnswer").html(data);
				showform(false);
				tabla.ajax.reload();
			},
			error: function(){
				$("#ajaxAnswer").html(msjError);
			}       
		});
	}else{
		Swal.fire({
			title: 'Oops',
			text: 'Por favor,rellene todos los campos',
			icon: 'info',
			showConfirmButton: false,
			timer: 1500
		});			
	}
}); 
/*=============================================================================
=============================================================================*/
$(document).on("click", ".desactivate", function () {
	var comprobante_id = $(this).attr("id");
	$.ajax({
	  url: base_url + "/Ajax/comprobanteAjax.php?op=deactivate",
	  method: "POST",
	  data: { comprobante_id: comprobante_id },
	  success: function (data) {
		$("#ajaxAnswer").html(data);
		tabla.ajax.reload();
	  },
	});
  });
  /*=============================================================================
  =============================================================================*/
  $(document).on("click", ".activate", function () {
	var comprobante_id = $(this).attr("id");
	$.ajax({
	  url: base_url + "/Ajax/comprobanteAjax.php?op=activate",
	  method: "POST",
	  data: { comprobante_id: comprobante_id },
	  success: function (data) {
		$("#ajaxAnswer").html(data);
		tabla.ajax.reload();
	  },
	});
  });
/*=============================================================================
=============================================================================*/
$(document).on('click', '.delete', function(){
	var comprobante_id = $(this).attr("id");
	Swal.fire({
		title: "Eliminar",
		text: "¿Seguro que desea eliminar?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: '#7cd1f9',
		cancelButtonColor: '#f27474',
		confirmButtonText: 'Aceptar',
		cancelButtonText: ' Cancelar'
	}).then(result => {
		if (result.value) {
			$.ajax({
				url: base_url+"/Ajax/comprobanteAjax.php?op=delete",
				method:"POST",
				data:{comprobante_id:comprobante_id},
				success:function(data)
				{
					$("#ajaxAnswer").html(data);
					tabla.ajax.reload();
				}
			});
		}else{
			Swal.fire("Cancelado!", "Operacion cancelada", "error");
		}
	});
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '.edit', function(){
	var comprobante_id = $(this).attr("id");
	$.ajax({
		url:base_url+"/Ajax/comprobanteAjax.php?op=show",
		method:"POST",
		data:{comprobante_id:comprobante_id},
		dataType:"json",
		success:function(data)
		{
			showform(true);
			$('.card-title').html('<i class="fa fa-file-pdf mr-1"></i>Actualizar comprobante');
			$('#comprobante_id').val(data.comprobante_id);
            $('#nombre').val(data.comprobante_nombre);
            $('#letraSerie').val(data.comprobante_letraSerie);
            $('#serie').val(data.comprobante_serie);
            $('#numeroSerie').val(data.comprobante_numero);
	
		}
	})
});
/*=============================================================================
=============================================================================*/
init();