<?php 
if(isset($_GET['envionick']))
{
$compEmail=0; //valor inicial para combrobaci€n email.
$compNick=0; //valor inicial para combrobaci€n email.
$compContra=0;  //valor inicial para comprobacion contrase“a
$nick=$_GET["envionick"];//recoger datos de email
$email=$_GET["envioEmail"];//recoger datos de email
$contra1=$_GET["envioContra1"]; //recoger datos de contrase“a 1
$contra2=$_GET["envioContra2"]; //recoger datos de contrase“a 2

if (strlen($nick)>0) { //si hay algo escrito en contrase“a ....
		$compNick=1; }//comprobaci€n correcta de Email
else { //si no hay nada escrito en email ...
   $textoNick="<p>No has escrito ningun usuario.</p>"; 
   }

if (strlen($email)>0) { //si hay algo escrito en contrase“a ....
    $num1=substr_count($email,"@"); //n˙mero de signos @ escritos en el email;
    if ($num1==1) { //correcto si ha una @ en el email
       
	           $compEmail=1; //comprobaci€n correcta de Email
        }
    else { //incorrecto si hay m∑s o menos de 1 @ en email.
        $textoEmail="<p>El e-mail no se ha escrito correctamente.</p>";
        }
    }
else { //si no hay nada escrito en email ...
   $textoEmail="<p>No has escrito ningun e-mail.</p>"; 
   }
if (strlen($contra1)<6 or strlen($contra2)<6) { //contrase“∑ menos de 6 caracteres: 
   $textoContra="<p>La contraseÒa o su repetici€n tienen menos de 6 caracteres.</p>";
   }
elseif ($contra1 != $contra2) { //contrase“a y repetici€n distintas
   $textoContra="<p>La contraseÒa y su repetici€n no son iguales</p>";
   }
else { //la contrase“a y su repetici€n son correctas.
   $textoContra="<p>La contraseÒa es correcta.</p>";
   $compContra=1; //Contrase“a correcta
   }
if ($compEmail==1 and $compContra==1 and $compNick==1) { //si todo est∑ correcto enviar mensaje ...

include("conexion.php");
 			$date= time(); 
            $nick= $_GET["envionick"];
            $mail= $_GET["envioEmail"];
            $verificar= rand();
            $pass= md5(md5($_GET["envioContra1"]));
			      $admin= "N";
            $ipuser= $_SERVER['REMOTE_ADDR'];            

            $b_user= mysql_query("SELECT nick FROM usuarios WHERE nick='$nick'");
            if($user=@mysql_fetch_array($b_user))
            {
                echo '<br />El nombre de usuario o el email ya esta registrado.';
                mysql_free_result($b_user); //liberamos la memoria del query a la db
            }
            else
            {
         mysql_query("INSERT INTO usuarios (fecha,nick,mail,pass,ip,admin,verificar) values ('$date','$nick','$mail','$pass','$ipuser','$admin','$verificar')");
		 
		 //Estoy recibiendo el formulario, compongo el cuerpo
	$cuerpo = "<h1>Bienvenido a la p·gina de PeopleRevolution</h1>";
	$cuerpo .= "<p>Estos son tus datos de registro:</p>";
	$cuerpo .= "<p>Usuario " . $nick . "</p>";
	$cuerpo .= "<p>Email: " . $mail . "</p>";

	$cuerpo .= "<p>Ahora puedes empezar a disfrutar en nuestro sitio, podr·s comentar y participar en nuestro site. Esperamos que tengas una feliz estancia.</p>";

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
	 } }}
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
 <form action="javascript:registro()"name="datos"  class="contacto">
        <div style="background-color:red;color:white;padding:0px;text-align:center;	" id="form"></div>
          <p>&nbsp;</p>
            <div><label>Escribe un usuario:</label><input type="text" class="minick" name="minick" /></div>
            <div><label>Escribe un email: </label><input type="text" class="miemail" name="miemail" /></div>
            <div>
              <label>Escribe una contraseÒa: (de m·s de 6 caracteres)  </label><input type="password" class="micontra1" name="micontra1" /></div>     
            <div><label>Repite la contraseÒa: </label><input type="password" class="micontra2" name="micontra2" /></div>      <div>
                <p>&nbsp;</p>
                <table width="458" height="52" border="0" cellpadding="1" cellspacing="1" bgcolor=#BEE1FC bordercolor="#000000" align="center">
        <tr>
    <th width="497" height="63" bgcolor="#99CC66" scope="row"> <div align="center"> La informaciÛn que introduzca en esta web quedar·; alojada en nuestros servidores y ser&aacute; tratada con absoluta confidencialidad de acuerdo con nuestra garant&iacute;a de <strong>seguridad y confidencialidad </strong>, en cumplimiento de lo dispuesto en la Ley Org&aacute;nica 15/1999 de 13 de Diciembre de Protecci&oacute;n de Datos. </span></th>
  </tr>
</table>
<p>&nbsp;</p>
              <p>Aceptar condiciones
  <input name="pol" type="checkbox" id="pol" value="S" />
</p></div>
          <button class="boton_envio">Registrarse</button>
  </form>
  <p>&nbsp;</p>
     
  </div>
  </div>
</div>
<p>&nbsp;</p>
<p>&nbsp; </p>