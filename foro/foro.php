<?php
require('../conexion.php');
@user_login();
require('funciones.php');
$id = $_GET["id"];
if(empty($id)) Header("Location: index.php");

$sql = "SELECT id, autor, titulo, mensaje, iduf, ";
$sql.= "DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s') as enviado FROM foro ";
$sql.= "WHERE id='$id' OR identificador='$id' ORDER BY fecha ASC";
$rs = mysql_query($sql, $con);
include('header.html');
if(mysql_num_rows($rs)>0)
{
	include('titulos_post.html');
	$template = implode("", file('post.html'));
	while($row = mysql_fetch_assoc($rs))
	{
		$color=($color==""?"#006699":"");
		$row["color"] = $color;
		$row["iduf"] = $row["iduf"];
		//manipulamos el mensaje
		$row["mensaje"] = nl2br($row["mensaje"]);
		$row["mensaje"] = parsearTags($row["mensaje"]);
		mostrarTemplate($template, $row);
	}
}
?>