<?php 
@ob_start("ob_gzhandler");
include_once("config.php");
@mysql_query("SET NAMES 'utf8'"); 
include("paginator.php");
$buscar= $_GET['criterio'];
$conex = mysql_connect ("$servidor","$usuario","$password"); 

if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 

mysql_select_db ("$database", $conex); 
$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$id = mysql_real_escape_string($_GET["id"]);
$end = 5;
$resultado = mysql_query ("SELECT * FROM noticia WHERE titulo LIKE '%$buscar%' or subtitulo like '%$buscar%' or detalle like '%$buscar%' ORDER BY fecha desc");
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM noticia WHERE titulo LIKE '%$buscar%' or subtitulo like '%$buscar%' or detalle like '%$buscar%' ORDER BY fecha desc LIMIT $start, $end"); 


   ?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Resultados de busqueda</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="row-articles articles">
            <?php      
            if ($aux !=0){
 paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0');
            
            while($mostrador = mysql_fetch_array($resultado)) 
if ($mostrador != ""){ $aux3 = "true";
{  ?>
     
  
           

            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php
                      echo "<img src=images_bd.php?id=$mostrador[id]&tam=2&aux=noticia alt=\"Imagen descriptiva del ultimo producto añadido\"  width=\"194\" height=\"99\"  class=alignleft >"; ?></a> </div>
              <div class="cnt">
                <h4><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php echo utf8_encode($mostrador['titulo']); ?></a></h4>
                <p><?php $aux = $mostrador['detalle']; 
                          $tam = strlen($aux);
                          
                          if ($tam > 99){

                          for ($i = 0; $i <= 100; $i++) {
                echo tf8_encode($aux[$i]);
              }
              echo "...";
              }
              else {
              echo utf8_encode($aux);
              }?></p>
                <pre><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');" class="description">Leer Más</a></pre>
        <div id="m-soc2">
          <ul >
            <li><a href="http://twitter.com/?status='+<?php echo $mostrador['titulo']; ?>' --> People Revolution +http://www.peoplerevolution.net?id=<?php echo $mostrador['id']; ?>;"><span>Comparte en Twitter</span></a></li>
            <li><a href="http://www.facebook.com/sharer.php?u=http://www.peoplerevolution.net?id=<?php echo $mostrador['id']; ?>"><span>Comparte en Facebook</span></a></li>
          </ul>
          
        </div>  

          
        
        
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            
            
            
      

    <?php 
}
echo "<br>";
echo "<br>";
}if ($aux3 != "true"){ 
echo "No hay resultados";}
mysql_close($conex); 
   }
   else 
    echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>No hay resultados</p></div>";
   ?>