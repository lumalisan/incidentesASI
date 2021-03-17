<?php

include_once 'funciones/funciones.php';

$id_creador = $_POST['id_creador'];
$descripcion = $_POST['descripcion'];

if ($_POST['registro'] == 'nuevo') { // Para crear nuevos tickets
  $prioridad = "baja";
  $estado = "inicio";
  $escalabilidad = "basica";

  try {
    $stmt = $conn->prepare('INSERT INTO tickets (fecha, descripcion, creador, prioridad, estado, escalabilidad) VALUES (NOW(), ?, ?, ?, ?, ?)');
    $stmt->bind_param("sisss", $descripcion, $id_creador, $prioridad, $estado, $escalabilidad);
    $stmt->execute();
    $id_insertado = $stmt->insert_id;
    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_insertado' => $id_insertado
      );
      header("location: crear-ticket.php?respuesta=1");
    } else {
      $respuesta = array('respuesta' => 'error');
      header("location: crear-ticket.php?respuesta=0");
    }
    $stmt->close();
    $conn->close();

  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

}

?>
