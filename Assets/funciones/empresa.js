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
		$("#tabla_empresa").hide();
		$('.card-title').html('<i class="fa fa-building mr-1"></i>Actualizar Empresa');
        $("#formulario_empresa").show();
	}else{
		$("#tabla_empresa").show();
		$('.card-title').html('<i class="fa fa-list mr-1"></i>Datos de la empresa');
		$("#formulario_empresa").hide();
	}
}
/*=============================================================================
=============================================================================*/
function hidden()
{
	$('#empresa_id').hide();
	$('#id_logo_pro').hide();
	$('#nombre_empresa').hide();
	$('#avatar').hide();
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
		buttons: [],
		"ajax":
		{
			url:base_url+'/Ajax/empresaAjax.php?op=list',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
        "lengthChange": false,
        "autoWidth": false,
        "responsive": true,
		"bDestroy":true,
        "ordering": false,
        "searching": false,
        "paging": false,
        "info": false,
		"iDisplayLength":6,
		"order":[[0,"desc"]],
		"language": {
			"sProcessing":     "Procesando...",
			"sSearch":         "Buscar:",
			"sZeroRecords":    "Lo sentimos, no se pudo encontrar el registro",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ total entradas)",
			"infoPostFix": "",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"sEmptyTable":     "No hay registros en el sistema",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Loading...",
			"oPaginate": {
				"sFirst":    "First",
				"sLast":     "Latest",
				"sNext":     "<i class='fa fa-chevron-right'></i>",
				"sPrevious": "<i class='fa fa-chevron-left'></i>"
        	}
		}
	}).DataTable();
}
/*=============================================================================
=============================================================================*/
$("#photo").change(function (){
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

  			$("#logo_actual").attr("src", rutaImagen);

  		})

  	}
});
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
$(document).on('submit', '#formLogo', function(e){
	e.preventDefault();  

	var photo = $('#photo').val();

	if(photo != ''){

		var form=$($("#formLogo")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#formLogo")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#msjLogo").html(data);
				$('#logo').modal('hide');
				tabla.ajax.reload();
			},
			error: function(){
				$("#msjLogo").html(msjError);
			}       
		});

	}else{
		$('#logo').modal('hide');
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
$(document).on('click', '.edit', function(){
	var empresa_id = $(this).attr("id");
	$.ajax({
		url:base_url+"/Ajax/empresaAjax.php?op=show",
		method:"POST",
		data:{empresa_id:empresa_id},
		dataType:"json",
		success:function(data)
		{
			showform(true);
			$('#empresa_id').val(data.empresa_id);
			$('.card-title').html('<i class="fa fa-building mr-1"></i>Actualizar Empresa');
            $('#nombre').val(data.empresa_nombre);
            $('#ruc').val(data.empresa_ruc);
            $('#celular').val(data.empresa_celular);
			$('#direccion').val(data.empresa_direccion);
			$('#correo').val(data.empresa_correo);
			$('#nombre_impuesto').val(data.empresa_impuesto);
			$('#monto_impuesto').val(data.empresa_impuestoValor);
			$('#moneda').val(data.empresa_moneda);
			$('#simbolo').val(data.empresa_simbolo);
	
		}
	})
});
/*=============================================================================
=============================================================================*/
$(document).on('click', '.editLogo', function(){
	var empresa_id  = $(this).attr("id");
	$.ajax({
		url:base_url+"/Ajax/empresaAjax.php?op=show",
		method:"POST",
		data:{empresa_id :empresa_id },
		dataType:"json",
		success:function(data)
		{
			$('#logo').modal('show');
			$("#formLogo").trigger("reset");
			$('#logo_titulo').text(data.empresa_nombre);
			$('#nombre_empresa').val(data.empresa_nombre);
			$("#logo_actual").attr("src",data.empresa_logo);
			$('#id_logo_pro').val(data.empresa_id );
			$('#avatar').val(data.empresa_logo);
		}
	})
});
/*=============================================================================
=============================================================================*/
init();