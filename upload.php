<?php
require_once 'header.php';
error_reporting(0);

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    echo "<script>alert('You are not allow to do this -_-. Please log in to continue.')
    window.location='index.php'</script>";
    die();
}

if (isset($_FILES) && !empty($_FILES)) {
    $dir = __DIR__ . "/upload/";
    $error = '';
    $success = '';
    try {
        $filename = $_FILES["image"]["name"];
        $uploaded_type = $_FILES['image']['type'];
        $explodedArray = explode(".", $filename);
        $extension = end($explodedArray);
        if (in_array($extension, ["php", "php2", "php3", "php4", "php5", "php6", "php7", "phps", "phps", "pht", "phtm", "phtml", "pgif", "shtml", "phar", "hphp", "ctp", "module", "asp", "aspx", "config", "ashx", "asmx", "aspq", "axd", "cshtm", "cshtml", "rem", "soap", "vbhtm", "vbhtml", "asa", "cer", "shtml"])) {
            $error .= '<p class="h5 text-danger">Hack detected.</p>';
        } else {
            $file = $dir . "/" . $filename;
            move_uploaded_file($_FILES["image"]["tmp_name"], str_replace(DIRECTORY_SEPARATOR, '/', $file));
            $id = sqlInsert($conn, 'insert into upload values (NULL, ?, ?, ?)', 'sss', $filename, $uploaded_type, $filename);
            if ($id == -1) {
                echo "<script>alert('Something wrong when insert into db.')
                    window.location='upload.php'</script>";
                die();
            }
            $success = "Successfully uploaded file at: /upload/$filename<br>";
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<body class="bg-body-tertiary">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <a href="/"><img class="d-block mx-auto mb-4" src="images/images.png" alt="" width="72"></a>
                <h2>File Upload checker</h2>
                <p class="lead">Only jpg files are supported and maximum file size is 1MB.</p>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <label class="h5 form-label">Upload your image</label>
                <input class="form-control form-control-lg my-4" name="image" type="file" required />
                <div class="col text-center">
                    <button class="btn btn-primary btn-lg" type="submit">Upload</button>
                </div>
                <!-- Black List: ["php", "php2", "php3", "php4", "php5", "php6", "php7", "phps", "phps", "pht", "phtm", "phtml", "pgif", "shtml", "phar", "hphp", "ctp", "module", "asp", "aspx", "config", "ashx", "asmx", "aspq", "axd", "cshtm", "cshtml", "rem", "soap", "vbhtm", "vbhtml", "asa", "cer", "shtml"] -->
            </form>
            <span style="color:green"><?php echo $success; ?></span>
            <?php
            echo $error;
            ?>
        </main>
    </div>
</body>

</html>