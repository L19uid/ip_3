<!DOCTYPE html>
<?php
require_once 'db_connect.inc.php';

$sort = filter_input(INPUT_GET, 'poradi', FILTER_SANITIZE_STRING);
if(!$sort) {
    $sortSTMT = $pdo->query("SELECT * FROM employee");
}

if($sort == "prijmeni_down") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY surname DESC");
} else if($sort == "telefon_down") {
    $sortSTMT = $pdo->query("SELECT * FROM room JOIN employee ON room = room_id ORDER BY phone DESC");
} else if($sort == "pozice_down") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY job DESC");
} else if($sort == "mistnost_down") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY room DESC");
}
else if($sort == "prijmeni_up") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY surname ASC");
} else if($sort == "telefon_up") {
    $sortSTMT = $pdo->query("SELECT * FROM room JOIN employee ON room = room_id ORDER BY phone ASC");
} else if($sort == "pozice_up") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY job ASC");
} else if($sort == "mistnost_up") {
    $sortSTMT = $pdo->query("SELECT * FROM employee ORDER BY room ASC");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>People list</title>
</head>
<body class="container">
<?php
echo '<h1>Seznam zaměstnanců</h1>';

//Info headers
echo '<table class="table"><tbody>';
echo '<tr>' ;
echo '<th>Jméno
<a href="?poradi=prijmeni_up"' . sortedDecider("prijmeni_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=prijmeni_down"' . sortedDecider("prijmeni_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<th>Místonost
<a href="?poradi=mistnost_up"' . sortedDecider("mistnost_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=mistnost_down"' . sortedDecider("mistnost_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<th>Telefon
<a href="?poradi=telefon_up"' . sortedDecider("telefon_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=telefon_down"' . sortedDecider("telefon_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<th>Pozice
<a href="?poradi=pozice_up"' . sortedDecider("pozice_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=pozice_down"' . sortedDecider("pozice_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '</tr>';

if ($sortSTMT->rowCount() == 0) {
    echo "Záznam neobsahuje žádná data";
} else {
    while ($employee = $sortSTMT->fetch()) { //nebo foreach ($stmt as $row)
        $text = '<tr>';
        $text .= '<td> <a href="employee.php?id=' . $employee["employee_id"] . '">' . $employee["surname"] . " ". $employee["name"] ."</a></td>";
        $text .=  '<td>' . getRoomName($pdo,$employee["room"]) . '</td>';
        $text .=  '<td>' . getPhoneNumber($pdo,$employee["room"]) . '</td>';
        $text .=  '<td>' . $employee["job"] . '</td></tr>';

        echo $text;
    }
}

echo "</tbody></table>";
echo '<div style="position:static !important"></div>';
unset($sortSTMT);
?>
</body>
</html>