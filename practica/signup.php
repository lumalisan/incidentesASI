<?php

include_once 'includes/templates/header.php';

?>

<!-- Intro Section -->
<section class="view intro-3 sunny-morning-gradient">
  <div class="mask h-100 d-flex justify-content-center align-items-center">
    <div class="container">

      <!-- Row 1 -->
      <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

          <!-- Form with header -->
          <div class="card wow fadeIn" data-wow-delay="0.3s">
            <div class="card-body">

              <!-- Header -->
              <div class="form-header juicy-peach-gradient">
                <h3 class="black-text">
                  <i class="fas fa-user mt-2 mb-2 black-text"></i> Sign Up:</h3>
                </div>

                <!-- Body -->
                <form class="form" name="signup-usuario-form" id="signup-usuario" method="post" action="signup-usuario.php">
                  <div class="md-form mb-0">
                    <i class="fas fa-file-signature prefix black-text"></i>
                    <input type="text" id="orangeForm-name" name="nombre" class="form-control" required>
                    <label for="orangeForm-name">Tu nombre...</label>
                  </div>

                  <div class="md-form mb-0">
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
                    <input type="hidden" name="signup-usuario" value="1">
                    <button type="submit" class="btn juicy-peach-gradient btn-lg black-text">Regístrate</button>
                  </div>
                </form>

                <div class="mt-lg-4 text-center">
                  <p>¿Ya tienes cuenta? <a href="index.php">Log In</a></p>
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

<?php

include_once 'includes/templates/footer.php';

?>
