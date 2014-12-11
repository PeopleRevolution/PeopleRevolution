<?php
    include_once("config.php"); 
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
$tipo = (isset($_GET["tipo"])) ? $_GET["tipo"] : exit();
mysql_select_db ("$database", $conex); 
$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$end = 5;
$resultado = mysql_query ("SELECT * FROM noticia where tipo='$tipo'"); 
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM noticia where tipo='$tipo' ORDER BY fecha DESC LIMIT $start, $end"); 


   ?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
        <?php      if($tipo=='n')
   { ?>
              <h3>Publicaciones de Noticias</h3>

              <?php } ?>
                   <?php      if($tipo=='v')
   { ?>
              <h3>Publicaciones de Videos</h3>

              <?php } ?>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="row-articles articles">
            <?php      
            if ($aux !=0){
if(($start + 5) < $filas_tot)
   {
?>    <a href="javascript:Enviar('noticias.php?start=<?php echo ($start + 5); ?>','contenido');">Página anterior</a>
	  
      <?php
   }

   if($start > 0)
   {
	   ?>
	<a href="javascript:Enviar('noticias.php?start=<?php echo ($start - 5); ?>','contenido');">Página siguiente</a>
<?php
   }

 
    echo "<br>";
   echo "<b>";
   echo "Página: ";
   echo "</b>";
   $aux2= ($start/5) + 1;
   echo"$aux2";
   echo "<b>";
   echo " de ";
   echo "</b>";
   echo "$aux";
   echo "</br>";
     echo "<br>";
            
            while($mostrador = mysql_fetch_array($resultado)) 
if ($mostrador != ""){ $aux3 = "true";
{  ?>
     
  
           

            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php
                      echo "<img src=images_bd.php?id=$mostrador[id]&tam=2&aux=noticia alt=\"Imagen descriptiva del ultimo producto añadido\"  width=\"194\" height=\"99\"  class=alignleft >"; ?></a> </div>
              <div class="cnt">
                <h4><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php echo $mostrador['titulo']; ?></a></h4>
                <p><?php $aux = $mostrador['detalle']; 
                        	$tam = strlen($aux);
                        	
                        	if ($tam > 99){

                        	for ($i = 0; $i <= 100; $i++) {
    						echo $aux[$i];
							}
							echo "...";
							}
							else {
							echo $aux;
							}?></p>
                <pre><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');" class="description">Leer Más</a></pre>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            
            
            
      

    <?php 
}
echo "<br>";
echo "<br>";
}if ($aux3 != "true"){ 
echo "No hay entradas";}
mysql_close($conex); 
   }
   else 
   	echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>No hay entradas</p></div>";
   ?>