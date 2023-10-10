<?php

namespace Blog\Views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Inscriptionpage
{
    public function show(): void {
        ob_start();
?>

    <script>
        $(document).ready(function(){
            $("#myModal").modal('show');
        });
    </script>

        <h1>inscription page</h1>

        <a href = '/modules/blog/controllers/cookies/VienDeSinscrire.php' > <button>Tu viens de t'inscrire ? </button>  </a>


        <?php
            if (!isset($_COOKIE["WantCookies"])) {
        echo '
        <!-- Modal -->
        <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cookies miam miam 🍪🍪🍪 </h1>
                    </div>
                    <div class="modal-body">
                        Nous utilisons des cookies pour cibler le contenu de vos annonces ainsi qu améliorer
                        l éxperience de l utilisateur.
                    </div>
                    <div class="modal-footer">
                        <a href="infocookiespage.php" target="_blank" id="buttonCookies">En apprendre plus</a>
                        <a href="/modules/blog/controllers/cookies/IdontWantCookies.php"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Refuser</button> </a>
                        <a href="/modules/blog/controllers/cookies/IWantCookies.php"> <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accepter</button> </a>
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
    ';
            }
            ?>"


<?php
        $content = ob_get_clean();
        (new \Blog\Views\Layout('Yuta', $content))->show();
    }
}
(new Inscriptionpage())->show();
