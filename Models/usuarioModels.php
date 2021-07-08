<?php
    if($ajaxRequest){
        require_once "../Core/mainModel.php";
    }else{
        require_once "./Core/mainModel.php";
    }

    class usuarioModels extends mainModel{

        protected function add_user_model($data){
            $sql=mainModel::connect()->prepare("INSERT INTO usuario(usuario_codigo,usuario_nombre,usuario_apellido, usuario_dni,usuario_fechanacimiento,usuario_profesion,usuario_celular,usuario_genero,usuario_cargo,usuario_descripcion,usuario_login,usuario_contrasena, usuario_perfil, usuario_estado) VALUES (:Codigo,:Nombre,:Apellido,:Dni,:Nacimiento,:Profesion,:Celular,:Genero,:Cargo,:Descripcion,:Login,:Clave,:Foto,:Estado)");
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Apellido",$data['Apellido']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Nacimiento",$data['Nacimiento']);
            $sql->bindParam(":Profesion",$data['Profesion']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Genero",$data['Genero']);
            $sql->bindParam(":Cargo",$data['Cargo']);
            $sql->bindParam(":Descripcion",$data['Descripcion']);
            $sql->bindParam(":Login",$data['Login']); 
            $sql->bindParam(":Clave",$data['Clave']);
            $sql->bindParam(":Foto",$data['Foto']);
            $sql->bindParam(":Estado",$data['Estado']);
            $sql->execute();
            return $sql;
        }
        protected function update_user_model($data){
            $sql=mainModel::connect()->prepare("UPDATE usuario SET 
            usuario_nombre=:Nombre,
            usuario_apellido=:Apellido,
            usuario_dni=:Dni,
            usuario_fechanacimiento=:Nacimiento,
            usuario_profesion=:Profesion,
            usuario_celular=:Celular,
            usuario_genero=:Genero,
            usuario_cargo=:Cargo,
            usuario_descripcion=:Descripcion,
            usuario_login=:Login,
            usuario_contrasena=:Clave,
            usuario_perfil=:Foto 
            WHERE usuario_id=:Codigo");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Apellido",$data['Apellido']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Nacimiento",$data['Nacimiento']);
            $sql->bindParam(":Profesion",$data['Profesion']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Genero",$data['Genero']);
            $sql->bindParam(":Cargo",$data['Cargo']);
            $sql->bindParam(":Descripcion",$data['Descripcion']);
            $sql->bindParam(":Login",$data['Login']);
            $sql->bindParam(":Clave",$data['Clave']);
            $sql->bindParam(":Foto",$data['Foto']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function update_perfil_model($data){
            $sql=mainModel::connect()->prepare("UPDATE usuario SET 
            usuario_nombre=:Nombre,
            usuario_apellido=:Apellido,
            usuario_fechanacimiento=:Nacimiento,
            usuario_dni=:Dni,
            usuario_profesion=:Profesion,
            usuario_celular=:Celular,
            usuario_descripcion=:Descripcion,
            usuario_login=:Usuario
            WHERE usuario_id=:Codigo");
            $sql->bindParam(":Nombre",$data['Nombre']);
            $sql->bindParam(":Apellido",$data['Apellido']);
            $sql->bindParam(":Nacimiento",$data['Nacimiento']);
            $sql->bindParam(":Dni",$data['Dni']);
            $sql->bindParam(":Profesion",$data['Profesion']);
            $sql->bindParam(":Celular",$data['Celular']);
            $sql->bindParam(":Descripcion",$data['Descripcion']);
            $sql->bindParam(":Usuario",$data['Usuario']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function update_password_model($data){
            $sql=mainModel::connect()->prepare("UPDATE usuario SET 
            usuario_contrasena=:Clave
            WHERE usuario_id=:Codigo");
            $sql->bindParam(":Clave",$data['Clave']);
            $sql->bindParam(":Codigo",$data['Codigo']);
            $sql->execute();
            return $sql;
        }
        protected function list_user_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM usuario WHERE usuario_codigo!='$code' AND usuario_id!='1' ORDER BY usuario_id DESC");
            $sql->execute();
            return $sql;
        }
        protected function activate_user_model($code){ 
            $sql=mainModel::connect()->prepare("UPDATE usuario SET usuario_estado='1' WHERE usuario_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function deactivate_user_model($code){ 
            $sql=mainModel::connect()->prepare("UPDATE usuario SET usuario_estado='0' WHERE usuario_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }
        protected function delete_user_model($code){
            $query=mainModel::connect()->prepare("DELETE FROM usuario WHERE usuario_id=:Code");
            $query->bindParam(":Code",$code);
            $query->execute();
            return $query;
        }
        protected function show_user_model($code){ 
            $sql=mainModel::connect()->prepare("SELECT *FROM usuario WHERE usuario_id=:Code");
            $sql->bindParam("Code",$code);
            $sql->execute();
            return $sql;
        }

    }