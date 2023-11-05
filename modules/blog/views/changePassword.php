<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="main.css" rel="stylesheet">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
    <style>
        h1{
            font: bold 210% Jost;
        }
        body{
            font-family: 'Jost', sans-serif;
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
        /* Ajouter de l'espace sous le titre */
        #titre {
            margin-bottom: 13%;
        }
        .custom-mt {
            margin-top: 15%;
        }
        .custom-mb{
            margin-bottom: 10%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <a href="/modules/blog/views/connectionPage.php"><i class="bi bi-arrow-bar-left mb-4" style="font-size: 2rem;"></i></a>
        <div class="col-md-6">
            <h1 class="text-center" id="titre">Changer mot de passe</h1>
            <form action="../controllers/forgetPasswordRequest.php" method="post" class="needs-validation" novalidate><div class="mb-4 col-8 mx-auto">
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
                    <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Continuer</button>
                </div>
            </form>
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


</body>
</html>
