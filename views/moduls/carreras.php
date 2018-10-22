<?php

if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">			
<?php

	$vistaCarrera = new Controlador_MVC();
	$vistaCarrera -> vistaCarrerasController();
	//$vistaCarrera -> editarCarreraController();
	$vistaCarrera -> deleteCarreraController();

	if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}
?>
</div>

<div class="col-md-3"></div>