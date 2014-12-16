<?php
require('../conexion.php');
user_login();
require('../config.php');
require('funciones.php');

$id = $_GET["id"];
$citar = $_GET["citar"];
$resp = $_GET["resp"];
$row = array("id" => $id);
if($citar==1)
{
	$sql = "SELECT titulo, mensaje, identificador AS id FROM foro WHERE id='$id'";
	$rs = mysql_query($sql, $con);
	if(mysql_num_rows($rs)==1) $row = mysql_fetch_assoc($rs);
	if($resp==1)
	{
		$row["titulo"] = $row["titulo"];
		$row["mensaje"] = "";
	}
	else{
		$row["titulo"] = "Re: ".$row["titulo"];
		$row["mensaje"] = "[citar]".$row["mensaje"]."[/citar]";
	}
	if($row["id"]==0) $row["id"]=$id;
	$row["citar"]=$citar;
}
$template = implode("", file('formulario.html'));
include('header.html');
mostrarTemplate($template, $row);
?>