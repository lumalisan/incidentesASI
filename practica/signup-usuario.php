<?php

  // Nos conectamos a la BD
  include_once 'includes/funciones/bd_conexion.php';

  // Cogemos el usuario y el password con el método POST
  $nombre = $_POST['nombre'];
  $user  = $_POST['user'];
  $pass = $_POST['password'];

  // Le decimos el coste del hash
  $opciones = array('cost' => 12);

  // Hasheamos el password
  $password_hashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);

  // Insertamos el usuario en la BD
  try {
      $stmt = $conn->prepare('INSERT INTO usuarios (nombre, user, password, nivel) VALUES (?, ?, ?, 0)');
      $stmt->bind_param("sss", $nombre, $user, $password_hashed);
      $stmt->execute();
      $id_user = $stmt->insert_id;
      if($id_user > 0) {
        // Si ha ido todo bien, guardamos los resultados la sesion
        session_start();
        $_SESSION['id'] = $id_user;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['user'] = $user;
        $_SESSION['nivel'] = 0;
        // Solo para debug
        $respuesta = array(
            'respuesta' => 'exito',
            'id_usuario' => $id_user
        );
        // Redirección al dashboard del cliente
        header("location: admin/cliente/dashboardCliente.php");
      } else {
        // Solo para debug
        $respuesta = array('respuesta' => 'error', 'id_usuario' => $id_user);
      }
      $stmt->close();
      $conn->close();
  } catch (Exception $e) {
    // Solo para debug
    $respuesta = array('respuesta' => $e->getMessage());
  }

  // Solo para debug
  die(json_encode($respuesta));

?>
