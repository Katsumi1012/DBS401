<?php
require_once 'header.php';
$reses = [];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    echo "<script>alert('You are not allow to do this -_-. Please log in to continue.')
    window.location='index.php'</script>";
    die();
}

if (isset($_POST['search'])) {
    $sr = $_POST['find'];
    $sql = "select * from upload where name='$sr'";
    try {
        $result = mysqli_query($conn, $sql);

        // Check for errors in the query execution
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        // Fetch and display the data
        if (($result->num_rows) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name = $row[1];
                $type = $row[2];

                $res = "<div class='card'>
                            <div class='card-body text-center'>
                                <h5 class='card-title'>$name</h5>
                                <p class='card-text'>Type: $type</p>
                            </div>                   
                        </div>";
                $reses[] = $res;
            }
        }
    } catch (Exception $e) {
        $res = $e;
        $reses[] = $res;
    }
    unset($_POST['search']);
}
?>

<body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Upload</h1>
        <p class="lead">Find your uploaded file here!</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <div class="mb-3">
                    <form action="" method="post">
                        <input type="text" class="form-control" id="find" placeholder="Enter something here" name="find" required="">
                        <br>
                        <button class="btn btn-primary btn-lg btn-block" type="submit" name="search">Search</button>
                    </form>
                </div>

            </div>
        </div>
        <div class='card-deck'>
            <?php
            if (isset($reses) && !empty($reses)) {
                foreach ($reses as $res) {
                    echo $res;
                }
            } else {
                echo "<h2>Find something??</h2>";
            }
            ?>
        </div>
    </div>
</body>