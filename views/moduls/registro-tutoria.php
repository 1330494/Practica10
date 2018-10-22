<?php
//session_start();
if(!isset($_SESSION["validar"])){
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}
$tutor = MaestroData::editarMaestroModel($_SESSION['user'],'maestros');
?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">
  <div class="card card-info">
      <div class="card-header">
          <h3 class="card-title"><i class="fa fa-id-badge" style="font-size: 36px;"></i>&nbsp;Registrar nueva tutoria</h3>
      </div>
      <!-- /.card-header -->
      
      <!-- form start -->
      <form role="form" method="POST">
          <div class="card-body">
            <label>Tutor:</label>
          	<div class="input-group mb-3">
                
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <select id="maestro" name="maestro" class="form-control">
                  <?php 
                    $maestros = MaestroData::viewMaestrosModel("maestros");                    
                    foreach ($maestros as $maestro) {
                      if($maestro['no_empleado']!=$tutor['no_empleado']){
                        echo '<option value="'.$maestro['no_empleado'].'" disabled >'.$maestro['nombre'].' '.$maestro['apellidos'].'</option>';
                      }else{
                        echo '<option value="'.$maestro['no_empleado'].'" selected>'.$maestro['nombre'].' '.$maestro['apellidos'].'</option>';
                      }                      
                    }
                   ?>
                </select>          
          	</div>
            <label>Tipo de Tutoria:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-tags"></i></span>
                </div>            
                <select id="tipo_tutoria" name="tipo_tutoria" class="form-control" required>                  
                    <option value="" disabled selected >Selecciona tipo de tutoria.</option>
                    <option value="Individual" >Individual</option>
                    <option value="Grupal" >Grupal</option>                     
                </select>
            </div>
            <script type="text/javascript">              
              document.getElementById("tipo_tutoria").onchange = function (e) {
                if(this.value=="Individual"){
                  document.getElementById("alumno").multiple = false;
                  document.getElementById("alumno").disabled = false;
                }else if(this.value=="Grupal"){
                  document.getElementById("alumno").multiple = "multiple";
                  document.getElementById("alumno").disabled = false;
                }
              };
            </script>
            <label>Alumno(s):</label>
          	<div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>          	
                <select id="alumno" name="alumno" class="form-control" required>
                  <?php 
                    $alumnos = AlumnoData::viewAlumnosTutorModel("alumnos",$tutor['no_empleado']);
                    echo '<option value="" disabled selected >Selecciona alumno(s).</option>';
                    foreach ($alumnos as $alumno) {
                      echo '<option value="'.$alumno['matricula'].'" >'.$alumno['nombre'].' '.$alumno['apellidos'].'</option>';
                    }
                   ?>
                </select>
          	</div>
            <script type="text/javascript">
              document.getElementById("alumno").disabled = true;
            </script>

            <label>Fecha:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="date" required class="form-control" id="fecha"
                 name="fecha" placeholder="Fecha">
            </div>
            <label>Hora:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-o-clock"></i></span>
                </div>
                <input type="time" required class="form-control" id="hora" name="hora" placeholder="Hora">
            </div>
            <label>Tipo de atencion:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-tags"></i></span>
                </div>            
                <select id="categoria" name="categoria" class="form-control" required>
                  <?php 
                    $categorias = CategoriaData::viewCategoriasModel("categorias_tutorias");
                    echo '<option value="" disabled selected >Selecciona categoria.</option>';
                    foreach ($categorias as $categoria) {
                      echo '<option value="'.$categoria['id'].'" >'.$categoria['nombre'].'</option>';
                    }
                   ?>
                </select>
            </div>

            <div class="form-group">
                <label>Descripcion:</label>
                <textarea class="form-control" rows="50" required placeholder="Descripcion ..." style="margin-top: 0px; margin-bottom: 0px; height: 160px;"></textarea>
              </div>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
             	<center><button type="submit" name="GuardarPago" class="btn btn-info">Guardar</button></center>
          </div>
      </form>
  </div>	
</div>

<div class="col-md-3"></div>
<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoAlumnoController de la clase Controlador_MVC:
$registro -> nuevaTutoriaController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>

