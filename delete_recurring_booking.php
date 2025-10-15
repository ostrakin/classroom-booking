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

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM recurring_bookings WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute() === TRUE) {
        echo "Регулярное бронирование успешно удалено";
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID бронирования не указан!";
}

$conn->close();
?>
<br>
<a href="manage_recurring_bookings.php">Назад</a>
