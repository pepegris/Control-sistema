<?php

require '../includes/conexion_control.php';

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM fiscal WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'fiscal Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: buscador.php');
}

?>
