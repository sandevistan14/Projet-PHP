<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class CreationUtilisateur
{
public function show(): void {
ob_start();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center" id="titre">Mot de passe oublié</h1>
            <form class="needs-validation" novalidate>
                <div class="mb-4 col-8 mx-auto">
                    <input type="mail" placeholder="Adresse mail" class="form-control form-control-lg shadow-sm" id="mail" name="mail" required>
                    <div class="invalid-feedback">
                        Veuillez choisir un nom d'utilisateur
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Acceptez les termes et conditions d'utilisation.
                        </label>
                        <div class="invalid-feedback">
                            Vous devez accepter avant de continuer.
                        </div>
                    </div>
                </div>


                <div class="d-grid gap-2 col-8 mx-auto custom-mt custom-mb">
                    <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Créer le compte</button>
                </div>
            </form>
            <p class="mt-3 text-center">Déjà un compte ? <a href="/blog/views/connectionPage.php">Se connecter</a></p>
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

    <?php
    $content = ob_get_clean();
    (new layout('Yuta', $content))->show();
}
}
(new CreationUtilisateur())->show();