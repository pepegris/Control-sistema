<?php
require '../../includes/log.php';
include '../../includes/header.php';
include '../../services/mysql.php';
include '../../services/sqlserver.php';

if (isset($_POST)  ) {
  
  $clave=$_POST['clave'];




  if ($clave === 'C0nt4b1l1d4d' ) {

?>

<style>
  .form-check {
    display: none;
    display: flexbox;

  }
</style>

<center>
  <h1>Reporte en Prueba</h1>
</center>

<div id="body">

  <form action="routes.php" method="POST">

    <div class="fieldset">
      <br>
      <center>
        <legend>Reporte</legend>
      </center>


      <div class="form-check">
        <?php
        $res1 = getTiendas();
        $i = 0;
        while ($row1 = mysqli_fetch_array($res1)) {

          $sede = $row1['sedes_nom'];
          if ($sede == 'Sede Boleita') {
            $sede = 'Previa Shop';
          }

        ?>

          <input class="form-check-input" type="checkbox" value="<?= $sede ?>" name="<?= $i ?>" checked>
          <label class="form-check-label" for="<?= $sede ?>">
            <?= $sede ?>
          </label>

        <?php $i++;
        } ?>

      </div>



      <div class="form-group">
        <label for="tipo_cob" class="form-label">Tipo</label>
        <select name="tipo_cob" id="">

          <option value="todos">Todos</option>
          <option value="TARJ">Tarjeta</option>
          <option value="EFEC">Efectivo</option>
          <option value="egreso">Egreso</option>
          <option value="detallado">Egreso Detallado</option>
          

        </select>
      </div>

      <!-- FORMULAIO DE FECHAS -->


      <div class="form-group">
        <label for="fecha1" class="form-label " required>Desde</label>
        <input type="date" name="fecha1" id="" required>
      </div>

      <div class="form-group">
        <label for="fecha2" class="form-label " >Hasta</label>
        <input type="date" name="fecha2" id="" >
      </div>



      <br>
      <center><button type="submit" class="btn btn-primary">Ingresar</button></center>
      <br>
      <center><a href='Import-database.php' class='btn btn-warning'>Importar Base de Datos</a></center>
    </div>
  </form>
</div>






<?php include '../../includes/footer.php'; 
  }else {
    header('refresh:1;url= form-2.php');
    exit;}

      }else {
        header('refresh:1;url= form-2.php');
        exit;}
?>