<?php 
	//session_start();
	if(!isset($_SESSION["validar"])){
		header("Location: index.php?action=admin");
		exit();
	}

?>

<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-2"></div>

<div class="col-md-8">		
<?php

	$vistaPagos = new Controlador_MVC();
	$vistaPagos -> vistaCategoriasController();
	
?>
</div>

<div class="col-md-2"></div>
