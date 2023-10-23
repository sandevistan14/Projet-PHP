<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();

class ConnectionPage
{
    public function show(): void {
        ob_start();

?>

    <script>
        $(document).ready(function(){
            $("#myModal").modal('show');
            $(".text-overlay").css("right", "0");
        });
    </script>

        <!DOCTYPE html>
        <head>
            <title>Créer un compte</title>

            <style>
                body{
                    font-family: 'Jost', sans-serif;
                }
                #yutaImg{
                    height: 80%;
                }
                /* Changer la couleur des champs de formulaire en #d8c0ff */
                .form-control {
                    font-family: 'Jost', sans-serif;
                    background-color: #d8c0ff;
                    border-color: #d8c0ff; /* Changer la couleur de la bordure */
                }

                /* Personnaliser l'apparence des champs actifs (focus) */
                .form-control:focus {
                    background-color: #d8c0ff;
                    border-color: #d8c0ff;
                    box-shadow: none; /* Supprimer la mise en évidence */
                }

                /* Changer la couleur du bouton "S'inscrire" */
                .btn-primary {
                    background: linear-gradient(to right,#7623FD,#8E48FF);
                    border-color: #8E48FF; /* Changer la couleur de la bordure */
                }
                .btn-primary:hover{
                    background: linear-gradient(to right,#7623FD,#8E48FF);
                    border-color: #8E48FF; /* Changer la couleur de la bordure */
                }
                .custom-mt {
                    margin-top: 15%;
                }
                .custom-mb{
                    margin-bottom: 10%;
                }
                input::placeholder {
                    font-size: 80%;
                }
            </style>
        </head>
        <body>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="image-container">
                        <img src="/favicon.ico" class="rounded mx-auto d-block" id="yutaImg">
                    </div>
                </div>
                <form class="needs-validation" method="post" action="../controllers/auth.php" novalidate>
                        <div class="mb-4 col-8 mx-auto">
                            <input type="text" placeholder="Email ou Nom d'utilisateur" class="form-control form-control-lg shadow-sm" id="ident" name="ident" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre Email ou Nom d'utilisateur
                            </div>
                        </div>
                        <div class="mb-4 col-8 mx-auto">
                            <div class="input-group">
                                <input type="password" placeholder="Mot de passe" class="form-control form-control-lg shadow-sm" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="showPasswordButton">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </button>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre mot de passe
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['connection_error'])) {
                            unset($_SESSION['connection_error']);
                            $error_message = '// MESSAGE D\'ERREUR A AJOUTER ICI SOUS FORME DE DIV //';
                            echo $error_message;
                        }
                        ?>
                        <div class="mb-4 col-8 mx-auto">
                            <a href="/modules/blog/views/forgotPassword.php"><p class="text-end">Mot de passe oublié ?</p></a>
                        </div>
                        <div class="d-grid gap-2 col-8 mx-auto custom-mt custom-mb">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Se connecter</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">Pas encore de compte ? <a href="/modules/blog/views/inscriptionPage.php">S'inscrire</a></p>
                </div>
            </div>
        </div>

        <!-- Inclure Bootstrap JS (facultatif, nécessaire pour certaines fonctionnalités) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");

            togglePassword.addEventListener("click", function () {
                // toggle the type attribute
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                // toggle the icon
                this.classList.toggle("bi-eye");
                this.classList.toggle("bi-eye-slash");
            });

            //Disables form submissions if there are invalid fields
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>


        </body>
        </html>


        <?php
            if (!isset($_COOKIE["WantCookies"])) {
        echo "
        <!-- Modal -->
        <div class=\"modal fade\" id=\"myModal\" data-bs-backdrop=\"static\" data-bs-keyboard=\"false\" tabindex=\"-1\" aria-labelledby=\"staticBackdropLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-dialog-centered\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h1 class=\"modal-title fs-5\" id=\"staticBackdropLabel\">Cookies miam miam 🍪🍪🍪 </h1>
                    </div>
                    <div class=\"modal-body\">
                        Nous utilisons des cookies pour cibler le contenu de vos annonces ainsi qu'améliorer
                        l'éxperience de l'utilisateur.
                    </div>
                    <div class=\"modal-footer\">
                        <a href=\"infocookiespage.php\" id=\"buttonCookies\">En apprendre plus</a>
                        <a href=\"/modules/blog/controllers/cookies/IdontWantCookies.php\"> <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Refuser</button> </a>
                        <a href=\"/modules/blog/controllers/cookies/IWantCookies.php\"> <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Accepter</button> </a>
                    </div>
                </div>
            </div>
        </div>

</html>

<style>
    #buttonCookies {
        text-align: left;
    }
</style>
    ";
            }
            ?>


<?php
        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new ConnectionPage())->show();
