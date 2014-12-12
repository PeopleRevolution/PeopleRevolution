<?php 
function paginator($url,$start,$filas_tot,$aux,$id) {
if(($start + 5) <= $filas_tot)
   {
?>    <a href="javascript:Enviar('<?php echo $url; ?>?id=<?php echo $id ?>&start=<?php echo ($start + 5); ?>','contenido');">Página anterior</a>
	  
      <?php
   }

   if($start > 0)
   {
	   ?>
	<a href="javascript:Enviar('<?php echo $url; ?>?id=<?php echo $id ?>&start=<?php echo ($start - 5); ?>','contenido');">Página siguiente</a>
<?php
   }

 
    echo "<br>";
   echo "<b>";
   echo "Página: ";
   echo "</b>";
   $aux2= ($start/5) + 1;
   echo"$aux2";
   echo "<b>";
   echo " de ";
   echo "</b>";
   echo "$aux";
   echo "</br>";
     echo "<br>";
   echo "<b>";
}
   ?>