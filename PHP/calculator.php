<?php
include 'test.php';


$operateurs = '*+-/';

?>

<?php
start_page('titre');
?>

<form action="calcul.php" method="get">
    <input type="text" name="op1"> <br>
    <input type="text" name="op2"> <br>
    <?php
    for($cpt = 0 ; $cpt <= 3 ; ++$cpt)
    {
        echo '<input ';
        if($cpt === 0)
        {
            echo 'checked="checked" ';
        }
        echo 'type="radio" name="op" value="' . $operateurs[$cpt] . '">' . $operateurs[$cpt] . ' <br>' . "\n";
 }
    ?>
    <button type="submit" value="Submit">Submit</button>
    <button type="reset" value="Reset">Reset</button>
</form>


<?php
end_page('nevot le goat');
?>