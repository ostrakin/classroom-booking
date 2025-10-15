<!DOCTYPE html>
<html>
<head>
    <title>Список аудиторий</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Список аудиторий</h1>
    
    <!-- Забронированные аудитории -->
    <h2>Забронированные аудитории</h2>
    <table>
        <tr>
            <th>Корпус</th>
            <th>Аудитория</th>
            <th>Вместимость</th>
            <th>Тип</th>
            <th>Дата бронирования</th>
            <th>Время бронирования</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "university";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Забронированные аудитории
        $sql = "SELECT buildings.name AS building_name, rooms.name AS room_name, rooms.capacity, rooms.type, bookings.date, bookings.time
                FROM bookings
                JOIN rooms ON bookings.room_id = rooms.id
                JOIN buildings ON rooms.building_id = buildings.id
                WHERE bookings.approved = 1
                ORDER BY bookings.date, bookings.time";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['building_name']}</td>
                        <td>{$row['room_name']}</td>
                        <td>{$row['capacity']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Нет забронированных аудиторий</td></tr>";
        }

        echo "</table>";

        // Applications under review
        echo "<h2>Заявки на рассмотрении</h2><table>
            <tr>
                <th>ID</th>
                <th>Корпус</th>
                <th>Аудитория</th>
                <th>Дата</th>
                <th>Время</th>
            </tr>";

        $sql_under_review = "SELECT bookings.id, buildings.name AS building_name, rooms.name AS room_name, bookings.date, bookings.time
                             FROM bookings
                             JOIN rooms ON bookings.room_id = rooms.id
                             JOIN buildings ON rooms.building_id = buildings.id
                             WHERE bookings.approved = 0";

        $result_under_review = $conn->query($sql_under_review);

        if ($result_under_review->num_rows > 0) {
            while($row = $result_under_review->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['building_name']}</td>
                        <td>{$row['room_name']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет заявок на рассмотрении</td></tr>";
        }

        echo "</table>";

        // Свободные аудитории
        $currentDate = date("Y-m-d");
        $currentTime = date("H:i:s");

        echo "<h2>Свободные аудитории</h2><table>
            <tr>
                <th>Корпус</th>
                <th>Аудитория</th>
                <th>Вместимость</th>
                <th>Тип</th>
            </tr>";

        $sql_free = "SELECT buildings.name AS building_name, rooms.name AS room_name, rooms.capacity, rooms.type
                     FROM rooms
                     JOIN buildings ON rooms.building_id = buildings.id
                     LEFT JOIN bookings ON rooms.id = bookings.room_id AND bookings.date = '$currentDate' AND bookings.time = '$currentTime'
                     WHERE bookings.room_id IS NULL";

        $result_free = $conn->query($sql_free);

        if ($result_free->num_rows > 0) {
            while($row = $result_free->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['building_name']}</td>
                        <td>{$row['room_name']}</td>
                        <td>{$row['capacity']}</td>
                        <td>{$row['type']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Нет свободных аудиторий</td></tr>";
        }

        echo "</table>";

        $conn->close();
        ?>
    <br>
    <a href="index.php" class="button">На главную</a>
</body>
</html>
