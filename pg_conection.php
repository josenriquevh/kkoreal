<?php

pg_connect("host=localhost dbname=anviz user=postgres password=1234")
    or die("No se puede conectar a la base de datos. ".pg_last_error());

    echo "se conecto. Actualizando 2";

?>
