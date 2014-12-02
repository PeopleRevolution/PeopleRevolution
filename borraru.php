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
$result=mysql_query("SELECT * FROM usuarios WHERE id=$id",$connect);
//borramos los registros pertenecientes a la id 
mysql_query("delete FROM usuarios WHERE id=$id",$connect);?>

<p><span class="titulo"><u>USUARIOS REGISTRADOS:</u></span></p>
<?php
echo"<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Usuario borrado correctamente.</div>";
exit(); 
?> 
