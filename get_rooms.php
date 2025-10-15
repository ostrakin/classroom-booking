<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$building_id = $_GET['building_id'];

$sql = "SELECT id, name FROM rooms WHERE building_id='$building_id'";
$result = $conn->query($sql);

$rooms = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}

echo json_encode($rooms);

$conn->close();
?>
