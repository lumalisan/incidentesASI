<?php

include_once 'includes/templates/adminHeader.php';
include_once 'includes/funciones/funciones.php';

try {
  $stmt = $conn->query("SELECT * FROM tickets WHERE estado != 'finalizado';");
  $cantidadTickets = $stmt->num_rows;

  $stmt2 = $conn->query("SELECT id FROM usuarios WHERE nivel = 0");
  $cantidadUsuarios = $stmt2->num_rows;

  $stmt3 = $conn->query("SELECT id FROM tickets WHERE tecnico IS NULL AND escalabilidad NOT LIKE 'externa'");
  $cantidadTecnicos = $stmt3->num_rows;
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

?>

<!-- Main layout -->
<main>

  <div class="container-fluid">

    <!-- Section: Intro -->
    <section class="mt-md-4 pt-md-2 mb-5 pb-4">
      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">

          <!-- Card -->
          <div class="card card-cascade cascading-admin-card">

            <!-- Card Data -->
            <div class="admin-up">
              <i class="fas fa-user-clock danger-color mr-3 z-depth-2"></i>
              <div class="data">
                <p class="text-uppercase">Técnicos sin asignar</p>
                <h4 class="font-weight-bold dark-grey-text"><?php echo $cantidadTecnicos; ?></h4>
              </div>
            </div>

            <!-- Card content -->
            <div class="card-body card-body-cascade">
              <div class="progress mb-3">
                <div class="progress-bar danger-color" role="progressbar" style="width: <?php echo $cantidadTecnicos; ?>%"
                  aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

            </div>
            <!-- Card -->

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">

            <!-- Card -->
            <div class="card card-cascade cascading-admin-card">

              <!-- Card Data -->
              <div class="admin-up">
                <i class="fas fa-ticket-alt primary-color mr-3 z-depth-2"></i>
                <div class="data">
                  <p class="text-uppercase">Tickets Pendientes</p>
                  <h4 class="font-weight-bold dark-grey-text"><?php echo $cantidadTickets; ?></h4>
                </div>
              </div>

              <!-- Card content -->
              <div class="card-body card-body-cascade">
                <div class="progress mb-3">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $cantidadTickets; ?>%"
                    aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>

              </div>
              <!-- Card -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">

              <!-- Card -->
              <div class="card card-cascade cascading-admin-card">

                <!-- Card Data -->
                <div class="admin-up">
                  <i class="fas fa-user-plus warning-color mr-3 z-depth-2"></i>
                  <div class="data">
                    <p class="text-uppercase">Clientes Registrados</p>
                    <h4 class="font-weight-bold dark-grey-text"><?php echo $cantidadUsuarios; ?></h4>
                  </div>
                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade">
                  <div class="progress mb-3">
                    <div class="progress-bar warning-color accent-2" role="progressbar" style="width: <?php echo $cantidadUsuarios; ?>%"
                      aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>

                </div>
                <!-- Card -->

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->

          </section>
          <!-- Section: Intro -->

          <!-- Section: Main panel -->
          <section class="mb-5">

            <!-- Card -->
            <div class="card card-cascade narrower">

              <!-- Section: Chart -->
              <section>

                <!-- Grid row -->
                <div class="row">

                  <!-- Grid column -->
                  <div class="col-xl-10 mb-4 pb-2 mx-auto">

                    <!-- Chart -->
                    <div class="view view-cascade gradient-card-header blue-gradient">

                      <canvas id="lineChart" height="140"></canvas>

                    </div>

                  </div>
                  <!-- Grid column -->

                </div>
                <!-- Grid row -->

              </section>
              <!-- Section: Chart -->

              <!-- Section: Table -->
              <section>

                <div class="card card-cascade narrower z-depth-0">

                  <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                    <h4 class="white-text mx-3 pb-3 pt-3 mx-auto">Últimos tickets</h4>
                  </div>

                  <div class="px-4">

                    <div class="table-responsive">

                      <!--Table-->
                      <table class="table table-hover mb-0">

                        <!-- Table head -->
                        <thead>
                          <tr>
                            <th class="th-lg">ID</th>
                            <th class="th-lg">Fecha de creación</th>
                            <th class="th-lg">Descripción</th>
                            <th class="th-lg">Creador</th>
                            <th class="th-lg">Técnico asignado</th>
                            <th class="th-lg">Prioridad</th>
                            <th class="th-lg">Estado</th>
                          </tr>
                        </thead>
                        <!-- Table head -->

                        <!-- Table body -->
                        <tbody>
                          <?php
                          try {
                            $sql = "SELECT * FROM tickets ORDER BY id DESC LIMIT 5";
                            $resultado = $conn->query($sql);
                          } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                          }

                          $contador = 0;

                          while($ticket = $resultado->fetch_assoc()) {

                            try {
                              $id_creador = $ticket['creador'];
                              $resultado_creador = $conn->query("SELECT nombre FROM usuarios WHERE id = $id_creador;");
                              $nombre_creador = $resultado_creador->fetch_assoc();
                              if (empty($nombre_creador['nombre'])) {
                                $nombre_creador['nombre'] = "El creador fue eliminado";
                              }
                            } catch (Exception $e) {
                              $error = $e->getMessage();
                              echo $error;
                            }

                            try {
                              $id_tecnico = $ticket['tecnico'];
                              if ($id_tecnico != null) {
                                $resultado_tecnico = $conn->query("SELECT nombre FROM usuarios WHERE id = $id_tecnico;");
                                $nombre_tecnico = $resultado_tecnico->fetch_assoc();
                                if (empty($nombre_tecnico['nombre'])) {
                                  $nombre_tecnico['nombre'] = "El técnico fue eliminado";
                                }
                              } else {
                                $nombre_tecnico['nombre'] = "NO ASIGNADO";
                              }
                            } catch (Exception $e) {
                              $error = $e->getMessage();
                              echo $error;
                            }

                            if ($ticket['prioridad'] == 'baja') {
                              $color = "badge-default";
                            } else if ($ticket['prioridad'] == 'media') {
                              $color = "badge-primary";
                            } else if ($ticket['prioridad'] == 'alta') {
                              $color = "badge-secondary";
                            } else if ($ticket['prioridad'] == 'grave') {
                              $color = "badge-warning";
                            } else {
                              $color = "badge-danger";
                            }

                            ?>

                            <tr>
                              <td><?php echo $ticket['id']; ?></td>
                              <td><?php echo $ticket['fecha']; ?></td>
                              <td><?php echo $ticket['descripcion']; ?></td>
                              <td><?php echo $nombre_creador['nombre']; ?></td>
                              <td><?php echo $nombre_tecnico['nombre']; ?></td>
                              <td class="text-center font-weight-bold"><h5><span class="badge badge-pill <?php echo $color; ?>"><?php echo $ticket['prioridad']; ?></span></h5></td>
                              <td class="text-center"><?php echo $ticket['estado']; ?></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                        <!-- Table body -->

                      </table>
                      <!-- Table -->

                    </div>

                  </div>

                </div>

              </section>
              <!--Section: Table-->

            </div>
            <!-- Card -->

          </section>
          <!-- Section: Main panel -->


        </div>

      </main>
      <!-- Main layout -->

      <?php include_once 'includes/templates/adminFooter.php'; ?>
