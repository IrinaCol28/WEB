<!DOCTYPE html>
<html>

<head>
	<title>Анкета</title>
	<link rel='stylesheet' href='css/style_anketa.css'>
</head>

<body>
	<?php


	//отправка в БД
	function sendFormToBD($name, $email, $password, $gender, $age, $occupation, $comments, $newsletter, $resume)
	{
		//переменные для подключения
		define('DB_HOST', 'localhost:3307');
		define('DB_USER', 'root');
		define('DB_PASSWORD', '');
		define('DB_NAME', 'laba');

		//подключение
		$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if ($mysql->connect_errno) exit('Ошибка подключения к БД');
		$mysql->set_charset('utf8');

		//запрос
		$sql = "INSERT INTO anketa (Name, Email, Password, Gender, Age, Оccupation, Resume, Comment, Newsletter)
		VALUES('$name','$email','$password','$gender','$age','$occupation','$resume', '$comments','$newsletter')";

		//если завпрос выполнен
		if ($mysql->query($sql) === TRUE) {
			echo "Запись добавлена<br>";
		}

		//выход
		$mysql->close();
	}



	//обработка POST-запроса
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$gender = $_POST["gender"];
		$age = $_POST["age"];
		$occupation = $_POST["occupation"];
		$comments = $_POST["comments"];
		$newsletter = isset($_POST["newsletter"]) ? True : false;

		//переменная пимени файла после сохранения в бд
		$resume_name = $_POST["resume_name"];

		echo "<p> Имя: $name </p>";
		echo "<p> Электронная почта: $email </p>";
		echo "<p> Пароль: $password </p>";
		echo "<p> Пол: $gender </p>";
		echo "<p> Возраст: $age </p>";
		echo "<p> Род занятий: $occupation </p>";
		echo "<p> Комментарий: $comments </p>";
		$newsletter_out = $newsletter ? 'Да' : 'Нет';
		echo "<p> Подписка на новости: $newsletter_out</p>";

		//если файл существует и resume_name не null, то выводим ссылку на файл и возврат к анкете
		if (file_exists("resume/$resume_name") && $resume_name != null) {
			$folder = 'resume';
			$resume = "$folder/$resume_name";
			echo "<p> Резюме: <a href='$resume' download=''>Скачать</a> </p>";
			echo "<a href='main.html'>Назад</a></p>";
		} else {

			$target_dir = "resume/"; // папка, куда загружается файл
			$new_file_name = $name . "_".$email . "_" . basename($_FILES["resume"]["name"]); //новое имя файла (добавляем email к названию)
			$target_file = $target_dir . $new_file_name; // полный путь к файлу на сервере
			$uploadOk = 1; // флаг, определяющий, успешна ли загрузка файла
			// Проверяем, была ли установлена флаг-ошибки загрузки файла
			if ($uploadOk == 0) {
				echo "Файл не загружен";
				// Если все проверки были пройдены успешно, то загружаем файл на сервер
			} else {
				if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
					$folder = 'resume';
					$resume = "$folder/$new_file_name";
					echo "<p> Резюме: <a href='$resume' download=''>Скачать</a> </p>";
				} else {
					echo "Файл не загружен";
				}
			}
			//кнопка для записи в бд
			echo "	<form method='post' action='visual.php'>
			<input name='name' value='$name' hidden>
			<input name='email' value='$email' hidden>
			<input name='password' value='$password' hidden>
			<input name='gender' value='$gender' hidden>
			<input name='age' value='$age' hidden>
			<input name='occupation' value='$occupation' hidden>
			<input name='comments' value='$comments' hidden>
			<input name='newsletter' value='$newsletter' hidden>
			<input name='resume_name' value='$new_file_name' hidden>
			<button type='submit' name='send'>Сохранить в БД</button>
			</form>";
		}
	}

	//проверка нажатия на кнопку записи в бд и вызов метода для записи
	if (isset($_POST['send'])) {
		sendFormToBD(
			$name,
			$email,
			$password,
			$gender,
			$age,
			$occupation,
			$comments,
			$newsletter,
			$resume
		);
	}
	?>


</body>

</html>