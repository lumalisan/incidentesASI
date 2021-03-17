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
            <div class="view view-cascade gradient-card-header light-blue lighten-1">
              <h2 class="h2-responsive mb-0 font-weight-500">Mi cuenta</h2>
            </div>
            <div class="card-body card-body-cascade pb-0">

              <!-- First column -->
              <div class="col-md-12">
                <?php
                $sql = "SELECT * FROM usuarios WHERE id = $id ";
                $resultado = $conn->query($sql);
                $categoria = $resultado->fetch_assoc();
                ?>

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert <?php echo $color; ?> text-center mr-3 ml-3" role="alert">
                      <?php echo $response; ?>
                  </div>
                <?php }  ?>

                <form class="border border-light p-5" role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-usuario.php">

                    <p class="h4 mb-4 text-center">Modifica los campos para cambiar tu nombre, usuario y/o contraseña</p>

                    <label for="textInput">Nombre</label>
                    <input type="text" id="textInput" class="form-control mb-4" name="nombre" placeholder="Tu nombre..." value="<?php echo $categoria['nombre']; ?>">

                    <label for="textInput">Usuario</label>
                    <input type="text" id="textInput" class="form-control mb-4" name="usuario" placeholder="Tu usuario..." value="<?php echo $categoria['user']; ?>">

                    <label for="passwdInput">Password</label>
                    <input type="password" id="passwdInput" class="form-control mb-4" name="password" placeholder="Tu password..." value="">

                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <button class="btn btn-info btn-block" type="submit" id="crear_registro">Guardar</button>
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
