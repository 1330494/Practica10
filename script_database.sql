-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2018 a las 20:55:07
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica10`
--

CREATE DATABASE practica10;

USE practica10;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE usuarios
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(32) NOT NULL,
	password VARCHAR(32) NOT NULL
);


-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `carreras`
--
CREATE TABLE carreras
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(64) NOT NULL,
	abrev VARCHAR(12) 
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `maestros`
--
CREATE TABLE maestros
(
	no_empleado VARCHAR(16) PRIMARY KEY,
	carrera INT(11) REFERENCES carreras(id),
	nombre VARCHAR(32) NOT NULL,
	apellidos VARCHAR(32) NOT NULL,
	email VARCHAR(32) NOT NULL,
	password VARCHAR(24) NOT NULL
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumnos`
--
CREATE TABLE alumnos
(
	matricula VARCHAR(12) PRIMARY KEY,
	nombre VARCHAR(32) NOT NULL,
	apellidos VARCHAR(32) NOT NULL,
	carrera INT REFERENCES carreras(id),
	tutor VARCHAR(11) REFERENCES maestros(no_empleado)
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `categorias_tutorias`
--
CREATE TABLE categorias_tutorias
(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(32) NOT NULL
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `tutorias`
--
CREATE TABLE tutorias
(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_alumno VARCHAR(11) REFERENCES alumnos(matricula),
	id_tutor VARCHAR(11) REFERENCES maestros(no_empleado),
	fecha DATE NOT NULL,
	hora TIME NOT NULL,
	tipo_tutoria VARCHAR(36) NOT NULL,
	tipo_atencion INT REFERENCES categorias_tutorias(id),
	descripcion VARCHAR(256) NOT NULL
);

--
-- Volcado de datos para la tabla `usuarios`
--
INSERT INTO  usuarios (email, password)
VALUES ('admin@admin.com', 'admin'), ('gomez@admin.com','12345');

--
-- Volcado de datos para la tabla `carreras`
--
INSERT INTO  carreras (nombre, abrev)
VALUES ('Ingenieria en Sistemas Automotrices','ISA'), ('Ingenieria en Tecnologias de la Informacion','ITI');


INSERT INTO maestros (no_empleado, carrera, nombre, apellidos, email, password )
VALUES ('10101',1,'Louis Henrich', 'Gomms Corner','admin@admin.com','admin');

--
-- Volcado de datos para la tabla `alumnos`
--
INSERT INTO  alumnos (matricula, nombre, apellidos, carrera, tutor)
VALUES ('1430548', 'Maria Daniela', 'Castro Moran', 1, '10101'), 
('1330494', 'Cristina ', 'Aguilera', 2, '10101');

INSERT INTO  categorias_tutorias (nombre)
VALUES ('Economica'), ('Enfermedad');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


