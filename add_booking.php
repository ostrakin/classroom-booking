<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['room'], $_POST['date'], $_POST['time'], $_POST['name'], $_POST['comment'])) {
    $room_id = $conn->real_escape_string($_POST['room']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO bookings (room_id, date, time, name, comment, approved) VALUES (?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssss", $room_id, $date, $time, $name, $comment);

    if ($stmt->execute() === TRUE) {
        echo "Заявка на бронирование успешно отправлена администратору";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Все поля должны быть заполнены!";
}

$conn->close();
?>
<br>
<a href="index.php">Назад</a>
