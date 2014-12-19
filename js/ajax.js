function ajaxFunction() {
var xmlhttp = false;
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
catch (E) {
xmlhttp = false;
}
}

if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
xmlhttp = new XMLHttpRequest();
}

xmlhttp.overrideMimeType('text/html; charset=iso-5589-1');
return xmlhttp;
} 


function Enviar(_pagina,capa) {
    var ajax;
    ajax = ajaxFunction();
    ajax.open("GET", _pagina, true);
    ajax.setRequestHeader("Content-Type", "text/html; charset=iso-5589-1");

    ajax.onreadystatechange = function() {
		if (ajax.readyState==1){
			document.getElementById(capa).innerHTML = " Aguarde por favor...";
			     }
		if (ajax.readyState == 4) {
		   
                document.getElementById(capa).innerHTML=ajax.responseText; 
		     }}
			 
	ajax.send(null);

} 


//funciÛn constructora del objeto:			 
function ObjetoAjax () {
     var nuevoajax=ajaxFunction()
     this.objeto=nuevoajax;
     this.pedirTexto=Enviar;
	
     }			

function contacto() {
   //Recoger datos del formulario:
	emis=document.enviar_email.nombre.value;
	ape=document.enviar_email.apellidos.value;
	men=document.enviar_email.mensaje.value;
	ema=document.enviar_email.email.value;
	aux = validarcontacto(document) ;
	if (aux == true){
   //Escribir la url para enviar los datos anteriores:
   ruta="contacto.php" //ruta del archivo
   envio0="nombre="+emis; //datos email
   envio1="apellidos="+ape; //datos email
   envio2="email="+ema; //datos contraseÒa 1™
   envio3="mensaje="+men; //datos contraseÒa 2™
   url=ruta+"?"+envio0+"&"+envio1+"&"+envio2+"&"+envio3; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"correcto"); //mÈtodo que devuelve texto en un id.
   }}
   
function foro() {
   //Recoger datos del formulario:
	titulo=document.f.titulo.value;
	mensaje=document.f.mensaje.value;
	identificador=document.f.identificador.value;
   //Escribir la url para enviar los datos anteriores:
   ruta="./foro/agregar.php" //ruta del archivo
   envio0="titulo="+titulo; //datos titulo
   envio1="mensaje="+mensaje; //datos mensaje
   envio2="identificador="+identificador; //datos identificador
   url=ruta+"?"+envio0+"&"+envio1+"&"+envio2; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"contenido"); //mÈtodo que devuelve texto en un id.
   //setTimeout("Enviar('./foro/index.php','contenido')",1000);
   }
   
   function registro() {
   //Recoger datos del formulario:
   renick=document.datos.minick.value; //Email escrito por el usuario
   reemail=document.datos.miemail.value; //Email escrito por el usuario
   recontra1=document.datos.micontra1.value; //ContraseÒa primera
   recontra2=document.datos.micontra2.value; //ContraseÒa segunda
    aux = validarregistro(document) ;
	if (aux == true){
   //Escribir la url para enviar los datos anteriores:
   ruta="registro.php" //ruta del archivo
   envio0="envionick="+renick; //datos email
   envio1="envioEmail="+reemail; //datos email
   envio2="envioContra1="+recontra1; //datos contraseÒa 1™
   envio3="envioContra2="+recontra2; //datos contraseÒa 2™
   url=ruta+"?"+envio0+"&"+envio1+"&"+envio2+"&"+envio3; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"contenido"); //mÈtodo que devuelve texto en un id.
   setTimeout("Enviar('reg.php','correcto')",2000);
   }}
   
      function registrotw() {
   //Recoger datos del formulario:
   reemail=document.datos.miemail.value; //Email escrito por el usuario
   reid=document.datos.miid.value;
    //aux = validarregistro(document) ;
    aux= true;
	if (aux == true){
   //Escribir la url para enviar los datos anteriores:
   ruta="mailtwitter.php" //ruta del archivo
   envio0="envioEmail="+reemail; //datos email
   envio1="envioid="+reid; //datos id
   url=ruta+"?"+envio0+"&"+envio1; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"contenido"); //mÈtodo que devuelve texto en un id.
   setTimeout("Enviar('reg.php','correcto')",2000);
   }}
   
      function login() {
   //Recoger datos del formulario:
   renick=document.login_user.minick.value; //Email escrito por el usuario
   repass=document.login_user.mipass.value; //Email escrito por el usuario
   	aux = validarlogin(document) ;
	if (aux == true){
   //Escribir la url para enviar los datos anteriores:
   ruta="login.php" //ruta del archivo
   envio0="nick="+renick; //datos email
   envio1="pass="+repass; //datos email
   url=ruta+"?"+envio0+"&"+envio1; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"contenido"); //mÈtodo que devuelve texto en un id.
  // temporizadorlogin();
   }}
   
      function loginf(nick,pass) {
   //Recoger datos del formulario:
   renick=nick; //Email escrito por el usuario
   repass=pass; //Email escrito por el usuario
   //Escribir la url para enviar los datos anteriores:
   ruta="login.php" //ruta del archivo
   envio0="nick="+renick; //datos email
   envio1="pass="+repass; //datos email
   url=ruta+"?"+envio0+"&"+envio1; //url para enviar
   ajax1=new ObjetoAjax; //instanciar objeto ObjetoAjax;
   ajax1.pedirTexto(url,"contenido"); //mÈtodo que devuelve texto en un id.
  // temporizadorlogin();
   }
   
function validarcontacto(document) {

  if(document.enviar_email.nombre.value.length==0) { //comprueba que no estÈ vacÌo
    document.enviar_email.nombre.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu nombre";
    return false; //devolvemos el foco
  }
  if(document.enviar_email.apellidos.value.length==0) { //comprueba que no estÈ vacÌo
    document.enviar_email.apellidos.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu apellido";
    return false; //devolvemos el foco
  }
    if(document.enviar_email.email.value.length==0) { //comprueba que no estÈ vacÌo
    document.enviar_email.email.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu email";
    return false; //devolvemos el foco
  }
  
 var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
	if (!filtro.test(document.enviar_email.email.value)) {
       document.enviar_email.email.focus();    
       document.getElementById("form").innerHTML = " No has escrito tu email correctamente";
	return false; //devolvemos el foco
}
  
   if(document.enviar_email.mensaje.value.length==0) { //comprueba que no estÈ vacÌo
    document.enviar_email.mensaje.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu mensaje";
    return false; //devolvemos el foco
  }
	setTimeout("Enviar('inicio.html','contenido','1')",2000);


  return true;
}

function validarlogin(document) {

  if(document.login_user.minick.value.length==0) { //comprueba que no estÈ vacÌo
    document.login_user.minick.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu usuario";
    return false; //devolvemos el foco
  }
  if(document.login_user.mipass.value.length==0) { //comprueba que no estÈ vacÌo
    document.login_user.mipass.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu contraseña";
    return false; //devolvemos el foco
  }
  //setTimeout("Enviar('login.php','contenido','5')",2000);
  setTimeout("Enviar('user.php','log')",1000);
  return true;
}

function addcom() {
var id = document.getElementById("idaux").value;
var start = document.getElementById("start").value;
var idusu = document.getElementById("idusu").value;
url="coment.php?id="+id+"&start="+start+"&idusu="+idusu;
setTimeout("Enviar('comen.php','comen')",2000);
setTimeout("Enviar(url,'auxcom')",2000);
document.getElementById("comen").innerHTML = "Actualizando";
  return true;
	
	}

function validarregistro(document) {

  if(document.datos.minick.value.length==0) { //comprueba que no estÈ vacÌo
    document.datos.minick.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu usuario";
    return false; //devolvemos el foco
  }
  if(document.datos.miemail.value.length==0) { //comprueba que no estÈ vacÌo
    document.datos.miemail.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu email";
	return false; //devolvemos el foco
	}
	
	var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
	if (!filtro.test(document.datos.miemail.value)) {
       document.datos.miemail.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu email correctamente";
	return false; //devolvemos el foco
}
  
	if(document.datos.micontra1.value.length==0) { //comprueba que no estÈ vacÌo
    document.datos.micontra1.focus();   
    document.getElementById("form").innerHTML = " No has escrito tu contraseña";
    return false; //devolvemos el foco
  }

  if(document.datos.micontra2.value.length==0) { //comprueba que no estÈ vacÌo
    document.datos.micontra2.focus();   
    document.getElementById("form").innerHTML = " No has verificado tu contraseÒa";
    return false; //devolvemos el foco
  }
  
    if(document.datos.micontra1.value!=document.datos.micontra2.value) {
    document.datos.micontra1.focus();            //comprueba que sean iguales
	 document.getElementById("form").innerHTML = " Las contraseñas no coinciden";
    return false;
    }
    
    if(document.datos.micontra1.value.length < 6){
    document.datos.micontra1.focus();   
    document.getElementById("form").innerHTML = " No has escrito una contraseña con más de 6 carácteres";
    return false;} //devolvemos el foco
    
      if(document.datos.pol.checked)
      	return true;
      else {
		document.datos.pol.focus();            //comprueba que sean iguales
	 	document.getElementById("form").innerHTML = "Debe aceptar la política de protección de datos";
    	return false;
  }
  

  return true;
}

function validarentrada(document) {

  if(document.titulo.value.length==0) { //comprueba que no estÈ vacÌo
    document.titulo.focus();   
    parent.document.getElementById("form").innerHTML = " No has escrito titulo a la entrada";
    return false; //devolvemos el foco

    
  }
  if(document.subtitulo.value.length==0) { //comprueba que no estÈ vacÌo
    document.subtitulo.focus();   
    parent.document.getElementById("form").innerHTML = " No has escrito subtitulo a la entrada";
    return false; //devolvemos el foco
  
  }
  
	if(document.detalle.value.length==0) { //comprueba que no estÈ vacÌo
    document.detalle.focus();   
    parent.document.getElementById("form").innerHTML = " No has escrito ninguna entrada";
    return false; //devolvemos el foco

  }
    if(document.fotoaux.value != 'N'){
  	if(document.foto.value.length==0) { //comprueba que no estÈ vacÌo
    document.foto.focus();   
    parent.document.getElementById("form").innerHTML = " No has añadido una foto de portada";
    return false; //devolvemos el foco
}
  }
  url="seccion.php?tipo=n";
  setTimeout("Enviar('url','contenido','8')",2000);
  return true;
}

function editarentrada(document) {
  url="seccion.php?tipo=n";
  setTimeout("Enviar('url','contenido','8')",2000);
  return true;
}


function validarusuarioe(document){
  if(document.nick.value.length==0) { //comprueba que no estÈ vacÌo
    document.nick.focus();   
    parent.document.getElementById("form").innerHTML = " No has escrito un nick";
    return false; //devolvemos el foco

    
  }
  if(document.mail.value.length==0) { //comprueba que no estÈ vacÌo
    document.mail.focus();   
    parent.document.getElementById("form").innerHTML = " No has escrito un email";
    return false; //devolvemos el foco
  
  }

   var filtro = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
	if (!filtro.test(document.mail.value)) {
       document.mail.focus();   
       parent.document.getElementById("form").innerHTML = " No has escrito tu email correctamente";
	return false; //devolvemos el foco
}
  
	if(document.pass.value.length!=0) { //comprueba que no estÈ vacÌo
	
		if(document.pass.value.length < 6){
   		 	document.pass.focus();   
    		parent.document.getElementById("form").innerHTML = " No has escrito una contraseÒa con m·s de 6 car·cteres";
    		return false; //devolvemos el foco
    		}

		if(document.pass.value!=document.pass2.value) {
   			 document.pass.focus();
			parent.document.getElementById("form").innerHTML = " Las contraseÒas no coinciden";
			return false; //devolvemos el foco
	        }
	}


  if(document.adminaux.value != 'N'){
	  setTimeout("Enviar('preferencias.php','contenido','10')",2000);}

  if(document.adminaux.value != 'S'){
	  setTimeout("Enviar('editaru.php','contenido','9')",2000);}

  return true;
}


function borrar(id,tipo){
	
	if(tipo =='entrada'){
		del= "borrar.php?tipo=entrada&id=";
	setTimeout("Enviar('inicio.php','contenido','8')",2000);}
	else
	if(tipo =='usuario'){
		del= "borrar.php?tipo=usuario&id=";
	setTimeout("Enviar('preferencias.php','contenido','10')",2000);}
	final = del + id;
	Enviar(final,'contenido');
}

function buscar(){
		aux= "buscar.php?criterio=";
		var buscar = document.getElementById("buscar").value;
	
	final = aux + buscar;
	Enviar(final,'contenido');
}

function changecolor (id)
{

if (id < 7){
	setTimeout("Enviar('user.php','log')",100);
for (var i=1;i<7;i++)
{ 
document.getElementById(i).color = "#D7EE9D";
}
if (id > 0){
document.getElementById(id).color = "red";}
else

document.getElementById(9).color = "red";}
else

for (var i=1;i<11;i++)
{ 
document.getElementById(5).color = "red";
document.getElementById(i).color = "#D7EE9D";
document.getElementById(id).color = "red";
}

}

var i = 0;
function contador()
{
i = i + 1;
var btn = document.getElementById("boton");
btn.value = "Revolution (" + i + ")";
}

$('#sort-nav lu').click(function() {

        // remove active class
        $('#menu li a').removeClass('first active first-active');
        // add active class
        $(this).addClass(''first active first-active');
 });
