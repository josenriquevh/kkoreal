<?php
class CrearDiasFeriados
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarDiasFeriados($array)
 	{
		$fechaDesde = $array['fechaDesde'];
		$fechaHasta = $array['fechaHasta'];
		$descripcion = $array['descripcion'];
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO feriado (desde, hasta, descripcion) VALUES ('".$fechaDesde."','".$fechaHasta."','".$descripcion."') RETURNING id");
		return 'Se Insertaron los datos Exitosamente!';
	}

	function modificarDiasFeriados($array)
 	{
 		$id = $array['id'];
		$fechaDesde = $array['fechaDesde'];
		$fechaHasta = $array['fechaHasta'];
		$descripcion = $array['descripcion'];
		$sqlUpdate = $this->invoco->Conectar("postgres","UPDATE feriado SET desde='".$fechaDesde."', hasta='".$fechaHasta."', descripcion='".$descripcion."' WHERE id=".$id);
		return 'Se Modificaron los datos Exitosamente!';
	}
}?>