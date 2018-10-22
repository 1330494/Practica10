<?php
// EL INDEX. En el mostraremos la salida de las vistas al usuario y tambien a traves de el enviaemos las distintas acciones que el usuario envíe al controlador.

#require() establece que el códigodel archivo invocado es requerido, es decr, obligatorio para el funcionamiento del programa. Por ello, si el archivo especificado en la función require() no se encuentra saltará un error "PHP Fatal error" y el programa se detendrá.

#La versión require_once() funcionan de la misma forma que sus respectivo, salvo que, al utilizar la versión _once se impide la carga de un mismo archivo mas de una vez.

#Si reuerimos el mismo código mas de una vez corremos el rieso de redeclaraciones de variables, funciones o clases.

//Se invocan los archivos que tienen los metodos:
require_once "models/Links.php";
require_once "models/CarreraCrud.php";
require_once "models/CategoriaCrud.php";
require_once "models/TutoriaCrud.php";
require_once "models/AlumnoCrud.php";
require_once "models/UsuarioCrud.php";
require_once "models/MaestroCrud.php";
require_once "controls/Controlador.php";
//Para poder ver el template se hace la petición mediante un controlador.

//creamos el objeto:
$pagina = new Controlador_MVC();

//muestra la función "pagina" que se encuentra en controladores/Controlador.php
$pagina->showPage();

?>