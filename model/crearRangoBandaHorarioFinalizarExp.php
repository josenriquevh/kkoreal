<?php
class CrearRangoBandaHorarioFinalizar
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarRangoBandaHorarioFinalizar($array)
 	{
		$horaDesde = $array['fechaDes'];
		$horaHasta = $array['fechaHas'];
		$tipoHora = $array['tipoHora'];
		$idbanda= $array['id'];
		if(($horaDesde > 0)and($horaHasta > 0)){
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO rango_banda (banda_id, hora_desde, hora_hasta, tipo_hora_id) VALUES (".$idbanda.",'".$horaDesde."','".$horaHasta."',".$tipoHora.")");
			return 'Se Insertaron los datos Exitosamente!'.$idbanda;
		}else{
			return 'No se Insertaron los Datos!'.$idbanda;
		}
	}

}?>