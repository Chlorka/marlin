<?php

if (!empty($_REQUEST['file'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=admin_academy', 'admin_academy', 'Academy2022');

        $file = $_REQUEST['file'];
        $stmt = $pdo->prepare("SELECT * FROM images WHERE `image` = :file");
        $stmt->execute(['file' => $file]);
        $result_text = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result_text)) {

            $stmt = $pdo->prepare("DELETE FROM images WHERE `image` = :file");
            $stmt->execute(['file' => $file]);

            $path = $_SERVER['DOCUMENT_ROOT'].'tmp/'.$file;
            unlink($path);

            header("Location: /tasks/task_19.php");
            exit();
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
}