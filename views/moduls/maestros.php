<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-1"></div>

<div class="col-md-10">			
<?php

	$vistaMaestro = new Controlador_MVC();
	$vistaMaestro -> vistaMaestrosController();
	$vistaMaestro -> deleteMaestroController();

	if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}
?>
</div>

<div class="col-md-1"></div>