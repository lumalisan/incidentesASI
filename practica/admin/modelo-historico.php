<?php

include_once 'includes/funciones/funciones.php';
$texto = $_POST['text'];
$id_ticket = $_POST['id_ticket'];
$id_tecnico = $_POST['id_tecnico'];

if($_POST['registro'] == 'actualizar'){  // Para actualizar el histórico

  try {
    $stmt = $conn->prepare('INSERT INTO historico (id_ticket, id_tecnico, texto, fecha) VALUES (?, ?, ?, NOW()) ');
    $stmt->bind_param("iis", $id_ticket, $id_tecnico, $texto);
    $stmt->execute();
    $id_insertado = $stmt->insert_id;
    if($stmt->affected_rows) {
      try {
        $stmt = $conn->prepare("UPDATE tickets SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id_ticket);
        $stmt->execute();
      } catch (\Exception $e) {
        $respuesta = array('respuesta' => $e->getMessage());
      }
      $respuesta = array(
        'respuesta' => 'exito',
        'id_insertado' => $id_insertado
      );
      header("location: historico-ticket.php?id=$id_ticket&respuesta=1");
    } else {
      $respuesta = array('respuesta' => 'error');
      header("location: historico-ticket.php?id=$id_ticket&respuesta=o");
    }
    $stmt->close();
    $conn->close();

  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

}

?>
