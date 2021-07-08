<?php
	if (isset($_POST['usuario']) && isset($_POST['clave'])) {
		require_once "./Controllers/loginControllers.php";
		$login = new loginControllers();
		echo $login->login_controller(); 
	}  
?>  
<!-- Vista Login -->

<!-- <div class="login-box">
  	<div class="login-logo">
		<a href="<?= base_url(); ?>">
			<img src="<?= media(); ?>/images/iconos/logo_3.png">
		</a>
	</div>
  	<div class="card">
    	<div class="card-body login-card-body">
			<p class="login-box-msg">-INGRESE SUS CREDENCIALES-</p>
      		<form action="" method="POST" autocomplete="off" >
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="usuario" placeholder="usuario">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="clave" placeholder="contraseña">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
        			<button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
      			<p class="mt-2 mb-0 text-right">Versión 1.0.0</p>
      		</form>
        </div>
  	</div>
</div> -->
<!-- /.Vista Login -->


<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
<div  class="bg-blue py-4"></div>
    <div class="card card0 border-0">
        <div class="row d-flex">
        	
            <div class="col-lg-6">
                <div class="card1 pb-5">
                	 <div class="row"><a href="<?= base_url(); ?>">
							<img class="logo" src="<?= media(); ?>/images/iconos/logo_3.png">
						</a> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <a href="<?= base_url(); ?>">
							<img class="image" src="<?= media(); ?>/images/iconos/medical.svg">
						</a> </div>
               
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
<!--                     <div class="row mb-4 px-3">
                        <a href="<?= base_url(); ?>">
							<img src="<?= media(); ?>/images/iconos/logo_3.png">
						</a>
                    </div> -->
                    <h1><center><strong>LOGIN</strong></center></h1>
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center"></small>
                        <div class="line"></div>
                    </div>
                    <form action="" method="POST" autocomplete="off" >
                    	<label class="mb-2">
                            <h6 class="mb-0 text-sm">Usuario</h6>
                        </label>
					<div class="input-group mb-3">
						
						<input type="text" class="form-control" name="usuario" placeholder="usuario">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<label class="mb-2">
                            <h6 class="mb-0 text-sm">Contraseña</h6>
                        </label>
					<div class="input-group mb-3">
						
						<input type="password" class="form-control" name="clave" placeholder="contraseña">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
        			<button type="submit" class="btn btn-primary btn-block">Iniciar Sesion</button>
      			<p class="mt-2 mb-0 text-right"></p>
      			<div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center"></small>
                        <div class="line"></div>
                    </div>
      		</form>
                    <!-- <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger ">Register</a></small> </div>
                </div> -->
            </div>
        </div>
       <!--  <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2019. All rights reserved.</small>
                <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
            </div>
        </div> -->
    </div>
</div>
<style type="text/css">
	body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #B0BEC5;
    background-repeat: no-repeat
}

.card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px
}

.card2 {
    margin: 0px 40px
}

.logo {
    width: 200px;
    height: 100px;
    margin-top: 20px;
    margin-left: 35px
}

.image {
    width: 360px;
    height: 280px
}

.border-line {
    border-right: 1px solid #EEEEEE
}

.facebook {
    background-color: #3b5998;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.twitter {
    background-color: #1DA1F2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.linkedin {
    background-color: #2867B2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.line {
    height: 1px;
    width: 45%;
    background-color: #E0E0E0;
    margin-top: 10px
}

.or {
    width: 10%;
    font-weight: bold
}

.text-sm {
    font-size: 14px !important
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

a {
    color: inherit;
    cursor: pointer
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer
}

.bg-blue {
    color: #fff;
    background-color: #1A237E
}

@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px
    }

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px
    }
}
</style>
