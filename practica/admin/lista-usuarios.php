<?php

include_once 'includes/templates/adminHeader.php';
include_once 'includes/funciones/funciones.php';

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
      $response = "¡El usuario ha sido eliminado correctamente!";
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
              <h2 class="h2-responsive mb-0 font-weight-500">Lista de usuarios</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12 table-responsive">

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                      <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <table id="tabladedatos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Nombre
                      </th>
                      <th class="th-sm">Usuario
                      </th>
                      <th class="th-sm">Nivel
                      </th>
                      <th class="th-sm">Acciones
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT id, nombre, user, nivel FROM usuarios;";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }

                    $contador = 0;

                    while($usuarios = $resultado->fetch_assoc()) {
                      if ($usuarios['nivel'] == 2) {
                        $nivelUsuario = "Administrador";
                      } else if ($usuarios['nivel'] == 1) {
                        $nivelUsuario = "Técnico";
                      } else {
                        $nivelUsuario = "Cliente";
                      }
                      ?>

                      <tr>
                        <td><?php echo $usuarios['nombre']; ?></td>
                        <td><?php echo $usuarios['user']; ?></td>
                        <td><?php echo $nivelUsuario; ?></td>
                        <td>
                          <a href="editar-usuario.php?id=<?php echo $usuarios['id']; ?>" class="btn-floating btn-sm info-color my-0 waves-effect waves-light ml-3 mr-3">
                            <i class="fas fa-edit dark-text"></i>
                          </a>
                          <!-- Button trigger modal-->
                          <a type="button" class="btn-floating btn-sm danger-color my-0 waves-effect waves-light" data-toggle="modal" data-target="#modalConfirmDelete<?php echo $contador; ?>">
                            <i class="fas fa-trash dark-text"></i>
                          </a>

                      <!--Modal: modalConfirmDelete-->
                      <div class="modal fade" id="modalConfirmDelete<?php echo $contador; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                        <!--Content-->
                        <div class="modal-content text-center">
                          <!--Header-->
                          <div class="modal-header d-flex justify-content-center">
                            <p class="heading">¿Estás seguro de que quieres borrar <?php echo $usuarios['user']; ?>?</p>
                          </div>

                          <!--Body-->
                          <div class="modal-body">
                            <i class="fas fa-trash fa-4x animated rotateIn"></i>
                          </div>

                          <!--Footer-->
                          <div class="modal-footer flex-center">
                            <a href="modelo-usuario.php?registro=eliminar&id=<?php echo $usuarios['id']; ?>" class="btn  btn-outline-danger">Sí</a>
                            <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
                          </div>
                        </div>
                        <!--/.Content-->
                      </div>
                    </div>
                    <!--Modal: modalConfirmDelete-->

                  </td>
                </tr>

              <?php
                $contador++;
              }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <th>Nombre
                </th>
                <th>Usuario
                </th>
                <th>Nivel
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
