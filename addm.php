﻿<?php include_once("config.php"); 
include("conexion.php");
include("paginator.php");
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
 

$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$end = 5;
$id= $_SESSION['id'];
$admin= $_SESSION['admin'];
if ($admin != 'S'){
$resultado = mysql_query ("SELECT * FROM noticia where idu ='$id'"); 
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM noticia where idu ='$id' ORDER BY fecha DESC LIMIT $start, $end"); }
else{
$resultado = mysql_query ("SELECT * FROM noticia"); 
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM noticia ORDER BY fecha DESC LIMIT $start, $end"); }


?>
<p><span class="row-articles articles">
</span></p>
<div id="correcto">
<div class="block">

      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Modificar Entradas</h3>
      
            </div>
          </div>
          <div class="row-articles articles">
            <?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>
            <table width="93%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
  <?php
while($mostrador = mysql_fetch_array($resultado)) 
{ 
	if($mostrador['id']%2)
		$color="#669933";
	else
 		$color="#B7E73A";
?>
              <tr>
    <td width="27%"><?php echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=noticia alt=\"Imagen producto\" height=279 width=432>"?></td>
    <td width="73%" bgcolor="<?php echo $color; ?>" class="tablas"> <p><?php echo utf8_encode($mostrador['titulo']) ?></p>
    <p>-------------------------------------------</p>
    <p><?php echo utf8_encode($mostrador['subtitulo']) ?></p>
     <p>-------------------------------------------</p>
    <p><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');">Detallar entrada</a></p>
   <?php if(isset($_SESSION['id'])){?>
     <p><a href="javascript:Enviar('edicion.php?ed=edit&id=<?php echo $mostrador['id']; ?>','contenido');">Editar entrada</a></p>
	  <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','entrada');">Borrar entrada</a></p>
	 <?php } ?>
    </td>
  </tr>

  
<?php
} 
mysql_close($conex); 
?>
</table>
<?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>
        </div>
</div>
</div>
</div>
<p><span class="row-articles articles">
</span></p>
