<?php

include_once 'includes/funciones/funciones.php';

$id_ticket = $_POST['id_ticket'];
$id_creador = $_POST['id_creador'];
$descripcion = $_POST['descripcion'];
$id_tecnico = $_POST['tecnico'];
$prioridad = $_POST['prioridad'];
$estado = $_POST['estado'];
$escalabilidad = $_POST['escalabilidad'];

if($_POST['registro'] == 'actualizar'){  // Para actualizar la info de otros tickets

  if ($escalabilidad == "externa") {
    $id_tecnico = NULL;
  } else {
    if (empty($id_tecnico)) {
      $estado = "inicio";
    }
  }

  try {
    if(empty($id_tecnico)) {
      $stmt = $conn->prepare("UPDATE tickets SET descripcion = ?, prioridad = ?, estado = ?, escalabilidad = ? WHERE id = ?");
      $stmt->bind_param("ssssi", $descripcion, $prioridad, $estado, $escalabilidad, $id_ticket);
    } else {
      $stmt = $conn->prepare("UPDATE tickets SET descripcion = ?, tecnico = ?, prioridad = ?, estado = ?, escalabilidad = ? WHERE id = ?");
      $stmt->bind_param("sisssi", $descripcion, $id_tecnico, $prioridad, $estado, $escalabilidad, $id_ticket);
    }
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

  if (empty($id_tecnico)) {
    $estado = "inicio";
  } else {
    $estado = "asignado";
  }

  if ($escalabilidad == "externa") {
    $id_tecnico = NULL;
  }

  try {
    $stmt = $conn->prepare('INSERT INTO tickets (fecha, descripcion, creador, tecnico, prioridad, estado, escalabilidad) VALUES (NOW(), ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param("siisss", $descripcion, $id_creador, $id_tecnico, $prioridad, $estado, $escalabilidad);
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

} else if ($_GET['registro'] == 'eliminar') { // Para eliminar tickets

  $id_borrar = $_GET['id'];

  try {
    $stmt = $conn->prepare('DELETE FROM tickets WHERE id = ? ');
    $stmt->bind_param('i', $id_borrar);
    $stmt->execute();
    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_eliminado' => $id_borrar
      );
      header("location: lista-tickets.php?respuesta=1");
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      header("location: lista-tickets.php?respuesta=0");
    }
  } catch (Exception $e) {
    $respuesta = array(
      'respuesta' => $e->getMessage()
    );
  }
  die(json_encode($respuesta));

}

?>
