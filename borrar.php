<?php 
include_once("conexion.php");
user_login();
//recibimos la variable id enviada en el enlace por GET
//$id=$_GET[id];
//conectamos a la base
$connect= mysql_connect ("$servidor","$usuario","$password"); 
//Seleccionamos la base
mysql_select_db("$database",$connect);
//hacemos las consultas
$id = (isset($_GET["id"])) ? $_GET["id"] : exit(); 
//$result=mysql_query("SELECT * FROM noticia WHERE id=$id",$connect);
//borramos los registros pertenecientes a la id 
if ($_GET["tipo"] == 'entrada')
	mysql_query("delete FROM noticia WHERE id=$id",$connect);
else
if ($_GET["tipo"] == 'usuario')
mysql_query("delete FROM usuarios WHERE id=$id",$connect);

?>

<?php
echo"<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Entrada borrada correctamente.</div>";
exit(); 
?> 
