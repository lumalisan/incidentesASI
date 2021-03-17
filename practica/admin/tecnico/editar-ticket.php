<?php

include_once 'templates/header.php';
include_once 'funciones/funciones.php';

if(!isset($_GET['id'])) {
  header("location: dashboardTecnico.php");
}

$id = $_GET['id'];

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
    $response = "¡Modificaciones realizadas correctamente!";
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
            <div class="view view-cascade gradient-card-header deep-blue-gradient text-dark">
              <h2 class="h2-responsive mb-0 font-weight-500">Editar ticket</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12">
                <?php
                $sql = "SELECT * FROM tickets WHERE id = $id ";
                $resultado = $conn->query($sql);
                $categoria = $resultado->fetch_assoc();
                ?>

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                    <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <form class="border border-light p-5" role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-ticket.php">

                  <p class="h4 mb-4 text-center">Modifica los campos para editar el ticket</p>

                  <div class="md-form">
                    <textarea id="textInput" class="md-textarea form-control" rows="3" name="descripcion" required><?php echo $categoria['descripcion']; ?></textarea>
                    <label for="textInput">Introduce aquí la descripción</label>
                  </div>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="prioridad" required>
                    <option value="" disabled selected>Selecciona la prioridad</option>
                  <?php if ($categoria['prioridad'] == 'baja') { ?>
                    <option value="baja" selected>Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="grave">Grave</option>
                    <option value="crítica">Crítica</option>
                  <?php } else if ($categoria['prioridad'] == 'media') { ?>
                    <option value="baja">Baja</option>
                    <option value="media" selected>Media</option>
                    <option value="alta">Alta</option>
                    <option value="grave">Grave</option>
                    <option value="crítica">Crítica</option>
                  <?php } else if ($categoria['prioridad'] == 'alta') { ?>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta" selected>Alta</option>
                    <option value="grave">Grave</option>
                    <option value="crítica">Crítica</option>
                  <?php } else if ($categoria['prioridad'] == 'grave') { ?>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="grave" selected>Grave</option>
                    <option value="crítica">Crítica</option>
                  <?php } else if ($categoria['prioridad'] == 'crítica') { ?>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="grave">Grave</option>
                    <option value="crítica" selected>Crítica</option>
                  <?php } ?>
                  </select>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="estado" required>
                    <option value="" disabled>Selecciona el estado</option>
                    <?php if ($categoria['estado'] == 'asignado') { ?>
                      <option value="asignado" selected>Asignado</option>
                      <option value="en proceso">En proceso</option>
                      <option value="finalizado">Finalizado</option>
                    <?php } else if ($categoria['estado'] == 'en proceso') { ?>
                      <option value="asignado">Asignado</option>
                      <option value="en proceso" selected>En proceso</option>
                      <option value="finalizado">Finalizado</option>
                    <?php } else if ($categoria['estado'] == 'finalizado') { ?>
                      <option value="asignado">Asignado</option>
                      <option value="en proceso">En proceso</option>
                      <option value="finalizado" selected>Finalizado</option>
                    <?php } ?>
                  </select>

                  <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="escalabilidad" required>
                    <option value="" disabled>Selecciona la escalabilidad</option>
                    <?php if ($categoria['escalabilidad'] == 'basica') { ?>
                      <option value="basica" selected>Básica</option>
                      <option value="tecnico">Técnico</option>
                      <option value="externa">Externa</option>
                    <?php } else if ($categoria['escalabilidad'] == 'tecnico') { ?>
                      <option value="basica">Básica</option>
                      <option value="tecnico" selected>Técnico</option>
                      <option value="externa">Externa</option>
                    <?php } else if ($categoria['escalabilidad'] == 'externa') { ?>
                      <option value="basica">Básica</option>
                      <option value="tecnico">Técnico</option>
                      <option value="externa" selected>Externa</option>
                    <?php } ?>
                  </select>

                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_ticket" value="<?php echo $id; ?>">
                  <input type="hidden" name="id_tecnico" value="<?php echo $_SESSION['id']; ?>">
                  <button class="btn btn-info btn-block deep-blue-gradient text-dark" type="submit" id="crear_registro">Guardar</button>
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

<?php include_once 'templates/footer.php'; ?>
