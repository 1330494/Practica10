<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class TutoriaData extends DBConnector
{

	# METODO PARA REGISTRAR NUEVA TUTORIA	
	#-------------------------------------
	public static function newTutoriaModel($TutoriaModel, $tabla_db){

		
		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (id_alumno,id_tutor,fecha,hora, tipo_tutoria, fecha_envio, descripcion, folio) VALUES (:id_alumno,:id_tutor,:fecha,:hora, :tipo_tutoria, :fecha_envio, :descripcion)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":id_alumno", $TutoriaModel["id_alumno"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tutor", $TutoriaModel["id_tutor"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $TutoriaModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $TutoriaModel["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_tutoria", $TutoriaModel["tipo_tutoria"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_atencion", $TutoriaModel["tipo_atencion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $TutoriaModel["descripcion"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE TUTORIAS
	#-------------------------------------

	public static function viewTutoriasModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# VISTA DE TUTORIAS DE UN TUTOR ESPECIFICO
	#-------------------------------------

	public static function viewTutoriasTutorModel($tabla_db, $TutoriaModel){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id_tutor=:id_tutor");
		$stmt->bindParam(":id_tutor", $TutoriaModel, PDO::PARAM_INT);
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# METODO PARA BORRAR UNA TUTORIA
	#------------------------------------
	public static function deleteTutoriaModel($TutoriaModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $TutoriaModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UNA TUTORIA
	#------------------------------------
	public static function editarTutoriaModel($TutoriaModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $TutoriaModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	

}
?>