<?php
    if($ajaxRequest){
        require_once "../Core/config.php";
    }else{
        require_once "./Core/config.php";
    }
    class mainModel{

        protected function connect(){
            
            $link = new PDO(SGBD,DB_USER,DB_PASSWORD);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("SET NAMES 'utf8'");
            return $link;

        }
        protected function run_simple_query($query){

            $answer=self::connect()->prepare($query);
            $answer->execute();
            return $answer;

        }
        protected function save_binnacle($data){

            $sql=self::connect()->prepare("INSERT INTO bitacora(bitacora_codigo,bitacora_fecha,bitacora_horaInicio,bitacora_horaFin,bitacora_tipoUsuario,bitacora_ano,bitacora_id_usuario) VALUES(:Code,:Date,:StartTime,:EndTime,:Type,:Year,:AccountCode)");
            $sql->bindParam(":Code",$data['Code']);
            $sql->bindParam(":Date",$data['Date']);
            $sql->bindParam(":StartTime",$data['StartTime']);
            $sql->bindParam(":EndTime",$data['EndTime']); 
            $sql->bindParam(":Type",$data['Type']);
            $sql->bindParam(":Year",$data['Year']);
            $sql->bindParam(":AccountCode",$data['AccountCode']);
            $sql->execute();
            return $sql;

        }
        protected function update_binnacle($code,$time){

            $sql=self::connect()->prepare("UPDATE bitacora SET bitacora_horaFin=:EndTime WHERE  bitacora_codigo=:Code");
            $sql->bindParam(":EndTime",$time);
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;

        }
        protected function delete_binnacle($code){
            $sql=self::connect()->prepare("DELETE FROM bitacora WHERE bitacora_id_usuario=:Code");
            $sql->bindParam(":Code",$code);
            $sql->execute();
            return $sql;

        }
        public  function encryption($string){

			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
            return $output;
            
		}
		public  function decryption($string){

			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
            return $output;
            
        }
        protected function random_code($letter,$length,$number){

            for($i=1; $i<=$length ; $i++){
                $num = rand(0,9);
                $letter.=$num;
            }
            return $letter.$number;

        } 
        protected function clean_chain($chain){

            $chain=preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $chain);//limpiar espacios entre palabras
            $chain=trim($chain); //quitar los espaicos en blanco
            $chain=stripslashes($chain); //quitar barras invertidas
            $chain=str_ireplace("<script>","", $chain); //remplezar los valores
            $chain=str_ireplace("</script>","", $chain); //remplezar los valores
            $chain=str_ireplace("<script src","", $chain); //remplezar los valores
            $chain=str_ireplace("<script type=","", $chain); //remplezar los valores
            $chain=str_ireplace("SELECT * FROM","", $chain); //remplezar los valores
            $chain=str_ireplace("DELETE  FROM","", $chain); //remplezar los valores
            $chain=str_ireplace("INSERT INTO","", $chain); //remplezar los valores
            $chain=str_ireplace("--","", $chain); //remplezar los valores
            $chain=str_ireplace("(+51)","", $chain); //remplezar los valores
            $chain=str_ireplace("^","", $chain); //remplezar los valores
            $chain=str_ireplace("[","", $chain); //remplezar los valores
            $chain=str_ireplace("]","", $chain); //remplezar los valores
            $chain=str_ireplace("==","", $chain); //remplezar los valores
            $chain=str_ireplace(";","", $chain); //remplezar los valores
            return $chain;

        }
        protected function sweet_alert($data){

            if($data['Alert']=="simple"){
                $alert="
                    <script>
                    Swal.fire({
                            title: '".$data['title']."',
                            text: '".$data['text']."',
                            icon: '".$data['icon']."',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                 
                ";
            }elseif($data['Alert']=="sales"){ 
                $alert="
                    <script>
                    Swal.fire({
                            title: '".$data['title']."',
                            text: '".$data['text']."',
                            icon: '".$data['icon']."',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href='".base_url()."/sales_list/';
                            } 
                        });
                    </script>
            ";
            }elseif($data['Alert']=="recharge"){ 
                $alert="
                    <script>
                    Swal.fire({
                            title: '".$data['title']."',
                            text: '".$data['text']."',
                            icon: '".$data['icon']."',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    </script>
            ";
            }elseif($data['Alert']=="clean"){
                $alert="
             
                    <script>
                    Swal.fire({ 
                        title: '".$data['title']."',
                        text: '".$data['text']."',
                        icon: '".$data['icon']."',
                        showConfirmButton: false,
			            timer: 1500,
                        confirmButtonText: 'Aceptar'
                    }).then(function () {
                        $('#form')[0].reset();
                    });
                </script>
            ";
            }
            return $alert;
        }
    }