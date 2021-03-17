<?php

include_once 'includes/templates/adminHeader.php';

if (isset($_GET['respuesta'])) {
  if ($_GET['respuesta'] == 1) {
      $response = "¡El usuario ha sido creado correctamente!";
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
              <h2 class="h2-responsive mb-0 font-weight-500">Crear usuario</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12">

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                      <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <form class="border border-light p-5" role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-usuario.php">

                    <p class="h4 mb-4 text-center">Introduce los datos para crear el usuario</p>

                    <label for="textInput">Nombre</label>
                    <input type="text" id="textInput" class="form-control mb-4" name="nombre" placeholder="Nombre..." value="" required>

                    <label for="textInput">Usuario</label>
                    <input type="text" id="textInput" class="form-control mb-4" name="usuario" placeholder="Usuario..." value="" required>

                    <label for="passwdInput">Password</label>
                    <input type="password" id="passwdInput" class="form-control mb-4" name="password" placeholder="Password..." value="" required>

                    <label for="textInput">Nivel</label>
                    <select class="mdb-select md-form colorful-select dropdown-info mt-n1" name="nivel_usuario" required>
                      <option value="" disabled selected>Selecciona el nivel</option>
                      <option value="2">Administrador</option>
                      <option value="1">Técnico</option>
                      <option value="0">Cliente</option>
                    </select>

                    <input type="hidden" name="registro" value="nuevo">
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
