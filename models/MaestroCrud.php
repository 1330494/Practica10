<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class MaestroData extends DBConnector{

	# METODO PARA REGISTRAR NUEVO MAESTRO
	#-------------------------------------
	public static function newMaestroModel($MaestroModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (matricula, nombre, apellidos, carrera, tutor) VALUES (:matricula, :nombre, :apellidos, :carrera, :tutor)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $MaestroModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $MaestroModel["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nac", $MaestroModel["fecha_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":id_grupo", $MaestroModel["id_grupo"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE MAESTROS
	#-------------------------------------

	public static function viewMaestrosModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN MAESTRO
	#------------------------------------
	public static function deleteMaestroModel($MaestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":no_empleado", $MaestroModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN MAESTRO
	#------------------------------------
	public static function editarMaestroModel($MaestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":no_empleado", $MaestroModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN MAESTRO
	#------------------------------------
	public static function actualizarMaestroModel($MaestroModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET carrera=:carrera, nombre=:nombre, apellidos=:apellidos, email = :email, password=:password WHERE no_empleado = :no_empleado");
		$stmt->bindParam(":carrera", $MaestroModel["carrera"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $MaestroModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $MaestroModel["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $MaestroModel["email"], PDO::PARAM_INT);
		$stmt->bindParam(":password", $MaestroModel["password"], PDO::PARAM_INT);
		$stmt->bindParam(":no_empleado", $MaestroModel["no_empleado"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA EL INGRESO DE UN MAESTRO
	#------------------------------------
	public static function ingresoMaestroModel($MaestroModel, $tabla_db)
	{
		$stmt = DBConnector::connect()->prepare("SELECT no_empleado, email, password FROM $tabla_db WHERE email = :email AND password = :password");	
		$stmt->bindParam(":email", $MaestroModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $MaestroModel["password"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();
	}

}
?>
