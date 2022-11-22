<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Připojení k DB</title>
</head>
<body>
<?php
require_once 'db_connect.inc.php';

echo '<div class ="container"> <h1>Prohlížeč databáze</h1>';

echo '<ul class="list-group">';
echo '<li class="list-group-item"> <a href="employeeList.php"> Seznam zaměstnanců </a></li>';
echo '<li class="list-group-item"> <a href="roomList.php"> Seznam místnosti </a></li>';
echo '</ul>';

echo "</div>";
unset($stmt);
?>
</body>
</html>