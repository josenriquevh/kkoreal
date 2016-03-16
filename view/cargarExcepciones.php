<script src="../complements/jquery.timepickr/jquery-1.7.1.js"></script>
<!--<script src="../complements/validate/js/jquery-1.8.2.min.js"></script>-->
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<link rel="stylesheet" href="../complements/validate/css/estiloError.css"/>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'archivoExcepcion': {
                required: true,
            }
        },
        messages: {
            'archivoExcepcion': {
                required: "El archivo de Excel es requerido",
            }
        },
        submitHandler: function(form){
            var formData = new FormData(document.getElementById("form"));
            $.ajax({
                type: 'POST',
                url: $("#form").attr('action'),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
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
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Archivo Excepciones</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Subir Archivo Excel
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="form" action="../controller/cargarExcepcionesAction.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Archivo:</label><br>
                                <input type="file" id="archivoExcepcion" name="archivoExcepcion">
                            </div>
                            <input type="submit" class="btn btn-default" onclick="" name="Guardar" value="Guardar">
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