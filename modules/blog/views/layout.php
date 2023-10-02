<?php
namespace Blog\Views;
class Layout {
    public function __construct(private string $title, private string $content) {}
    public function show(): void {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <!--    Title   -->
            <title><?= $this->title; ?></title>

            <!--    Meta   -->
            <meta charset="UTF-8">
            <meta name="language" content="EN">
            <meta name="description" content="Social network based on sharing categorized posts">
            <meta name="keywords" content="Social media, X killer">
            <meta name="author" content="BRAHMI Moundir, Brunet Ronan, DITLECADET Michael, ESSALHI Ayoub, LEROUGE Robin, LESTRELIN Valentin">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!--    Link   -->
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
            <link href="/_assets/styles/font.css" rel="stylesheet"/>
            <link href="" rel="stylesheet"/>
        </head>



        <body>

            <?= $this->content; ?>

        </body>

        </html>
        <?php
    }
}