<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM recurring_bookings WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Регулярное бронирование успешно отклонено";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<br>
<a href="manage_recurring_bookings.php">Назад</a>
