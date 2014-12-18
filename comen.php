<?php      

    include_once("config.php"); 
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 

$resultado2 = mysql_query ("SELECT * FROM comentarios order by fecha desc limit 0,4"); 
?>

         
          <div id="comen">
          <div class="text-articles articles">
                                  <?php      while($mostrador = mysql_fetch_array($resultado2)) {
 ?>
           
            <div class="article">
              <small class="date"><?php echo $mostrador['fecha']; 
                            $idu= $mostrador['idu'];
              $resultado3 = mysql_query ("SELECT * FROM usuarios WHERE id=$idu");
              if ($idu == "0"){
            	echo ". Publicado por: Invitado ";
              }
              else{
              while($mostrador3 = mysql_fetch_array($resultado3)) {
              echo ". Publicado por: ";
              echo utf8_encode($mostrador3['nick']);
              }}
              ?>
              </small>
              <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');">
              <?php $idn= $mostrador['id'];
              $resultado4 = mysql_query ("SELECT * FROM noticia WHERE id=$idn");
              while($mostrador4 = mysql_fetch_array($resultado4)) {
              ?> <p> <?php 
              echo "Publicación: ";
              echo utf8_encode($mostrador4['titulo']);
              }
              ?></p></a>
              <p><?php 
              echo "Comentario: ";
              $comenaux = $mostrador['com'];
              for ($i = 0 ; $i <= 55; $i++){
              echo utf8_encode($comenaux[$i]);
              } 
              echo "...";
			  ?></a>
              
            </div>
                           <?php 
}?>
        