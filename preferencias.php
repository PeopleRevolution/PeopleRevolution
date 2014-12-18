<?php include_once("config.php"); 
include("conexion.php");
include("paginator.php");
$admin= $_SESSION['admin'];
if ($admin == 'N'){
echo "Lo sentimos esta página es solo para admnistradores";	
exit();
}


$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
 

$start = (empty($_REQUEST["start"]) ? 0 : ($_REQUEST["start"]));
$start = mysql_real_escape_string($start);
$end = 5;
$resultado = mysql_query ("SELECT * FROM usuarios"); 
$filas_tot = mysql_num_rows($resultado);
$aux=ceil($filas_tot/5);
$resultado = mysql_query ("SELECT * FROM usuarios ORDER BY fecha DESC LIMIT $start, $end");


?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Usuarios Registrados</h3>
                  </div>
          </div>
          <div class="row-articles articles">


<?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>
<table width="93%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
<?php
while($mostrador = mysql_fetch_array($resultado)) 
{ 
if($mostrador['admin'] == 'S')
  $color="#3366CC";
else
  $color="#006699";

  ?>

    <td width="27%" bgcolor="<?php echo $color ?>" ><p>
      <?php $img = $mostrador[foto];
if ($img == ""){
   echo "<img src=imagenes/userg.png height=109 weight=54>";
  }
else
 echo "<img src=images_bd.php?id=$mostrador[id]&tam=1&aux=usuarios height=109 weight=54 alt=\"Imagen perfil de usuario\" >"; ?></p>
    <p>Usuario: <?php echo $mostrador['nick'] ?> </p>
    <a href="javascript:Enviar('editaru.php?id=<?php echo $mostrador['id']; ?>','contenido');">Editar usuario</a></p>
          <p><a href="javascript:borrar('<?php echo $mostrador['id']; ?>','usuarios');">Borrar usuario</a></p></td>
    <td width="73%" bgcolor="<?php echo $color ?>" class="tablas"> <?php
        $admin= $mostrador['admin'];
  if ($admin != 'N'){
  echo " (Usuario administrador)";}
    echo '</b><br /><br />';
    echo '<b>Fecha de registro:</b> ' . date("d-m-Y - H:i", $mostrador['fecha']) . '<br />';
    echo '<b>Email de registro:</b> ' . $mostrador['mail'] . '<br />';
    echo '<b>IP:</b> ' . $mostrador['ip'] . '<br /><br />';
  echo "<br>";?>
    </td>
  </tr>
  
<?php
} 
mysql_close($conex); 
?>
</table>
<?php paginator(array_pop(explode('/', $_SERVER['PHP_SELF'])),$start,$filas_tot,$aux,'0'); ?>

</div>
</div>
</div>
</div>
</div>