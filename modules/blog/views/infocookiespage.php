<?php

namespace Blog\Views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Infocookiespage                                                           
{
    public function show(): void {
        ob_start();
?>
    miam miam les bonnes info cookies

        <a href="/modules/blog/controllers/cookies/IdontWantCookies.php"> Refuser </a>






<?php
        $content = ob_get_clean();
        (new Layout('Yuta', $content))->show();
    }
}
(new Infocookiespage())->show();