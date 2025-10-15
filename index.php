<!DOCTYPE html>
<html>
<head>
    <title>Система бронирования аудиторий</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Система бронирования аудиторий</h1>
        <div class="button-container">
            <h2>Функции пользователя</h2>
            <a href="book_room.php" class="button">Обычное бронирование</a>
            <a href="book_recurring_room.php" class="button">Бронирование по графику</a>
            <a href="list_of_available_audiences.php" class="button">Список доступных аудиторий</a>
            <a href="select_room_by_datetime.php" class="button">Подбор аудитории по дате и времени</a>
        </div>
        <br>
        <div class="button-container">
            <h2>Функции администратора</h2>
            <a href="manage_bookings.php" class="button">Управление бронированиями</a>
            <a href="manage_recurring_bookings.php" class="button">Управление регулярными бронированиями</a>
        </div>
    </div>
</body>
</html>
