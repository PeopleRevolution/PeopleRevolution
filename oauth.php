<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
include('config.php');
include("conexion.php");


if(isset($_GET['oauth_token']))
{


	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token)
	{
			$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			$params =array();
			$params['include_entities']='false';
			$content = $connection->get('account/verify_credentials',$params);

			if($content && isset($content->screen_name) && isset($content->name))
			{
				$_SESSION['name']=$content->name;
				//$_SESSION['image']=$content->profile_image_url;
				$_SESSION['twitter_id']=$content->screen_name;
				$twid= $content->id;
				$date= time(); 
				$nick= $content->screen_name;
				//$mail= $content->mail;
				$auxr=rand();
				$pass= md5(md5($auxr));
				$admin= "N";
				$verificar= "S";
				$ipuser= $_SERVER['REMOTE_ADDR'];  
				$verifica = mysql_query("SELECT * FROM `usuarios`  WHERE `id` = '$twid'"); 
				$auxq=false;
                    if (mysql_num_rows ($verifica) < 1) { 
                         
						$auxq=true;
			// mysql_query("INSERT INTO usuarios (id,fecha,nick,pass,ip,admin,verificar) values ('$twid','$date','$nick','$pass','$ipuser','$admin','$verificar')");
      
      		 //header('Location: http://peoplerevolution.net/desarrollo/?entrada=mailtwitter');
	 }
	 			 
				//redirect to main page.
			if($auxq){
				header("Location: http://peoplerevolution.net/desarrollo/?entrada=mailtwitter");
			}	$_SESSION['aux']= $twid;
			else
			if(!$auxq){
				$b_user= mysql_query("SELECT * FROM usuarios WHERE id='$twid'");   
    		    $ses = @mysql_fetch_assoc($b_user) ;
    		    $_SESSION['id']= $twid;
            	$_SESSION['fecha']=    $ses["fecha"];
            	$_SESSION['nick']=    $ses["nick"];
            	$_SESSION['mail']=    $ses["mail"];
            	$_SESSION['ip']=        $ses["ip"];
            	$_SESSION['admin']=     $ses["admin"];
				$_SESSION[foto]=     $ses[foto];

				header('Location: index.php'); }

			}
			else
			{
				echo "<h4> Error </h4>";
			}
	}

else
{

	echo "<h4> Error </h4>";
}

}
else //Error. redireccionando a principal.
{
	header('Location: http://peoplerevolution.net'); 

}

?>