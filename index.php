<?php

include 'PHP/test.php';

$var1 = 6;
$var2 = 1.3;
$var3 = 'Variable 3';
?>

<?php
start_page('titre');
?>

    <?php

    echo '<strong> Voici mon premier programme PHP </strong><br>' . "\n";
    echo 'C\'est pas mal non ? <br>';

    ?>

    <?php echo "$var1 + $var2"; ?>
    <?php echo $var1 + $var2; ?>
<br>
<?php
$jour = date('d/m/Y', strtotime('2020-04-01'));
echo $jour;
?>


<?php
end_page('nevot e goat');
?>

