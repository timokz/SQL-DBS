<?php

//include DatabaseHelper.php file
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

$P_NAME = '';
if (isset($_GET['P_NAME'])) {
    $P_NAME = $_GET['P_NAME'];
}

$T_NAME = '';
if (isset($_GET['T_NAME'])) {
    $T_NAME = $_GET['T_NAME'];
}

$P_DATE = '';
if (isset($_GET['P_DATE'])) {
    $P_DATE = $_GET['P_DATE'];
}

$DIRECTION = '';
if (isset($_GET['DIRECTION'])) {
    $DIRECTION = $_GET['DIRECTION'];
}

$LANGUAGES = '';
if (isset($_GET['LANGUAGES'])) {
    $LANGUAGES = $_GET['LANGUAGES'];
}
// Insert method
$success = $database->insertIntoPerf($T_NAME, $P_NAME, $P_DATE, $DIRECTION,$LANGUAGES);

// Check result
if ($success){
    echo "Performance '{$T_NAME}, {$P_NAME}, {$P_DATE}, {$DIRECTION}, {$LANGUAGES}' successfully added!'";
}
else{
    echo "Error can't insert Performance'{$T_NAME}, {$P_NAME}, {$P_DATE}, {$DIRECTION}, {$LANGUAGES}'!";
}
?>

<!-- link back to index page-->
<ul class="list-group">
    <li class="list-group-item"><a href="index.php" class="btn btn-info" role="button">Go back to Main Page</a> </li>
    <p></p>
    <li class="list-group-item"><a href="Performances.php" class="btn btn-info" role="button">Go back to Performances Page</a></li>
</ul>
