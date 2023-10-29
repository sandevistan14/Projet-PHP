<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class InscriptionPage
{
    public function show(): void {
        ob_start();
        ?>




        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1 class="text-center" id="titre">S'inscrire</h1>
                    <form action="../controllers/inscription.php" class="needs-validation" novalidate method="post">
                        <div class="mb-4 col-8 mx-auto">
                            <input type="text" placeholder="Nom" class="form-control form-control-lg shadow-sm" id="username"
                                   name="username" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre nom
                            </div>
                        </div>
                        <div class="mb-4 col-8 mx-auto">
                            <input type="email" placeholder="Email" class="form-control form-control-lg shadow-sm" id="email" name="email" required>
                            <div class="invalid-feedback">
                                Veuillez entrer votre email
                            </div>
                        </div>
                        <div class="mb-4 col-8 mx-auto">
                            <div class="input-group">
                                <input type="password" placeholder="Mot de passe" class="form-control form-control-lg shadow-sm" id="password" name="password"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" id="showPasswordButton">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </button>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre mot de passe
                                </div>
                            </div>
                        </div>
                        <div class="col-8 mx-auto">
                            <div class="input-group">
                                <input type="password" placeholder="Confirmer mot de passe" class="form-control form-control-lg shadow-sm" id="confirmPassword" name="confirmerMotDePasse" required>
                                <button class="btn btn-outline-secondary" type="button" id="showConfirmPasswordButton">
                                    <i class="bi bi-eye-slash" id="toggleConfirmPassword"></i>
                                </button>
                                <div class="invalid-feedback">
                                    Veuillez confirmer votre mot de passe
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 col-8 mx-auto custom-mt custom-mb">
                            <input type="submit" class="btn btn-primary btn-lg" id="submitButton" value="Continuer">
                        </div>
                    </form>
                    <p class="mt-3 text-center">Déjà un compte ? <a href="/modules/blog/views/connectionPage.php">Se connecter</a></p>
                </div>
            </div>
        </div>

        <!-- Inclure Bootstrap JS (facultatif, nécessaire pour certaines fonctionnalités) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            const confirmPassword = document.querySelector("#confirmPassword");

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


        <script>
         strength += 25;
            }
                if (containsLowerCase) {
                strength += 25;
            }
                if (containsDigit) {
                strength += 25;
            }

                passwordStrength.style.width = strength + "%";

                    if (strength === 100) {
                        passwordStrength.innerHTML = "Fort";
                        passwordStrength.classList.remove("bg-danger");
                        passwordStrength.classList.remove("bg-warning"); // Supprimez la classe bg-warning
                        passwordStrength.classList.add("bg-success");
                    } else if (strength >= 75) {
                        passwordStrength.innerHTML = "Moyen";
                        passwordStrength.classList.remove("bg-danger");
                        passwordStrength.classList.add("bg-warning"); // Ajoutez la classe bg-warning-orange
                    } else if (strength >= 50) {
                        passwordStrength.innerHTML = "Faible";
                        passwordStrength.classList.remove("bg-danger");
                        passwordStrength.classList.remove("bg-warning"); // Supprimez la classe bg-warning
                        passwordStrength.classList.add("bg-warning-orange");
                    } else {
                        passwordStrength.innerHTML = "Nul";
                        passwordStrength.classList.remove("bg-warning");
                        passwordStrength.classList.remove("bg-success"); // Supprimez la classe bg-success
                        passwordStrength.classList.add("bg-danger");
                    }

            }

                password.addEventListener("input", checkPasswordStrength);

                togglePassword.addEventListener("click", function () {
                // toggle the type attribute
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);

                // toggle the icon
                this.classList.toggle("bi-eye");
                this.classList.toggle("bi-eye-slash");
            });

                // Disables form submissions if there are invalid fields
                (() => {
                    'use strict';

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    const forms = document.querySelectorAll('.needs-validation');

                    // Loop over them and prevent submission
                    Array.from(forms).forEach(form => {
                        form.addEventListener('submit', event => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            // Password match validation
                            if (password.value !== confirmPassword.value) {
                                confirmPassword.setCustomValidity("Les mots de passe ne correspondent pas.");
                            } else {
                                confirmPassword.setCustomValidity("");
                            }

                            form.classList.add('was-validated');
                        }, false);
                    });
                })();

        </script>


        <?php
        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new InscriptionPage())->show();
