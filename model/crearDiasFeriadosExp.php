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
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO feriado (desde, hasta) VALUES ('".$fechaDesde."','".$fechaHasta."') RETURNING id");
		return 'Se Insertaron los datos Exitosamente!';
	}

	function modificarDiasFeriados($array)
 	{
 		$id = $array['id'];
		$fechaDesde = $array['fechaDesde'];
		$fechaHasta = $array['fechaHasta'];
		$sqlUpdate = $this->invoco->Conectar("postgres","UPDATE feriado SET desde='".$fechaDesde."', hasta='".$fechaHasta."' WHERE id=".$id);
		return 'Se Modificaron los datos Exitosamente!';
	}
}?>