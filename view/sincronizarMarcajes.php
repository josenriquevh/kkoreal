<?php
ini_set('max_execute_time', 0);
set_time_limit(600);
require_once("../db/conexiones.php");
$consulta = new Conexion();
$update = 0;
$ultimoMarcaje = $consulta->Conectar("postgres","SELECT * FROM checkinout ORDER BY logid DESC LIMIT 1");
$datosMarcaje = $consulta->Conectar("access","SELECT Checkinout.Logid, Checkinout.Userid, Checkinout.CheckTime, Checkinout.CheckType FROM Checkinout WHERE Checkinout.Logid > ".$ultimoMarcaje[0]['logid']." ORDER BY Checkinout.Logid ASC");
if (!$datosMarcaje) 
{
	exit("No existen marcajes para actualizar. Por favor Intente más tarde.");
}else{
	foreach($datosMarcaje as $key => $marcaje)
	{
		$logid = $marcaje['Logid'];
		$userid = $marcaje['Userid'];
		$checktime = $marcaje['CheckTime'];
		$checktype = $marcaje['CheckType'];
		$sqlInsert = $consulta->Conectar("postgres","INSERT INTO checkinout VALUES (".$logid.", ".$userid.", '".$checktime."', '".$checktype."')");
	}
	$time = time();
	$fecha = date("Y-m-d H:i:s", $time);
	$tabla = "checkinout";
	$sqlInsertRefresh = $consulta->Conectar("postgres","INSERT INTO refrescamiento (fecha, tabla) VALUES ('".$fecha."','".$tabla."')");
	$update = 1;
}
?>
<script>
$('#divSincronizar').hide();
$('.well').show();
</script>
<?php
require_once("administrarMarcajes.php");
echo "<center>Se actualizaron ".count($datosMarcaje)." registros.</center>";
?>