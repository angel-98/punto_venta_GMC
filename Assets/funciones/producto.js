var tabla;
function init()
{
	showform(false);
	$(".porcentaje").on( 'change', function() {
		if( $(this).is(':checked') ) {
			$("#precioV").prop("readonly",true);
		} else {
			$("#precioV").prop("readonly",false);
		}
	});
	hidden();
	listar();
	proveedor();
	laboratorio();
	categoria();
	prsentacion();
	$("#precioC").change(function(){

		if($(".porcentaje").prop("checked")){
	
			var valorPorcentaje = $(".nuevoPorcentaje").val();
			
			var porcentaje = Number(($("#precioC").val()*valorPorcentaje/100))+Number($("#precioC").val());
	
	
			$("#precioV").val(porcentaje);
			$("#precioV").prop("readonly",true);
	
		}
	});
	$(".nuevoPorcentaje").change(function(){

		if($(".porcentaje").prop("checked")){

			var valorPorcentaje = $(this).val();
			
			var porcentaje = Number(($("#precioC").val()*valorPorcentaje/100))+Number($("#precioC").val());


			$("#precioV").val(porcentaje);
			$("#precioV").prop("readonly",true);

		}

	});

}
/*=============================================================================
=============================================================================*/
function showform(flag)
{
	clean();
	if(flag){
        $("#tabla_productos").hide();
		$('#btnShows').hide();
		$('.card-title').html('<i class="fa fa-capsules mr-1"></i>Registrar producto');
        $("#formulario_productos").show();
	}else{
		$('#btnShows').show();
		$('.card-title').html('<i class="fa fa-list mr-1"></i>Lista de productos');
		$("#tabla_productos").show();
		$("#formulario_productos").hide();
	}
}
/*=============================================================================
=============================================================================*/
function hidden()
{
	$('#prod_id').hide();
	$('#id_logo_pro').hide();
	$('#nombre_producto').hide();
	$('#avatar').hide();
	$('#prod_id').hide();
	$('#lote_id_product').hide();
} 
/*=============================================================================
=============================================================================*/
function clean()
{
	$('#form')[0].reset();
	$('#laboratorio').trigger('change.select2'); 
	$('#categoria').trigger('change.select2'); 
	$('#presentacion').trigger('change.select2'); 
	$("#producto").prop("readonly", false);
	$("#codigo").prop("readonly", false);
	$("#precioV").prop("readonly",true);
	$('.porcentaje').prop('checked', true);
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
function proveedor(){
	$.post(base_url+"/Ajax/productoAjax.php?op=selectP", function(r){
		$("#proveedor").html(r);
		$("#proveedor").select2(
			{theme: 'bootstrap4'}
		);
	});
}
/*=============================================================================
=============================================================================*/
function laboratorio(){
	$.post(base_url+"/Ajax/productoAjax.php?op=selectL", function(r){
		$("#laboratorio").html(r);
		$("#laboratorio").select2(
			{theme: 'bootstrap4'}
		);
	});
}
/*=============================================================================
=============================================================================*/
function categoria(){
	$.post(base_url+"/Ajax/productoAjax.php?op=selectC", function(r){
		$("#categoria").html(r);
		$("#categoria").select2(
			{theme: 'bootstrap4'}
		);
	});
}
/*=============================================================================
=============================================================================*/
function prsentacion(){
	$.post(base_url+"/Ajax/productoAjax.php?op=selectPre", function(r){
		$("#presentacion").html(r);
		$("#presentacion").select2(
			{theme: 'bootstrap4'}
		);
	});
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
				title: company + ' - Reporte de Productos',
			},
			{
				extend: 'csvHtml5',
				text:'<i class="fa fa-table"></i> CSV',
				titleAttr: 'Exportar a Csv',
				title: company + ' - Reporte de Productos',
			},
			{	
				extend: 'pdfHtml5',
				text:'<i class="fa fa-file-pdf"></i> PDF',
				titleAttr: 'Exportar a PDF',
				title: company + ' - Reporte de Productos',

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
			url: base_url+'/Ajax/productoAjax.php?op=list',
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
$("#photo").change(function () {
	var imagen = this.files[0];
	
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$("#photo").val("");

			Swal.fire({
				title: 'Error al subir la imagen',
				text: '¡La imagen debe estar en formato JPG o PNG!',
				icon: 'error',
				showConfirmButton: false,
				timer: 1500
			});	

  	}else if(imagen["size"] > 2000000){

  		$("#photo").val("");
			Swal.fire({
				title: 'Error al subir la imagen',
				text: '¡La imagen no debe pesar más de 2MB!',
				icon: 'error',
				showConfirmButton: false,
				timer: 1500
			});	
  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$("#image_actual").attr("src", rutaImagen);

  		})

  	}
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '.addLote', function(){
	var prod_id = $(this).attr("id");
	$.ajax({
		url: base_url+"/Ajax/productoAjax.php?op=show",
		method:"POST",
		data:{prod_id:prod_id},
		dataType:"json",
		success:function(data)
		{
			$('#lote').modal('show');
			$("#formLote").trigger("reset");
			$('#titleP').text(data.prod_nombre);
			$('#lote_id_product').val(data.prod_id);
		}
	})
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '.editarImagen', function(){
	var prod_id = $(this).attr("id");
	$.ajax({
		url: base_url+"/Ajax/productoAjax.php?op=show",
		method:"POST",
		data:{prod_id:prod_id},
		dataType:"json",
		success:function(data)
		{
			$('#imagen').modal('show');
			$("#formImagen").trigger("reset");
			$('#image_titulo').text(data.prod_nombre);
			$('#nombre_producto').val(data.prod_nombre);
			$("#image_actual").attr("src",data.prod_imagen);
			$('#id_logo_pro').val(data.prod_id);
			$('#avatar').val(data.prod_imagen);
		}
	})
});
/*=============================================================================
=============================================================================*/
$(document).on('submit', '#form', function(e){
	e.preventDefault();  

	var producto = $('#producto').val();
	var codigo = $('#codigo').val();
	var concentracion = $('#concentracion').val();
	var adicional = $('#adicional').val();
	var precioC = $('#precioC').val();
	var precioV = $('#precioV').val();
	var laboratorio = $('#laboratorio').val();
	var categoria = $('#categoria').val();
	var presentacion = $('#presentacion').val();


	if(producto != '' && codigo != '' && concentracion != '' && adicional != '' && precioC != '' && precioV != '' && laboratorio != '0' && categoria != '0' && presentacion != '0'){

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
$(document).on('submit', '#formLote', function(e){
	e.preventDefault();  

	var proveedor = $('#proveedor').val();
	var stock = $('#stock').val();
	var fechaV = $('#fechaV').val();

	if(proveedor != '0' && stock != '' && fechaV != ''){

		var form=$($("#formLote")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#formLote")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#msjLote").html(data);
				$('#lote').modal('hide');
				tabla.ajax.reload();
			},
			error: function(){
				$("#msjLote").html(msjError);
			}       
		});

	}else{
		$('#lote').modal('hide');
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
$(document).on('submit', '#formImagen', function(e){
	e.preventDefault();  

	var photo = $('#photo').val();

	if(photo != ''){

		var form=$($("#formImagen")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#formImagen")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#msjImagen").html(data);
				$('#imagen').modal('hide');
				tabla.ajax.reload();
			},
			error: function(){
				$("#msjImagen").html(msjError);
			}       
		});

	}else{
		$('#imagen').modal('hide');
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
$(document).on('click', '.delete', function(){
	var prod_id  = $(this).attr("id");
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
				url: base_url+"/Ajax/productoAjax.php?op=delete",
				method:"POST",
				data:{prod_id :prod_id },
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
	var prod_id = $(this).attr("id");
	$.ajax({
		url: base_url+"/Ajax/productoAjax.php?op=show",
		method:"POST",
		data:{prod_id:prod_id},
		dataType:"json",
		success:function(data)
		{
			showform(true);
			$('.card-title').html('<i class="fa fa-capsules mr-1"></i>Actualizar producto');
			$('#prod_id').val(data.prod_id);
			$('#producto').val(data.prod_nombre);
			//$("#producto").prop("readonly", true);
			$('#codigo').val(data.prod_codigo);
			//$("#codigo").prop("readonly", true);
			$('#concentracion').val(data.prod_concentracion);
			$('#adicional').val(data.prod_adicional);
			$('#precioC').val(data.prod_precioC);
			$('#precioV').val(data.prod_precioV);
			$("#precioV").prop("readonly",true);
			$('#porcentaje_prod').val(data.prod_porcentaje);
			$('.porcentaje').prop('checked', true);
			$('#laboratorio').val(data.prod_id_lab);
			$('#laboratorio').trigger('change.select2'); 
			$('#categoria').val(data.prod_id_tipo);
			$('#categoria').trigger('change.select2'); 
			$('#presentacion').val(data.prod_id_present);
			$('#presentacion').trigger('change.select2'); 

		}
	})
});
/*=============================================================================
=============================================================================*/
$('body').barcodeListener().on('barcode.valid', function(e, code){
    $('#codigo').val(code)
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '#print', function(e){
	Print_Report('product');
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

}
/*=============================================================================
=============================================================================*/
init();