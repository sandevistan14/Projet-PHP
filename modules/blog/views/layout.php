<?php
namespace modules\blog\views;
class Layout {
    public function __construct(private string $title, private string $content) {}
    public function show(): void {
?>
        <!DOCTYPE html>
        <html lang="fr" xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <!--   Title   -->
            <title><?= $this->title; ?></title>


            <!--   Meta   -->
            <meta charset="UTF-8">
            <meta name="language" content="EN">
            <meta name="description" content="Yuta is a social network based on sharing categorized posts online, the users of Yuta are able to see your profile, when you joined Yuta for the first time and the last time you connected to Yuta. Yuta allows you to share some content online such as GIF or pictures, a title and a description are assigned to your publication, a button is present to allows you to choose the category you would like to share your post in for users to see it.">
            <meta name="keywords" content="Social media, X killer">
            <meta name="author" content="BRAHMI Moundir, Brunet Ronan, DITLECADET Michael, ESSALHI Ayoub, LEROUGE Robin, LESTRELIN Valentin">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!--    Link   -->
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link href="/_assets/styles/style.css" rel="stylesheet">
            
            <!--   Script   -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
            <script src="/_assets/scripts/script.js"></script>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1866345567848015"
                    crossorigin="anonymous"></script>
            <script src="https://yuta.alwaysdata.net/_assets/scripts/ButtonLoadMore.js"></script>
            
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