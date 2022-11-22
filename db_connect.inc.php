<?php
$host = '127.0.0.1';
$db = 'ip_3';
$user = 'www-aplikace';
$pass = 'Bezpe4n0Heslo.';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);

function getRoomName($pdo, $id) {
    $stmt = $pdo->query("SELECT * FROM room WHERE room_id = $id");
    $room = $stmt->fetch();
    return $room["name"];
}

function getPhoneNumber($pdo, $id) {
    $stmt = $pdo->query("SELECT * FROM room WHERE room_id = $id");
    $phone = $stmt->fetch();
    return $phone["phone"];
}

function getEmployeeName($pdo, $id) {
    $stmt = $pdo->query("SELECT * FROM employee WHERE employee_id = $id");
    $row = $stmt->fetch();
    return $row['surname'] . " " . substr($row['name'], 0, 1) . ".";
}

function averageSalaryPerRoom($pdo, $id) {
    $stmt = $pdo->query("SELECT AVG(wage) FROM employee WHERE room = $id");
    $row = $stmt->fetch();
    return $row['AVG(wage)'];
}

function sortedDecider($cur,$sort)
{
    if($cur == $sort)
    {
        return 'class="sorted"';
    }
    return "";
}
echo '<style>
    .sorted {
        color: red;
    }
    dd  {
        padding:2px 4px 2px 4px;
        outline: #212121 solid 1px;
    }
    dt {
        padding:2px 4px 2px 4px;
        outline: solid 1px;
    }
    tr {
        padding:2px 4px 2px 4px;
        outline: solid 1px;
    }
    </style>';

?>