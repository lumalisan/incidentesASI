<?php

include_once 'includes/templates/adminHeader.php';
include_once 'includes/funciones/funciones.php';

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
    $response = "¡El ticket ha sido creado correctamente!";
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
            <div class="view view-cascade gradient-card-header tempting-azure-gradient text-dark">
              <h2 class="h2-responsive mb-0 font-weight-500">Crear ticket</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12">

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                    <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <form class="border border-light p-5" role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-ticket.php">

                  <p class="h4 mb-4 text-center">Introduce los datos para crear el ticket</p>

                  <div class="md-form">
                    <textarea id="textInput" class="md-textarea form-control" rows="3" name="descripcion" required></textarea>
                    <label for="textInput">Introduce aquí la descripción</label>
                  </div>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="tecnico">
                    <option value="" disabled selected>Selecciona el técnico</option>
                    <?php
                    try {
                      $sql = "SELECT id, nombre FROM usuarios WHERE nivel = 1";
                      $resultado = $conn->query($sql);
                      while($aux = $resultado->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $aux['id']; ?>"><?php echo $aux['nombre']; ?></option>
                      <?php }
                    } catch (Exception $e) {
                      echo "Error" . $e->getMessage();
                    }
                    ?>
                  </select>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="prioridad" required>
                    <option value="" disabled selected>Selecciona la prioridad</option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="grave">Grave</option>
                    <option value="crítica">Crítica</option>
                  </select>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="escalabilidad" required>
                    <option value="" disabled selected>Selecciona la escalabilidad</option>
                    <option value="basica">Básica</option>
                    <option value="tecnico">Técnico</option>
                    <option value="externa">Externa</option>
                  </select>

                  <input type="hidden" name="registro" value="nuevo">
                  <input type="hidden" name="id_creador" value="<?php echo $_SESSION['id']; ?>">
                  <button class="btn btn-info btn-block tempting-azure-gradient text-dark" type="submit" id="crear_registro">Guardar</button>
                </form>

              </div>
              <!-- First column -->

            </div>

          </div>
        </div>
      </section>

    </div>
  </div>
</main>

<?php include_once 'includes/templates/adminFooter.php'; ?>
