<?php

$uploaddir = '/var/www/html/tmp/';

if (!empty($_FILES)) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=admin_academy', 'admin_academy', 'Academy2022');

        foreach ($_FILES["images"]["tmp_name"] as $key => $image) {
            $uniqname = uniqid() . basename($_FILES['images']['name'][$key]);
            $uploadfile = $uploaddir . $uniqname;

            if (move_uploaded_file($image, $uploadfile)) {
                echo "Файл корректен и был успешно загружен.\n";
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }

            $stmt = "INSERT INTO images (image) VALUES ('$uniqname')";
            $result = $pdo->exec($stmt);
        }
        header("Location: /tasks/task_20.php");
        exit();
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}