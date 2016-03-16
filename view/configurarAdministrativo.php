<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$sql = $consulta->Conectar("postgres","UPDATE dept SET administrativo=".$_GET['admin']." WHERE deptid=".$_GET['id']."");
require_once("administrarDepartamentos.php");
?>
<script type="text/javascript">
alert("El departamento se modificó exitosamente!");
</script>