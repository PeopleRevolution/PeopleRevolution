<?php

?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>  <p class="titulo"><u>Panel de Control</u></p></h3>
      
            </div>
          </div>
          <div class="row-articles articles">
    

            <div class="article">

<div id="correcto"> </div>
  <p>

    <div>
    <?php
    echo 'Bienvenido <b>' . $_SESSION['nick'];
    $admin= $_SESSION['admin'];
	$id= $_SESSION['id'];
	$img= $_SESSION[foto];
	if ($admin != 'N'){
	echo " (Usuario administrador)";}
	echo '</b><br /><br />';
	 ?>
     </div>
 <div id="info">
 <?php
if ($img == ""){
	echo '</b><br />';
	 echo "<img src=imagenes/userg.png height=109 weight=54 alt=\"Imagen perfil usuario\" >";
	}
else{
 echo "<img src=images_bd.php?id=$id&tam=1&aux=usuarios height=109 weight=54 alt=\"Imagen perfil usuario\" >";}
 ?></div>
 <div id="panel">
 <?php
 	echo '</b><br /><br />';
    echo '<b>Fecha de registro:</b> ' . date("d-m-Y - H:i", $_SESSION['fecha']) . '<br />';
    echo '<b>Email de registro:</b> ' . $_SESSION['mail'] . '<br />';
    echo '<b>IP:</b> ' . $_SESSION['ip'] . '<br /><br />';
	echo "<br>";
	echo '</b><br /><br />';
	?>
 </div>
<div>
    <?php if ($admin == 'S'){?>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
              <td width="20%"><img src="imagenes/blue-add-button.jpg" alt="Boton de aÒadir" width="110" height="100" /></td>
              <td width="20%" align="center"><img src="imagenes/ACTUALIZACIONES.jpg" alt="Boton de modificar" width="110" height="100" /></td>
              <td width="20%"><img src="imagenes/users.jpg" alt="Boton de preferencias" width="110" height="100" /> </td>
                    <td width="20%"><img src="imagenes/consejo-administracion.jpg" alt="Boton de administraciÛn" width="110" height="100" /> </td>
              
              <td width="20%"><img src="imagenes/16581346-logout-blue-glossy-icon-on-white-background.jpg" alt="Boton de desconectar" width="110" height="100" /></td>
    </tr>
            <tr>
              <td><a href="javascript:Enviar('edicion.php?ed=add','contenido')">A–adir Entrada</a></td>
              <td><a href="javascript:Enviar('addm.php','contenido')">Modificar/Borrar Entrada</a></td>
             <td><a href="javascript:Enviar('editaru.php','contenido');">Preferencias</a></td>			
             <td><a href="javascript:Enviar('preferencias.php','contenido')">Administrar</a></td> 
             <td><a href="javascript:Enviar('login.php?modo=desconectar','contenido')">Desconectar</a></td></tr>
 			
              <?php }?></table></div>
              <div>
                  <?php if ($admin == 'N'){?>
                   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
              <td width="23%"><img src="imagenes/users.jpg" alt="Boton de preferencias" width="110" height="100" /> </td>
              <td width="36%"><img src="imagenes/16581346-logout-blue-glossy-icon-on-white-background.jpg" alt="Boton de desconectar" width="110" height="100" /></td>
    </tr>
            <tr>
             <td><a href="javascript:Enviar('editaru.php','contenido');">Preferencias</a></td>           
             <td><a href="javascript:Enviar('login.php?modo=desconectar','contenido')">Desconectar</a></td>
 			        </tr>
              <?php }?>
    
          </table>
</div>
            
</div>
</div>
</div>