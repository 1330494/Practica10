
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">	
	<div class="card card-danger">
		<div class="card-header">
			<center><h3 class="card-title">Sistema de tutorias</h3></center>
		</div>
		<div class="card-body">
			<?php
				//session_start();
				if (isset($_SESSION['validar'])) {
					$_SESSION['validar'] = null;
					$_SESSION["rol"] = null;
					$_SESSION["password"] = null;
					session_destroy();
			?>
			<h5>Ha salido de la aplicacion.</h5>
			
			<?php
			}else{
				?>
			<h5>No ha ingresado a la aplicacion.</h5>
			<?php
				}
				?>
		</div>
		<div class="card-footer"></div>
	</div>
</div>

<div class="col-md-4"></div>