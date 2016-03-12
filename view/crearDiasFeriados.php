<link rel="stylesheet" type="text/css" href="../complements/jquery.timepickr/jquery-ui.css" />
<script src="../complements/jquery.timepickr/jquery-1.7.1.js"></script>
<script src="../complements/jquery.timepickr/jquery-ui.js"></script>
<script src="../complements/jquery.timepickr/jquery.timepickr.js"></script>
<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<link rel="stylesheet" href="../complements/validate/css/estiloError.css"/>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'fechaDesde': {
                required: true,
            },
            'fechaHasta': {
                required: true,
            },
            'descripcion':{
                required: true,
            }
        },
        messages: {
            'fechaDesde': {
                required: "La fecha desde es requerida",
            },
            'fechaHasta': {
                required: "La fecha hasta es requerida",
            },
            'descripcion':{
                required: "La descripción es requerida",
            }
        },
        submitHandler: function(form){
            $.ajax({
                type: 'POST',
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                success: function(data){
                    var datos = data.split('!');
                    alert(datos[0]);
                    setTimeout( function(){
                        $('#contenido').load("administrarDiasFeriados.php");
                    }, 1000);
                }
            });
        }
    });
});
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
if($_GET['id']!==0)
{
    $feriado = $consulta->Conectar("postgres","SELECT * FROM feriado WHERE id=".$_GET['id']);
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Días Feriados</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Nuevos Días Feriados
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="../controller/crearDiasFeriadosAction.php" role="form" method="post">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $_GET['id']; ?>">
                            <div class="form-group">
                                <label>Descripción:</label>
                                <input id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese la Descripcion" value="<?php echo $de=isset($feriado[0]['descripcion'])? $feriado[0]['descripcion'] : ''; ?>" style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Fecha Desde:</label>
                                <input id="fechaDesde" name="fechaDesde" class="form-control" placeholder="Ingrese la Fecha Desde" value="<?php echo $he=isset($feriado[0]['desde'])? $feriado[0]['desde'] : ''; ?>" style="width:250px">
                            </div>
                            <div class="form-group">
                                <label>Fecha Hasta:</label>
                                <input id="fechaHasta" name="fechaHasta" class="form-control" placeholder="Ingrese la Fecha Hasta" value="<?php echo $hs=isset($feriado[0]['hasta'])? $feriado[0]['hasta'] : ''; ?>" style="width:250px">
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Guardar</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('administrarDiasFeriados.php','','contenido');">Volver</button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>