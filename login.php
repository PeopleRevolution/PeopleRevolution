<?php
include("conexion.php");
mysql_query("SET NAMES 'UTF-8'");

if(isset($_GET['modo']) == 'desconectar')
{
    session_destroy();
	?>
    <div id="correcto">
      <?php
   echo '<meta http-equiv="Refresh" content="2;"> ';
	echo "<div style=\"background-color:green;color:white;padding:4px;text-align:center;\"><p>Te has desconectado del sistema.</p></div>";
    exit();
	?>
</div>
    <?php
}

    $nick= $_GET['nick'];
if($nick !="")
{
    $pass= md5(md5($_GET['pass']));
    $b_user=mysql_query("SELECT * FROM usuarios WHERE nick='$nick'");    
    $ses = @mysql_fetch_assoc($b_user) ;
    if(@mysql_num_rows($b_user))
    {
if($ses['pass'] == $pass)
        {    
        
        	if($ses['verificar'] != "S"){
			
		echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>Aún no has validado tu correo. Debes validarlo para poder acceder a tu cuenta</p></div>";
			}
        else{
        
        
            $_SESSION['id']=        $ses["id"];
            $_SESSION['fecha']=    $ses["fecha"];
            $_SESSION['nick']=    $ses["nick"];
            $_SESSION['mail']=    $ses["mail"];
            $_SESSION['ip']=        $ses["ip"];
            $_SESSION['admin']=     $ses["admin"];
			$_SESSION[foto]=     $ses[foto];
        

        }
  
  	}
  	
  	else {
  		echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>Contraseña incorrecta. Vuelva a intentarlo.</p></div>";
    exit();
  	}
  	
  	}
    else 
    {
	echo "<div style=\"background-color:red;color:white;padding:4px;text-align:center;\"><p>No existe el usuario.</p></div>";
    exit();
    }
}
 if(isset($_SESSION['id'])){
        include("panel.php");   }
