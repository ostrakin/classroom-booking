<!DOCTYPE html>
<html>
<head>
    <title>Управление бронированиями</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Управление бронированиями</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Аудитория</th>
            <th>Дата</th>
            <th>Время</th>
            <th>Имя</th>
            <th>Комментарий</th>
            <th>Статус</th>
            <th>Действие</th>
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

        $sql = "SELECT bookings.id, rooms.name as room_name, buildings.name as building_name, date, time, bookings.name, comment, approved
                FROM bookings
                JOIN rooms ON bookings.room_id = rooms.id
                JOIN buildings ON rooms.building_id = buildings.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['building_name'] . " - " . $row['room_name'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['time'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['comment'] . "</td>
                        <td>" . ($row['approved'] ? 'Одобрено' : 'Ожидает одобрения') . "</td>
                        <td>
                            <a href='approve_booking.php?id=" . $row['id'] . "'>Одобрить</a> |
                            <a href='reject_booking.php?id=" . $row['id'] . "'>Отклонить</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Нет бронирований</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <br>
    <a href='index.php' class='button' style='width: 50px;'>Назад</a>
</body>
</html>
