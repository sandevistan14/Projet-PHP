<?php

namespace blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();
if(!isset($_SESSION["currentUser"])){
    header("Location: connectionPage.php");
    exit();
}
class Homepage
{
    public function show(): void {
        ob_start();
        ?>

        <style>
            .offcanvas-size-full {
                --bs-offcanvas-width: 100% !important;
            }
            .navbar{
                border-bottom: 1px solid lightgrey;
                box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
            }
            .ancrage {
                position: fixed;
                bottom: 5%;
                left: 85%;
                border: 0;
            }
            .secondary{
                background-color: #D8C0FF;
                color: black;
            }
            .form-control{
                background-color: #D8C0FF;
                color: black;
            }
            .form-control:focus{
                background-color: #D8C0FF;
                color: black;
            }
            .primary {
                background: linear-gradient(to right,#7623FD,#8E48FF);
                border-color: #8E48FF; /* Changer la couleur de la bordure */
                color: white;
            }
            .primary:hover{
                background: linear-gradient(to right,#7623FD,#8E48FF);
                border-color: #8E48FF; /* Changer la couleur de la bordure */
            }
            .offcanvas-header{
                margin-bottom: 10%;
            }
            .accordion-item{
                padding-top: 5%;
                border-bottom: 1px solid black;
                padding-bottom: 5%;
            }
        </style>
        <nav class="navbar fixed-top bg-light">
            <div class="container-fluid">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuDeroulant" aria-controls="menuDeroulant">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand mx-auto" href="#">
                    <img src="/_assets/images/Logo_Yuta_1.PNG" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                </a>
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuMessage" aria-controls="menuMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Le contenu de l'offcanvas menu -->
        <div class="offcanvas offcanvas-size-full offcanvas-start" tabindex="-1" id="menuDeroulant" aria-labelledby="menuDeroulantLabel">
            <div class="offcanvas-header">
                <nav class="navbar fixed-top bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        <a class="navbar-brand mx-auto" href="#">
                            <img src="/_assets/images/Logo_Yuta_1.PNG" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                        </a>
                        <h5 class="offcanvas-title" id="menuDeroulantLabel">Menu</h5>
                    </div>
                </nav>
            </div>
            <div class="offcanvas-body">
                <div class="accordion accordion-flush">
                    <div class="accordion-item">
                        <form class="row g-3" role="search">
                            <div class="col-md-3">
                                <label for="SearchBar">Rechercher</label>
                                <div class="d-flex">
                                    <input class="form-control me-2 secondary" id="SearchBar" type="search" placeholder="..." aria-label="SearchBar">
                                    <button class="btn primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CategorieMenu" aria-expanded="false" aria-controls="CategorieMenu">
                                Categories
                            </button>
                        </h2>
                        <div id="CategorieMenu" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="d-flex">
                                    <input class="form-control me-2 secondary" id="SearchBarCat" type="search" placeholder="Categorie" aria-label="SearchBarCat">
                                    <button class="btn primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a href="#" class="btn w-100">
                                <div class="container-fluid d-flex justify-content-between align-items-center">
                                    <div class="d-inline">
                                        <label for="ParamIcon">Profil</label>
                                    </div>
                                    <div class="d-inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a href="#" class="btn w-100">
                                <div class="container-fluid d-flex justify-content-between align-items-center">
                                    <div class="d-inline">
                                        <label for="ParamIcon">Paramètres</label>
                                    </div>
                                    <div class="d-inline">
                                        <svg id="ParamIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a href="#" class="btn w-100">
                                <div class="container-fluid d-flex justify-content-between align-items-center">
                                    <div class="d-inline">
                                        <label for="ParamIcon">Se déconnecter</label>
                                    </div>
                                    <div class="d-inline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Le contenu de l'offcanvas message -->
        <div class="offcanvas offcanvas-size-full offcanvas-end" tabindex="-1" id="menuMessage" aria-labelledby="menuMessageLabel">
            <div class="offcanvas-header">
                <nav class="navbar fixed-top bg-light">
                    <div class="container-fluid">
                        <h5 class="offcanvas-title" id="menuDeroulantLabel">Messages</h5>
                        <a class="navbar-brand mx-auto" href="#">
                            <img src="/_assets/images/Logo_Yuta_1.PNG" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                </nav>
            </div>
            <div class="offcanvas-body">
                <!-- Mettez ici le contenu de votre offcanvas -->
            </div>
        </div>

        <!-- Bouton ancrage -->
        <button type="button" class="btn secondary ancrage" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-plus" viewBox="0 0 16 16">
                <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855a.75.75 0 0 0-.124 1.329l4.995 3.178 1.531 2.406a.5.5 0 0 0 .844-.536L6.637 10.07l7.494-7.494-1.895 4.738a.5.5 0 1 0 .928.372l2.8-7Zm-2.54 1.183L5.93 9.363 1.591 6.602l11.833-4.733Z"/>
                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
            </svg>
        </button>

        <!-- Modal Ecrire post -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ecrire un post</h1>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="inputTitre" class="form-label">Titre :</label>
                                <input type="text" class="form-control" id="inputTitre" name="inputTitre" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputImg" class="form-label">Inserer une image</label>
                                <input type="file" class="form-control" id="inputImg" name="inputImg" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="inputMsg" class="form-label">Entrez votre message</label>
                                <textarea class="form-control" id="inputMsg" name="inputMsg" rows="3" required></textarea>
                            </div>
                            <!--à modifier pour qu'il prenne les catégories de la bd-->
                            <div class="mb-3">
                                <div class="btn-group dropend">
                                    <button type="button" class="btn secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                        Catégorie
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <input type="checkbox" value="Michael" id="inputCatMichael">
                                            <label for="inputCatMichael" class="form-label"> Michael</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Ronan" id="inputCatRonan">
                                            <label for="inputCatRonan" class="form-label"> Ronan </label>
                                        </li>
                                        <li>
                                            <input type="checkbox" value="Moundiwe" id="inputCatMoundiwe">
                                            <label for="inputCatMoundiwe" class="form-label"> Moundiwe </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" value="Effacer">
                                <input type="submit" class="btn primary" value="Envoyer un post">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="CreateCategory.php">
            <input type="submit" name="action" value="+">
        </form>

        <?php
        $content = ob_get_clean();
        (new Layout('Yuta', $content))->show();
    }
}
(new Homepage())->show();
