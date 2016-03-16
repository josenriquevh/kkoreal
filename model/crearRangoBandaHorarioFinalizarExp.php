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
		$horaDesde = $array['horaDesde'];
		$horaHasta = $array['horaHasta'];
		$tipoHora = $array['tipoHora'];
		$idbanda = $array['idbanda'];
		if(($horaDesde <> 0) && ($horaHasta <> 0)){
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO rango_banda (banda_id, hora_desde, hora_hasta, tipo_hora_id) VALUES (".$idbanda.",'".$horaDesde."','".$horaHasta."',".$tipoHora.")");
			return 'Se Insertaron los datos Exitosamente!'.$idbanda;
		}else{
			return 'No se Insertaron los Datos!'.$idbanda;
		}
	}
}?>