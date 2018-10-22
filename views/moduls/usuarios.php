<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">	
<?php

	$vistaUsuarios = new Controlador_MVC();
	$vistaUsuarios -> vistaUsuariosController();
	
?>
</div>

<div class="col-md-3"></div>