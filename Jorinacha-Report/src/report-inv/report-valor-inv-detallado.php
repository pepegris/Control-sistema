<?php
ini_set('memory_limit', '4096M');
ini_set('max_execution_time', 3600);

require "../../includes/log.php";
include '../../includes/header2.php';
include '../../services/mysql.php';
include '../../services/adm/inv/inv.php';

if ($_GET) {

  $database = $_GET['tienda'];
  $fecha1 = date("Ymd", strtotime($_GET['fecha1']));



?>



  <link rel='stylesheet' href='responm.css'>




  <center>
    <h1>Valor del Inventario <?=$database?></h1>
  </center>



  <table class="table table-dark table-striped" id="tblData">
    <thead>

      <tr>

      <center>
        <th scope="col">Marca</th>
        <th scope='col'>Codigo</th>
        <th scope='col'>Descripcion</th>

        <th scope='col'>Stock Teorico</th>
        <th scope='col'>Stock Real</th>
        <th scope='col'>DIF</th>


        <th scope='col'>Costo</th>
        <th scope='col'>Costo Teorico</th>
        <th scope='col'>Costo Real</th>
        <th scope='col'>DIF</th>

        <th scope='col'>Precio</th>
        <th scope='col'>Precio Teorico</th>
        <th scope='col'>Precio Real</th>
        <th scope='col'>DIF</th>
      </center>


      </tr>

    </thead>
    <tbody>

      <?php

      $marca=getLin_art("$fecha1",$database);

      var_dump(count($marca));
      echo "<br>";

  


      for ($i = 0; $i < count($marca); $i++) {

       $co_lin=$marca[$i]['co_lin'];
       $lin_des=$marca[$i]['lin_des'];

       $teorico=getreng_stock_teorico("$co_lin","$database","$fecha1");

       for ($e = 0; $e < 3; $e++) {
       //for ($e = 0; $e < count($teorico); $e++) {


        $co_art=$teorico[$e]['co_art'];
        $art_des=$teorico[$e]['art_des'];

        $real=getreng_stock_real("$co_lin","$database","$fecha1","$co_art");


        $stock_teorico=$teorico[$e]['stock_teor'];
        $stock_real=$real['stock_real'];

        
        $costo=$teorico[$e]['costo'];
        $teorico_total_costo=$teorico[$e]['total_costo_teorico'];
        $real_total_costo=$real['total_costo_real'];

        $precio=$teorico[$e]['precio'];
        $teorico_total_precio=$teorico[$e]['total_precio_teorico'];
        $real_total_precio=$real['total_precio_real'];


      ?>
        <tr>

          <td><?= $lin_des  ?> - <?= $co_lin ?></td>
          <td><?= $co_art  ?></td>
          <td><?= $art_des  ?></td>

          <td><?= $stock_teorico  ?></td>
          <td><?= $stock_real  ?></td>
          <td><?= $stock_teorico - $stock_real  ?></td>

          <td><?= $costo  ?></td>
          <td><?= $teorico_total_costo  ?></td>
          <td><?= $real_total_costo  ?></td>
          <td><?= $teorico_total_costo - $real_total_costo  ?></td>

          <td><?= $precio  ?></td>
          <td><?= $teorico_total_precio  ?></td>
          <td><?= $real_total_precio  ?></td>
          <td><?= $teorico_total_precio - $real_total_precio  ?></td>


        </tr>

        <?php

  /*
        $total_stock_teor+=$stock_teorico;
        $total_costo_teor+=$costo_teor;
        $total_dif+=$stock_teor - $stock_real;


        $total_stock_real+=$stock_real;
        $total_costo_real+=$costo_real;
        $total_precio_real+=$precio_real;*/
          }

        }
        ?>




        <tr>
          <td colspan="1">
            <h3>Totales</h3>
          </td>



          <td><b><?= $total_stock_teor ?></b></td>
          <td><b><?= number_format($total_costo_teor, 2, ',', '.') ?></b></td>
          <td><b><?= number_format($total_precio_teor, 2, ',', '.') ?></b></td>

          <td><b><?= $total_stock_real ?></b></td>
          <td><b><?= number_format($total_costo_real, 2, ',', '.') ?></b></td>
          <td><b><?= number_format($total_precio_real, 2, ',', '.') ?></b></td>




        </tr>

    </tbody>


  </table>


<?php
} else {
  header("location: form.php");
}



include '../../includes/footer.php'; ?>