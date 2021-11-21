<?php
    include '../vendor/autoload.php';

    // Set session ti default value every time enter the page
    // loginFail to check if user fail to login
    $_SESSION["loginFail"] = false;
    // loginTeacher to check if user login as teacher
    $_SESSION["loginTeacher"] = false;
    // loginStudent to check if user login as student
    $_SESSION["loginStudent"] = false;

    $connect = new MongoDB\Client(
        'mongodb+srv://hoainambrvt2001:tMIxYDVcInK2mCkN@nhattan.7vquo.mongodb.net/myFirstDatabase?retryWrites=true&w=majority'
    );
    
    $db = $connect->data;

    if (isset($_POST['TeacherButton'])){
        // Login as teacher => loginTeacher = true
        $_SESSION["loginTeacher"] = true;
        $post = $db->teacher;

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        $res = $post->findOne(['username' => $username, 'password' => $password]);

        if (!empty($res)){
            $_SESSION['username'] = $username;
            $_SESSION['isTeacher'] = true;
            header('Location: ../teacher/');
        } 
        else {
            // Login Fail => loginFail = true
            $_SESSION["loginFail"] = true;
        }
        // else {
        // echo '<p class="wrong">Invalid username or password</p>';
        // }
    }

    if (isset($_POST['StudentButton'])){
        // Login as Student => loginStudent = true
        $_SESSION["loginStudent"] = true;
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        $post = $db->student;

        $res = $post->findOne(['username' => $username, 'password' => $password]);

        if (!empty($res)){
            $_SESSION['username'] = $username;
            $_SESSION['isStudent'] = true;
            header('Location: ../student/');
        } 
        else {
            // Login Fail => loginFail = true
            $_SESSION["loginFail"] = true;
        }
        // else {
        // echo '<p class="wrong">Invalid username or password</p>';
        // }
    }

?>