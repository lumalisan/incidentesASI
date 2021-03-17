<?php

include_once 'templates/clientHeader.php';
include_once 'funciones/funciones.php';

?>

<!-- Main layout -->
<main>

  <div class="container-fluid">
    <div class="card card-cascade narrower">

      <section>
        <div class="row">
          <div class="col-xl-12 col-lg-12 mr-0 pb-2">
            <div class="view view-cascade gradient-card-header juicy-peach-gradient text-dark">
              <h2 class="h2-responsive mb-0 font-weight-500">Lista de mis tickets</h2>
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
                      <th class="th-sm">Técnico asignado
                      </th>
                      <th class="th-sm">Estado
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $id_creador = $_SESSION['id'];
                      $sql = "SELECT * FROM tickets WHERE creador = $id_creador";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }

                    $contador = 0;

                    while($ticket = $resultado->fetch_assoc()) {

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

                      ?>

                      <tr>
                        <td><?php echo $ticket['id']; ?></td>
                        <td><?php echo $ticket['fecha']; ?></td>
                        <td><?php echo $ticket['descripcion']; ?></td>
                        <td><?php echo $nombre_tecnico['nombre']; ?></td>
                        <td class="text-center"><?php echo $ticket['estado']; ?></td>
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
                <th>Técnico asignado
                </th>
                <th>Estado
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

<?php include_once 'templates/clientFooter.php'; ?>
