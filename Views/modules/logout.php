<script>
    jQuery(function ($){
        $('#btn-exit-system').on('click', function(e){
            e.preventDefault();
            var Token=$(this).attr('href');
            Swal.fire({
                title: '¿Estas seguro ?',
                text: "La sesion actual se cerrara y deberas iniciar sesion nuevamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#7cd1f9',
                cancelButtonColor: '#f27474',
                confirmButtonText: 'Si, Cerrar sesion',
                cancelButtonText: 'No, Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'<?= base_url();?>/Ajax/loginAjax.php?Token='+Token,
                        success:function(data){
                            if (data=="true") {
                                window.location.href="<?= base_url();?>/login/";
                            } else {
                                Swal.fire(
                                    "Ocurrio un problema",
                                    "No se pudo cerrar la sesion",
                                    "error"
                                );
                            }
                        }
                    });
                }else{
                    Swal.fire(
                        'Cancelado',
                        'Cancelaste el cierre de sesion',
                        'error'
                    )
                }
            });
        });
    });
</script>