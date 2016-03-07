<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'optionHorarioPersonal': {
                required: true,
            }
        },
        messages: {
            'optionHorarioPersonal': {
                required: "Seleccione una opción",
            }
        },
        submitHandler: function(form){
            var radio = $("input[name='optionHorarioPersonal']:checked").val(); 
            $('#contenido').load(radio);
        }
    });
});
</script>
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
                Opciones para Cargar Horarios
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" name="form" action="" role="form" method="post">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionHorarioPersonal" id="optionHorarioPersonal1" value="horarioPersonal.php" checked>Definir Horario de un Empleado.
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionHorarioPersonal" id="optionHorarioPersonal2" value="option2">Definir horario de varios empleados a través de un archivo Excel.
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionHorarioPersonal" id="optionHorarioPersonal3" value="option3">Cargar Excepciones.
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default" onclick="">Siguiente</button>
                            <button type="button" class="btn btn-default" onclick="cargaContent('carruselkkoReal.html','','contenido');">Cancelar</button>
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