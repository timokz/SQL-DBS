<?php

require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

//Grab variable id from POST request
$t_Name = '';
if(isset($_POST['t_Name'])){
    $t_Name = $_POST['t_Name'];
}
if (empty($_POST)){
    echo "HUTREASD ";
}
$arr = $_POST;
//echo "POST INHALT IST" . $_POST;
//foreach ($_POST as $item)
//   echo $item;
//foreach ($arr as $key=>$items)
//    echo "ITEM:". $items . $key;

//echo "DER NAME IST " . $arr['t_name'];
$t_Name = $arr['t_name'];
$error_code = $database->deleteTheatre($t_Name);

// Check result
if ($error_code == 1){
    echo "Theatre: '{$t_Name}' successfully deleted!'";
}
else{
    echo "Error can't delete Theater: '{$t_Name}'. Errorcode: {$error_code}";
}
?>

<!-- link back to index page-->
<ul class="list-group">
    <li class="list-group-item"><a href="index.php" class="btn btn-info" role="button">Go back to Main Page</a> </li>
    <p></p>
    <li class="list-group-item"><a href="Theatre.php" class="btn btn-info" role="button">Go back to Theatre Page</a></li>
</ul>