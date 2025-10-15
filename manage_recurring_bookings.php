<!DOCTYPE html>
<html>
<head>
    <title>Управление регулярными бронированиями</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Управление регулярными бронированиями</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Аудитория</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Время</th>
            <th>Частота</th>
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

        $sql = "SELECT recurring_bookings.id, rooms.name as room_name, buildings.name as building_name, start_date, end_date, time, frequency, recurring_bookings.name, comment, approved
                FROM recurring_bookings
                JOIN rooms ON recurring_bookings.room_id = rooms.id
                JOIN buildings ON rooms.building_id = buildings.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['building_name'] . " - " . $row['room_name'] . "</td>
                        <td>" . $row['start_date'] . "</td>
                        <td>" . $row['end_date'] . "</td>
                        <td>" . $row['time'] . "</td>
                        <td>" . $row['frequency'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['comment'] . "</td>
                        <td>" . ($row['approved'] ? 'Одобрено' : 'Ожидает одобрения') . "</td>
                        <td>
                            <a href='approve_recurring_booking.php?id=" . $row['id'] . "'>Одобрить</a> |
                            <a href='reject_recurring_booking.php?id=" . $row['id'] . "'>Отклонить</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Нет регулярных бронирований</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <br>
    <a href='index.php' class='button' style='width: 50px;'>Назад</a>
</body>
</html>
