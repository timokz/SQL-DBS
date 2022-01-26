
<?php
//require
require_once('DatabaseHelper.php');

$database = new DatabaseHelper();
/*
$t_name = '';
if (isset($_GET['t_name'])) {
    $t_name = $_GET['t_name'];
}

$Address = '';
if (isset($_GET['Address'])) {
    $Address = $_GET['Address'];
}

$t_capacity = '';
if (isset($_GET['t_capacity'])) {
    $t_capacity = $_GET['t_capacity'];
}
$PRIVATE_OR_PUBLIC = '';
if (isset($_GET['PRIVATE_OR_PUBLIC'])) {
    $t_capacity = $_GET['PRIVATE_OR_PUBLIC'];
}
$theatre_list = $database->selectAllTheater($t_name, $Address, $t_capacity,$PRIVATE_OR_PUBLIC);
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vienna Theatre DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 450px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
    </style>
</head>

<body>
<div class="jumbotron text-center">
    <h1>Vienna Theatre DB</h1>
    <p>Supports Insertion, Deletion, Editing of all associated Data</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>Theatre</h2>
            <a href="Theatre.php">
                Click here to view and edit Theatres!
            </a>
        </div>
        <div class="col-sm-4">
            
        </div>
        <div class="col-sm-4">
            <h2>Performances</h2>
            <a href="Performances.php">
                Click here to access the Performances!
            </a>
        </div>
    </div>
</div>

<div class="container">
    <h3>Upcoming Performances</h3>
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
            <?php  $upcoming = $database->upcoming();
            foreach ($upcoming as $item) : ?>
                <tr>
                    <td><?php echo $item['T_NAME']; ?>  </td>
                    <td><?php echo $item['P_NAME']; ?>  </td>
                    <td><?php echo $item['P_DATE']; ?>  </td>
                    <td><?php echo $item['DIRECTION']; ?>  </td>
                    <td><?php echo $item['LANGUAGES']; ?>  </td>
                    <td><?php echo $item['ADDRESS']; ?>  </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>