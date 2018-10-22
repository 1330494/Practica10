<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "alumnos" || $links == "usuarios"  || $links == "carreras" || $links == "maestros" 
			|| $links == "categorias" || $links == "tutorias"  || $links == "tutorias-admin"|| $links == "registro-alumno" 
			|| $links == "registro-usuario" || $links == "registro-carrera" || $links == "registro-maestro"
			|| $links == "registro-categoria" || $links == "registro-tutoria" || $links == "editar-alumno"
			|| $links == "editar-usuario" || $links == "editar-carrera" || $links == "editar-maestro" 
			|| $links == "editar-categoria"	|| $links == "salir" || $links == "tutorados")
		{
			$module =  "views/moduls/".$links.".php";
		}else if($links == "ingresar"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "ok"){
			$module =  "views/moduls/inicio.php?";
		}else if($links == "fallo"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "cambio"){
			$module =  "views/moduls/usuarios.php";
		}else{
			$module =  "views/moduls/inicio.php";
		}
		return $module; 
	}
}

?>