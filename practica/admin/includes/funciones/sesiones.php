<?php

    function usuario_autenticado() {
      if(!revisar_usuario()) {
        header('Location: ../index.php');
        exit();
      }
    }

    function revisar_usuario() {
      return isset($_SESSION['id']);
    }

    session_start();
    usuario_autenticado();

    if ($_SESSION['nivel'] == 1) {
      header("location: tecnico/dashboardTecnico.php");
    } else if ($_SESSION['nivel'] == 0) {
      header("location: cliente/dashboardCliente.php");
    }

 ?>
