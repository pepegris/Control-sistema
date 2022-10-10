<?php
ini_set('memory_limit', '4096M');
ini_set('max_execution_time', 3600);

require "../../includes/log.php";
include '../../includes/header.php';
include '../../services/mysql.php';
include '../../services/sqlserver.php';

if (isset($_GET)) {


  $linea = $_GET['linea'];
  $almacen = $_GET['almacen'];

  $fecha1 = date("Ymd", strtotime($_GET['fecha1']));
  $fecha2 = date("Ymd", strtotime($_GET['fecha2']));


?>


  <style>
    form,
    td {
      font-size: 12px;
    }
  </style>
  <center>
    <h1>Reporte de Aj</h1>
  </center>
  <table class="table table-dark table-striped" id="tblData">
    <thead>
      <tr>
        <th scope="col">TIENDAS</th>

        <?php

        for ($i = 0; $i < count($sedes_ar); $i++) {

          if ($sedes_ar[$i] != null) {

            $sede = $sedes_ar[$i];


            if ($sedes_ar[$i] != 'Previa Shop') {
              echo "<th scope='col'> $sede </th>";
            }
          }
        } ?>
        <th scope="col">TOTALES</th>

      </tr>
    </thead>
    <tbody>


      <tr>
        <th scope='row'>FACTURADO DESDE PREVIA</th>

        <?php
        $g = 1;
        for ($i = 0; $i < count($sedes_ar); $i++) {




          if ($sedes_ar[$g] != null) {

            $res0 = getFactura($sedes_ar[$g], null, $fecha1, $fecha2, $linea);

            if ($res0 == null) {
              $res0 = 0;
            }


            $total_enviado_tienda[$sedes_ar[$g]] += $res0;


        ?>

            <td><?= $res0 ?></td>

        <?php }
          $g++;
        }   ?>

        <th><?= $total_enviado_tienda[$sedes_ar[$g]] ?></th>

      </tr>

      <tr>
        <th scope='row'>AJUSTES ENTRADAS X SOBRANTES</th>

        <?php
        $g = 1;
        for ($i = 0; $i < count($sedes_ar); $i++) {




          if ($sedes_ar[$g] != null) {

            $res1 = getAjustes($sedes_ar[$g], $fecha1, $fecha2, $linea, 'EN');

            if ($res1 == null) {
              $res1 = 0;
            }

            $total_entradas_sobrantes[$sedes_ar[$g]] += $res1;


        ?>

            <td><?= $res1 ?></td>

        <?php }
          $g++;
        }   ?>

        <th><?= $total_entradas_sobrantes[$sedes_ar[$g]] ?></th>
      </tr>


      <tr>
        <th scope='row'>AJUSTES SALIDAS X FALTANTES</th>

        <?php
        $g = 1;

        for ($i = 0; $i < count($sedes_ar); $i++) {




          if ($sedes_ar[$g] != null) {

            $res2 = getAjustes($sedes_ar[$g], $fecha1, $fecha2, $linea, 'SAL');

            if ($res2 == null) {
              $res2 = 0;
            }

            $total_salidas_faltantes[$sedes_ar[$g]] += $res2;


        ?>

            <td><?= $res2 ?></td>

        <?php }
          $g++;
        }   ?>

        <th><?= $total_salidas_faltantes[$sedes_ar[$g]] ?></th>
      </tr>


      <tr>
        <th scope='row'>TOTALES</th>

        <?php
        $g = 1;
        $total = 0;
        for ($i = 0; $i < count($sedes_ar); $i++) {


          if ($sedes_ar[$g] != null) {

            $total = $total_salidas_faltantes[$sedes_ar[$g]] + $total_entradas_sobrantes[$sedes_ar[$g]] + $total_enviado_tienda[$sedes_ar[$g]];
            $totales += $total;

        ?>

            <th><?= $total ?></th>

        <?php }
          $total = 0;
          $g++;
        }   ?>
        <th><?= $totales ?></th>
      </tr>

    </tbody>
  </table>

<!--   <script src="../../assets/js/excel.js"></script>
  <center>
    <button id="submitExport" class="btn btn-success">Exportar Reporte a EXCEL</button>
  </center>
 -->



<?php
} else {
  header("location: form.php");
}




include '../../includes/footer.php'; ?>