<!DOCTYPE html>
<html>
<head>
    <title>Доступные аудитории</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Доступные аудитории</h1>
    <form action="submit_booking.php" method="post">
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required>
        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>
        <table>
            <tr>
                <th>Корпус</th>
                <th>Аудитория</th>
                <th>Вместимость</th>
                <th>Тип</th>
                <th>Действие</th>
            </tr>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "university";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $date = $_POST['date'];
                $time = $_POST['time'];
                $type = $_POST['type'];

                $sql = "SELECT rooms.id AS room_id, rooms.name AS room_name, buildings.name AS building_name, rooms.capacity, rooms.type
                        FROM rooms
                        JOIN buildings ON rooms.building_id = buildings.id
                        LEFT JOIN bookings ON rooms.id = bookings.room_id AND bookings.date = '$date' AND bookings.time = '$time'
                        WHERE bookings.room_id IS NULL AND rooms.type = '$type'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['building_name']}</td>
                                <td>{$row['room_name']}</td>
                                <td>{$row['capacity']}</td>
                                <td>{$row['type']}</td>
                                <td>
                                    <input type='hidden' name='room_id' value='{$row['room_id']}'>
                                    <input type='hidden' name='date' value='$date'>
                                    <input type='hidden' name='time' value='$time'>
                                    <button type='submit'>Отправить заявку</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Нет доступных аудиторий</td></tr>";
                }

                $conn->close();
            }
            ?>
        </table>
    </form>
    <br>
    <a href="select_room_by_datetime.php" class='button' style='width: 50px;'>Назад</a>
</body>
</html>
