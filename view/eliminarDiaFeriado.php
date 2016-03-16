<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$sqlDelete = $consulta->Conectar("postgres","DELETE FROM feriado WHERE id=".$_GET['id']);
require_once("administrarDiasFeriados.php");
?>
<script type="text/javascript">
alert("El día feriado se eliminó exitosamente!");
</script>