<?php

include_once 'includes/templates/adminHeader.php';
include_once 'includes/funciones/funciones.php';

?>

<!-- Main layout -->
<main>

  <div class="container-fluid">
    <div class="card card-cascade narrower">

      <section>
        <div class="row">
          <div class="col-xl-12 col-lg-12 mr-0 pb-2">
            <div class="view view-cascade gradient-card-header juicy-peach-gradient text-dark">
              <h2 class="h2-responsive mb-0 font-weight-500">Lista de tickets</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12 table-responsive">

                <table id="tabladedatos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">ID
                      </th>
                      <th class="th-sm">Fecha de creación
                      </th>
                      <th class="th-sm">Descripción
                      </th>
                      <th class="th-sm">Creador
                      </th>
                      <th class="th-sm">Técnico asignado
                      </th>
                      <th class="th-sm">Prioridad
                      </th>
                      <th class="th-sm">Estado
                      </th>
                      <th class="th-sm">Escalabilidad
                      </th>
                      <th class="th-sm">Acciones
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT * FROM tickets;";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }

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
                        <td>
                          <?php
                          if ($ticket['escalabilidad'] == "externa") {
                            echo "EXTERNO";
                          } else {
                            echo $nombre_tecnico['nombre'];
                          }
                          ?>
                      </td>
                        <td class="text-center font-weight-bold"><h5><span class="badge badge-pill <?php echo $color; ?>"><?php echo $ticket['prioridad']; ?></span></h5></td>
                        <td class="text-center"><?php echo $ticket['estado']; ?></td>
                        <td class="text-center"><?php echo $ticket['escalabilidad']; ?></td>
                        <td class="text-center">
                          <a href="historico-ticket.php?id=<?php echo $ticket['id']; ?>" class="btn-floating btn-sm success-color my-0 waves-effect waves-light ml-3 mr-3">
                            <i class="fas fa-clipboard-list dark-text"></i>
                          </a>
                          <a href="editar-ticket.php?id=<?php echo $ticket['id']; ?>" class="btn-floating btn-sm info-color my-0 waves-effect waves-light ml-3 mr-3">
                            <i class="fas fa-edit dark-text"></i>
                          </a>
                        </td>
                      </tr>

                      <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID
                      </th>
                      <th>Fecha de creación
                      </th>
                      <th>Descripción
                      </th>
                      <th>Creador
                      </th>
                      <th>Técnico asignado
                      </th>
                      <th>Prioridad
                      </th>
                      <th>Estado
                      </th>
                      <th>Escalabilidad
                      </th>
                      <th>Acciones
                      </th>
                    </tr>
                  </tfoot>
                </table>

              </div>
              <!-- First column -->

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-12 col-lg-12 mr-0 pb-2">
            <div class="card-body card-body-cascade pb-0">
              <!-- First column -->
              <div class="col-md-12">
                <h5 class="ml-2">Descargar</h5>
                <p class="lead">
                  <button id="json" class="btn btn-primary">EN JSON</button>
                  <button id="csv" class="btn btn-info">EN CSV</button>
                  <button class="btn btn-danger" onclick="return xepOnline.Formatter.Format('tabladedatos',{render:'download'});">EN PDF</button>
                </p>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </div>
</main>

<?php include_once 'includes/templates/adminFooter.php'; ?>
