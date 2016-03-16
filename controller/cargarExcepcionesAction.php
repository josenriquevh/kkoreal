<?php
require_once("../model/cargarExcepcionesExp.php");
$cargarExcepcion = new CargarExcepciones();
$resultado = $cargarExcepcion->insertarCargarExcepciones($_FILES);
if (!empty($resultado)){
	echo $resultado;
}?>