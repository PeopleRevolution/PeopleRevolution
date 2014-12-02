<?php 
include_once("conexion.php");
//recibimos la variable id enviada en el enlace por GET

$id=$_GET[id];
$id2=$_POST[id];
if ($id == "")
{ $id = $id2;}
//conectamos a la base
$connect= mysql_connect ("$servidor","$usuario","$password"); 
//Seleccionamos la base
mysql_select_db("$database",$connect);
//hacemos las consultas

if(isset($_POST['detalle'])){
error_reporting(E_ALL); 
# Altura de el thumbnail en píxeles 
define("ALTURA", 100); 
# Nombre del archivo temporal del thumbnail 
define("NAMETHUMB", "/tmp/thumbtemp"); 
define("DBHOST", "$servidor"); 
define("DBNAME", "$database"); 
define("DBUSER", "$usuario"); 
define("DBPASSWORD", "$password"); 
$mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png"); 
$name = $_FILES["foto"]["name"]; 
if ($name !=""){
$type = $_FILES["foto"]["type"]; 
$tmp_name = $_FILES["foto"]["tmp_name"]; 
$size = $_FILES["foto"]["size"]; 
if(!in_array($type, $mimetypes)) {
	echo'<script>parent.document.getElementById("mensaje").innerHTML="<div style=\"background-color:red;color:white;padding:4px;text-align:center;\">La imagen que has subido no es correcta.</div>";</script>';
die("El archivo que subiste no es una Imagen válida"); }
switch($type) { 
case $mimetypes[0]: 
case $mimetypes[1]: 
$img = imagecreatefromjpeg($tmp_name); 
break; 
case $mimetypes[2]: 
$img = imagecreatefromgif($tmp_name); 
break; 
case $mimetypes[3]: 
$img = imagecreatefrompng($tmp_name); 
break; 
} 
$datos = getimagesize($tmp_name); 
$ratio = ($datos[1]/ALTURA); 
$ancho = round($datos[0]/$ratio); 
$thumb = imagecreatetruecolor($ancho, ALTURA); 
imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, ALTURA, $datos[0], $datos[1]); 
switch($type) { 
case $mimetypes[0]: 
case $mimetypes[1]: 
imagejpeg($thumb, NAMETHUMB); 
break; 
case $mimetypes[2]: 
imagegif($thumb, NAMETHUMB); 
break; 
case $mimetypes[3]: 
imagepng($thumb, NAMETHUMB); 
break; 
} 
# foto original 
$fp = fopen($tmp_name, "rb"); 
$tfoto = fread($fp, filesize($tmp_name)); 
$tfoto = addslashes($tfoto); 
fclose($fp); 
# thumbnail 
$fp = fopen(NAMETHUMB, "rb"); 
$tthumb = fread($fp, filesize(NAMETHUMB)); 
$tthumb = addslashes($tthumb); 
fclose($fp); 
// Borra archivos temporales 
@unlink($tmp_name); 
@unlink(NAMETHUMB); }
//proceso de almacenamiento 
//$fuente = $_POST["fuente"]; 
//$categoria = $_POST["categoria"]; 
 
//$id = $_POST["id"]; 
$titulo = $_POST["titulo"]; 
$subtitulo = $_POST["subtitulo"]; 
$detalle = $_POST["detalle"]; 




if ($tfoto != ""){

$sql = "UPDATE noticia SET titulo='$titulo', subtitulo='$subtitulo', detalle='$detalle', foto='$tfoto', thumb='$tthumb', mime='$type' WHERE id='$id'";}

else{
if ($tfoto == ""){

$sql = "UPDATE noticia SET titulo='$titulo', subtitulo='$subtitulo', detalle='$detalle' WHERE id='$id'";}
}


mysql_query($sql, $connect) or die(mysql_error($connect)); 
echo'<script>parent.document.getElementById("contenido").innerHTML="<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Entrada editada correctamente.</div>";</script>';
 
}


$result=mysql_query("select * from noticia where id='$id'",$connect);
//Una vez seleccionados los registros los mostramos para su edición
while($row=mysql_fetch_array($result)) { ?>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--[if IE 6]><link rel="stylesheet" href="css/ie6-style.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/fns.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script src="js/ckeditor.js"></script>
<script language="javascript" src="WYSIWYG/source.js" type="text/javascript"></script>
<div class="block">
      <div class="block-bot">
          <div class="head">
          </div>
          <div class="row-articles articles">

<div id="correcto">
     
<form target="edit" method="post" class="contacto" enctype="multipart/form-data" action="<?php echo basename($_SERVER['PHP_SELF'])?>" >
<div id="form"></div>
<div id="mensaje"></div>
<input name="id" type=hidden id="id" value="<?php echo $row[id] ?>"/>
<input name="fotoaux" type="hidden" id="fotoaux" value="N" />
<p>Titulo<br /> 
<input name="titulo" type="text" class="text" id="titulo" value="<?php echo $row[titulo] ?>" /> 
</p> 
<p>Subtitulo<br /> 
<input name="subtitulo" type="text" class="text" id="subtitulo" value="<?php echo $row[subtitulo] ?>" size="50%" /> 
</p> 
<p> Detalle<br /> 
<textarea name="detalle" id="detalle" cols="100%" rows="25%" tabindex="4" style="background-color: #87CEEB;"><?php echo $row[detalle] ?></textarea> 

<div></p> 

<p><br> Imagen Portada </br></p>
<p><?php echo "<img src=images_bd.php?id=$row[id]&tam=1&aux=noticia  alt=\"Imagen producto\" height=109 weight=54>"?></p>
<p>Selecione una imagen nueva<br> 
  <input name="foto" type="file" class="text" id="foto"/></div>
</p>
<button class="boton_envio">Editar Entrada</button>
</form>
</div>
</div>
</div>
</div>
<?php
}
mysql_free_result($result);
mysql_close($connect);
?> 