<?php
require '../../includes/log.php';
include '../../includes/header.php';
include '../../services/mysql.php';
include '../../services/sqlserver.php';

?>


<div id="body">

  <ul class="list-group">
    <li class="list-group-item disabled" style="background-color:black" aria-disabled="true">
      <center><b>Replica</b></center>
    </li>

    <?php

    for ($i = 0; $i < count($sedes_ar); $i++) {

      if ($sedes_ar[$i] != 'Previa Shop') {

        $sede = $sedes_ar[$i];

        $res = Replica($sedes_ar[$i]);
        $res1 = $res['fec_emis'];
        $fecha = $res1->format('d-m-Y');
    ?>

        <li class="list-group-item"><b style="color:black"><?= $sede ?></b> / <?= $fecha ?></i></li>



    <?php

      }
    }



    $fecha_actual = strtotime(date("d-m-Y", time()));
    $fecha_entrada = strtotime($fecha);

    //sumo 1 mes
    //echo date("d-m-Y",strtotime($fecha_actual."+ 1 month")); 
    //resto 1 mes

    $fecha1= date("d-m-Y",strtotime($fecha_actual."- 3 day"));
    $fecha2= date("d-m-Y",strtotime($fecha_actual."- 7 day"));

    echo "$fecha_entrada <br>";
    echo "$fecha1 <br>";
    echo "$fecha2 <br>";

    if ( $fecha_entrada >= $fecha1) {
      echo '<i class="lni lni-cloud-check"></i>';
    }elseif (    $fecha_entrada >= $fecha2) {
      echo '<i class="lni lni-cloud-sync"></i>';
    }
     else {
      echo '<i class="lni lni-cloud-upload"></i>';
    }
    ?>

  </ul>

  
  


</div>




<?php include '../../includes/footer.php'; ?>