<!DOCTYPE html>
<?php
require_once 'db_connect.inc.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT,["options" => ["min_range" => 1]]);

if(!$id) {
    http_response_code(400);
    echo"<h1>400 ERROR</h1>";
    exit;
}

$roomSTMT = $pdo->query("SELECT * FROM room WHERE room_id = $id");
if($roomSTMT->rowCount() == 0) {
    http_response_code(404);
    echo"<h1>404 ERROR</h1>";
    exit;
}

$room = $roomSTMT->fetch();
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
$name = $room["name"];
$no = $room["no"];
$phone = $room["phone"];

echo '<h1>Místnost č. ' . $no . ' </h1>';
echo //rakovinotvorný kód
    '<dl class="dl-horizontal">
    <dt>Číslo</dt><dd>' .$no. '</dd>
    <dt>Název</dt><dd>' . $name . '</dd>
    <dt>Telefon</dt><dd> ' . $phone . '</dd>
    <dt>Lidé</dt>';
$employeeSTMT = $pdo->query("SELECT * FROM employee WHERE room = $id");
$employees = $employeeSTMT->fetchAll();
if($employeeSTMT->rowCount() == 0)
    echo '<dd>---</dd>';
else
{
    foreach($employees as $employee) {
        echo '<dd><a href="employee.php?id=' . $employee["employee_id"] . '">' . getEmployeeName($pdo,$employee["employee_id"]) . '</a></dd>';
    }
}

if($employeeSTMT->rowCount() == 0)
    echo '<dt>Průměrná mzda</dt><dd>---</dd>';
else
    echo '<dt>Průměrná mzda</dt><dd>' . averageSalaryPerRoom($pdo,$id) . '</dd>';


echo '<dt>Klíče</dt>';
$keySTMT = $pdo->query("SELECT * FROM ip_3.key WHERE room = $id");
$keys = $keySTMT->fetchAll();
foreach($keys as $key) {
    echo '<dd><a href="employee.php?id=' . $key["employee"] . '">' . getEmployeeName($pdo,$key["employee"]) . '</a></dd>';
}
?>
</dl>
<a href='roomList.php'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span> Zpět na seznam místností</a>
</body>
</html>