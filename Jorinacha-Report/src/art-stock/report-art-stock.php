<?php
require "../../includes/log.php";
include '../../includes/header.php';
include '../../services/mysql.php';
include '../../services/sqlserver.php';

if ($_POST) {


  $linea = $_POST['linea'];
  $fecha1 = $_POST['fecha1'];
  $fecha2 = $_POST['fecha2'];

  for ($i = 0; $i < 20; $i += 1) {
    $sedes[] = $_POST[$i];
  }


?>
<style>
  #table-fixed tbody{
    height: 230px;
    overflow-y: auto;
    width: 100%;
  }
  #table-fixed thead,#table-fixed tbody,
  #table-fixed td ,#table-fixed th{
    display: block;
  }
  #table-fixed tbody td,
  #table-fixed thead > tr > th{
    float: left;
    border-bottom-width:0 ;
  }

</style>

  <table class="table table-dark table-striped" id="table-fixed">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope='col'>Codigo</th>
        <th scope='col'>Linea</th>
        <th scope='col'>Marca</th>
        <th scope='col'>Talla</th>
        <th scope='col'>Color</th>
        <th scope='col'>Total Vendido</th>
        <th scope='col'>Precio Bs</th>
        <th scope='col'>Ref</th>
        <?php

        for ($i = 0; $i < count($sedes); $i++) {

          if ($sedes[$i] != null) {

            $sede = $sedes[$i];

        ?>
            <th scope='col'><?= $sede ?></th>
        <?php }
        } ?>

      </tr>
    </thead>
    <tbody>
      <?php

      $res1 = getArt('Previa Shop', $linea);
      $n = 1;
      for ($e = 0; $e < count($res1); $e++) {

        $co_art = $res1[$e]['co_art'];
        $co_lin = getLin_art($res1[$e]['co_lin']);
        $co_subl = getSub_lin($res1[$e]['co_subl']);
        $co_cat = getCat_art($res1[$e]['co_cat']);
        $co_color = getColores($res1[$e]['co_color']);

        $stock_act = round($res1[$e]['stock_act']);
        $totak_stock += $stock_act;

        $precio = round($res1[$e]['prec_vta1']);
        $prec_vta1 = number_format($precio, 2, ',', '.');

        $prec_vta5 = round($res1[$e]['prec_vta5']);

      ?>

        <tr>
          <th scope='row'><?= $n ?></th>
          <td><?= $co_art ?></td>
          <td><?= $co_lin ?></td>
          <td><?= $co_subl ?></td>
          <td><?= $co_cat ?></td>
          <td><?= $co_color ?></td>
          <?php
          $g = 1;
          /* $total_vendido = 0; */
          for ($i = 0; $i < count($sedes); $i++) {

            if ($sedes[$f] != null) {

              $res2 = getReng_fac($sedes[$g],  $co_art, $fecha1, $fecha2);
              $total_vendido += round($res2);
            }
            $f++;
          } 


          ?>
          <td><?= $total_vendido ?></td>
          <td><?= $prec_vta1 ?></td>
          <td>$<?= $prec_vta5 ?></td>
          <td><?= $stock_act ?></td>
          <?php
          $f = 1;
          for ($i = 0; $i < count($sedes); $i++) {


            if ($sedes[$f] == null) {
              $f++;
            } else {

              $res3 = getArt_stock_tiendas($sedes[$f], $co_art);
              $stock_act_tienda = round($res3[0]['stock_act']);

          ?>
              <td><?= $stock_act_tienda  ?></td>
          <?php $f++;
            }
          }
          $n++ ?>
        </tr>




      <?php  }    ?>
    </tbody>
  </table>




<?php
} else {
  header("location: form.php");
}

var_dump($total_vendido);


include '../../includes/footer.php'; ?>