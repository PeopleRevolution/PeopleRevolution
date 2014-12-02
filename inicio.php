<?php
    include_once("config.php"); 
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
$resultado = mysql_query ("SELECT * FROM noticia ORDER BY fecha DESC LIMIT 0,5"); 
$resultado2 = mysql_query ("SELECT * FROM noticia ORDER BY fecha DESC LIMIT 0,3"); 
?>


      <div class="block">
      <div class="block-bot">
            <div class="block-cnt">
              <div id="slider">
                <div class="buttons"> <span class="prev">prev</span> <span class="next">next</span> </div>
                <div class="holder">
                  <div class="frame">&nbsp;</div>
                  <div class="content">
                    <ul>
                 
                          <?php      while($mostrador = mysql_fetch_array($resultado2)) 

{  ?>
                 
                  <li class="fragment">
                    <div class="image"><?php
                      echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=noticia alt=\"Imagen descriptiva del ultimo producto añadido\"  width=\"638\" height=\"287\"  class=alignleft >"; ?> </div>
                    <div class="cnt">
                      <div class="cl">&nbsp;</div>
                      <div class="side-a">
                        <h4><?php echo $mostrador['titulo']; ?></h4>
                        <ul class="rating">
                          <li><span class="votes"><?php echo $mostrador['top']; ?> vistas</span></li>
                        </ul>
                      </div>
                      <div class="side-b">
                        <p><?php
                        	$aux = $mostrador['detalle']; 
                        	$tam = strlen($aux);
                        	
                        	if ($tam > 99){

                        	for ($i = 0; $i <= 100; $i++) {
    						echo $aux[$i];
							}
							echo "...";
							}
							else {
							echo $aux;
							}
                        	
                        
                        ?></p> 
                         <?php  } ?>
                         
                         
                      </div>
                      
                      
                      <div class="cl">&nbsp;</div>
                    </div>
                  </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

       <div class="block"></div>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt"> <a href="javascript:Enviar('noticias.php','contenido');" class="view-all">Ver todas</a>
              <h3>Más Noticias</h3>
              <div class="cl">&nbsp;</div>
            </div>
          </div>
          <div class="row-articles articles">
            <?php      while($mostrador = mysql_fetch_array($resultado)) 
if ($mostrador != ""){ $aux = "true";
{  ?>
     
  
           

            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php
                      echo "<img src=images_bd.php?id=$mostrador[id]&tam=2&aux=noticia alt=\"Imagen descriptiva del ultimo producto añadido\"  width=\"194\" height=\"99\"  class=alignleft >"; ?></a> </div>
              <div class="cnt">
                <h4><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php echo $mostrador['titulo']; ?></a></h4>
                <p><?php
                 	$aux = $mostrador['detalle']; 
                        	$tam = strlen($aux);
                        	
                        	if ($tam > 99){

                        	for ($i = 0; $i <= 100; $i++) {
    						echo $aux[$i];
							}
							echo "...";
							}
							else {
							echo $aux;
							}
                ?></p>
                <pre><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');" class="description">Leer Más</a></pre>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
            
            
            
      

    <?php 
}
echo "<br>";
echo "<br>";
}

if ($aux3 != "true"){ 
mysql_close($conex); 
   }
   else 
   	echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>No hay entradas</p></div>";
   ?>