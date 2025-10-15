<!DOCTYPE html>
<html>
<head>
    <title>Забронировать аудиторию по расписанию</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Забронировать аудиторию по расписанию</h1>
    <form action="add_recurring_booking.php" method="post">
        <label for="building">Корпус:</label>
        <select id="building" name="building">
            <?php
            // Подключение к базе данных
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "university";
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка подключения
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Получение корпусов из базы данных
            $sql = "SELECT id, name FROM buildings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                }
            } else {
                echo "<option>Нет доступных корпусов</option>";
            }

            $conn->close();
            ?>
        </select>
        
        <label for="room">Аудитория:</label>
        <select id="room" name="room">
            <!-- Аудитории будут загружены с помощью JavaScript -->
        </select>
        
        <label for="start_date">Дата начала:</label>
        <input type="date" id="start_date" name="start_date" required>
        
        <label for="end_date">Дата окончания:</label>
        <input type="date" id="end_date" name="end_date" required>
        
        <label for="time">Время:</label>
        <input type="time" id="time" name="time" required>
        
        <label for="frequency">Частота:</label>
        <select id="frequency" name="frequency" required>
            <option value="weekly">Еженедельно</option>
            <option value="monthly">Ежемесячно</option>
            <option value="quarterly">Ежеквартально</option>
            <option value="yearly">Ежегодно</option>
        </select>
        
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment" rows="4" cols="50"></textarea>

        <input type="submit" value="Забронировать">
    </form>
    <br>
    <a href='index.php' class='button' style='width: 50px;'>Назад</a>

    <script>
    document.getElementById('building').addEventListener('change', function() {
        var buildingId = this.value;
        fetch('get_rooms.php?building_id=' + buildingId)
            .then(response => response.json())
            .then(data => {
                var roomSelect = document.getElementById('room');
                roomSelect.innerHTML = '';
                data.forEach(function(room) {
                    var option = document.createElement('option');
                    option.value = room.id;
                    option.textContent = room.name;
                    roomSelect.appendChild(option);
                });
            });
    });
    </script>
</body>
</html>
