<?php include_once 'includes/templates/header.php'; ?>

    <!-- Intro Section -->
    <section class="view intro-3 morpheus-den-gradient">
      <div class="mask h-100 d-flex justify-content-center align-items-center">
        <div class="container">

          <!-- Row 1 -->
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

              <!-- Form with header -->
              <div class="card wow fadeIn" data-wow-delay="0.3s">
                <div class="card-body">

                  <!-- Header -->
                  <div class="form-header deep-blue-gradient">
                    <h3 class="black-text">
                      <i class="fas fa-user mt-2 mb-2 black-text"></i> Log In:</h3>
                  </div>

                <?php if (isset($_GET['respuesta'])) {  ?>
                  <div class="alert alert-danger text-center mr-3 ml-3" role="alert">
                      <?php echo $response; ?>
                  </div>
                <?php }  ?>

                  <!-- Body -->
                  <form class="form" name="login-usuario-form" id="login-usuario" method="post" action="login-usuario.php">
                  <div class="md-form mb-0 mt-5">
                    <i class="fas fa-user prefix black-text"></i>
                    <input type="text" id="orangeForm-name" name="user" class="form-control" required>
                    <label for="orangeForm-name">Tu usuario...</label>
                  </div>

                  <div class="md-form mb-0">
                    <i class="fas fa-lock prefix black-text"></i>
                    <input type="password" id="orangeForm-pass" name="password" class="form-control" required>
                    <label for="orangeForm-pass">Tu password...</label>
                  </div>

                  <div class="text-center">
                    <input type="hidden" name="login-usuario" value="1">
                    <button type="submit" class="btn deep-blue-gradient btn-lg black-text">Entrar</button>
                  </div>
                  </form>

                  <div class="mt-lg-4 text-center">
                    <p>¿Eres Nuevo? <a href="signup.php">Crear cuenta</a></p>
                  </div>

                </div>
              </div>
              <!-- Form with header -->

            </div>

          </div>
          <!-- Row 1 -->

        </div>
      </div>
    </section>

  </header>

<?php include_once 'includes/templates/footer.php'; ?>
