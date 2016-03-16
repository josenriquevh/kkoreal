<script src="../complements/jquery.timepickr/jquery-1.7.1.js"></script>
<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'bandaHorario': {
                required: true,
            }
        },
        messages: {
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
error_reporting(0);
require_once("../db/conexiones.php");
$consulta = new Conexion();
$empleado = $consulta->Conectar("postgres","SELECT * FROM userinfo WHERE userid=".$_REQUEST['id']);
$datosBanda = $consulta->Conectar("postgres","SELECT banda.*, tipo_horario.nombre FROM banda INNER JOIN tipo_horario ON banda.tipo_horario_id=tipo_horario.id ORDER BY banda.id");
$horarioPersonal = $consulta->Conectar("postgres","SELECT horario_Personal.*, userinfo.name FROM horario_Personal INNER JOIN userinfo ON horario_Personal.user_id=userinfo.userid WHERE horario_Personal.user_id=".$_REQUEST['id']." ORDER BY horario_Personal.id DESC LIMIT 1");
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
                            <input type="hidden" id="horarioPersonal" name="horarioPersonal" value="<?php echo count($horarioPersonal[0]['id']);?>">
                            <input type="hidden" id="userid" name="userid" value="<?php echo $_REQUEST['id'];?>">
                            <input type="hidden" id="idHorarioPersonal" name="idHorarioPersonal" value="<?php echo $horarioPersonal[0]['id'];?>">
                            <div class="form-group">
                                <label>Empleado:</label>
                                <?php echo $empleado[0]['name'];?>
                            </div>
                            <div class="form-group">
                                <label>Banda de Horario:</label>
                                <select id="bandaHorario" name="bandaHorario" class="form-control" style="width:250px">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    if($horarioPersonal){
                                        foreach ($datosBanda as $key => $value) {
                                            if($horarioPersonal[0]['banda_id']==$value['id']){
                                                echo '<option value="'.$value['id'].'" selected="selected">'.$value['nombre'].': '.$value['hora_entrada'].' - '.$value['hora_salida'].'</option>';
                                            }else{
                                                echo '<option value="'.$value['id'].'">'.$value['nombre'].': '.$value['hora_entrada'].' - '.$value['hora_salida'].'</option>';
                                            }
                                        }
                                    }else{
                                        foreach ($datosBanda as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['nombre'].': '.$value['hora_entrada'].' - '.$value['hora_salida'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Días</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'1')){ echo 'checked';}else{ echo '';}?> value="1">Lunes
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'2')){ echo 'checked';}else{ echo '';}?> value="2">Martes
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'3')){ echo 'checked';}else{ echo '';}?> value="3">Miercoles
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'4')){ echo 'checked';}else{ echo '';}?> value="4">Jueves
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'5')){ echo 'checked';}else{ echo '';}?> value="5">Viernes
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'6')){ echo 'checked';}else{ echo '';}?> value="6">Sabado
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="dias" name="dias[]" <?php if(strstr($horarioPersonal[0]['dias'],'7')){ echo 'checked';}else{ echo '';}?> value="7">Domingo
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Guardar</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('horarioPersonal.php','','contenido');">Volver</button>
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