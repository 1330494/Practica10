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
  <div class="card bg-light">
    <div class="card-header">
      <h3 class="card-title"><i class="fa fa-user-plus" style="font-size: 36px;"></i> Nuevo Maestro</h3>
    </div>
    <!-- /.card-header -->

    <!-- form start -->
    <form role="form" method="POST">
      <div class="card-body">

        <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-key"></i></span>
              </div>
                <input type="text" required class="form-control" id="no_empleado" name="no_empleado" placeholder="No. de Empleado">
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
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
          </div>
          <input type="email" id="email" name="email" placeholder="E-Mail" required class="form-control">
				</div>

				<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
          </div>
        	<input type="password" id="PW1" name="password1" placeholder="Contraseña" required class="form-control">
				</div>

				<div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
          </div>
          <input type="password" id="PW2" name=password2" placeholder="Confirmar contraseña" required class="form-control">
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

 				</div>
        	<!-- /.card-body -->
        	<div class="card-footer">
           	<center><button type="submit" name="GuardarUsuario" class="btn btn-white">Guardar</button></center>
        	</div>
    		</form>
		</div>
</div>

<div class="col-md-4"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoUsuarioController();

if(isset($_GET["resp"])){
  if($_GET["resp"] == "ok"){
    echo "Registro Exitoso";
  }
}

?>