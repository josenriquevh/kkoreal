<?php
require_once("../model/definirPorArchivoExcelExp.php");
$DefinirExcel = new DefinirPorArchivoExcel();
$resultado = $DefinirExcel->insertarExcel($_FILES);
if (!empty($resultado)){
	echo $resultado;
}?>