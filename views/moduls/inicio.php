<?php
//session_start();
ob_clean();
ob_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

if ($_SESSION['rol']!=1) {
  echo "<script type='text/javascript'>
    window.location = 'index.php?action=tutorados';
  </script>";
}

?>

<div class="row" style="height: 10px;width: 100%;"></div>

<div class="col-md-12">

<?php 
$control_contadores = new Controlador_MVC();
$contadores = $control_contadores->DataBaseTablesCounterController(); 
 ?>
<div class="row">

        <div class="col-lg-12 ">
          <center>
            <h1 class="m-0 text-dark">Concentrado de tutorias</h1>
          </center>
          <br>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
              <div class="inner">
                <h3><h3><?php echo $contadores['usuarios']; ?></h3></h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="index.php?action=usuarios" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3><h3><?php echo $contadores['alumnos']; ?></h3></h3>

                <p>Alumnos</p>
              </div>
              <div class="icon">
                <i class="fa fa-graduation-cap"></i>
              </div>
              <a href="index.php?action=alumnos" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><h3><?php echo $contadores['maestros']; ?></h3></h3>

                <p>Maestros</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="index.php?action=maestros" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><h3><?php echo $contadores['carreras']; ?></h3></h3>

                <p>Carreras</p>
              </div>
              <div class="icon">
                <i class="fa fa-institution"></i>
              </div>
              <a href="index.php?action=carreras" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
</div>
<div class="row" style="height: 20px;width: 100%;"></div>

<div class="col-md-12">
	<div class="row">
		<div class="col-lg-3 col-6"></div> <!-- ./col -->
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><h3><?php echo $contadores['categorias']; ?></h3></h3>

                <p>Categorias</p>
              </div>
              <div class="icon">
                <i class="fa fa-tags"></i>
              </div>
              <a href="index.php?action=categorias" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><h3><?php echo $contadores['tutorias']; ?></h3></h3>

                <p>Tutorias</p>
              </div>
              <div class="icon">
                <i class="fa fa-id-badge"></i>
              </div>
              <a href="index.php?action=tutorias" class="small-box-footer">Ver mas... <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6"></div> <!-- ./col -->
	</div>
</div>
