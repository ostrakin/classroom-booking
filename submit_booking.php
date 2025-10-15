<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$resultMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO bookings (room_id, date, time, name, comment, approved) VALUES ('$room_id', '$date', '$time', '$name', '$comment', 0)";

    if ($conn->query($sql) === TRUE) {
        $resultMessage = "<div class='success-message'>Ваша заявка на бронирование успешно отправлена администратору.</div>";
    } else {
        $resultMessage = "<div class='error-message'>Ошибка: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Результат бронирования</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php echo '<font size="10">' . $resultMessage . '</font>'; ?>
    <p><a href="index.php" class="button" style='width: 150px;'>Вернуться на главную</a></p>
</body>
</html>
