<?php
function start_page($title): void {
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
</head>
<body>
<?php
}
?>

<?php
function end_page($credit): void {
?>

<footer>
    <p><?php echo $credit; ?></p>
</footer>
</body>
</html>
<?php
}
?>