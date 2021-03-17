<?php

  if (isset($_POST['login-usuario'])) {

    $user = $_POST['user'];
    $pass = $_POST['password'];

    try {
      include_once 'includes/funciones/bd_conexion.php';

      $stmt = $conn->prepare("SELECT * FROM usuarios WHERE user = ?;");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $stmt->bind_result($id_usuario, $nombre_usuario, $user_usuario, $pass_usuario, $nivel);
      if ($stmt->affected_rows) {
        $existe = $stmt->fetch();
        if ($existe) {
          if (password_verify($pass, $pass_usuario)) {
            // Si el usuario y el password son correctos, guardamos los resultados en la sesion
            session_start();
            $_SESSION['id'] = $id_usuario;
            $_SESSION['nombre'] = $nombre_usuario;
            $_SESSION['user'] = $user_usuario;
            $_SESSION['nivel'] = $nivel;
            // Solo debug
            $respuesta = array(
              'respuesta' => 'exitoso',
              'nombre' => $nombre_usuario
            );
            //die(json_encode($respuesta));
            // Dependiendo de su nivel se le redireccionará al panel que le corresponda
            if ($nivel == 2) {
              // Redirección al dashboard del admin
              header("location: admin/dashboardAdmin.php");
            } else if ($nivel == 1) {
              // Redirección al dashboard del técnico
              header("location: admin/tecnico/dashboardTecnico.php");
            } else if ($nivel == 0) {
              // Redirección al dashboard del cliente
              header("location: admin/cliente/dashboardCliente.php");
            }
          } else {
            $respuesta = array('respuesta' => 'password_incorrecto');
            header("location: index.php?respuesta=1");
          }
        } else {
          $respuesta = array('respuesta' => 'no_existe');
          header("location: index.php?respuesta=0");
        }
      }
      $stmt->close();
      $conn->close();

    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));

  }

?>
