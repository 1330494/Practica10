<?php 

/**
* Clase controlador que permite la funcionabilidad del sistema 
* por medio de MVC.
*/
class Controlador_MVC
{
	// Metodo que permite mostrar la plantilla de la pagina
	public function showPage()
	{
		include "views/template.php";
	}

	// Metodo que permite el control de los enlaces y las vistas finales.
	public function linksController()
	{
		if(isset( $_GET['action'])){ // Se obtiene el valor de la variable action
			$enlaces = $_GET['action'];		
		}else{ // De lo contrario se le asigna el valor index
			$enlaces = "index";
		}

		// Obtenemos la respuesta del modelo
		$respuesta = Pages::linksModel($enlaces); 

		include $respuesta;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para INICIO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function DataBaseTablesCounterController()
	{
		$usuarios = UsuarioData::viewUsuariosModel("usuarios");
		$alumnos = AlumnoData::viewAlumnosModel("alumnos");
		$maestros = MaestroData::viewMaestrosModel("maestros");
		$carreras = CarreraData::viewCarrerasModel("carreras");
		$categorias = CategoriaData::viewCategoriasModel("categorias_tutorias");
		$tutorias = CategoriaData::viewCategoriasModel("tutorias");

		$counter = array(
				'usuarios'=>count($usuarios),
				'alumnos'=>count($alumnos),
				'maestros'=>count($maestros),
				'carreras'=>count($carreras),
				'categorias'=>count($categorias),
				'tutorias'=>count($tutorias)
			);

		return $counter;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para el Tipo de Sesion ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function SessionTypeController()
	{
		if(isset($_POST["SubmitUsuario"])){
			if (isset($_POST['checkAs'])) {
				$datosController = array( 
					"email"=>$_POST["emailIngreso"], 
					"password"=>$_POST["passwordIngreso"],
					"check"=>$_POST['checkAs']
				);
				//$ing = new Controlador_MVC();
				$this->ingresoMaestroController($datosController);
			}else{
				$datosController = array( 
					"email"=>$_POST["emailIngreso"], 
					"password"=>$_POST["passwordIngreso"],
					"check"=>'off'
				);
				//$ing = new Controlador_MVC();
				$this->ingresoUsuarioController($datosController);
			}
			
			//print_r($datosController);
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=usuarios';
			  	</script>";
			}
		}
	}

	# REGISTRO DE USUARIOS
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de username y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"email"=>$_POST['email'],
				"password"=>$_POST['password1']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-usuario&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card bg-light">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-users text-dark" style="font-size:32px;">&nbsp;</i>Usuarios</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>E-Mail</th>
						<th>Password</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $usuario){
				echo'<tr>
					<td><span class="badge bg-light">'.$usuario["id"].'</span></td>
					<td>'.$usuario["email"].'</td>
					<td>'.crypt($usuario["password"],'YYL').'</td>
					<td><a href="index.php?action=editar-usuario&idUsuario='.$usuario["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=usuarios&idBorrar='.$usuario["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
				';
				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-light" href="index.php?action=registro-usuario">
	        	<i class="fa fa-user-plus"></i> Nuevo Usuario
	    	</a>
		</div>

		</div>';
	}

	#INGRESO DE USUARIOS
	#------------------------------------
	public function ingresoUsuarioController($datosController)
	{
			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["email"] == $datosController["email"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION['user'] = $respuesta['id'];
				$_SESSION["validar"] = true;
				$_SESSION["rol"] = 1;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	#EDITAR USUARIOS
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'

		<div class="card card-light">
    		<div class="card-header">
        		<h3 class="card-title"><i class="fa fa-user" style="font-size:36px;">&nbsp; </i> Editar Usuario</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
    			<input type="hidden" name="pwUser" id="pwUser" value="'.$respuesta['password'].'">
        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["email"].'" name="emailEditar" required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW1" name="password1Editar" placeholder="Nueva contraseña" required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW2" name=password2Editar" placeholder="Confirmar contraseña" required class="form-control">
					</div>
					<script type="text/javascript">
						document.getElementById("PW2").onchange = function(e){
							var PW1 = document.getElementById("PW1");
							if(this.value != PW1.value ){
								alert("Contraseñas no coinciden.");
								PW1.focus();
								this.value = "";
							}
						};
					</script>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña anterior" required class="form-control">
					</div>
					<script type="text/javascript">
						document.getElementById("oldPassword").onchange = function(e){
							var id = document.getElementById("pwUser");
							if(this.value != id.value ){
								alert("Error a confirmar contraseña anterior.");
								this.focus();
								this.value = "";
							}
						};
					</script>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="UsuarioEditar" class="btn btn-light">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR USUARIOS
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){

			$datosController = array( "email"=>$_POST["emailEditar"],
							        "password"=>$_POST["password1Editar"]);
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=cambio';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para TUTORIAS    +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR TUTORIA
	#------------------------------------
	public function deleteTutoriaController(){
		// Obtenemos el ID del pago a borrar
		if(isset($_GET["idTutoriaBorrar"])){
			$datosController = $_GET["idTutoriaBorrar"];
			// Mandamos los datos al modelo del pago a eliminar
			$respuesta = TutoriaData::deleteTutoriaModel($datosController, "tutorias");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de pagos
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=tutorias';
			  	</script>";
			}
		}
	}

	# REGISTRO DE TUTORIA
	#------------------------------------
	public function nuevaTutoriaController(){

		if(isset($_POST["GuardarTutoria"])){
			//Recibe a traves del método POST el name (html) de no. de empleado, nombre, carrera password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (Usuario, password y email):
			$datosController = array( "id_grupo"=>$_POST["grupo"], 
								      "id_alumna"=>$_POST["alumna"],
								      "nombre_mama"=>$_POST["nombre_mama"], 
								      "apellidos_mama"=>$_POST["apellidos_mama"],
								      "fecha_pago"=>$_POST["pago"],
								      "comprobante"=>$_POST["comprobante"], 
								      "folio"=>$_POST["folio"], );

			//Se le dice al modelo models/crud.php (PagoData::registroUsuarioModel),que en la clase "PagoData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "grupos":
			$respuesta = PagoData::newPagoModel($datosController, "pagos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}

		}

	}

	# VISTA DE TUTORIAS PARA USUARIO NORMAL
	#------------------------------------

	public function vistaTutoriasController(){

		//$respuesta = MaestroData::editarMaestroModel($_SESSION['user'],'maestros');
		//$alumnos = AlumnoData::viewAlumnosTutorModel("alumnos",$respuesta['no_empleado']);
		$tutorias = TutoriaData::viewTutoriasTutorModel('tutorias', $_SESSION['user']);
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-danger">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-id-badge" style="font-size:36px;"></i> Tutorias</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Alumno</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Tipo</th>
						<th>Atencion</th>
					</tr>
				</thead>
				<tbody>';
				foreach($tutorias as $tutoria){
				$alumno = AlumnoData::editarAlumnoModel($tutoria['id_alumno'], "alumnos");
				$atencion = CategoriaData::editarCategoriaModel($tutoria['tipo_atencion'], "categorias_tutorias");
				echo'<tr>
					<td><span class="badge bg-danger">'.$tutoria["id"].'</span></td>
					<td>'.$alumno["nombre"].' '.$alumno["apellidos"].'</td>
					<td>'.$tutoria["fecha"].'</td>
					<td>'.$tutoria["hora"].'</td>
					<td>'.$tutoria["tipo_tutoria"].'</td>
					<td>'.$atencion["nombre"].'</td>	
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>
		<div class="card-footer">
		 '.count($tutorias).' Registro(s).
		</div>
		</div>';
	}

	# VISTA DE TUTORIAS PARA ADMIN
	#------------------------------------

	public function vistaTutoriasAdminController(){

		$respuesta = TutoriaData::viewTutoriasModel("tutorias");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-info">

        <div class="card-header">
            <h3 class="card-title">Tutorias</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Alumno</th>
						<th>Tutor</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Tipo</th>
						<th>Atencion</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $tutoria){
				$alumno = AlumnoData::editarAlumnoModel($tutoria['id_alumno'], "alumnos");
				$tutor = MaestroData::editarMaestroModel($tutoria['id_tutor'], "maestros");
				$atencion = CategoriaData::editarCategoriaModel($tutoria['tipo_atencion'], "categorias_tutorias");
				echo'<tr>
					<td><span class="badge bg-danger">'.$tutoria["id"].'</span></td>
					<td>'.$alumno["nombre"].' '.$alumno["apellidos"].'</td>
					<td>'.$tutor["nombre"].' '.$tutor["apellidos"].'</td>
					<td>'.$tutoria["fecha"].'</td>
					<td>'.$tutoria["hora"].'</td>
					<td>'.$tutoria["tipo_tutoria"].'</td>
					<td>'.$atencion["nombre"].'</td>	
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>

		</div>';
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Carreras   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR CARRERA
	#------------------------------------
	public function deleteCarreraController(){
		// Obtenemos el ID del carrera a borrar
		if(isset($_GET["idGrupoBorrar"])){
			$datosController = $_GET["idGrupoBorrar"];
			// Mandamos los datos al modelo del carrera a eliminar
			$respuesta = CarreraData::deleteCarreraModel($datosController, "carreras");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de carreras
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=carreras';
			  	</script>";
			}
		}
	}

	# VISTA DE CARRERAS
	#------------------------------------

	public function vistaCarrerasController(){

		$respuesta = CarreraData::viewCarrerasModel("carreras");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-success">

        <div class="card-header">
            <h3 class="card-title">Carreras</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Abreviatura</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $carrera){
				echo'<tr>
					<td> <span class="badge bg-success">'.$carrera["id"].'</span></td>
					<td>'.$carrera["nombre"].'</td>
					<td>'.$carrera["abrev"].'</td>
					<td><a href="index.php?action=editar-carrera&idCarrera='.$carrera["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=eliminar-carrera$idCarrera='.$carrera["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
				</tr>';
				}
				echo '</tbody>
			</table>
		</div>
		<div class="card-footer">
			<a class="btn btn-success" href="index.php?action=registro-carrera">
	        	<i class="fa fa-plus"></i> Nueva Carrera
	    	</a>
	    </div>
		</div>';
	}

	# REGISTRO DE CARRERA
	#------------------------------------
	public function nuevaCarreraController(){

		if(isset($_POST["GuardarCarrera"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"nombre"=>$_POST['nombreCarrera'],
				"abrev"=>$_POST['abrevCarrera']
			);

			//Se le dice al modelo models/crud.php (CarreraData::newCarreraModel),que en la clase "CarreraData", la funcion "newCarreraModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = CarreraData::newCarreraModel($datosController, "carreras");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=carreras';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	#EDITAR CARRERA
	#------------------------------------

	public function editarCarreraController(){

		$datosController = $_GET["idCarrera"];
		$respuesta = CarreraData::editarCarreraModel($datosController, "carreras");

		echo'

		<div class="card card-success">
    		<div class="card-header">
        		<h3 class="card-title">Editar Carrera</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["id"].'" placeholder="Identificador" name="idCarreraEditar" readonly required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-edit"></i></span>
				        </div>
              			<input type="text" id="nombreCarreraEditar" placeholder="Nombre" name="nombreCarreraEditar" required class="form-control" value="'.$respuesta['nombre'].'">
					</div>
					
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-ellipsis-h"></i></span>
				        </div>
              			<input type="text" id="abrevCarreraEditar" placeholder="Abreviatura" name="abrevCarreraEditar" required class="form-control" value="'.$respuesta['abrev'].'">
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="CarreraEditar" class="btn btn-success">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR CARRERA
	#------------------------------------
	public function actualizarCarreraController(){

		if(isset($_POST["CarreraEditar"])){

			$datosController = array( "id"=>$_POST["idCarreraEditar"],
							        "nombre"=>$_POST["nombreCarreraEditar"]);
			
			$respuesta = CarreraData::actualizarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=cambio';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para ALUMNOS  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR ALUMNO
	#------------------------------------
	public function deleteAlumnoController(){
		// Obtenemos el ID del alumno a borrar
		if(isset($_GET["idAlumnoBorrar"])){
			$datosController = $_GET["idAlumnoBorrar"];
			// Mandamos los datos al modelo de la alumno a eliminar
			$respuesta = AlumnoData::deleteAlumnoModel($datosController, "alumnos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de alumnos
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=alumnos';
			  	</script>";
			}
		}
	}

	# VISTA DE ALUMNOS
	#------------------------------------

	public function vistaAlumnosController(){

		$respuesta = AlumnoData::viewAlumnosModel("alumnos");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-secondary">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-graduation-cap" style="font-size:36px;">&nbsp;</i>Alumnos</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Matricula</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Carrera</th>
						<th>Tutor</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $alumno){
				$carrera = CarreraData::editarCarreraModel($alumno["carrera"],"carreras");
				$tutor = MaestroData::editarMaestroModel($alumno["tutor"],"maestros");
				echo'
				<tr>
					<td> <span class="badge bg-secondary">'.$alumno["matricula"].'</span></td>
					<td>'.$alumno["nombre"].'</td>
					<td>'.$alumno["apellidos"].'</td>
					<td>'.$carrera["abrev"].'</td>
					<td>'.$tutor['nombre'].' '.$tutor['apellidos'].'</td>
					<td><a href="index.php?action=editar-alumno&idAlumno='.$alumno["matricula"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=eliminar-alumno&idAlumno='.$alumno["matricula"].'"><i class="fa fa-trash-o text-danger"></i></a></td>				
				</tr>';

				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-secondary" href="index.php?action=registro-alumno">
        		<i class="fa fa-user-plus"></i> Nuevo Alumno
    		</a>
		</div>

		</div>';
	}

	# REGISTRO DE ALUMNOS
	#------------------------------------
	public function nuevoAlumnoController(){

		if(isset($_POST["GuardarAlumno"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"matricula"=>$_POST['matricula'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"carrera"=>$_POST['carrera'],
				"tutor"=>$_POST['tutor']);

			//Se le dice al modelo models/crud.php (AlumnoData::newAlumnoModel),que en la clase "AlumnoData", la funcion "newGrupoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = AlumnoData::newAlumnoModel($datosController, "alumnos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=alumnos';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para CATEGORIAS DE TIPO DE ATENCION       +++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	# BORRAR CATEGORIA
	#------------------------------------
	public function deleteCategoriaController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idCategoriaBorrar"])){
			$datosController = $_GET["idCategoriaBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = CategoriaData::deleteCategoriaModel($datosController, "categorias_tutorias");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de categorias
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=categorias';
			  	</script>";
			}
		}
	}

	# REGISTRO DE UNA NUEVA CATEGORIA
	#------------------------------------
	public function nuevaCategoriaController(){

		if(isset($_POST["GuardarCategoria"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"nombre"=>$_POST['nombreCategoria']
			);

			//Se le dice al modelo models/crud.php (CategoriaData::newCarreraModel),que en la clase "CategoriaData", la funcion "newCategoriaModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = CategoriaData::newCategoriaModel($datosController, "categorias_tutorias");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=categorias';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	# VISTA DE CATEGORIAS
	#------------------------------------

	public function vistaCategoriasController(){

		$respuesta = CategoriaData::viewCategoriasModel("categorias_tutorias");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-warning">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-tags" style="font-size:26px;">&nbsp;</i>Categorias para tutorias</h3>
        </div>

		<div class="card-body p-1">
		<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
			<div class="row">
              		<div class="col-sm-12 col-md-6">
              			<div class="dataTables_length" id="categorias_length">
              				<label>Mostrar 
              					<select name="categorias_length" aria-controls="tabla-categorias" class="form-control form-control-sm">
              					<option value="10">10</option>
              					<option value="25">25</option>
              					<option value="50">50</option>
              					<option value="100">100</option>
              					</select> registros.
              				</label>
              			</div>
              		</div>
              		<div class="col-sm-12 col-md-6">
              			<div id="example1_filter" class="dataTables_filter">
              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-categorias"></label>
              			</div>
              		</div> 
            </div>
			<table id="tabla-categorias" class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">ID</th>
						<th>Nombre</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $categoria){
				echo'
				<tr>
					<td> <span class="badge bg-warning">'.$categoria["id"].'</span></td>
					<td>'.$categoria["nombre"].'</td>
					<td><a href="index.php?action=editar-categoria&idCategoria='.$categoria["id"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=eliminar-categoria&idCategoria='.$categoria["id"].'"><i class="fa fa-trash-o text-danger"></i></a></td>				
				</tr>';

				}
				echo '</tbody>
			</table>
			</div>
		</div>

		<div class="card-footer">
			<a class="btn btn-warning" href="index.php?action=registro-categoria">
        		<i class="fa fa-plus"></i> Nueva Categoria
    		</a>
		</div>

		</div>';
	}

	#EDITAR CATEGORIA
	#------------------------------------

	public function editarCategoriaController(){

		$datosController = $_GET["idCategoria"];
		$respuesta = CategoriaData::editarCategoriaModel($datosController, "categorias_tutorias");

		echo'

		<div class="card card-warning">
    		<div class="card-header">
        		<h3 class="card-title">Editar Categoria</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["id"].'" placeholder="Identificador" name="idCategoriaEditar" readonly required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-edit"></i></span>
				        </div>
              			<input type="text" id="nombreCategoriaEditar" placeholder="Nombre" name="nombreCategoriaEditar" required class="form-control" value="'.$respuesta['nombre'].'">
					</div>					

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="CategoriaEditar" class="btn btn-warning">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR CATEGORIA
	#------------------------------------
	public function actualizarCategoriaController(){

		if(isset($_POST["CategoriaEditar"])){

			$datosController = array( "id"=>$_POST["idCategoriaEditar"],
							        "nombre"=>$_POST["nombreCategoriaEditar"]);
			
			$respuesta = CategoriaData::actualizarCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=cambio';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}


	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Maestros +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR MAESTRO
	#------------------------------------
	public function deleteMaestroController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = MaestroData::deleteMaestroModel($datosController, "maestros");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de maestros
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=maestros';
			  	</script>";
			}
		}
	}

	# REGISTRO DE MAESTROS
	#------------------------------------
	public function nuevoMaestroController(){

		if(isset($_POST["GuardarMaestro"])){
			//Recibe a traves del método POST el name (html) de no_empleado, carrera, nombre, apellidos, email y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"no_empleado"=>$_POST['no_empleado'],
				"carrera"=>$_POST['carrera'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"email"=>$_POST['email'],
				"password"=>$_POST['password']
			);

			//Se le dice al modelo models/MaestroCrud.php (MaestroData::registroMaestroModel),que en la clase "MaestroData", la funcion "registroMaestroModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = MaestroData::newMaestroModel($datosController, "maestros");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE MAESTROS
	#------------------------------------

	public function vistaMaestrosController(){

		$respuesta = MaestroData::viewMaestrosModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card ">

        <div class="card-header bg-primary">
            <h3 class="card-title"><i class="fa fa-users" style="font-size:32px;">&nbsp;</i>Maestros</h3>
        </div>

		<div class="card-body p-0">
			<table class="table table-bordered table-striped dataTable">
				<thead>
					<tr>
						<th>No. Emp.</th>
						<th>Carrera</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Password</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>';
				foreach($respuesta as $maestro){
				$carrera = CarreraData::editarCarreraModel($maestro["carrera"],"carreras");
				echo'<tr>
					<td><span class="badge bg-primary">'.$maestro["no_empleado"].'</span></td>
					<td>'.$carrera["abrev"].'</td>
					<td>'.$maestro["nombre"].'</td>
					<td>'.$maestro["apellidos"].'</td>
					<td>'.$maestro["email"].'</td>
					<td>'.crypt($maestro["password"],'YYL').'</td>
					<td><a href="index.php?action=editar-maestro&idMaestro='.$maestro["no_empleado"].'"><i class="fa fa-edit text-secondary"></i></a></td>
					<td><a href="index.php?action=maestros&idBorrar='.$maestro["no_empleado"].'"><i class="fa fa-trash-o text-danger"></i></a></td>
					</tr>
				';
				}
				echo '</tbody>
			</table>
		</div>

		<div class="card-footer">
			<a class="btn btn-primary" href="index.php?action=registro-maestro">
	        	<i class="fa fa-user-plus"></i> Nuevo Maestro
	    	</a>
		</div>

		</div>';
	}

	#INGRESO DE MAESTROS
	#------------------------------------
	public function ingresoMaestroController($datosController)
	{
			$respuesta = MaestroData::ingresoMaestroModel($datosController, "maestros");
			//Valiación de la respuesta del modelo para ver si es un Maestro correcto.
			if($respuesta["email"] == $datosController["email"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION["user"] = $respuesta['no_empleado'];
				$_SESSION["validar"] = true;
				$_SESSION["rol"] = 2;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	#EDITAR MAESTROS
	#------------------------------------

	public function editarMaestroController(){

		$datosController = $_GET["idMaestro"];
		$respuesta = MaestroData::editarMaestroModel($datosController, "maestros");

		echo'

		<div class="card card-primary">
    		<div class="card-header">
        		<h3 class="card-title"><i class="fa fa-user">&nbsp; </i> Editar Maestro</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["email"].'" name="emailEditar" required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW1" name="password1Editar" placeholder="Nueva contraseña" required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW2" name=password2Editar" placeholder="Confirmar contraseña" required class="form-control">
					</div>
					<script type="text/javascript">
						document.getElementById("PW2").onchange = function(e){
							var PW1 = document.getElementById("PW1");
							if(this.value != PW1.value ){
								alert("Contraseñas no coinciden.");
								PW1.focus();
								this.value = "";
							}
						};
					</script>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña anterior" required class="form-control">
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="MaestroEditar" class="btn btn-primary">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR MAESTROS
	#------------------------------------
	public function actualizarMaestroController(){

		if(isset($_POST["MaestroEditar"])){

			$datosController = array( "email"=>$_POST["emailEditar"],
							        "password"=>$_POST["password1Editar"]);
			
			$respuesta = MaestroData::actualizarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=cambio';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}	


}
?>
