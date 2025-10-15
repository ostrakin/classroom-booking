<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['room'], $_POST['start_date'], $_POST['end_date'], $_POST['time'], $_POST['frequency'], $_POST['name'], $_POST['comment'])) {
    $room_id = $conn->real_escape_string($_POST['room']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $time = $conn->real_escape_string($_POST['time']);
    $frequency = $conn->real_escape_string($_POST['frequency']);
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO recurring_bookings (room_id, start_date, end_date, time, frequency, name, comment, approved) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssssss", $room_id, $start_date, $end_date, $time, $frequency, $name, $comment);

    if ($stmt->execute() === TRUE) {
        echo "Заявка на регулярное бронирование успешно отправлена администратору";
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
