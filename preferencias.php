<?php include_once("config.php"); 
include("conexion.php");
include("paginator.php");
$admin= $_SESSION['admin'];
if ($admin == 'N'){
echo "Lo sentimos esta página es solo para admnistradores";	
exit();
}


$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
 

$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$end = 5;
$resultado = mysql_query ("SELECT * FROM usuarios"); 
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM usuarios ORDER BY fecha DESC LIMIT $start, $end");


?>
<p><span class="titulo"><u>USUARIOS REGISTRADOS:</u></span></p>
<div id="correcto">

<?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>
<table width="93%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
<?php
while($mostrador = mysql_fetch_array($resultado)) 
{ 
if($mostrador['id']%2){
?>
  <tr>
    <td width="27%" bgcolor="#3399CC" ><p><?php $img = $mostrador[foto];
if ($img == ""){
	 echo "<img src=imagenes/userg.png height=109 weight=54>";
	}
else
 echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=usuarios height=109 weight=54 alt=\"Imagen perfil de usuario\" >"; ?></p>
      <p>Usuario: <?php echo $mostrador['nick'] ?> </p>
      <p><a href="javascript:Enviar('editaru.php?id=<?php echo $mostrador['id']; ?>','contenido');">Editar usuario</a></p>
	  <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','usuario');">Borrar usuario</a></p></td>
    <td width="73%" bgcolor="#0099CC" class="tablas"> <?php
        $admin= $mostrador['admin'];
	if ($admin != 'N'){
	echo " (Usuario administrador)";}
    echo '</b><br /><br />';
    echo '<b>Fecha de registro:</b> ' . date("d-m-Y - H:i", $mostrador['fecha']) . '<br />';
    echo '<b>Email de registro:</b> ' . $mostrador['mail'] . '<br />';
    echo '<b>IP:</b> ' . $mostrador['ip'] . '<br /><br />';
	echo "<br>";?>
    </td>

    </td>
  </tr>
<?php  }else{?>
<tr>
    <td width="27%" bgcolor="#006699">
    <p><?php $img = $mostrador[foto];
if ($img == ""){
	 echo "<img src=imagenes/userg.png height=109 weight=54>";
	}
else
 echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=usuarios height=109 weight=54 alt=\"Imagen perfil de usuario\" >"; ?></p>
    <p>Usuario: <?php echo $mostrador['nick'] ?> </p>
    <a href="javascript:Enviar('editaru.php?id=<?php echo $mostrador['id']; ?>','contenido');">Editar usuario</a></p>
       	  <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','usuarios');">Borrar usuario</a></p></td>
    <td width="73%" bgcolor="#006699" class="tablas"> <?php
        $admin= $mostrador['admin'];
	if ($admin != 'N'){
	echo " (Usuario administrador)";}
    echo '</b><br /><br />';
    echo '<b>Fecha de registro:</b> ' . date("d-m-Y - H:i", $mostrador['fecha']) . '<br />';
    echo '<b>Email de registro:</b> ' . $mostrador['mail'] . '<br />';
    echo '<b>IP:</b> ' . $mostrador['ip'] . '<br /><br />';
	echo "<br>";?>
    </td>
  </tr>
  
<?php

}
} 
mysql_close($conex); 
?>
</table>
<?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>

</div>