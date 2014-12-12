<?php $ed = (isset($_GET["ed"])) ? $_GET["ed"] : exit();
?>
<div class="block">
      <div class="block-bot">
          <div class="head">
            <div class="head-cnt">
              <h3>
                <?php if ($ed == 'add'){
              	$ed='adddo.php';
              	echo "Añadir Entrada";}?>
              	
              	<?php if ($ed == 'edit'){
              	$ed='editardo.php?id=';
              	$ed=$ed.$_GET["id"];
              	echo "Editar Entrada";}?>
              </h3>
      
            </div>
          </div>
          <div class="row-articles articles">

   
        
<iframe src="<?php echo $ed?>" name="add" width="99%" height="550" marginheight="0" marginwidth="0" noresize scrolling="No" frameborder="0"></iframe>

</div>
</div>
</div>
</div>
</body>