function init() {
    $("#usuario_id").hide();
	$("#usuario_idi").hide();
	$('#fnacimiento').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
}
/*=============================================================================
=============================================================================*/
$("#photoPerfil").change(function () {
	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$("#photoPerfil").val("");

			Swal.fire({
				title: 'Error al subir la imagen',
				text: '¡La imagen debe estar en formato JPG o PNG!',
				icon: 'error',
				showConfirmButton: false,
				timer: 1500
			});	

  	}else if(imagen["size"] > 2000000){

  		$("#photoPerfil").val("");
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

  			$("#perfilview").attr("src", rutaImagen);

  		})

  	}
});
/*=============================================================================
=============================================================================*/
$(document).on('submit', '#formPassword', function(e){
	e.preventDefault();  

	var passwordOld = $("#passwordNew").val();
	var passwordNew = $("#passwordNew").val();

	if(passwordOld != '' && passwordNew != ''){

		var form=$($("#formPassword")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#formPassword")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#msjPassword").html(data);
				$("#Modalpassword").modal("hide");
			},
			error: function(){
				$("#msjPassword").html(msjError);
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
$(document).on('submit', '#formPerfil', function(e){
	e.preventDefault();  

	var nombre = $("#nombre").val();
	var apellido = $("#apellido").val();
	var dni = $("#dni").val();
	var celular = $("#celular").val();
	var profesion = $("#profesion").val();
	var descripcion = $("#descripcion").val();


	if(nombre != '' && apellido != '' && dni != '' && celular != '' && profesion !='' && descripcion !=''){

		var form=$($("#formPerfil")[0]);

		var method=form.attr('method');
		var action=form.attr('action');
		
		var msjError="<script>swal(title: 'Ocurrió un error inesperado',text: 'Por favor recarga la página',icon: 'error',showConfirmButton: false,timer: 1500);</script>";

		var formdata = new FormData($("#formPerfil")[0]);

		$.ajax({
			type: method,
			url: action,
			data: formdata ? formdata : form.serialize(),
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				$("#msjPerfil").html(data);
				$("#Modalperfil").modal("hide");
			},
			error: function(){
				$("#msjPerfil").html(msjError);
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
$(document).on("click", ".porfile", function () {
	var usuario_id = $(this).attr("id");
	$.ajax({
	  url: base_url + "/Ajax/usuarioAjax.php?op=show",
	  method: "POST",
	  data: { usuario_id: usuario_id },
	  dataType: "json",
	  success: function (data) {
		$("#Modalperfil").modal("show");
		$("#usuario_id").val(data.usuario_id);
		$("#nombre").val(data.usuario_nombre);
		$("#apellido").val(data.usuario_apellido);
		$("#fnacimiento").val(data.usuario_fechanacimiento);
		$("#profesion").val(data.usuario_profesion); 
		$("#dni").val(data.usuario_dni);
		$("#celular").val(data.usuario_celular);
		$("#usuario").val(data.usuario_login);
		$("#descripcion").val(data.usuario_descripcion);
	  },
	});
});
/*=============================================================================
=============================================================================*/
$(document).on("click", ".password", function () {
	var usuario_id = $(this).attr("id");
	$.ajax({
	  url: base_url + "/Ajax/usuarioAjax.php?op=show",
	  method: "POST",
	  data: { usuario_id: usuario_id },
	  dataType: "json",
	  success: function (data) {
        $("#Modalpassword").modal("show");
        $('#formPassword')[0].reset();
		$("#usuario_idi").val(data.usuario_id);
	  },
	});
});
/*=============================================================================
=============================================================================*/
init();
