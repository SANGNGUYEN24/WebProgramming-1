<?php
session_start();
if (!isset($_SESSION['username']) or $_SESSION['username'] == NULL) {
    //header('Location: ./login/index.php');
} else {
    if (isset($_SESSION['isStudent']) && $_SESSION['isStudent'] == true) {
        header('Location: ../student/');
    }
    if (isset($_SESSION['isTeacher']) && $_SESSION['isTeacher'] == true) {
        header('Location: ../teacher/');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ MAKER - Register </title>
    <meta name="description" content="This website is used to do quiz for free. This is used by teachers and students. Students do the quiz from the teachers.">
    <meta name="keywords" content="quiz, quizz, quizzes, quiz.com, www.quiz.com, quiz.com website, online quiz, join quiz, do quiz
                                 quiz register">
    <link rel="stylesheet" href="./login.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>

    <!-- Register form -->
    <form class="RegisterWrapper" action="index.php" method="POST">

        <a href="../login/">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14 icon-back" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path></svg>
        </a>

        <div class="RegisterForm">
            <p class="register-logo">REGISTER</p>
            <div class="InputWrapper">
                <svg aria-hidden="true" class="icon" focusable="false" data-prefix="fas" data-icon="user-alt" class="svg-inline--fa fa-user-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
                <input name="fullname" placeholder="Full name" type="text" class="input" autocomplete="off" required />
            </div>
            <div class="InputWrapper">
                <svg aria-hidden="true" class="icon" focusable="false" data-prefix="fas" data-icon="user-alt" class="svg-inline--fa fa-user-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path></svg>
                <input name="username" placeholder="Username" type="email" class="input" autocomplete="off" required />
            </div>
            <div class="InputWrapper">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path></svg>
                <input name="password" id="password" placeholder="Password" type="password" class="input" required />
            </div>
            <div class="InputWrapper">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="key" class="svg-inline--fa fa-key fa-w-16 icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M512 176.001C512 273.203 433.202 352 336 352c-11.22 0-22.19-1.062-32.827-3.069l-24.012 27.014A23.999 23.999 0 0 1 261.223 384H224v40c0 13.255-10.745 24-24 24h-40v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24v-78.059c0-6.365 2.529-12.47 7.029-16.971l161.802-161.802C163.108 213.814 160 195.271 160 176 160 78.798 238.797.001 335.999 0 433.488-.001 512 78.511 512 176.001zM336 128c0 26.51 21.49 48 48 48s48-21.49 48-48-21.49-48-48-48-48 21.49-48 48z"></path></svg>
                <input placeholder="Confirm Password" type="password" class="input" register oninput="inputHandler(this)" />
            </div>
            <p id="error" style="color: red"></p>
            <script type="text/javascript">
                function inputHandler(text) {
                    if (text.value != document.getElementById('password').value) {
                        document.getElementById('error').innerHTML = "Password does not match";
                        document.getElementById('mybtn').disabled = true;
                    } else {
                        document.getElementById('error').innerHTML = "";
                        document.getElementById('mybtn').disabled = false;
                    }
                }
            </script>


            <span class="custom-dropdown">
                <select name="role">
                    <option>Student</option>
                    <option>Teacher</option>
                </select>
            </span>
            <?php
            include '../connect.php';

            $db = $connect->data;

            if (isset($_POST['register'])) {
                $role = $_POST['role'];
                $fullname = $_POST['fullname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $id = rand(1000000000, 10000000000);

                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                function validatePassword($password)
                {
                    if (empty($password)) {
                        echo '<p class="wrong">Password is required</p>';
                        return false;
                    }
                    $password = test_input($password);
                    if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)) {
                        echo '<p class="wrong">Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters!</p>';
                        return false;
                    }
                    return true;
                }

                function validateUsername($username)
                {
                    if (empty($username)) {
                        echo '<p class="wrong">Username is required</p>';
                        return false;
                    }
                    $username = test_input($username);
                    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                        echo '<p class="wrong">Invalid email format</p>';
                        return false;
                    }
                    return true;
                }

                if (validatePassword($password) && validateUsername($username)) {
                    if ($role == 'Teacher') {
                        $post = $db->teacher;
                        $res = $post->findOne(['username' => $username]);
                        if (empty($res)) {
                            $insert = $post->insertOne([
                                "teacherId" => 'TC-' . (string)$id,
                                'name' => $fullname,
                                'username' => $username,
                                'password' => md5($password),
                                'gender' => '',
                                'birthday' => '',
                                'phone' => '',
                                'courseIds' => [],
                            ]);
                            echo "<p class='correct'>Register successfully</p>";
                        } else {
                            echo "<p class='wrong'>Username already exists</p>";
                        }
                    } else {
                        $post = $db->student;
                        $res = $post->findOne(['username' => $username]);

                        if (empty($res)) {
                            $insert = $post->insertOne([
                                "studentId" => 'STU-' . (string)$id,
                                'name' => $fullname,
                                'username' => $username,
                                'password' => md5($password),
                                'gender' => '',
                                'birthday' => '',
                                'phone' => '',
                            ]);
                            echo "<p class='correct'>Register successfully</p>";
                        } else {
                            echo "<p class='wrong'>Username already exists</p>";
                        }
                    }
                }
            }

                // if ($role == 'Teacher') {
                //     $post = $db->teacher;
                //     $res = $post->findOne(['username' => $username]);
                //     if (empty($res)) {
                //         $insert = $post->insertOne([
                //             "teacherId" => 'TC-' . (string)$id,
                //             'name' => $fullname,
                //             'username' => $username,
                //             'password' => $password,
                //             'gender' => '',
                //             'birthday' => '',
                //             'phone' => '',
                //             'courseIds' => [],
                //         ]);
                //         echo "<p class='correct'>Register successfully</p>";
                //     } else {
                //         echo "<p class='wrong'>Username already exists</p>";
                //     }
                // } else {
                //     $post = $db->student;
                //     $res = $post->findOne(['username' => $username]);

                //     if (empty($res)) {
                //         $insert = $post->insertOne([
                //             "studentId" => 'STU-' . (string)$id,
                //             'name' => $fullname,
                //             'username' => $username,
                //             'password' => $password,
                //             'gender' => '',
                //             'birthday' => '',
                //             'phone' => '',
                //         ]);
                //         echo "<p class='correct'>Register successfully</p>";
                //     } else {
                //         echo "<p class='wrong'>Username already exists</p>";
                //     }
                // }

            ?>
            <button type="submit" id="mybtn" class="RegisterButton" disabled name="register">Register</button>
        </div>
    </form>
    <script src="./register.js"></script>
</body>

</html>