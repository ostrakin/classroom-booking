<!DOCTYPE html>
<html>
<head>
    <title>Подбор аудитории по дате и времени</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Подбор аудитории по дате и времени</h1>
    <form action="get_available_rooms.php" method="post">
        <label for="date">Дата:</label>
        <input type="date" id="date" name="date" required>
        <label for="time">Время:</label>
        <input type="time" id="time" name="time" required>
        <label for="type">Тип аудитории:</label>
        <select id="type" name="type">
            <option value="Лекционные аудитории">Лекционные аудитории</option>
            <option value="Семинарские аудитории">Семинарские аудитории</option>
            <option value="Лабораторные аудитории">Лабораторные аудитории</option>
            <option value="Компьютерные классы">Компьютерные классы</option>
        </select>
        <button type="submit">Подобрать</button>
    </form>
    <br>
    <a href='index.php' class='button' style='width: 50px;'>Назад</a>
</body>
</html>
