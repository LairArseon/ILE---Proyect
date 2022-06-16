<!-- Section: Design Block -->
<section class="container-sm text-center text-lg-start login-container">

  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="../assets/img/pexels-pixabay-277559.jpg" alt="Door" class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" 
        style="padding-left: 2rem;"/>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5 text-center">
        <img src="../assets/img/ILE.png" width="540" class="img-fluid text-center" alt="ILE - Logo">

          <form action="login_try.php" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form2Example1" name="email" class="form-control" value=<?= isset($_COOKIE['email']) ? "$_COOKIE[email]" : "";?>>
              <label class="form-label" for="form2Example1">Correo electrónico</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form2Example2" name="pass" class="form-control" />
              <label class="form-label" for="form2Example2">Contraseña</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                  <label class="form-check-label" for="remember"> Recordarme </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="./forgot_pass.php">¿Olvidaste la contraseña?</a>
              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Entrar</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->