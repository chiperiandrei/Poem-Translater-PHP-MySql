<?php
    require_once('connect.component.php');

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
        
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (isset($email) && !empty($email)) {
        if (isset($password) && !empty($password)) {
            $result = $mysqli->query('SELECT * FROM `USERS` WHERE `EMAIL`=\'' . $email . '\'');

            if ($result) {
                // Valid SQL Query

                if ($result->num_rows === 1) {
                    // Email found

                    if ($row = $result->fetch_assoc()) {
                        if ($password === $row['PASSWORD']) {
                            // Password is correct
                            $_SESSION['login'] = TRUE;
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                            $_SESSION['first-name'] = $row['FIRST_NAME'];
                            $_SESSION['last-name'] = $row['LAST_NAME'];

                            header("Location: ../");
                        } else {
                            // Password is incorect
                            header("Location: ../login");
                        }
                    }
        
                } else {
                    // Email not found
                    header("Location: ../login");
                }
            } else {
                // Invalid SQL Query
                header("Location: ../login");
            }
        }
    } else {
        header("Location: ../login");
    }
?>