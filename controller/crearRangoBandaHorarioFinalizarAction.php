<?php
require_once("../model/crearRangoBandaHorarioFinalizarExp.php");
$crearRBH = new CrearRangoBandaHorarioFinalizar();
	$resultado = $crearRBH->insertarRangoBandaHorarioFinalizar($_GET);
if (!empty($resultado)){
	echo $resultado;
}?>