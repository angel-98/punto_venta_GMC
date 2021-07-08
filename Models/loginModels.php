<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class loginModels extends mainModel{
        
        protected function login_model($data){
            $sql=mainModel::connect()->prepare("SELECT * FROM usuario WHERE usuario_login=:Username AND usuario_contrasena=:Pass AND usuario_estado='1'");
            $sql->bindParam(":Username",$data['Username']);
            $sql->bindParam(":Pass",$data['Pass']);
            $sql->execute();
            return $sql; 
        } 
        protected function logout_model($data){

            if ($data['Username']!="" && $data['Token_User']==$data['Token']) {
  
                $update_binnacle=mainModel::update_binnacle($data['Code_binnacle'],$data['End_Time']);
    
                if ($update_binnacle->rowCount()==1) {
                    # cod
                    session_unset();
                    session_destroy();
                    $answer="true";
                }else{
                 $answer="false";
                }
            } else {

                $answer="false";
            }
            return $answer;

        }
 
    }