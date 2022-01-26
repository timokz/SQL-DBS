<?php

require_once('DatabaseHelper.php');

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

//Fetch data from database
$perf_array = $database->selectAllPerf($P_NAME, $T_NAME, $P_DATE, $DIRECTION,$LANGUAGES);
?>

<!DOCTYPE html>
<html lang="en">
<title>Data: Performances</title>

<head>
    <!-- Search form -->
    <title>Performance Search:</title>
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
             <!--   <li><a href="#del">Delete</a></li>
                <li><a href="#upd">Update</a></li> -->
            </ul>
        </div>
    </nav>

    <section id = "search">
        <div class="container">

            <form method="get">
                <!-- p_name textbox:-->
                <div class="form-group">
                    <label for="Performance Name">Performance Name:</label>
                    <input id="t_name" name="t_name" type="text"  class="form-control" placeholder="Faust I" value='<?php echo $P_NAME; ?>' maxlength="64">
                </div>

                <!-- t_name textbox:-->
                <div class="form-group">
                    <label for="T_NAME">Theatre:</label>
                    <input id="T_NAME" name="T_NAME" type="text"  class="form-control" placeholder="Burgtheater" value='<?php echo $T_NAME; ?>' maxlength="64">
                </div>

                <div class="form-group">
                    <label for="P_DATE">Date:</label>
                    <input id="P_DATE" name="P_DATE" type="date"  class="form-control" value='<?php echo $P_DATE; ?>' >
                </div>

                <div class="form-group">
                    <label for="DIRECTION">Direction:</label>
                    <input id="DIRECTION" name="DIRECTION" type="text"  class="form-control" value='<?php echo $DIRECTION; ?>'>
                </div>

                <div class="form-group">
                    <label for="LANGUAGES">Language:</label>
                    <input id="LANGUAGES" name="LANGUAGES" type="text"  class="form-control" value='<?php echo $LANGUAGES; ?>'>
                </div>

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
            <h2>Performance Search Result:</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Performance Name</th>
                        <th>Theatre Name</th>
                        <th>Date</th>
                        <th>Direction</th>
                        <th>Language</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($perf_array as $Performance) : ?>
                        <tr>
                            <td><?php echo $Performance['T_NAME']; ?>  </td>
                            <td><?php echo $Performance['P_NAME']; ?>  </td>
                            <td><?php echo $Performance['P_DATE']; ?>  </td>
                            <td><?php echo $Performance['DIRECTION']; ?>  </td>
                            <td><?php echo $Performance['LANGUAGES']; ?>  </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </section>

    <section id = "add">
        <div class="container">
            <!-- Add Performance: -->
            <h2>Add Performance: </h2>
            <form method="post" action="addPerformance.php">

                <div class="form-group">
                    <label for="Performance Name">Performance Name:</label>
                    <input id="t_name" name="t_name" type="text"  class="form-control" placeholder="Faust I"  maxlength="64">
                </div>

                <div class="form-group">
                    <label for="T_NAME">Theatre:</label>
                    <input id="T_NAME" name="T_NAME" type="text"  class="form-control" placeholder="Burgtheater"  maxlength="64">
                </div>

                <div class="form-group">
                    <label for="P_DATE">Date:</label>
                    <input id="P_DATE" name="P_DATE" type="date"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="DIRECTION">Direction:</label>
                    <input id="DIRECTION" name="PRIVATE_OR_PUBLIC" type="text"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="LANGUAGES">Language:</label>
                    <input id="LANGUAGES" name="LANGUAGES" type="text"  class="form-control">
                </div>
                <div>
                    <button id='submit' type='submit' class="btn btn-primary">
                        Add Performance
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