<?php
session_start();
if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=ingresar");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">
	<div class="card card-secondary">
	    <div class="card-header">
	        <h3 class="card-title"><i class="fa fa-user-plus" style="font-size: 36px;"></i> Nuevo Alumno</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	 		
	 			<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-key"></i></span>
			        </div>
		            <input type="text" required class="form-control" id="matricula" name="matricula" placeholder="Matricula">
		        </div>

		 		<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-address-card"></i></span>
			        </div>
		            <input type="text" required class="form-control" id="nombre" placeholder="Nombre(s)" name="nombre" placeholder="Nombre(s)">
		        </div>

		        <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-address-card"></i></span>
			        </div>
		            <input type="text" required class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos" placeholder="Apellidos">
		        </div>

		        <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-institution"></i></span>
			        </div>
                	<select id="carrera" name="carrera" class="form-control" required>
                  	<?php 
                    $carreras = CarreraData::viewCarrerasModel("carreras");;
                    echo '<option value="" disabled selected >Selecciona una carrera</option>';
                    foreach ($carreras as $carrera) {
                      	echo '<option value="'.$carrera['id'].'" >'.$carrera['nombre'].'</option>';
                    }
                   	?>
                	</select>
          		</div>

          		<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-user"></i></span>
			        </div>
                	<select id="tutor" name="tutor" class="form-control" required>
                  	<?php 
                    $maestros = MaestroData::viewMaestrosModel("maestros");;
                    echo '<option value="" disabled selected >Selecciona tutor</option>';
                    foreach ($maestros as $tutor) {
                      	echo '<option value="'.$tutor['no_empleado'].'" >'.$tutor['nombre']." ".$tutor['apellidos'].'</option>';
                    }
                   	?>
                	</select>
          		</div>

	 		</div>
	        <!-- /.card-body -->
	        
	        <div class="card-footer">
	           	<center><button type="submit" name="GuardarAlumno" class="btn btn-secondary">Guardar</button></center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-4"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevoAlumnoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
