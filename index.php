<?php
    include_once("config.php"); 
$conex = mysql_connect ("$servidor","$usuario","$password"); 
if (!$conex) 
{ 
die('NO puede conetarse: ' . mysql_error()); 
} 
mysql_select_db ("$database", $conex); 
$resultado = mysql_query ("SELECT * FROM noticia order by top desc limit 0,4"); 
$resultado2 = mysql_query ("SELECT * FROM comentarios order by fecha desc limit 0,4");  

   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>People Revolution</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="css/hexaflip.css" rel="stylesheet" type="text/css">
<link href="css/demo.css" rel="stylesheet" type="text/css">
<!--[if IE 6]><link rel="stylesheet" href="css/ie6-style.css" type="text/css" media="all" /><![endif]-->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/fns.js" type="text/javascript"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script src="js/ckeditor.js"></script>
</head>
<?php if($_GET['entrada'] !=""){
			if($_GET['id'] !=""){
				$sec=$_GET['entrada'].'.php?id='.$_GET['id'];}
				else{
				$sec=$_GET['entrada'].'.php';}
		
		}
	  else{
	  		if($_GET['id'] !=""){
	  			$sec='detalle.php?id='.$_GET['id'];
	  		}
	  		else{
	  			$sec='inicio.php';}}
 ?>
<body onload="javascript:Enviar('<?php echo $sec; ?>','contenido');javascript:Enviar('user.php','log')">
<!-- Page -->
<div id="page" class="shell">
  <!-- Header -->
  <div id="header">
    <!-- Top Navigation -->
    <div id="top-nav"></div>
    <!-- / Top Navigation --><!-- Logo -->
    <div id="logo">
      <!-- <h1><a href="http://www.peoplerevolution.net/">People<span>revolution</span></a></h1> -->
	  <div id="hexaflip-demo1" class="demo"></div>
	  <div id="hexaflip-demo2" class="demo"></div>
	  <p class="description">Información y cultura al alcance de todo - SYSWEB Proyecto</p>
	  <script src="js/hexaflip.js"></script>
	 </div>
    <script>
        var hexaDemo1,
            text1 = 'PEOPLE'.split(''),
            text2 = 'REVOLUTION'.split(''),
            settings = {
                size: 30,
                margin: 12,
                fontSize: 20,
                perspective: 450
            },
            makeObject = function(a){
                var o = {};
                for(var i = 0, l = a.length; i < l; i++){
                    o['letter' + i] = a;
                }
                return o;
            },
            getSequence = function(a, reverse, random){
                var o = {}, p;
                for(var i = 0, l = a.length; i < l; i++){
                    if(reverse){
                        p = l - i - 1;
                    }else if(random){
                        p = Math.floor(Math.random() * l);
                    }else{
                        p = i;
                    }
                    o['letter' + i] = a[p];
                }
                return o;
            };
    
        document.addEventListener('DOMContentLoaded', function(){
            hexaDemo1 = new HexaFlip(document.getElementById('hexaflip-demo1'), makeObject(text1), settings);
            hexaDemo2 = new HexaFlip(document.getElementById('hexaflip-demo2'), makeObject(text2), settings);
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1, true));
                hexaDemo2.setValue(getSequence(text2, true));
            }, 0);
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1));
                hexaDemo2.setValue(getSequence(text2));
            }, 1000);
    
            setTimeout(function(){
                setInterval(function(){
                    hexaDemo1.setValue(getSequence(text1, false, true));
                    hexaDemo2.setValue(getSequence(text2, false, true));
                }, 8000);
            }, 10000);
        }, false);
    
    </script>

    
    <!-- / Logo -->
    <!-- Main Navigation --><!-- / Main Navigation -->
    <div class="cl">&nbsp;</div>
    <!-- Sort Navigation -->
    <div id="sort-nav">
      <div class="bg-right">
        <div class="bg-left">
          <div class="cl">&nbsp;</div>
          <ul>
            <li class="first active first-active"><a href="javascript:Enviar('inicio.php','contenido','4')">Inicio</a><span class="sep">&nbsp;</span></li>
            <li><a href="javascript:Enviar('seccion.php?tipo=n','contenido')">Noticias </a><span class="sep">&nbsp;</span></li>
            <li><a href="javascript:Enviar('seccion.php?tipo=v','contenido')">Videocast </a><span class="sep">&nbsp;</span></li>
            <li><a href="javascript:Enviar('quien.php','contenido')">¿Quienes somos?</a><span class="sep">&nbsp;</span></li>
            <li><a href="javascript:Enviar('unete.php','contenido')">Únete</a><span class="sep">&nbsp;</span></li>
            <li><a href="javascript:Enviar('contacto.php','contenido')">Contacto</a><span class="sep">&nbsp;</span></li>
          </ul>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
    </div>
    <!-- / Sort Navigation -->
  </div>
  <!-- / Header -->
  <!-- Main -->
  <div id="main">
    <div id="main-bot">
      <div class="cl">&nbsp;</div>
      <!-- Content -->
      <div id="content">
      <div id="contenido">

      </div>
    </div>
    </div>
    <!-- / Content -->
    <!--  -->
    <div id="sidebar">
      <!-- Search -->
      <div id="search" class="block">
        <div class="block-bot">
          <div class="block-cnt">
            <form action="javascript:Enviar('buscar.php','contenido')" method="post">
              <div class="cl">&nbsp;</div>
              <div class="fieldplace">
                <input type="text" class="field" value="Buscar" title="Search" />
              </div>
              <input type="submit" class="button" value="GO" />
              <div class="cl">&nbsp;</div>
            </form>
          </div>
        </div>
      </div>
      <!-- / Search -->
      <!-- Sign In -->
<div id="correcto">
<div id="log">


</div>
</div>
      <!-- / Sign In -->
     
      <div class="block">
       <div id="topn"></div>
      <div class="block">
        <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>Lo mas visto</h3>
            </div>
          </div>
          <div class="image-articles articles">
            <div class="cl">&nbsp;</div>
                        <?php      while($mostrador = mysql_fetch_array($resultado)) {
 ?>
            <div class="article">
              <div class="cl">&nbsp;</div>
              <div class="image"> <a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php
                      echo "<img src=images_bd.php?id=$mostrador[id]&tam=2&aux=noticia alt=\"Imagen descriptiva del ultimo producto añadido\"  width=\"51\" height=\"51\"  class=alignleft >"; ?></a> </div>
              <div class="cnt">
                <h4><a href="javascript:Enviar('detalle.php?id=<?php echo $mostrador['id']; ?>','contenido');"><?php echo $mostrador['titulo'] ?></a></h4>
                <p><?php 
                
                	$aux = $mostrador['detalle']; 
                        	$tam = strlen($aux);
                        	
                        	if ($tam > 19){

                        	for ($i = 0; $i <= 20; $i++) {
    						echo $aux[$i];
							}
							echo "...";
							}
							else {
							echo $aux;
							}
                 ?> </p>
              </div>
              <div class="cl">&nbsp;</div>
            </div>
                <?php 
}?>
    
            <a href="javascript:Enviar('topn.php','contenido');" class="view-all">Mostrar todo</a>
            <div class="cl">&nbsp;</div>
          </div>
        </div>
      </div>
      </div>
      <div class="topv">
      <div class="block">
        <div class="block-bot">
        <div id="comen">

		<?php include("comen.php") ?>
  </div>

        </div>
      </div>
    </div>
    </div>
    <!-- / Sidebar -->
    <div class="cl">&nbsp;</div>
    <!-- Footer -->
    <div id="footer">
      <div class="navs">
        <div class="navs-bot">
          <div class="cl">&nbsp;</div>
          <ul>
            <li><a href="http://-/">Comunidad</a></li>
            <li><a href="javascript:Enviar('./foro/index.php','contenido');">Foro</a></li>
            <li><a href="http://-">Redes</a></li>
            <li><a href="http://-/">Descargas</a></li>
            <li><a href="http://-/">Aviso Legal</a></li>
          </ul>
<div class="cl">&nbsp;</div>
        </div>
      </div>
      <p class="copy">&copy; peoplerevolution.net</p>
    </div>
    <!-- / Footer -->
  </div>
</div>
<!-- / Main -->
</div>

</body>
</html>
