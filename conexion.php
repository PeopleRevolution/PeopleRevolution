<?php 
@session_start();
include_once("config.php");
$conectar = @mysql_connect($servidor,$usuario,$password) or exit('Datos de conexion incorrectos.');
mysql_select_db($database) or exit('No existe la base de datos.');    
/*En este archivo también pondremos unas funciones necesarias para el registro y el login*/    
/*Función que se encarga de eliminar codigo malicioso de las variables.*/
function limpiar($var)
{

    $var = trim($var);
    $var = htmlspecialchars($var);
    $var = str_replace(chr(160),'',$var);
    return $var;
}
/*Función que se encarga de validar el email de registro para que sea correcto.*/
function validar_email($email){
    $mail_correcto = 0; 
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
    { 
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," ")))
       {//miro si tiene caracter .
          if (substr_count($email,".")>= 1)
          {//obtengo la terminacion del dominio 
             $term_dom = substr(strrchr ($email, '.'),1); 
             //compruebo que la terminaci?n del dominio sea correcta 
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
             {//compruebo que lo de antes del dominio sea correcto 
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                if ($caracter_ult != "@" && $caracter_ult != ".")
                { 
                   $mail_correcto = 1; 
                }
             }
          }
       }
    }
    if ($mail_correcto) 
       return 1;
    else 
       return 0;
}
/*Funcion que se encarga de validar si el usuario esta registrado en el sistema*/
function user_login()
{
    if(!$_SESSION['id'])
    {
        exit ("Solo usuarios registrados, <a href='javascript:history.back(-1)'>Volver</a>");
    }
}
?>