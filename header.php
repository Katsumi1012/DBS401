<?php
require_once 'config/untils.php';
$conn = connect();
onSes();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
//     echo "<script>alert('You are not allow to do this -_-. Please log in to continue.')
//     window.location='login.php'</script>";
//     die();
// } else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Shopping :3</title>

    <!-- Prevent Form Resubmission alert POST -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand">Shopping</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="upload.php">Upload</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="search.php">Search</a>
                </li>
            </ul>
        </div>
    </nav>