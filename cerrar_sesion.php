<?php  ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location:login.php");
    ?>