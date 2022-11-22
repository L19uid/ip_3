<!DOCTYPE html>
<?php
require_once 'db_connect.inc.php';
$sort = filter_input(INPUT_GET, 'poradi', FILTER_SANITIZE_STRING);
if(!$sort) {
    $sortSTMT = $pdo->query("SELECT * FROM room");
}

if($sort == "nazev_down") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY name DESC");
} else if($sort == "cislo_down") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY no DESC");
} else if($sort == "telefon_down") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY phone DESC");
}
else if($sort == "nazev_up") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY name ASC");
} else if($sort == "cislo_up") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY no ASC");
} else if($sort == "telefon_up") {
    $sortSTMT = $pdo->query("SELECT * FROM room ORDER BY phone ASC");
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
<body>
<?php

echo '<body class="container">';
echo '<h1>Seznam místonstí</h1>';

//Info headers
echo '<table class="table"><tbody>';
echo '<tr>' ;
echo '<td>Název
<a href="?poradi=nazev_up"' . sortedDecider("nazev_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=nazev_down" ' . sortedDecider("nazev_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<td>Číslo
<a href="?poradi=cislo_up"' . sortedDecider("cislo_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=cislo_down" ' . sortedDecider("cislo_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<td>Telefon
<a href="?poradi=telefon_up"' . sortedDecider("telefon_up",$sort) . '><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=telefon_down" ' . sortedDecider("telefon_down",$sort) . '><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '</tr>';

if ($sortSTMT->rowCount() == 0) {
    echo "Záznam neobsahuje žádná data";
} else {
    while ($room = $sortSTMT->fetch()) { //nebo foreach ($stmt as $row)
        echo '<tr>' ;
        echo '<td> <a href="room.php?id= ' . $room["room_id"] .' ">' . $room["name"] ."</a></td>";
        echo "<td>" . $room["no"] . "</td>";
        echo "<td>" . $room["phone"] . "</td>";
        echo "</tr>";
    }
}
echo "</tbody></table>";
echo '<div style="position:static !important"></div>';
echo "</body>";
unset($stmt);
?>
</body>
</html>