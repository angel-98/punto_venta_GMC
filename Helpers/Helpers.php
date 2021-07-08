<?php
    
    //Retorna url del proyecto
    function base_url()
    {
        return BASE_URL;
    }

    //Retorna url del assets
    function media()
    {
        return BASE_URL."/Assets";
    }
    
    //Formato de moneda
    function formatMoney($quanty)
    {
        $quanty = number_format($quanty,2,SPD,SPM);
        return $quanty;
    } 

    //Desencriptar
    function decryption($string)
    {

        $key=hash('sha256', SECRET_KEYC);
        $iv=substr(hash('sha256', SECRET_IVC), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHODC, $key, 0, $iv);
        return $output;
        
    }

    //Encriptar
    function encryption($string)
    {

        $output=FALSE;
        $key=hash('sha256', SECRET_KEYC);
        $iv=substr(hash('sha256', SECRET_IVC), 0, 16);
        $output=openssl_encrypt($string, METHODC, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
        
    }

    function dep($data)
    {
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    //Calcular edad
    function calcularedad($fechanacimiento)
    {
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
    }

    function conocerDiaSemanaFecha($fecha) {

        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    
        $dia = $dias[date('w', strtotime($fecha))];
    
        return $dia;
    
    }
    //Calcular fecha en letras
    function obtenerFechaEnLetra($fecha)
    {

        $dia= conocerDiaSemanaFecha($fecha);
    
        $num = date("j", strtotime($fecha));
    
        $anno = date("Y", strtotime($fecha));
    
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    
        return $dia.', '.$num.' de '.$mes.' del '.$anno;
    
    }

    //lIimpiar cadenas
    function limitar_cadena($cadena, $limite, $sufijo){
        
        if(strlen($cadena) > $limite){
            
            return substr($cadena, 0, $limite) . $sufijo;
        }
        
        return $cadena;
    }

    // Calcular dias del mes
    function get_total_day_in_month($month, $year)
    {
        return date("d",mktime(0,0,0,$month,0,$year));
    //return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

