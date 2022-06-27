<?php

$uploaddir = '/var/www/html/tmp/';
$uniqname = uniqid() . basename($_FILES['images']['name']);
$uploadfile = $uploaddir . $uniqname;

//echo '<pre>';
if (move_uploaded_file($_FILES['images']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}
//echo 'Некоторая отладочная информация:';
//print "</pre>";

if (!empty($_FILES)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=admin_academy', 'admin_academy', 'Academy2022');

        $stmt = "INSERT INTO images (image) VALUES ('$uniqname')";
        $result = $pdo->exec($stmt);
        header("Location: /tasks/task_18.php");
        exit();
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}