<?php 
  include_once("config.php"); 
  $id = $_GET["id"]; 
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$end = 5;
$resultado2 = mysql_query ("SELECT * FROM comentarios WHERE id=$id order by fecha desc");
$filas_tot = mysql_num_rows($resultado2);
$aux=ceil($filas_tot/5);
$resultado2 = mysql_query ("SELECT * FROM comentarios WHERE id=$id order by fecha desc LIMIT $start, $end"); 


if($filas_tot !=0){
?>

       <div class="block"></div>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Comentarios</h3> 
            </div>
          </div>
          <div class="row-articles articles">
          <?php 
          
if(($start + 5) < $filas_tot)
   {
?>    <a href="javascript:Enviar('detalle.php?id=<?php echo $id;?>&start=<?php echo ($start + 5); ?>','contenido');">Página anterior</a>
	  
      <?php
   }

   if($start > 0)
   {
	   ?>
	<a href="javascript:Enviar('detalle.php?id=<?php echo $id;?>&start=<?php echo ($start - 5); ?>','contenido');">Página siguiente</a>
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
   ?>
<?php while($mostrador = mysql_fetch_array($resultado2)) {
 ?>
 <div class="article">
              
              <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');">
              <?php $idn= $mostrador['id'];
              $resultado4 = mysql_query ("SELECT * FROM noticia WHERE id=$idn");
              while($mostrador4 = mysql_fetch_array($resultado4)) {
              ?> </a>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="15%" height="60" bgcolor="#666666">
                    <?php 
			
					$idu= $mostrador['idu'];
							if ($idu == "0"){
								?><small class="date"> <p> <?php 
              echo "Publicado por: Invitado ";?>
			  <p> <?php echo $mostrador['fecha'] ?></p>
              <?php	
              				echo '</b><br />';
	 			echo "<img src=imagenes/userg.png height=95 weight=39 alt=\"Imagen perfil usuario\" >";
							
					}
					else{
					
              $resultado3 = mysql_query ("SELECT * FROM usuarios WHERE id=$idu");
              while($mostrador3 = mysql_fetch_array($resultado3)) {
              ?><small class="date"> <p> <?php 
              echo "Publicado por: ";
              echo $mostrador3['nick'];?>
			  <p> <?php echo $mostrador['fecha'] ?></p><?php
              	$img= $mostrador3[foto];
			  if ($img == ""){
				echo '</b><br />';
	 			echo "<img src=imagenes/userg.png height=95 weight=39 alt=\"Imagen perfil usuario\" >";
				}
				else{
				echo '</b><br />';
 				echo "<img src=images_bd.php?id=$idu&tam=1&aux=usuarios height=95 weight=39 alt=\"Imagen perfil usuario\" >";}
              }}
              ?></p></small>
                  
                  </td>
                  <td width="85%" bgcolor="#55667C">              <p> <?php 
              echo "Publicación: ";
              echo $mostrador4['titulo'];
              }?>
			  
			   <p><?php 
              echo "Comentario: ";
              echo $mostrador['com'];?></p>
              </p></td>
                </tr>
              </table>
      
             
             
           
              
            </div>
                           <?php 
}?>
   
        </div>
    </div>
    </div>
     <div class="cl">&nbsp;</div>
    <!-- / Sidebar -->
    <?php }
if($_POST['com']!=""){
	$idaux = $_POST["idaux"]; 
// Verificamos que el formulario no ha sido enviado aun 
// errores 
error_reporting(E_ALL);  
define("DBHOST", "$servidor"); 
define("DBNAME", "$database"); 
define("DBUSER", "$usuario"); 
define("DBPASSWORD", "$password"); 

 
//$subtitulo = $_POST["subtitulo"]; 
$com = (nl2br(htmlspecialchars(urldecode($_POST["com"]))));
//$detalle['detalle'] = (nl2br(htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8'))); 
$link = mysql_connect(DBHOST, DBUSER, DBPASSWORD) or die(mysql_error($link));; 
mysql_select_db(DBNAME, $link) or die(mysql_error($link)); 


$sql = "INSERT INTO comentarios(id, idu, com) 
VALUES 
('$idaux', '$idu', '$com')"; 
mysql_query($sql, $link) or die(mysql_error($link)); 
 
echo'<script>parent.document.getElementById("comentario").innerHTML="<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Comentario añadido correctamente.</div>";</script>';
$aux = "true";
?>
<?php
}
?>

<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Añadir Comentario</h3>
      
            </div>
          </div>
          <div class="row-articles articles">

   
            
<div id="comentario"></div>
<form target="aux2" method="post" class="contacto" action="<?php echo basename($_SERVER['PHP_SELF'])?>" onSubmit="addcom(this);" >
<fieldset>
<div id="form"></div>
<input name="idaux" type="hidden" id="idaux" value="<?php echo $id ?>" />
<input name="idu" type="hidden" id="idu" value="<?php echo $idu ?>" />
<input name="id" type="hidden" id="id" value="<?php echo $id ?>" />
<p>
<textarea name="com" id="com" cols="91%" rows="15%" style="background-color: #87CEEB;"></textarea> 
</p><div></div>
</p>
<button class="button button-left">Añadir Comentario</button> 
  </fieldset>
</form>
<iframe name="aux2" width="0" height="0" style="visibility:hidden"></iframe>
</div>
</div>
</div>
</div>
</body>
