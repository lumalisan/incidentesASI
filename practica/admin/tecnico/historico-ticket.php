<?php

include_once 'templates/header.php';
include_once 'funciones/funciones.php';

$id = $_GET['id'];

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
    $response = "¡El mensaje ha sido añadido correctamente!";
    $color = "alert-success";
  } else if ($_GET['respuesta'] == 0) {
    $response = "Se ha producido un error, inténtelo más tarde";
    $color = "alert-danger";
  }
}

?>

<!-- Main layout -->
<main>

  <div class="container-fluid">
    <div class="card card-cascade narrower">

      <section>
        <div class="row">
          <div class="col-xl-12 col-lg-12 mr-0 pb-2">
            <div class="view view-cascade gradient-card-header juicy-peach-gradient text-dark">
              <h2 class="h2-responsive mb-0 font-weight-500">Histórico del ticket <?php echo $id; ?></h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12">

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                    <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <table id="tabladedatos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Nombre del técnico
                      </th>
                      <th class="th-sm">Fecha y hora
                      </th>
                      <th class="th-sm">Texto
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT * FROM historico WHERE id_ticket = $id;";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }

                    while($historico = $resultado->fetch_assoc()) {

                      try {
                        $id_tecnico = $historico['id_tecnico'];
                        $resultado_tecnico = $conn->query("SELECT nombre FROM usuarios WHERE id = $id_tecnico;");
                        $nombre_tecnico = $resultado_tecnico->fetch_assoc();
                        if (empty($nombre_tecnico['nombre'])) {
                          $nombre_tecnico['nombre'] = "El técnico fue eliminado";
                        }
                      } catch (Exception $e) {
                        $error = $e->getMessage();
                        echo $error;
                      }
                      ?>

                      <tr>
                        <td><?php echo $nombre_tecnico['nombre']; ?></td>
                        <td><?php echo $historico['fecha']; ?></td>
                        <td><?php echo $historico['texto']; ?></td>
                      </tr>

                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre del técnico
                      </th>
                      <th>Fecha y hora
                      </th>
                      <th>Texto
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

          <div class="col-xl-6 col-lg-6 mr-0 pb-2">
            <div class="card-body card-body-cascade pb-0">
              <!-- First column -->
              <div class="col-xl-6 col-md-6">
                <h5 class="ml-2">Descargar</h5>
                <p class="lead">
                  <button id="json" class="btn btn-primary">EN JSON</button>
                  <button id="csv" class="btn btn-info">EN CSV</button>
                  <button class="btn btn-danger" onclick="return xepOnline.Formatter.Format('tabladedatos',{render:'download'});">EN PDF</button>
                </p>
              </div>
            </div>
          </div>

          <?php

          $sql = "SELECT estado FROM tickets WHERE id = $id";
          $resultado = $conn->query($sql);
          $estado_ticket = $resultado->fetch_assoc();

          if ($estado_ticket['estado'] != 'finalizado') {
          ?>

          <div class="col-xl-6 col-lg-6 mr-0 pb-2">
            <div class="card-body card-body-cascade pb-0">
              <!-- First column -->
              <div class="col-xl-6 col-md-6">
                <h5 class="text-center">Mensaje</h5>
                <form class="" role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-historico.php">
                  <div class="md-form">
                    <i class="fas fa-pencil-alt prefix"></i>
                    <textarea id="textInput" class="md-textarea form-control" rows="3" name="text" required></textarea>
                    <label for="textInput">Introduce aquí la información que quieres añadir al histórico</label>
                  </div>
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_tecnico" value="<?php echo $_SESSION['id']; ?>">
                  <input type="hidden" name="id_ticket" value="<?php echo $id; ?>">
                  <button class="btn btn-info btn-block juicy-peach-gradient text-dark" type="submit" id="crear_registro">Añadir</button>
                </form>
              </div>
            </div>
          </div>

        <?php } else { ?>

          <div class="col-xl-6 col-lg-6 mr-0 pb-2">
            <div class="card-body card-body-cascade pb-0">
              <!-- First column -->
              <div class="col-xl-6 col-md-6">
                <h5 class="text-center">Este ticket ha sido finalizado y no se pueden añadir comentarios al historial</h5>
              </div>
            </div>
          </div>

        <?php } ?>

        </div>

      </section>

    </div>
  </div>
</main>

<?php include_once 'templates/footer.php'; ?>
