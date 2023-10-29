<?php
namespace modules\blog\views;
class Layout {
    public function __construct(private string $title, private string $content) {}
    public function show(): void {
?>
        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <!--   Title   -->
            <title><?= $this->title; ?></title>


            <!--   Meta   -->
            <meta charset="UTF-8">
            <meta name="language" content="EN">
            <meta name="description" content="Social network based on sharing categorized posts">
            <meta name="keywords" content="Social media, X killer">
            <meta name="author" content="BRAHMI Moundir, Brunet Ronan, DITLECADET Michael, ESSALHI Ayoub, LEROUGE Robin, LESTRELIN Valentin">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!--    Link   -->
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="/_assets/styles/style.css" rel="stylesheet"/>



            <!--   Script   -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <script src="/_assets/scripts/script.js"></script>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1866345567848015"
                    crossorigin="anonymous"></script>
            
            <!--   Twig   -->
            <?php
            /*
            $loader = new \Twig\Loader\FilesystemLoader('../../../_assets/utils/templates');
            $twig = new \Twig\Environment($loader, [
            'cache' => false,
            ]);*/
            ?>

        </head>


        <body>

            <?= $this->content; ?>

        </body>

        </html>
        <?php
    }
}