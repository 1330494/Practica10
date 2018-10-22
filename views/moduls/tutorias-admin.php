<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>


<div class="col-md-12">		
<?php

	$vistaPagos = new Controlador_MVC();
	$vistaPagos -> vistaTutoriasAdminController();
	
?>
</div>