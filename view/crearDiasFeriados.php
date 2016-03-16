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
    $.validator.setDefaults({ ignore: ":hidden:not(input)" });
    $("#form").validate({
        invalidHandler: function() {
            validateForm = true;
        },
        rules: {
            'descripcion':{
                required: true,
            },
            'fechaDesde': {
                required: true,
            },
            'fechaHasta': {
                required: true,
            }
        },
        messages: {
            'descripcion':{
                required: "La descripción es requerida",
            },
            'fechaDesde': {
                required: "La fecha desde es requerida",
            },
            'fechaHasta': {
                required: "La fecha hasta es requerida",
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

    ng.ready( function() {
        var end_cal = new ng.Calendar({
            input: 'fechaHasta'
        });
        var start_cal = new ng.Calendar({
            input: 'fechaDesde',
            start_date: 'last year',
            display_date: new Date(),
            my_end_cal: end_cal,
            events: {
                onSelect: function(dt){
                    var st_dt = dt.clone();
                    var dt_on_aval = {};
                    dt_on_aval[st_dt.print('n_j_Y', 'en')] = function(id){
                        ng.get(id).add_class('highlighted_date');
                    };
                    this.p.my_end_cal.set_date_on_available(dt_on_aval);
                    var num_days = 0;
                    st_dt = st_dt.from_string('today+'+num_days);
                    var end_dt = this.p.my_end_cal.get_selected_date();
                    if ((ng.defined(end_dt)) && (end_dt.getTime() < st_dt.getTime())){
                        this.p.my_end_cal.clear_selection();
                    }
                    this.p.my_end_cal.set_start_date(st_dt);
                    this.p.my_end_cal.open();
                },
                onUnSelect: function(dt){
                    this.p.my_end_cal.set_date_on_available({});
                    var st_dt = this.get_start_date().clone();
                    this.p.my_end_cal.set_start_date(st_dt);
                }
            }
        });
    });

});
</script>
<style>
.highlighted_date {
    font-weight:bold;
    background:#95bee7;
}
.form-control1{
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
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
                            <div class="form-group" style="width:250px;">
                                <label>Fecha Desde:</label><br>
                                <input id="fechaDesde" name="fechaDesde" class="form-control1" placeholder="Ingrese la Fecha Desde" value="<?php echo $he=isset($feriado[0]['desde'])?$feriado[0]['desde']:'';?>" style="width:250px">
                            </div>
                            <div class="form-group" style="width:250px;">
                                <label>Fecha Hasta:</label><br>
                                <input id="fechaHasta" name="fechaHasta" class="form-control1" placeholder="Ingrese la Fecha Hasta" value="<?php echo $hh=isset($feriado[0]['hasta'])?$feriado[0]['hasta']:'';?>" style="width:250px">
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