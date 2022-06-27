 <?php


    if(!empty($_REQUEST['text'])) {
                $_SESSION['text'] = $_REQUEST['text'];

                header("Location: /tasks/task_14.php");
                exit();
//                echo "<script type='text/javascript'> document.location = '/tasks/task_13.php'; alert('sdsdsd');</script>";
//                 exit();
    }