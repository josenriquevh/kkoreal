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
 		$iduser = $array['userid'];
		$banda= $array['bandaHorario'];
		$dias = $array['dias'];
		$last = end($dias);
		$lunDom='';
		foreach($dias as $value){
			if($last == $value){
				$lunDom = $lunDom.$value;
			}else{
				$lunDom = $lunDom.$value.",";
			}
		}
		$time = time();
		$fecha = date("Y-m-d", $time);
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO horario_personal (user_id, banda_id, dias, fecha) VALUES (".$iduser.",".$banda.",'".$lunDom."','".$fecha."')");
		return 'Se Insertaron los datos Exitosamente!';
	}

	function modificarHorarioPersonal($array)
 	{
 		$iduser = $array['userid'];
		$banda= $array['bandaHorario'];
		$dias = $array['dias'];
		$idHorarioPersonal = $array['idHorarioPersonal'];
		$last = end($dias);
		$lunDom='';
		foreach($dias as $value){
			if($last == $value){
				$lunDom = $lunDom.$value;
			}else{
				$lunDom = $lunDom.$value.",";
			}
		}
		$time = time();
		$fecha = date("Y-m-d", $time);
		$sqlUpdate = $this->invoco->Conectar("postgres","UPDATE horario_personal SET banda_id=".$banda.", dias='".$lunDom."', fecha='".$fecha."' WHERE id=".$idHorarioPersonal);
		return 'Se Modificaron los datos Exitosamente!';
	}
}?>