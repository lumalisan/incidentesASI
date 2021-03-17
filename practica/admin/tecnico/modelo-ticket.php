<?php

include_once 'funciones/funciones.php';

$id_ticket = $_POST['id_ticket'];
$id_creador = $_POST['id_creador'];
$descripcion = $_POST['descripcion'];
$prioridad = $_POST['prioridad'];
$estado = $_POST['estado'];
$escalabilidad = $_POST['escalabilidad'];
$id_tecnico = $_POST['id_tecnico'];

if($_POST['registro'] == 'actualizar'){  // Para actualizar la info de otros tickets

  $sql = "SELECT escalabilidad FROM tickets WHERE id = $id_ticket";
  $resultado = $conn->query($sql);
  $escalabilidad_ticket = $resultado->fetch_assoc();

  if ($escalabilidad_ticket['escalabilidad'] != $escalabilidad) {
    $id_tecnico = NULL;
    $estado = 'inicio';
  }

  try {
    $stmt = $conn->prepare("UPDATE tickets SET descripcion = ?, tecnico = ?, prioridad = ?, estado = ?, escalabilidad = ? WHERE id = ?");
    $stmt->bind_param("sisssi", $descripcion, $id_tecnico, $prioridad, $estado, $escalabilidad, $id_ticket);
    $stmt->execute();

    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_actualizado' => $stmt->insert_id
      );
      header("location: editar-ticket.php?id=$id_ticket&respuesta=1");
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      header("location: editar-ticket.php?id=$id_ticket&respuesta=0");
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

} else if ($_POST['registro'] == 'nuevo') { // Para crear nuevos tickets

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
