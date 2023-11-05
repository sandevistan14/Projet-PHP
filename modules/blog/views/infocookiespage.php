<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Infocookiespage                                                           
{
    public function show(): void {
        ob_start();
?>


        <div class="zonbouton"></div>
        <a class="boutonretour" href="https://yuta.alwaysdata.net/"><i class="bi bi-arrow-bar-left mb-4" style="font-size: 2rem;"></i></a>

    <div class="zonemess">
        <h3>Qu'est-ce qu'un cookie ?</h3>
        <br>
        Un cookie est un petit fichier texte contenant des informations, qui est stocké sur votre ordinateur lorsque vous visitez un site web. Ces informations sont souvent liées à votre activité sur le site.
        <br><br>

        <h3>Pourquoi nous utilisons les cookies ?</h3>
        <br>
        Nous utilisons des cookies pour faciliter votre expérience en vous permettant de ne pas avoir à saisir à nouveau vos identifiants lorsque vous revenez sur le site. De plus, nous utilisons des cookies pour stocker vos préférences de paramétrage, garantissant ainsi une expérience personnalisée.
    </div>




<?php
        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new Infocookiespage())->show();