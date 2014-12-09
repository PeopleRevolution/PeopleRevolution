<?php
include("conexion.php");
 if(isset($_SESSION['id'])){
	 
	 ?>
     <div id="correcto">
<div id="log">
     <div id="sign" class="block">
       <div class="block-bot">
         <div class="block-cnt">
           <div class="cl">&nbsp;</div>  
           <h4>
             <?php
echo 'Bienvenido <b>' . $_SESSION['nick'];
?>

             <?php
			 $id= $_SESSION['id'];
			   $admin= $_SESSION['admin'];
	$id= $_SESSION['id'];
	$img= $_SESSION[foto];
if ($img == ""){
	echo '</b><br />';
	 echo "<img src=imagenes/userg.png height=109 weight=54 alt=\"Imagen perfil usuario\" >";
	}
else{
	echo '</b><br />';
 echo "<img src=images_bd.php?id=$id&tam=1&aux=usuarios height=109 weight=54 alt=\"Imagen perfil usuario\" >";}
 ?>
             <a href="javascript:Enviar('login.php?modo=desconectar','contenido')"><br>Salir</a> |
              
              
              <a href="javascript:Enviar('login.php','contenido','9');"><font
id=9>Panel de control</a>
              |<?php if ($_SESSION['admin'] == 'S'){?>
              <a href="javascript:Enviar('add.php','contenido','10')"><font
id=10>Publicar</a></h4>
            <?php }?></div>



</div>
</div>

<?php
}
else
{
?>
<div id="correcto">
<div id="log">
     <div id="sign" class="block">
       <div class="block-bot">
         <div class="block-cnt">
            <div class="cl">&nbsp;</div>

        <form action="javascript:login()"name="login_user"  class="contacto">
        <div style="background-color:red;color:white;padding:0px;text-align:center;	" id="form"></div>
            <div>
              <p>
                <label>Usuario:</label>
              </p>
              <p>
                <input type="text" class="field" name="minick" />
              </p>
            </div>
            <div>
              <p>
                <label>Contraseña:<br />
                </label>
                <input type="password" class="field" name="mipass" />
              </p>
              <p>&nbsp; </p>
            </div>
          <button class="button button-left"  >Conectar</button> 
          <a href="javascript:Enviar('registro.php','contenido')" class="button button-right">Crear Cuenta</a>
        </form>

</div>
</div>
            <div class="cl">&nbsp;</div>
            <p class="center"><a href="javascript:Enviar('ayuda.php','contenido')">¿Ha olvidado su contraseña?</a></p>
			<div class="cl">&nbsp;</div>
			<i class="fa fa-facebook-square"></i>
			<a href="javascript:Enviar('registrofb.php', 'contenido')"</a>

    </div>
  </div>
</div>
<?php } ?>
