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
            <h1 class="text-center" id="titre">Mot de passe oublié</h1>
            <form class="needs-validation" novalidate>
                <div class="mb-4 col-8 mx-auto">
                    <input type="email" placeholder="Email" class="form-control form-control-lg shadow-sm" id="nom" name="nom" required>
                    <div class="invalid-feedback">
                        Veuillez entrer votre Email
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
