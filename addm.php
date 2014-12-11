<?php include_once("config.php"); 
include("conexion.php");
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
<?php 
if ($aux !=0){
if(($start + 5) < $filas_tot)
   {
?>
<a href="javascript:Enviar('productom.php?start=<?php echo ($start + 5); ?>','contenido');">P&aacute;gina anterior</a>
<?php
   }

   if($start > 0)
   {
	   ?>
<a href="javascript:Enviar('productom.php?start=<?php echo ($start - 5); ?>','contenido');">P&aacute;gina siguiente</a>
<?php
   }

 
    echo "<br>";
   echo "<b>";
   echo "P&aacute;gina: ";
   echo "</b>";
   $aux2= ($start/5) + 1;
   echo"$aux2";
   echo "<b>";
   echo " de ";
   echo "</b>";
   echo "$aux";
   echo "</br>";
     echo "<br>";
   echo "<b>";
   ?>
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
            <table width="93%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
  <?php
while($mostrador = mysql_fetch_array($resultado)) 
{ 
if($mostrador['id']%2){
?>
              <tr>
    <td width="27%"><?php echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=noticia alt=\"Imagen producto\" height=279 width=432>"?></td>
    <td width="73%" bgcolor="#669933" class="tablas"> <p><?php echo $mostrador['titulo'] ?></p>
    <p><?php echo $mostrador['cop'] ?></p>
    <p><?php echo $mostrador['precio'] ?></p>
    <p><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');">Detallar entrada</a></p>
   <?php if(isset($_SESSION['id'])){?>
     <p><a href="javascript:Enviar('edicion.php?ed=edit&id=<?php echo $mostrador['id']; ?>','contenido');">Editar entrada</a></p>
	  <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','producto');">Borrar entrada</a></p>
	 <?php } ?>
    </td>
  </tr>
<?php  }else{?>
<tr>
    <td width="27%"><?php echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=noticia alt=\"Imagen producto\" height=279 width=432>"?></td>
    <td width="73%" bgcolor="#B7E73A" class="tablas"> <p><?php echo $mostrador['titulo'] ?></p>
    <p><?php echo $mostrador['coop'] ?></p>
    <p><?php echo $mostrador['precio'] ?></p>
   <p><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');">Detallar entrada</a></p>
   <?php if(isset($_SESSION['id'])){?>
       <p><a href="javascript:Enviar('editar.php?id=<?php echo $mostrador['id']; ?>','contenido');">Editar entrada</a></p>
       	  <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','producto');">Borrar entrada</a></p>
       <?php } ?>
    </td>
  </tr>
  
<?php

}
} 
mysql_close($conex); 
?>
</table>
        </div>
</div>
</div>
</div>
<p><span class="row-articles articles">
  <?php 

  echo "<b>";
    echo "<br>";
   echo "<b>";
if(($start + 5) < $filas_tot)
   {
?>
  <a href="javascript:Enviar('producto.php?start=<?php echo ($start + 5); ?>','contenido');">P&aacute;gina anterior</a>
  <?php
   }

   if($start > 0)
   {
	   ?>
  <a href="javascript:Enviar('producto.php?start=<?php echo ($start - 5); ?>','contenido');">P&aacute;gina siguiente</a>
  <?php
   }

   
   echo "<b>";
    echo "<br>";
   echo "<b>";
   echo "P&aacute;gina: ";
   echo "</b>";
   $aux2= ($start/5) + 1;
   echo"$aux2";
   echo "<b>";
   echo " de ";
   echo "</b>";
   echo "$aux";
   echo "</br>";
   echo "<br>";
   echo "<b>";}
   else 
   	echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>No hay productos</p></div>";
   ?>
</span></p>
