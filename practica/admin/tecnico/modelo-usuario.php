<?php

include_once 'funciones/funciones.php';
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$id_registro = $_POST['id_registro'];

if($_POST['registro'] == 'actualizar'){  // Para actualizar la info de mi cuenta

  try {
    if(empty($_POST['password']) ) {
      $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, user = ? WHERE id = ?");
      $stmt->bind_param("ssi", $nombre, $usuario, $id_registro);
    } else {
      $opciones = array('cost' => 12);
      $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
      $stmt = $conn->prepare('UPDATE usuarios SET nombre = ?, user = ?, password = ? WHERE id = ?');
      $stmt->bind_param("sssi", $nombre, $usuario, $hash_password, $id_registro);
    }
    $stmt->execute();

    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_actualizado' => $stmt->insert_id
      );
      header("location: micuenta.php?id=$id_registro&respuesta=1");
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      header("location: micuenta.php?id=$id_registro&respuesta=0");
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

}

?>
