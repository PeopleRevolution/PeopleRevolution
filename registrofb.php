<?php 
require 'config.php';
//include("conexion.php");
require 'src/facebook.php';  // Include facebook SDK file
//require 'functions.php';  // Include functions
$facebook = new Facebook(array(
  'appId'  => '1529379410651232',   // Facebook App ID 
  'secret' => 'a78867afb22c6376ae7c5704a3533cef',  // Facebook App Secret
  'cookie' => true,	
));
$user = $facebook->getUser();
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
	    $_SESSION['id']=    $fbid;       
	    $_SESSION['USERNAME'] = $fbuname;
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
    //       checkuser($fbid,$fbuname,$fbfullname,$femail);    // To update local DB
   
  
				$date= time(); 
				$nick= $_SESSION['FULLNAME'];
				$mail= $_SESSION['EMAIL'];
				$auxr=rand();
				$pass= md5(md5($auxr));
				$admin= "N";
				$verificar= "S";
				$ipuser= $_SERVER['REMOTE_ADDR'];  
				 

          
	  
  } //try
  
  
	catch (FacebookApiException $e) {
    error_log($e);
   $user = null;
  }
}

if ($user) {

	    			$verifica = mysql_query("SELECT * FROM `usuarios`  WHERE `id` = '$fbid'"); 

                    if (mysql_num_rows ($verifica) < 1) { 
                         
			
			 mysql_query("INSERT INTO usuarios (id,fecha,nick,mail,pass,ip,admin,verificar) values ('$fbid','$date','$nick','$mail','$pass','$ipuser','$admin','$verificar')");
      
        //Estoy recibiendo el formulario, compongo el cuerpo
		$cuerpo = "<h1>Bienvenido a la página de PeopleRevolution</h1>";
		$cuerpo .= "<p>Estos son tus datos de registro:</p>";
		$cuerpo .= "<p>Usuario " . $nick . "</p>";
		$cuerpo .= "<p>Email: " . $mail . "</p>";
		$cuerpo .= "<p>Contraseña: " . $auxr . "</p>";
		$cuerpo .= "<p>Ahora puedes empezar a disfrutar en nuestro sitio, podrás comentar y participar en nuestro site. Esperamos que tengas una feliz estancia.</p>";


	// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Cabeceras adicionales
	$cabeceras .= 'From: PeopleRevolution <admin@peoplerevolution.net>' . "\r\n";

		//mando el correo...
		mail($mail,"Registro en PeopleRevolution",$cuerpo,$cabeceras);
		//header("Location: index.php");
	 }
	 

	 $b_user= mysql_query("SELECT * FROM usuarios WHERE id='$fbid'");   
    $ses = @mysql_fetch_assoc($b_user) ;

  
            $_SESSION['fecha']=    $ses["fecha"];
            $_SESSION['nick']=    utf8_encode($ses["nick"]);
            $_SESSION['mail']=    $ses["mail"];
            $_SESSION['ip']=        $ses["ip"];
            $_SESSION['admin']=     $ses["admin"];
			$_SESSION[foto]=     $ses[foto];
	header("Location: index.php");
	
} else {
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
 header("Location: ".$loginUrl);
}

?>