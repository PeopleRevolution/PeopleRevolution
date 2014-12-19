<?php
@ob_start("ob_gzhandler");
require('../conexion.php');
@user_login();
$autor = $_SESSION["nick"];
$iduf = $_SESSION["id"];
$titulo = $_GET["titulo"];
$mensaje = $_GET["mensaje"];
$ident = $_GET["identificador"];
$foto = "S";
//Hacemos algunas validaciones
//if(empty($autor)) $autor = "Invitado";
if(empty($titulo)) $titulo = "Sin título";
//Evitamos que el usuario ingrese HTML
$mensaje = htmlentities($mensaje);
// Grabamos el mensaje en la base.
$sql = "INSERT INTO foro (autor, titulo, mensaje, identificador, fecha, ult_respuesta, iduf) ";
$sql.= "VALUES ('$autor','$titulo','$mensaje','$ident',NOW(),NOW(),'$iduf')";
$rs = mysql_query($sql, $con) or die("Error al grabar un mensaje: ".mysql_error);
$ult_id = mysql_insert_id($con);
/* si es un mensaje en respuesta a otro
   actualizamos los datos */
if(!empty($ident))
{
	$sql = "UPDATE foro SET respuestas=respuestas+1, ult_respuesta=NOW()";
	$sql.= " WHERE id = '$ident'";
	$rs = mysql_query($sql, $con);
	header("Location: foro.php?id=$ident#$ult_id");
	exit();
}
header("Location: index.php");
?>