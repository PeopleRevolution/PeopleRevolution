<?php 
require 'config.php';
//require 'src/facebook.php';  // Include facebook SDK file
//$user = $facebook->getUser();

if ($user) 
{
	try {
		$user_profile = $facebook->api('/me');
  	    $fbid = $user_profile['id'];                 // To Get Facebook ID
 	    $fbuname = $user_profile['username'];  // To Get Facebook Username
 	    $fbfullname = $user_profile['name']; // To Get Facebook full name
	    $femail = $user_profile['email'];    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
	    $_SESSION['USERNAME'] = $fbuname;
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
    //       checkuser($fbid,$fbuname,$fbfullname,$femail);    // To update local DB
   
  include("conexion.php");
				$date= time(); 
				$nick= $_SESSION['FULLNAME'];
				$mail= $_SESSION['EMAIL'];
				$auxr=rand();
				$pass= md5(md5($auxr));
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
			 mysql_query("INSERT INTO usuarios (fecha,nick,mail,pass,ip,admin) values ('$date','$nick','$mail','$pass','$ipuser','$admin')");
			 
			 //Estoy recibiendo el formulario, compongo el cuerpo
		$cuerpo = "<h1>Bienvenido a la página de PeopleRevolution</h1>";
		$cuerpo .= "<p>Estos son tus datos de registro:</p>";
		$cuerpo .= "<p>Usuario " . $nick . "</p>";
		$cuerpo .= "<p>Email: " . $mail . "</p>";
		$cuerpo .= "<p>Contraseña: " . $pass . "</p>";

		$cuerpo .= "<p>Ahora puedes empezar a disfrutar en nuestro sitio, podrás comentar y participar en nuestro site. Esperamos que tengas una feliz estancia.</p>";

	$cuerpo .= "<p>Pero antes debes verificar que tu email sea verdadero en el siguiente enlance</p>";
	$cuerpo =  $cuerpo."<a href =\"http://www.peoplerevolution.net/verificar.php?nick=$nick\"> Verificar Email </a>";

	// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Cabeceras adicionales
	$cabeceras .= 'From: PeopleRevolution <admin@peoplerevolution.net>' . "\r\n";

		//mando el correo...
		mail($mail,"Registro en PeopleRevolution",$cuerpo,$cabeceras);
		header("Location: index.php");
	 } 
  } //try
  
  
	catch (FacebookApiException $e) {
    error_log($e);
   $user = null;
  }
}

if ($user) {
	header("Location: index.php");
} else {
 //$loginUrl = $facebook->getLoginUrl(array(
		//'scope'		=> 'email', // Permissions to request from the user
		//));
 header("Location: index.php");
}

?>