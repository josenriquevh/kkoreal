<?php
require_once('sanearString.php');
error_reporting(E_ALL);
set_time_limit(0);

class CargarExcepciones
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarCargarExcepciones($array)
 	{
		$uploadOk = 1;
 		$time = time();
		$fecha = date("Y-m-d", $time);
 		$target_dir = "../documents/";
		$target_file = $target_dir . basename($_FILES["archivoExcepcion"]["name"]);
			move_uploaded_file($array["archivoExcepcion"]["tmp_name"], $target_file);

			set_include_path(get_include_path() . PATH_SEPARATOR . '../complements/PHPExcel-1.8/Classes/');
			$inputFileType = 'Excel2007';
			include 'PHPExcel/IOFactory.php';
			$inputFileName = $target_file;
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($inputFileName);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			require_once("../db/conexiones.php");
			$consulta = new Conexion();
			foreach ($sheetData as $key => $datos) {
				$nombreSinAcentos = sanear_string($datos['B']);
				$nombre = strtoupper(trim($nombreSinAcentos));
				$datosEmpleado=$consulta->Conectar("postgres","SELECT * FROM userinfo WHERE UPPER(name)='".$nombre."'");
				if($datosEmpleado){
					$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO horario_excepcion (user_id, desde, hasta, banda_id) VALUES (".$datosEmpleado[0]['userid'].",'".date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('D'.$key)->getvalue()))."', '".date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell('E'.$key)->getvalue()))."',".$datos['C'].")");
				}
			}
			return "Se insertaron los datos Exitosamente!";
	}
}?>