<?php 
include_once("conexion.php");
?>
<link rel="stylesheet" href="estilo.css"/>
<p><span class="titulo"><u>Activaci€n de cuenta:</u></span></p>
<div style="background-color:green;color:white;padding:4px;text-align:center;">
  <p>Usuario activado correctamente.</p>
  <p><a href="index.php">Acceder</a></p>
</div>
<?php
$verificar = "S";
//recibimos la variable id enviada en el enlace por GET
//$id=$_GET[id];
//conectamos a la base
$connect= mysql_connect ("$servidor","$usuario","$password"); 
//Seleccionamos la base
mysql_select_db("$database",$connect);
//hacemos las consultas
$nick = (isset($_GET["nick"])) ? $_GET["nick"] : exit();
mysql_query("UPDATE usuarios SET verificar='$verificar' WHERE nick='$nick'",$connect);
echo '<meta http-equiv="Refresh" content="2;url=index.php"> ';
?> 
