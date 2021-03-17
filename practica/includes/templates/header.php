<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_GET['cerrar_sesion'])) {
  session_destroy();
}

// Si la sesion ya existe, redireccionar al usuario
if(isset($_SESSION['nivel'])) {
  $nivel = $_SESSION['nivel'];
  // Dependiendo de su nivel se le redireccionará al panel que le corresponda
  if ($nivel == 2) {
    // Redirección al dashboard del admin
    header("location: admin/dashboardAdmin.php");
    exit();
  } else if ($nivel == 1) {
    // Redirección al dashboard del técnico
    header("location: admin/tecnico/dashboardTecnico.php");
    exit();
  } else if ($nivel == 0) {
    // Redirección al dashboard del cliente
    header("location: admin/cliente/dashboardCliente.php");
    exit();
  }
}

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
      $response = "Password incorrecto";
  } else if ($_GET['respuesta'] == 0) {
      $response = "Ese usuario no existe";
  }
}

include_once 'includes/funciones/bd_conexion.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Administración de Sistemas</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <style>
    html,
    body,
    header,
    .intro-3 {
      height: 100%;
    }
    @media (max-width: 450px) {
      html,
      body,
      header,
      .intro-3 {
        height: 820px;
      }
    }
    @media (min-width: 451px) and (max-width: 740px) {
      html,
      body,
      header,
      .intro-3 {
        height: 900px;
      }
    }
    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .intro-3 {
        height: 950px;
      }
    }
  </style>
</head>

<body>

  <!-- Intro -->
  <header>
