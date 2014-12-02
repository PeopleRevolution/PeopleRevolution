<?php
 include_once("conexion.php");
//smysql_query ("SET NAMES 'utf8'");

if($_POST['titulo']!=""){

// Verificamos que el formulario no ha sido enviado aun 
// errores 
error_reporting(E_ALL); 
# Altura de el thumbnail en pÃxeles 
define("ALTURA", 100); 
# Nombre del archivo temporal del thumbnail 
define("NAMETHUMB", "/tmp/thumbtemp"); 
define("DBHOST", "$servidor"); 
define("DBNAME", "$database"); 
define("DBUSER", "$usuario"); 
define("DBPASSWORD", "$password"); 
$mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png"); 
$name = $_FILES["foto"]["name"]; 
$type = $_FILES["foto"]["type"]; 
$tmp_name = $_FILES["foto"]["tmp_name"]; 
$size = $_FILES["foto"]["size"]; 
if(!in_array($type, $mimetypes)) {
	echo'<script>parent.document.getElementById("form").innerHTML="<div style=\"background-color:red;color:white;padding:4px;text-align:center;\">La imagen que has subido no es correcta.</div>";</script>';
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
@unlink(NAMETHUMB); 
//proceso de almacenamiento 
//$fuente = $_POST["fuente"]; 
//$categoria = $_POST["categoria"]; 
$titulo = $_POST["titulo"]; 
//$titulo = htmlspecialchars($_POST['titulo'], ENT_QUOTES, 'UTF-8'); 
//$subtitulo = htmlspecialchars($_POST['subtitulo'], ENT_QUOTES, 'UTF-8'); 
$subtitulo = $_POST["subtitulo"]; 
$detalle = $_POST["detalle"]; 
//$detalle = (nl2br(htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8'))); 
$link = mysql_connect(DBHOST, DBUSER, DBPASSWORD) or die(mysql_error($link));; 
mysql_select_db(DBNAME, $link) or die(mysql_error($link)); 
$id= $_SESSION['id'];
$tipo= "n";
$sql = "INSERT INTO noticia(idu, tipo, titulo, subtitulo, detalle, foto, thumb, mime) 
VALUES 
('$id', '$tipo', '$titulo', '$subtitulo', '$detalle', '$tfoto', '$tthumb', '$type')"; 
mysql_query($sql, $link) or die(mysql_error($link)); 
 
echo'<script>parent.document.getElementById("contenido").innerHTML="<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Entrada añadida correctamente.</div>";</script>';
$aux = "true";
}
?>
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

   
            

<form target="add" method="post" class="contacto" enctype="multipart/form-data" action="<?php echo basename($_SERVER['PHP_SELF'])?>" onSubmit="return validarproducto(this);" >

<div id="form"></div>
<input name="fotoaux" type="hidden" id="fotoaux" value="S" />
<p>Titulo<br /> 
<input name="titulo" type="text" class="text" id="titulo" /> 
</p> 
<p>Subtitulo<br /> 
<input name="subtitulo" type="text" class="text" id="subtitulo" size="50%" /> 
</p> 
<p> Detalle<br /> 
<textarea name="detalle" id="detalle" cols="90%" rows="25%" tabindex="4" style="background-color: #87CEEB;"></textarea> 


<div></p>
<p><br> Imagen Portada </br></p>
  Selecione una imagen<br> 
  <input name="foto" type="file" class="text" id="foto" />
</div>
</p>
<button class="button button-left"  >Añadir</button> 

</form>
</div>
</div>
</div>
</div>
</body>