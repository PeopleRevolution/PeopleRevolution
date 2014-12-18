<?php 
include('config.php');
include_once("conexion.php");
?>

<div style="background-color:green;color:white;padding:4px;text-align:center;">
  <p>Usuario <?php echo $_SESSION['nick']; ?> activado correctamente.</p>
</div>

<?php
$verificar = "S";
//recibimos la variable id enviada en el enlace por GET
//$id=$_GET[id];
//conectamos a la base
$connect= mysql_connect ("$servidor","$usuario","$password"); 
//Seleccionamos la base
mysql_select_db("$database",$connect);
//hacemos las consultas
$id = (isset($_GET["id"])) ? $_GET["id"] : exit();
$b_user= mysql_query("SELECT * FROM usuarios WHERE verificar='$id'");   
    		    $ses = @mysql_fetch_assoc($b_user) ;
				$_SESSION['id']=    $ses["id"];
            	$_SESSION['fecha']=    $ses["fecha"];
            	$_SESSION['nick']=    $ses["nick"];
            	$_SESSION['mail']=    $ses["mail"];
            	$_SESSION['ip']=        $ses["ip"];
            	$_SESSION['admin']=     $ses["admin"];
				$_SESSION['foto']=     $ses['foto'];


mysql_query("UPDATE usuarios SET verificar='$verificar' WHERE verificar='$id'",$connect);
				//header('Location: index.php');

?> 

