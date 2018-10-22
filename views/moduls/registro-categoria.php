<?php

if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=ingresar");
	exit();
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">	
	<div class="card card-warning">
	    <div class="card-header">
	        <h3 class="card-title"><i class="fa fa-tags" style="font-size: 32px;"></i>&nbsp;+ Nueva Categoria para tutoria</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	        	
	        	<div class="form-group">          
	              	<label for="nombreCategoria">Nombre:</label>
	              	<input type="text" required class="form-control" id="nombreCategoria"
	               name="nombreCategoria" placeholder="Nombre">
	          	</div>

	 		</div>
	        <!-- /.card-body -->
	        <div class="card-footer">
	           	<center><button type="submit" name="GuardarCategoria" class="btn btn-warning">Guardar</button></center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-3"></div>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevaCategoriaController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
}

?>