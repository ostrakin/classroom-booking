<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Забронировать аудиторию</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Забронировать аудиторию</h1>
    <form action="add_booking.php" method="post">
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
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
            } else {
                echo "<option>Нет доступных корпусов</option>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </select>
        
        <label for="room">Аудитория:</label>
        <select id="room" name="room">
            <!-- Аудитории будут загружены с помощью JavaScript -->
        </select>
        
        <label for="date">Дата:</label>
        <input type="date" id="date" name="date" required>
        
        <label for="time">Время:</label>
        <input type="time" id="time" name="time" required>
        
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
        fetch('get_rooms.php?building_id=' + encodeURIComponent(buildingId))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                var roomSelect = document.getElementById('room');
                roomSelect.innerHTML = '';
                if (data.length === 0) {
                    var option = document.createElement('option');
                    option.textContent = 'Нет доступных аудиторий';
                    roomSelect.appendChild(option);
                } else {
                    data.forEach(function(room) {
                        var option = document.createElement('option');
                        option.value = room.id;
                        option.textContent = room.name;
                        roomSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
    });
    </script>
</body>
</html>