<?php
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();

$t_name = '';
if (isset($_GET['t_name'])) {
    $t_name = $_GET['t_name'];
}

$Address = '';
if (isset($_GET['Address'])) {
    $Address = $_GET['Address'];
}

$Capacity = '';
if (isset($_GET['Capacity'])) {
    $Capacity = $_GET['Capacity'];
}
$PRIVATE_OR_PUBLIC = '';
if (isset($_GET['PRIVATE_OR_PUBLIC'])) {
    $Capacity = $_GET['PRIVATE_OR_PUBLIC'];
}
$theatre_list = $database->selectAllTheater($t_name, $Address, $Capacity,$PRIVATE_OR_PUBLIC);

?>
<!DOCTYPE html>
<html lang="en">
<title>Data: Theatres</title>

<head>
<!-- Search form -->
<title>Theatre Search:</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="Search"><a href="#search">Search</a></li>
            <li><a href="#add">Add</a></li>
            <li><a href="#del">Delete</a></li>
            <li><a href="#upd">Update</a></li>
        </ul>
    </div>
</nav>

<section id = "search">
    <div class="container">

    <form method="get">
    <!-- t_name textbox:-->
  <div class="form-group">
      <label for="Theater Name">Theatre Name:</label>
        <input id="t_name" name="t_name" type="text"  class="form-control" placeholder="Burgtheater" value='<?php echo $t_name; ?>' maxlength="64">
    </div>

    <!-- Address textbox:-->
    <div class="form-group">
        <label for="Address">Address:</label>
        <input id="Address" name="Address" type="text"  class="form-control" placeholder="1010" value='<?php echo $Address; ?>' maxlength="64">
    </div>
<!--
    <div class="form-group">
        <label for="Capacity">Capacity:</label>
        <input id="Capacity" name="Capacity" type="number"  class="form-control" placeholder="50" value='<?php echo $Capacity; ?>' min="0">
    </div>


    <div class="form-group">
        <label for="PRIVATE_OR_PUBLIC">Private:</label>
        <input id="PRIVATE_OR_PUBLIC" name="PRIVATE_OR_PUBLIC" type="number" placeholder="0" class="form-control" value='<?php echo $PRIVATE_OR_PUBLIC; ?>' min="0">
    </div>
-->
    <!-- Submit button -->
    <div>
        <button id='submit' type='submit' class="btn btn-primary">
            Search
        </button>
    </div>
</form>
<br>
<hr>
    </div>
<!-- Search result -->
    <div class="container">
    <h2>Theatre Search Result:</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
    <tr>
        <th>Theater Name</th>
        <th>Address</th>
        <th>Capacity</th>
        <th>Private or Public</th>
    </tr>
                </thead>
                <tbody>
    <?php foreach ($theatre_list as $theatre) : ?>
        <tr>
            <td><?php echo $theatre['T_NAME']; ?>  </td>
            <td><?php echo $theatre['ADDRESS']; ?>  </td>
            <td><?php echo $theatre['T_CAPACITY']; ?>  </td>
            <td><?php echo $theatre['PRIVATE_OR_PUBLIC']; ?>  </td>
        </tr>
    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</section>

<section id = "add">
    <div class="container">
    <!-- Add Theatre: -->
<h2>Add Theatre: </h2>
<form method="post" action="addTheatre.php">

    <!-- Name textbox -->
    <div class="form-group">
        <label for="Theater Name">Theatre Name:</label>
        <input id="t_name" name="t_name" type="text"  class="form-control" placeholder="Burgtheater"  maxlength="64">
    </div>

    <!-- Address textbox -->
    <div class="form-group">
        <label for="Address">Address:</label>
        <input id="Address" name="Address" type="text"  class="form-control" placeholder="1010"  maxlength="64">
    </div>

    <!-- capacity textbox -->
    <div class="form-group">
        <label for="Capacity">Capacity:</label>
        <input id="Capacity" name="Capacity" type="number"  class="form-control" placeholder="50" min="0">
    </div>
    <!-- porp textbox -->
    <div class="form-group">
        <label for="PRIVATE_OR_PUBLIC">Private:</label>
        <input id="PRIVATE_OR_PUBLIC" name="PRIVATE_OR_PUBLIC" type="number"  class="form-control" min="0">
    </div>
    <!-- Submit button -->
    <div>
        <button id='submit' type='submit' class="btn btn-primary">
            Add Theatre
        </button>
    </div>
</form>
    </div>
</section>

<!-- Del Theatre: -->
<section id="del">
    <div class="container">
        <?php    $t_name = '';
        if (isset($_GET['t_name'])) {
            $t_name = $_GET['t_name'];
        }?>
        <h2>Delete Theatre: </h2>
        <form method="post" action="delTheatre.php">
    <div class="form-group">
        <label for="Theater Name">Theatre Name:</label>
        <input id="t_name" name="t_name" type="text"  class="form-control">
    </div>
    <div>
        <button id='submit' type='submit' class="btn btn-primary">
            Delete Theatre
        </button>
</form>
</div>
</section>

    <!---Upd Theatre -->
<section id="upd">
    <div class="container">
        <h2>Update Theatre: </h2>
        <form method="post" action="updTheatre.php">

            <!-- Name textbox -->
            <div class="form-group">
                <label for="Theater Name">Theatre Name:</label>
                <input id="t_name" name="t_name" type="text"  class="form-control" placeholder="Burgtheater"  maxlength="64">
            </div>

            <!-- Address textbox -->
            <div class="form-group">
                <label for="Address">Address:</label>
                <input id="Address" name="Address" type="text"  class="form-control" placeholder="1010"  maxlength="64">
            </div>

            <!-- capacity textbox -->
            <div class="form-group">
                <label for="Capacity">Capacity:</label>
                <input id="Capacity" name="Capacity" type="number"  class="form-control" placeholder="50" min="0">
            </div>
            <!-- porp textbox -->
            <div class="form-group">
                <label for="PRIVATE_OR_PUBLIC">Private:</label>
                <input id="PRIVATE_OR_PUBLIC" name="PRIVATE_OR_PUBLIC" type="number"  class="form-control" min="0">
            </div>
            <!-- Submit button -->
            <div>
                <button id='submit1' type='submit' class="btn btn-primary">
                    Update Theatre
                </button>
            </div>
        </form>
    </div>

</section>
<div class="container"
     <p></p>
<form action=<?php $database->commit(); ?> >
    <input type="submit" value="commit!">
</form>
</div>

</body>
</html>