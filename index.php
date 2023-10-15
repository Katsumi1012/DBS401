<?php
require_once 'config/untils.php';
onSes();
$errors = [];
$success = '';

if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if ($_POST["username"] == $_POST['password']) {
            $errors[] = "Username and password can not be the same";
        } else {
            $username = base64_decode($_POST["username"]);
            $password = base64_decode($_POST['password']);

            if (md5($username) === md5($password)) {
                $file = 'flag1.txt';

                $content = file_get_contents($file);
                $_SESSION['loggedin'] = true;
                $success .= "Well done, here is your first flag: $content. <br>Go to <a href='upload.php'>THIS PAGE</a> to continue the challenge.";
            } else {
                $errors[] = "Invalid username or password";
            }
        }
    } else {
        $errors[] = "Username and password can't be empty";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Login</title>

    <!-- Prevent Form Resubmission alert POST -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body class="text-center">
    <div class="container mt-5">
        <form action="" method="post">
            <img class="mb-4" src="images/gumball.jpg" alt="" width="80" height="80">
            <br>
            <?php
            if (isset($errors)) {
                foreach ($errors as $errorMsg) {
                    echo '<div class="alert alert-danger" role="alert">
                  ' . $errorMsg . '</div>';
                };
            };

            if (!empty($success)) {
                echo "<div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>$success</h4>
              </div>";
            }
            ?>

            <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
            <input type="text" name="username" class="form-control mb-4" placeholder="User Name">
            <input type="text" name="password" class="form-control mb-4" placeholder="Password">
            <button class="btn btn-lg btn-outline-primary btn-block" name="login" type="submit">Sign in</button>
            <p>Don't have account? <a href="source.txt">Register Here</a></p>
            <p class="mt-5 mb-3 text-muted">Author Kn1ght</p>
            <!-- if (isset($_POST['login'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if ($_POST["username"] == $_POST['password']) {
            $errors[] = "Username and password can not be the same";
        } else {
            $username = base64_decode($_POST["username"]);
            $password = base64_decode($_POST['password']);

            if (md5($username) === md5($password)) {
                $file = 'flag1.txt';

                $content = file_get_contents($file);
                $_SESSION['loggedin'] = true;
                $success .= "Well done, here is your first flag: $content. <br>Go to <a href='upload.php'>THIS PAGE</a> to continue the challenge.";
            } else {
                $errors[] = "Invalid username or password";
            }
        }
    } else {
        $errors[] = "Username and password can't be empty";
    }
} -->
        </form>
    </div>
</body>

</html>