<?php

include_once 'includes/funciones/funciones.php';
$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$nivel = $_POST['nivel_usuario'];
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

} else if ($_POST['registro'] == 'actualizarUsuario') { // Para actualizar la info de otros usuarios

  try {
    if(empty($_POST['password']) ) {
      $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, user = ?, nivel = ? WHERE id = ?");
      $stmt->bind_param("ssii", $nombre, $usuario, $nivel, $id_registro);
    } else {
      $opciones = array('cost' => 12);
      $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
      $stmt = $conn->prepare('UPDATE usuarios SET nombre = ?, user = ?, password = ?, nivel = ? WHERE id = ?');
      $stmt->bind_param("sssii", $nombre, $usuario, $hash_password, $nivel, $id_registro);
    }
    $stmt->execute();

    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_actualizado' => $stmt->insert_id
      );
      header("location: editar-usuario.php?id=$id_registro&respuesta=1");
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      header("location: editar-usuario.php?id=$id_registro&respuesta=0");
    }
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

} else if ($_POST['registro'] == 'nuevo') { // Para crear nuevos usuarios

  try {
    $opciones = array('cost' => 12);
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
    $stmt = $conn->prepare('INSERT INTO usuarios (nombre, user, password, nivel) VALUES (?, ?, ?, ?) ');
    $stmt->bind_param("sssi", $nombre, $usuario, $hash_password, $nivel);
    $stmt->execute();
    $id_insertado = $stmt->insert_id;
    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_insertado' => $id_insertado
      );
      header("location: crear-usuario.php?respuesta=1");
    } else {
      $respuesta = array('respuesta' => 'error');
      header("location: crear-usuario.php?respuesta=0");
    }
    $stmt->close();
    $conn->close();

  } catch (Exception $e) {
    $respuesta = array('respuesta' => $e->getMessage());
  }

  die(json_encode($respuesta));

} else if ($_GET['registro'] == 'eliminar') { // Para eliminar usuarios

  $id_borrar = $_GET['id'];

  try {
    $stmt = $conn->prepare('DELETE FROM usuarios WHERE id = ? ');
    $stmt->bind_param('i', $id_borrar);
    $stmt->execute();
    if($stmt->affected_rows) {
      $respuesta = array(
        'respuesta' => 'exito',
        'id_eliminado' => $id_borrar
      );
      header("location: lista-usuarios.php?respuesta=1");
    } else {
      $respuesta = array(
        'respuesta' => 'error'
      );
      header("location: lista-usuarios.php?respuesta=0");
    }
  } catch (Exception $e) {
    $respuesta = array(
      'respuesta' => $e->getMessage()
    );
  }
  die(json_encode($respuesta));

}

?>
