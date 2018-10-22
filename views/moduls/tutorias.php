<?php
//session_start();
if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=ingresar");
	exit();
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-1"></div>

<div class="col-md-10">		
<?php

	$vistaTutorias = new Controlador_MVC();
	$vistaTutorias -> vistaTutoriasController();
	
?>
</div>

<div class="col-md-1"></div>