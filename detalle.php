<?php
include("conexion.php"); include_once("config.php");
 if(isset($_SESSION['id'])){
	$id= $_SESSION['id'];
	
 }
 

$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
$id = $_GET["id"]; 
$resultado = mysql_query ("SELECT * FROM noticia WHERE id=$id"); 


$sql = "UPDATE noticia SET noticia.top = noticia.top + 1 WHERE id='$id'";


mysql_query($sql, $conex);



?>

<?php 
while($mostrador = mysql_fetch_array($resultado)) 
{ ?>

<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3><?php echo $mostrador['titulo'] ?></h3>
      
            </div>
          </div>
    

            <div class="article">
            
             <p>&nbsp;</p>
             <table width="100%" border="0">
               <tr>
                 <td width="60%"><?php echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=noticia alt=\"Imagen producto\" height=279 width=432>"?></td>
                 <td><p><?php echo $mostrador['subtitulo'];?></p></td>
               </tr>
             </table>
                          <?php 
             $idu = $mostrador['idu'];
             $resultado3 = mysql_query ("SELECT * FROM usuarios WHERE id=$idu");
              while($mostrador3 = mysql_fetch_array($resultado3)) {
              ?><small class="date"> <p><p><br>
             </p> <?php 
              
              echo "Publicado por: ";
              echo $mostrador3['nick'];?>
			  <?php echo "el ".$mostrador['fecha']; }?></p></small>
             <p><br>
             </p>
             <p><br><?php echo $mostrador['detalle'];?></p>

            
</div>   
            
</div>
</div>



<p>

  <?php }mysql_close($conex); 
$idu= $_SESSION['id'];
?>
<div id="auxcom">
<?php
include_once("coment.php");

  ?>
  </div>
</p>
<p>&nbsp;</p>
