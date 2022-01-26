<?php

//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variables from POST request
$t_name = '';
if (isset($_POST['t_name'])) {
    $t_name = $_POST['t_name'];
}
$Address = '';
if (isset($_POST['Address'])) {
    $Address = $_POST['Address'];
}
$t_capacity = '';
if (isset($_POST['Capacity'])) {
    $t_capacity = $_POST['Capacity'];
}
$PRIVATE_OR_PUBLIC = '';
if (isset($_POST['Public_or_Private'])) {
    $t_capacity = $_POST['Public_or_Private'];
}
$success = $database->update_theatre($t_name, $Address, $t_capacity, $PRIVATE_OR_PUBLIC);

// Check result
if ($success){
    echo "Theatre '{$t_name}, {$Address}, {$t_capacity}, {$PRIVATE_OR_PUBLIC}' successfully updated!'";
}
else{
    echo "Error can't update Theatre'{$t_name}, {$Address}, {$t_capacity}, {$PRIVATE_OR_PUBLIC}'!";
}
?>

<!-- link back to index page-->
<ul class="list-group">
    <li class="list-group-item"><a href="index.php" class="btn btn-info" role="button">Go back to Main Page</a> </li>
    <p></p>
    <li class="list-group-item"><a href="Theatre.php" class="btn btn-info" role="button">Go back to Theatre Page</a></li>
</ul>
