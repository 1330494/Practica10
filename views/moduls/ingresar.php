<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">

  <div class="card card-success">
    <div class="card-header">
      <center><h3 class="card-title">Ingresar</h3></center>
    </div>
    <!-- /.card-header -->
      
    <!-- form start -->
    <form role="form" method="POST">
    <div class="card-body">

      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-envelope"></i></span>
        </div>
        <input type="email" required class="form-control" id="email" name="emailIngreso" placeholder="E-Mail">
      </div>
      
      <div class="input-group mb-3">
        <br>
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fa fa-key"></i></span>
        </div>
        <input type="password" required class="form-control" id="password" name="passwordIngreso" placeholder="Contraseña">
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <input type="checkbox" name="checkAs">
              </span>
                Ingresar como tutor.
            </div>
          </div> <!-- /input-group -->
        </div> <!-- /.col-lg-12 -->                 
      </div> <!-- /.row -->

  	</div>
  	<!-- /.card-body -->
  	
    <div class="card-footer">
      <center><button type="submit" name="SubmitUsuario" class="btn btn-success">Ingresar</button></center>
    </div>
    <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div> <!-- /.col-md-4 -->

<div class="col-md-4"></div>

<?php

$ingreso = new Controlador_MVC();
$ingreso -> SessionTypeController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}

?>
