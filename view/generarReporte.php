<!-- Bootstrap Core CSS -->
<link href="../complements/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="../complements/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- DataTables CSS -->
<link href="../complements/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<!--<link href="../complements/sb-admin/bower_components/datatables-responsive/css/dataTables.responsive.scss" rel="stylesheet">-->
<!-- Custom CSS -->
<link href="../complements/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="../complements/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- jQuery -->
<script src="../complements/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../complements/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../complements/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="../complements/sb-admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../complements/sb-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
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
<script src="../complements/sb-admin/dist/js/sb-admin-2.js"></script>
<script src="../complements/validate/js/jquery.validate.js"></script>
<script src="../complements/validate/js/additional-methods.js"></script>
<script src="../complements/validate/js/messages_es.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#form").validate({
        rules: {
            'fechaDesde': {
                required: true,
            },
            'fechaHasta': {
                required: true,
            }
        },
        messages: {
            'fechaDesde': {
                required: "La fecha requerida",
            },
            'fechaHasta': {
                required: "La fecha requerida",
            }
        },
        submitHandler: function(form){
            /*var radio = $("input[name='optionHorarioPersonal']:checked").val(); 
            $('#contenido').load(radio);*/
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
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$departamentos = $consulta->Conectar("postgres","SELECT * FROM dept ORDER BY deptid DESC");
$empleados = $consulta->Conectar("postgres","SELECT * FROM userinfo ORDER BY userid DESC");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reporte de Horas Trabajadas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Generar Reporte
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- /.panel-heading -->
                <div class="dataTable_wrapper">
                    <form name="busquedas" id="busquedas">
                        <div class="form-group">
                            <label for="fechaDesde"><strong>Desde:</strong></label><br>
                            <input type="text" id="fechaDesde" name="fechaDesde" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="fechaHasta"><strong>Hasta:</strong></label><br>
                            <input type="text" id="fechaHasta" name="fechaHasta" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="departamento"><strong>Departamento:</strong></label><br>
                            <div id="dep">
                                <select name="departamento" id="departamento" class="chosen-select" style="width:250px">
                                    <option value="" selected>Seleccionar</option> 
                                    <?php foreach($departamentos as $departamento){ ?>
                                    <option value="<?php echo $departamento['deptid']; ?>"><?php echo ucfirst(strtolower($departamento['deptname'])); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="empleado"><strong>Empleado:</strong></label><br>
                            <div id="emp">
                                <select name="empleado" id="empleado" class="chosen-select" style="width:250px">
                                    <option value="" selected>Seleccionar</option>
                                    <?php foreach($empleados as $empleado){ ?>
                                    <option value="<?php echo $empleado['userid']; ?>"><?php echo $empleado['name']; ?></option>
                                    <?php } ?>                                    
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.table-responsive -->
                <div class="well">
                    <a class="btn btn-default btn-lg btn-block" href="#" onclick="">Generar Reporte</a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>