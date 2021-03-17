<?php

include_once 'includes/funciones/sesiones.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashboard Admin</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- MDBootstrap Datatables  -->
  <link href="css/addons/datatables.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <style>

  </style>
</head>

<body class="fixed-sn white-skin">

  <!-- Main Navigation -->
  <header>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul>

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="dashboardAdmin.php" class="pl-0"><img src="img/ticketmaster.png" width="80%" height="70%"></a>
          </div>
        </li>

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">

            <li>
              <a class="collapsible-header waves-effect arrow-r" href="dashboardAdmin.php">
                <i class="w-fa fas fa-tachometer-alt"></i>Dashboard
              </a>
            </li>

            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-user"></i>Usuarios<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <a href="lista-usuarios.php" class="waves-effect">Ver todos</a>
                  </li>
                  <li>
                    <a href="crear-usuario.php" class="waves-effect">Crear nuevo</a>
                  </li>
                </ul>
              </div>
            </li>

            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-ticket-alt"></i>Tickets<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <a href="lista-tickets.php" class="waves-effect">Ver todos</a>
                  </li>
                  <li>
                    <a href="crear-ticket.php" class="waves-effect">Crear nuevo</a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        </li>
        <!-- Side navigation links -->

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>
    <!-- Sidebar navigation -->

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">

      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <p><strong>¡Bienvenido <?php echo $_SESSION['nombre'] ?>!</strong></p>
      </div>

      <div class="d-flex change-mode">

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Perfil</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="micuenta.php?id=<?php echo $_SESSION['id']; ?>"><i class="fas fa-cog"></i><span class="pl-3">Mi cuenta</span></a>
              <a class="dropdown-item" href="../index.php?cerrar_sesion"><i class="fas fa-power-off"></i><span class="pl-3">Salir</span></a>
            </div>
          </li>

        </ul>
        <!-- Navbar links -->

      </div>

    </nav>
    <!-- Navbar -->

  </header>
  <!-- Main Navigation -->
