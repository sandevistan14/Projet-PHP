<?php
require '_assets/includes/autoloader.php';

class Homepage {
public function show(): void {
    ob_start();
?>  <h1>Les derniers billets du blog</h1>








<?php

    $content = ob_get_clean();

    (new \Blog\Views\Layout('Le meilleur blog', $content))->show();
    }
}

(new Homepage())->show();