<?php
	if(isset($_GET['mensaje']))
{
	$destinatario='bonedark@gmail.com';
	$mensaje=$_GET['mensaje'];
	$nombre=$_GET['nombre'];
	$apellidos=$_GET['apellidos'];
	$email=$_GET['email'];

	//Estoy recibiendo el formulario, compongo el cuerpo
	$cuerpo = "<h1>Contacto por formulario desde UA</h1>";
		
	$cuerpo .= "<p>Nombre " . $nombre . "</p>";
	$cuerpo .= "<p>Apellidos: " . $apellidos . "</p>";
	$cuerpo .= "<p>Email: " . $email . "</p>";

	$cuerpo = $cuerpo."<p>Mensaje: " . $mensaje. "</p>";

	//mando el correo...
	mail($destinatario,"Nuevo mensaje UA",$cuerpo,"MIME-Version: 1.0\nContent-type: text/html; charset=UTF-8\nFrom: ".$emisor." Usabilidad & Accesibilidad");
	
	//doy las gracias por el envio
	echo "<div style=\"background-color:green;color:white;padding:4px;text-align:center;\">Gracias por rellenar el formulario. Se ha enviado correctamente.</div>";
}
else{
?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Contacto</h3>
      
            </div>
          </div>
          <div class="row-articles articles">
  <div id="correcto">
    <form action="javascript:contacto()"name="enviar_email"  class="contacto">
          <div id="form"></div>
            <div><label>Nombre:</label><input type="text" class="nombre" name="nombre" /></div>
            <div>
              <label>Apellidos: </label><input type="text" class="apellidos" name="apellidos" /></div>
            <div><label>Email:</label><input type="text" class="email" name="email" /></div>
            <div><label>Mensaje:</label><textarea cols="30" rows="5" class="mensaje" name="mensaje" style="background-color: #87CEEB;"></textarea></div>
              <button class="boton_envio"  >Enviar Mensaje</button>
     </form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>