<?php
namespace Blog\Views;
class Layout {
    public function __construct(private string $title, private string $content) {}
    public function show(): void {
?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8"/>
            <title><?= $this->title; ?></title>
            <link rel="icon" type="image/x-icon" href="../../../../faviicon.ico">
            <link href="" rel="stylesheet"/>
        </head>
        <body>
            Salut
        <?= $this->content; ?>
        </body>
        </html>
        <?php
    }
}