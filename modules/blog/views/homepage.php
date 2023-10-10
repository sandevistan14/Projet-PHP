<?php

namespace blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Homepage
{
    public function show(): void {
        ob_start();
        ?>

        <h1>HomePage</h1>


        <a href = '/index.php' > <button>coucou</button>  </a>



        <?php
        $content = ob_get_clean();
        (new Layout('Yuta', $content))->show();
    }
}
(new Homepage())->show();
