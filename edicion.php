<?php $ed = (isset($_GET["ed"])) ? $_GET["ed"] : exit();
?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>
                <?php if ($ed == 'add'){
              	$ed='adddo.php';
                $scroll= "no";
                $altura= "550";
              	echo "Añadir Entrada";}?>
              	
              	<?php if ($ed == 'edit'){
              	$ed='editardo.php?id=';
              	$ed=$ed.$_GET["id"];
                $scroll= "no";
                $altura= "670";
              	echo "Editar Entrada";}?>
              </h3>
      
            </div>
          </div>
          <div class="row-articles articles">

   
        
<iframe src="<?php echo $ed?>" name="add" width="99%" height="<?php echo $altura?>" marginheight="0" marginwidth="0" noresize scrolling="<?php echo $scroll?>" frameborder="0"></iframe>

</div>
</div>
</div>
</div>
</body>