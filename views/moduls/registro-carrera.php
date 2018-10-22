<?php

if(!$_SESSION["validar"]){
	header("Location: index.php?action=admin");
	exit();
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">	
	<div class="card card-success">
	    <div class="card-header">
	        <h3 class="card-title">Nueva Carrera</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	        	
	        	<div class="form-group">          
	              	<label for="nombreCarrera">Nombre:</label>
	              	<input type="text" required class="form-control" id="nombreCarrera"
	               name="nombreCarrera" placeholder="Nombre">
	          	</div>

	          	<div class="form-group">          
	              	<label for="abrevCarrera">Abreviatura:</label>
	              	<input type="text" required class="form-control" id="abrevCarrera"
	               name="abrevCarrera" placeholder="Abreviatura">
	          	</div>

	 		</div>
	        <!-- /.card-body -->
	        <div class="card-footer">
	           	<center><button type="submit" name="GuardarCarrera" class="btn btn-success">Guardar</button></center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-4"></div>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevaCarreraController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
}

?>