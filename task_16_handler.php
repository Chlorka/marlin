<?php

session_start();
$error = false;
unset($_SESSION['error']);
if (!empty($_REQUEST['email'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=admin_academy', 'admin_academy', 'Academy2022');
        $mail = $_REQUEST['email'];
        $stmt = $pdo->prepare("SELECT * FROM users_list WHERE `email` = :email");
        $stmt->execute(['email' => $mail]);
        $result_text = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result_text)) {
            $error = false;
            $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
            $stmt = "INSERT INTO users_list (email, password) VALUES ('$mail', '$password')";
            $result = $pdo->exec($stmt);
            header("Location: /tasks/task_16.php");
            exit();
        } else {

            if (!password_verify($_REQUEST['password'], $result_text[0]['password'])) {
                $error = true;
            }

            if ($error == true) {
                $_SESSION['error'] = $error;
                header("Location: /tasks/task_16.php");
                exit();
            } else {
                echo 'Пользователь авторизован';
            }
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}