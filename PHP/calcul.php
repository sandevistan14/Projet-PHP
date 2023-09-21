<?php
include 'test.php';
?>

<?php
start_page('titre');
?>


<?php
$op1 = $_GET['op1'];
$op2 = $_GET['op2'];
$op = $_GET['op'];
?>

<?php
if('*' === $op)
{
    echo $op1 * $op2;
}
elseif('+' === $op)
{
    echo $op1 + $op2;
}
elseif('-' === $op)
{
    echo $op1 - $op2;
}
elseif('/' === $op)
{
    echo $op1 / $op2;
}
else
{
    echo '<br><strong>opérateur ' . $op . ' non géré </strong>';
}
?>



<?php
end_page('nevot le goat');
?>
