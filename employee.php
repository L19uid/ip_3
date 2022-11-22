<!DOCTYPE html>
<?php
require_once 'db_connect.inc.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT,["options" => ["min_range" => 1]]);

if(!$id) {
    http_response_code(400);
    echo"<h1>400 ERROR</h1>";
    exit;
}

$stmt = $pdo->query("SELECT * FROM employee WHERE employee_id = $id");
$keystmt = $pdo->query("SELECT * FROM ip_3.key WHERE employee = $id ORDER BY key_id");

if($stmt->rowCount() == 0) {
    http_response_code(404);
    echo"<h1>404 ERROR</h1>";
    exit;
}

$employee = $stmt->fetch();
$keys = $keystmt->fetchAll();
?>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Připojení k DB</title>
</head>
<body class="container">
<?php
$name = $employee["name"];
$surname = $employee["surname"];
$wage = $employee["wage"];
$job = $employee["job"];
$room = getRoomName($pdo,$employee["room"]);

echo '<h1>Karta osoby: <i>' . getEmployeeName($pdo,$employee["employee_id"]) . '</i></h1>';
echo //rakovinotvorný kód
    '<dl class="dl-horizontal">
    <dt>Jméno</dt><dd>' .$name. '</dd>
    <dt>Příjmení</dt><dd>' . $surname . '</dd>
    <dt>Pozice</dt><dd> ' . $job . '</dd>
    <dt>Mzda</dt><dd>' . $wage .'</dd>
    <dt>Místnost</dt><dd> <a href="room.php?id='. $employee["room"] . '">' . $room . '</a></dd>
    <dt>Klíče</dt>';

    foreach($keys as $key) {
        $name = getRoomName($pdo,$key["room"]);
        echo '<dd><a href="room.php?id=' . $key["room"] . '">' . $name . '</a></dd>';
    }
    ?>
</dl>
<a href='employeeList.php'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span> Zpět na seznam zaměstnanců</a>
</body>
</html>