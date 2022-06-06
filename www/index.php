<?php

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('ILE - Bienvenida', ['./css/styles.css']);

?>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="../assets/img/ILE.png" width="190" height="120" class="img-fluid text-center" alt="ILE - Logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link active h3" href="#">Inicio</a>
                <a class="nav-item nav-link h3" href="#">Informacion</a>
                <a class="nav-item nav-link h3" href="#">Tarifas</a>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <img src="../assets/img/ILE.png" width="1090" height="600" class="img-fluid text-center" alt="ILE - Logo">
                            <h1 class="mb-5">La herramienta simple para centros educativos</h1>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-piggy-bank m-auto text-primary"></i></div>
                            <h3>Económico</h3>
                            <p class="lead mb-0">Consulta las tarifas y encuentra un precio que se amolde a tus necesidades.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-layout-wtf m-auto text-primary"></i></div>
                            <h3>Adaptable</h3>
                            <p class="lead mb-0">Si las características del entorno no encajasen con el perfil de tu entidad educativa es posible aplicar pequeñas modificaciones.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-emoji-smile m-auto text-primary"></i></div>
                            <h3>Fácil de usar</h3>
                            <p class="lead mb-0">ILE es una herramienta muy simple e intuitiva, sacarle partido está en tus manos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Call to Action-->
        <section class="call-to-action text-white text-center" id="signup">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <h2 class="mb-4">Déjanos tu correo y nos pondremos en contacto contigo</h2>
                        <!-- Signup form-->
                        <form class="form-subscribe" id="contactFormFooter" method="POST" action="contact_petition.php">
                            <!-- Email address input-->
                            <div class="row">
                                <div class="col">
                                    <input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">Email Address is required.</div>
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">Email Address Email is not valid.</div>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button></div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        

<?php

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);