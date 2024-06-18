<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Таблица</title>
    <link rel="stylesheet" type="text/css" href="static/styles/style.css">
    <style>
        .custom-btn {
            width: 190px;
            height: 50px;
            color: #fff;
            border-radius: 5px;
            padding: 10px 25px;
            font-family: 'Lato', sans-serif;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            box-shadow: inset 2px 2px 2px 0px rgba(255, 255, 255, .5),
                7px 7px 20px 0px rgba(0, 0, 0, .1),
                4px 4px 5px 0px rgba(0, 0, 0, .1);
            outline: none;
        }

        .btn-16 {
            border: none;
            color: #000;
            z-index: 1;
        }

        .btn-16:after {
            position: absolute;
            content: "";
            width: 0;
            height: 100%;
            top: 0;
            left: 0;
            direction: rtl;
            z-index: -1;
            box-shadow:
                -7px -7px 20px 0px #fff9,
                -4px -4px 5px 0px #fff9,
                7px 7px 20px 0px #0002,
                4px 4px 5px 0px #0001;
            transition: all 0.3s ease;
        }

        .btn-16:hover {
            color: #000;
        }

        .btn-16:hover:after {
            left: auto;
            right: 0;
            width: 100%;
        }

        .btn-16:active {
            top: 2px;
        }

        input {
            width: 30%;
            margin: 10px 0;
            height: 30px;
            padding: 10px;
        }

        .type-1 {
            border-radius: 10px;
            border: 1px solid #eee;
            transition: .3s border-color;
        }

        .type-1:hover {
            border: 1px solid #aaa;
        }

        p {
            font-weight: bold;
            font-size: 13pt;
        }
    </style>
</head>

<body>
    <form method="post">
        <label for="table" style="font-weight: bold; font-size: 15pt;">Введите название таблицы:</label>
        <input type="text" class="type-1" style="font-weight: bold; font-size: 13pt;" name="table" id="table" required>
        <button type="submit" class="custom-btn btn-16">Показать данные</button>
    </form>

    <?php


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tableName = $_POST['table'];
        define('DB_HOST', 'localhost:3307');
        define('DB_USER', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'laba');

        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysql->connect_errno) exit('Ошибка подключения к БД');
        $mysql->set_charset('utf8');
        $query = "SELECT * FROM information_schema.tables WHERE table_name = '$tableName' LIMIT 1";
        $result = mysqli_query($mysql, $query);
        if (mysqli_num_rows($result) == 1) {
            $query = "SELECT * FROM $tableName";
            $result = mysqli_query($mysql, $query);

            $row = mysqli_fetch_assoc($result);
            $columnNames = array_keys($row);

            echo '<table><thead><tr>';
            foreach ($columnNames as $columnName) {
                echo '<th>' . $columnName . '</th>';
            }
            echo '</tr></thead><tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                foreach ($columnNames as $columnName) {
                    echo '<td>' . $row[$columnName] . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>Таблица не найдена';
        }
        $mysql->close();
    }



    // if ($columnName == 'resume') {
    //     echo "<td>  <a href='../OSPanel/domains/LABA7WEB/$row[$columnName]' download=''>Скачать</a>  </td>";
    // } else echo '<td>' . $row[$columnName] . '</td>';


    ?>
</body>

</html>