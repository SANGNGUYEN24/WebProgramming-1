<?php
    session_start();

    if (!isset($_SESSION['username']) or $_SESSION['username'] == NULL) {
        header('Location: ../login/');
    }

    unset($_SESSION['username']);
    unset($_SESSION['isTeacher']);
    unset($_SESSION['isStudent']);
    session_unset();
    header('Location: ../login/');
?>