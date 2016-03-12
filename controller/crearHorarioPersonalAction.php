<?php
require_once("../model/crearHorarioPersonalExp.php");
$crearHP = new CrearHorarioPersonal();
$resultado = $crearHP->insertarHorarioPersonal($_POST);
if (!empty($resultado)){
	echo $resultado;
}?>