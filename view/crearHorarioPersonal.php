<script src="../complements/jquery.timepickr/jquery-1.7.1.js"></script>
<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<link rel="stylesheet" href="../complements/validate/css/estiloError.css"/>
  <!--<link rel="stylesheet" href="../complements/chosen_v1.5.1/docsupport/style.css">-->
  <link rel="stylesheet" href="../complements/chosen_v1.5.1/docsupport/prism.css">
  <link rel="stylesheet" href="../complements/chosen_v1.5.1/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>-->
  <script src="../complements/chosen_v1.5.1/chosen.jquery.js" type="text/javascript"></script>
  <script src="../complements/chosen_v1.5.1/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script type="text/javascript">
$(document).ready(function(){
    $.validator.setDefaults({ ignore: ":hidden:not(select)" });
    $("#form").validate({
        invalidHandler: function() {
            validateForm = true;
        },
        rules: {
            'nombre': {
                required: true,
            },
            'bandaHorario': {
                required: true,
            }
        },
        messages: {
            'nombre': {
                required: "El Nombre es requerido.",
            },
            'bandaHorario': {
                required: "La Banda de Horario es requerida",
            }
        },
        submitHandler: function(form){
            $.ajax({
                type: 'POST',
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                success: function(data){
                    alert(data);
                    setTimeout( function(){
                        $('#contenido').load("opcionesHorarioPorPersonal.php");
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
$datosEmpleados = $consulta->Conectar("postgres","SELECT * FROM userinfo ORDER BY userid ASC");
$datosBanda = $consulta->Conectar("postgres","SELECT banda.*, tipo_horario.nombre FROM banda INNER JOIN tipo_horario ON banda.tipo_horario_id=tipo_horario.id ORDER BY banda.id");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Horario por Personal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Horario del Empleado
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="../controller/crearHorarioPersonalAction.php" role="form" method="post">
                            <div class="form-group">
                                <label>Empleado:</label><br>
                                <select id="nombre" name="nombre" class="chosen-select form-control" style="width:250px">
                                    <option value="">Seleccione un Empleado</option>
                                    <?php foreach ($datosEmpleados as $key => $value) {
                                        echo '<option value="'.$value['userid'].'">'.$value['name'].'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Banda de Horario:</label>
                                <select id="bandaHorario" name="bandaHorario" class="form-control" style="width:250px">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                        foreach ($datosBanda as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['nombre'].': '.$value['hora_entrada'].' - '.$value['hora_salida'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Guardar</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('opcionesHorarioPorPersonal.php','','contenido');">Volver</button>
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