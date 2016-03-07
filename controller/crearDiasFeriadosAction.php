<?php
require_once("../model/crearDiasFeriadosExp.php");
$crearDF = new CrearDiasFeriados();
if($_POST['id']==0){
	$resultado = $crearDF->insertarDiasFeriados($_POST);
}else{
	$resultado = $crearDF->modificarDiasFeriados($_POST);
}
if (!empty($resultado)){
	echo $resultado;
}?>