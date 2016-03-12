<?php
class CrearHorarioPersonal
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarHorarioPersonal($array)
 	{
 		$iduser = $array['nombre'];
		$banda= $array['bandaHorario'];
		$time = time();
		$fecha = date("Y-m-d", $time);
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO horario_personal (user_id, banda_id, fecha) VALUES (".$iduser.",".$banda.", '".$fecha."')");
		return 'Se Insertaron los datos Exitosamente!';
	}
	
}?>