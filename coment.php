<?php 
  include_once("config.php"); 
  include("paginator.php");
 // $id = $_GET["id"];
  //$id = mysql_real_escape_string($_GET["id"]);
  $nickaux = $nickf= (empty($_REQUEST["nickaux"]) ? "Invitado" : ($_REQUEST["nickaux"]));
  $replicaaux = (empty($_REQUEST["replicacom"]) ? "NULL" : ($_REQUEST["replicacom"])); 
  $conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$id = mysql_real_escape_string($_GET["id"]);
$end = 5;
$resultado = mysql_query ("SELECT * FROM comentarios WHERE id=$id order by fecha desc");
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT distinct com,comentarios.fecha,nick,usuarios.foto,comentarios.idu,replica,idc,noticia.id FROM noticia INNER JOIN comentarios INNER JOIN usuarios WHERE noticia.id=comentarios.id and usuarios.id=comentarios.idu and noticia.id=$id group by idc order by fecha desc LIMIT $start, $end"); 

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
<?php paginator('detalle.php',$start,$filas_tot,$aux,$id); ?>
<?php while($mostrador = mysql_fetch_array($resultado)) {
  if (is_null($mostrador['replica'])){
 ?>
 <div class="article">
              
              <?php 
              $idn= $mostrador['id'];
              $idu= $mostrador['idu'];
              $img= $mostrador['foto'];
              $idc= $mostrador['idc'];
              $nick= $mostrador['nick'];
              ?> 
            </a>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="15%" height="60" bgcolor="#666666">
                  <small class="date"> <p> 
                   <?php 
                    if ($idu == "0"){
                    echo "Publicado por: Invitado ";}
                    else{
                      echo "Publicado por: ";
                      echo $mostrador['nick'];
                  }?>
			         <p> <?php echo $mostrador['fecha'] ?></p>
              <?php	

              	
			  if (($idu == "0") or (is_null($mostrador['foto']))){
				echo '</b><br />';
	 			echo "<img src=imagenes/userg.png height=95 weight=39 alt=\"Imagen perfil usuario\" >";
				}
          else{  
				echo '</b><br />';
 				echo "<img src=images_bd.php?id=$idu&tam=1&aux=usuarios height=95 weight=39 alt=\"Imagen perfil usuario\" >";}
              
              ?></p>
<p> <a href="javascript:Enviar('coment.php?id=<?php echo $idn ?>&nickaux=<?php echo $nick ?>&replicacom=<?php echo $idc ?>&start=<?php echo $start ?>','auxcom');">Replicar</a></p>

            </small>
                  
                  </td>
                  <td width="85%" bgcolor="#55667C">
              <?php 
              echo "Comentario: ";
              echo $mostrador['com'];?>
              </td>
                </tr>
              </table>
      
                   <?php 


              $resultado2 = mysql_query ("SELECT distinct com,comentarios.fecha,nick,usuarios.foto,comentarios.idu,replica,idc,noticia.id FROM noticia INNER JOIN comentarios INNER JOIN usuarios WHERE noticia.id=comentarios.id and (usuarios.id=comentarios.idu or comentarios.idu=0) and noticia.id=$id group by idc order by fecha desc"); 
              while($mostrador2 = mysql_fetch_array($resultado2)) {
            if ($mostrador2['replica'] == $mostrador['idc'] ){
              $idn2= $mostrador2['id'];
              $idu2= $mostrador2['idu'];
             // $img2= $mostrador2['foto'];
              ?> 
            </a>
            <IMG SRC="./imagenes/20864.png" WIDTH=24 HEIGHT=29 BORDER=0 ALT="Un bebé">
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="85%" bgcolor="#55667C">
              <?php 
              echo "Comentario: ";
              echo $mostrador2['com'];?>
              </td>
                 <td width="15%" height="60" bgcolor="#666666">
                  <small class="date"> <p> 
                   <?php 
                    if ($mostrador2['idu'] == "0"){
                    echo "Replicado por: Invitado ";}
                    else{
                      echo "Replicado por: ";
                      echo $mostrador2['nick'];
                  }?>
               <p> <?php echo $mostrador2['fecha'] ?></p>
              <?php 

                
        if (($mostrador2['idu'] == "0") or (is_null($mostrador2['foto']))){
        echo '</b><br />';
        echo "<img src=imagenes/userg.png height=95 weight=39 alt=\"Imagen perfil usuario\" >";
        }
          else{  
        echo '</b><br />';
        echo "<img src=images_bd.php?id=$idu2&tam=1&aux=usuarios height=95 weight=39 alt=\"Imagen perfil usuario\" >";}
              
              ?></p></small>
                  
                  </td>
                </tr>

              </table>  
             
           <?php }} ?>
              
            </div>
                           <?php 
}}?>

    </div>
     <div class="cl">&nbsp;</div>
    <!-- / Sidebar -->
    <?php }
if($_POST['com']!=""){
	//$idaux = $_POST["idaux"]; 
	$idaux = mysql_real_escape_string($_POST["idaux"]);
  //$replica = $_POST["replica"]; 
  $replica = mysql_real_escape_string($_POST["replica"]);
  $idu = $_SESSION['id']; 
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

$sql = "INSERT INTO comentarios(id, idu, com,replica) 
VALUES 
('$idaux', '$idu', '$com',$replica)"; 
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
              <?php if($replicaaux != 'NULL')  
              {?> 
                    <h3>Replicando a <?php echo $nickaux; ?></h3>
              <?php } 
              else{ ?>
                    <h3>Añadir Comentario</h3>
              <?php }?>
            </div>
          </div>
          <div class="row-articles articles">

   
            
<div id="comentario"></div>
<form target="aux2" method="post" class="contacto" action="<?php echo basename($_SERVER['PHP_SELF'])?>" onSubmit="addcom(this);" >
<fieldset>
<div id="form"></div>
<input name="idaux" type="hidden" id="idaux" value="<?php echo $id ?>" />
<input name="start" type="hidden" id="start" value="<?php if($replicaaux != 'NULL') {echo $start;} ?>" />
<input name="replica" type="hidden" id="replica" value="<?php echo $replicaaux ?>" />
<p>
<?php if($replicaaux != 'NULL') {
?>
<textarea name="com" id="com" cols="91%" rows="15%" style="background-color: #87CEEB;" autofocus></textarea> 
<?php } 
else{ ?>
<textarea name="com" id="com" cols="91%" rows="15%" style="background-color: #87CEEB;"></textarea> 
<?php }?>
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