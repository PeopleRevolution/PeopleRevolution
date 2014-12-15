<?php 
include('config.php');
$temp= $_GET["id"]; 

if(isset($_GET['envioEmail']))
{
	
//si todo est· correcto enviar mensaje ...

include("conexion.php");

            //$mail= $_GET["envioEmail"];  
            $mail = mysql_real_escape_string($_GET["envioEmail"]); 
			$date= time(); 
			$nick= $_SESSION['twitter_id'];
			$auxr=rand();
			$pass= md5(md5($auxr));
			$admin= "N";
			$verificar= rand();
			$ipuser= $_SERVER['REMOTE_ADDR'];         
			$twid = mysql_real_escape_string($_GET["envioid"]); 
 
        mysql_query("INSERT INTO usuarios (id,fecha,nick,pass,mail,ip,admin,verificar) values ('$twid','$date','$nick','$pass','$mail','$ipuser','$admin','$verificar')");
		 
		 //Estoy recibiendo el formulario, compongo el cuerpo
	$cuerpo = "<h1>Bienvenido a la página de PeopleRevolution</h1>";
	$cuerpo .= "<p>Estos son tus datos de registro:</p>";
	$cuerpo .= "<p>Usuario " . $nick . "</p>";
	$cuerpo .= "<p>Email: " . $mail . "</p>";

	$cuerpo .= "<p>Ahora puedes empezar a disfrutar en nuestro sitio, podrás comentar y participar en nuestro site. Esperamos que tengas una feliz estancia.</p>";

	$cuerpo .= "<p>Pero antes debes verificar que tu email sea verdadero en el siguiente enlance</p>";
	$cuerpo =  $cuerpo."<a href =\"http://www.peoplerevolution.net/desarrollo/?entrada=verificar&id=$verificar\"> Verificar Email </a>";

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
//$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: PeopleRevolution <admin@peoplerevolution.net>' . "\r\n";
//$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	//mando el correo...
	mail($mail,"Registro en PeopleRevolution",$cuerpo,$cabeceras);

}
?>
		 
<div id="correcto">
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
     <h3><?php echo "Sistema de registro" ?></h3>
      
            </div>
          </div>


<p>&nbsp;</p>
 <form action="javascript:registrotw()"name="datos"  class="contacto">
 	<input type="hidden" value="<?php echo $temp ?>" class="miid" name="miid"/>
        <div style="background-color:red;color:white;padding:0px;text-align:center;	" id="form"></div>
          <p>&nbsp;</p>
            <div><label>Escribe un email: </label><input type="text" class="miemail" name="miemail" /></div>

</p></div>
          <button class="boton_envio">Registrarse</button>
  </form>
  <p>&nbsp;</p>
     
  </div>
  </div>
</div>
<p>&nbsp;</p>
<p>&nbsp; </p>