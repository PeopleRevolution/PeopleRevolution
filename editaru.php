<?php 
include_once("conexion.php");
//recibimos la variable id enviada en el enlace por GET

//$id=$_GET[id];
$id = mysql_real_escape_string($_GET['id']); 
//$id2 = $_POST["id"]; 
$id2 = mysql_real_escape_string($_POST['id']); 
$adminaux = $_SESSION[admin];

if ($id == "" and $id2 ==""){
$id = $_SESSION[id];	
$adminaux = $_SESSION[admin];	
$nick = $_SESSION[nick];	
$email = $_SESSION[email];	
	
	}
//conectamos a la base
$connect= mysql_connect ("$servidor","$usuario","$password"); 
//Seleccionamos la base
mysql_select_db("$database",$connect);
//hacemos las consultas

if(isset($_POST['nick'])){
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
$nick = mysql_real_escape_string($_GET['nick']);  
$nick = (ucfirst($nick));
$id = mysql_real_escape_string($_POST["id"]); 
//$id = $_POST["id"]; 
$pass = mysql_real_escape_string($_POST["pass"]); 
$pass= md5(md5($pass);
$passaux= $_POST["pass"];
$mail = mysql_real_escape_string($_POST["mail"]); 
$mail = (ucfirst($mail)); 
$admin = mysql_real_escape_string($_POST["admin"]); 
$admin = (ucfirst($admin));

if ($admin != "S"){
	
$admin = "N";

}

if ($passaux != "" and $tfoto != ""){

$sql = "UPDATE usuarios SET nick='$nick', pass='$pass', mail='$mail', foto='$tfoto', thumb='$tthumb', mime='$type', admin='$admin' WHERE id='$id'";}

else{
if ($passaux == "" and $tfoto == ""){

$sql = "UPDATE usuarios SET nick='$nick', mail='$mail', admin='$admin' WHERE id='$id'";}

if ($passaux != "" or $tfoto != ""){

if ($tfoto != ""){

	$sql = "UPDATE usuarios SET nick='$nick', mail='$mail', foto='$tfoto', thumb='$tthumb', mime='$type', admin='$admin' WHERE id='$id'";}
	
if ($passaux != ""){	

	$sql = "UPDATE usuarios SET nick='$nick', pass='$pass', admin='$admin' WHERE id='$id'";}
	
	
	}}


mysql_query($sql, $connect);

 
//mysql_query($sql, $link) or die(mysql_error($link)); 
echo'<script>parent.document.getElementById("correcto").innerHTML="<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Usuario editado correctamente.</div>";</script>';
 
}


$result=mysql_query("select * from usuarios where id='$id'",$connect);

while($row=mysql_fetch_array($result)) { ?>

<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Editar Usuario</h3>
      
            </div>
          </div>
          <div class="row-articles articles">

<div id="correcto">
     
<form target="aux" method="post" class="contacto" enctype="multipart/form-data" action="<?php echo basename($_SERVER['PHP_SELF'])?>" onSubmit="return validarusuarioe(this);" >
<fieldset>
<div id="form"></div>
<div id="mensaje"></div>
<input name="id" type="hidden" id="id" value="<?php echo $id ?>" />
<input name="adminaux" type="hidden" id="adminaux" value="<?php echo $adminaux ?>" />
<p>Usuario:<br /> 
<input name="nick" type="text" class="text" id="nick" value="<?php echo $row[nick] ?>" /> 
</p> 
<p>Email:<br />
  <input name="mail" type="text" class="text" id="mail" value="<?php echo $row[mail] ?>" /> 
</p>
<p>Introduce nueva contraseña para cambiarla o dejala en blanco</p> 
<p>Nueva Contraseña (de más de 6 caracteres):<br />
  <input name="pass" type="password" class="text" id="pass" /> 
</p> 
<p> Repite la contraseña: <br />
<input name="pass2" type="password" class="text" id="pass2" /> 
</p>

<?php if($row[admin] == "S") {  ?>
<p>Seleccione si es administrador 
  <input name="admin" type="checkbox" id="admin" value="S" <?php if (!(strcmp($row[admin],"S"))) {echo "checked=\"checked\"";} ?> />
</p>
<?php } ?>
<div>
<p><?php
$img = $row[foto];
if ($img == ""){
	 echo "<img src=imagenes/userg.png height=109 alt=\"Imagen perfil usuario\" weight=54>";
	}
else
 echo "<img src=images_bd.php?id=$row[id]&tam=1&aux=usuarios alt=\"Imagen perfil usuario\" height=109 weight=54>"; ?> </p>
 
<p>Selecione una imagen nueva de perfil<br> 
  <input name="foto" type="file" class="text" id="foto"/></div>
</p>
<button class="boton_envio">Editar Usuario</button>
  </fieldset>
</form>
</div>
</div>
</div>
</div>
</div>
<iframe name="aux" width="0" height="0" style="visibility:hidden"></iframe>
<?php
}
mysql_free_result($result);
mysql_close($connect);
?> 