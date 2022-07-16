<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "koneksi.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM data_user WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["nama"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            border: 5px solid rgb(0, 2, 20, 0.4);
            width: 500px;
            margin: 50px auto;
            background-color: rgb(0, 8, 84, 0.2);
            color: aliceblue;
        }
        .row {
            border: 1px solid yellow;
            margin: 20px 20px;
        }
        p {
            border: 1px solid gray;
            padding: 5px;
        }
        .btn-primary {
            margin-bottom: 30px;
            margin-top: 30px;
        }
        .bg-img {
            background: url("https://hargalaminate.files.wordpress.com/2018/01/bg-kayu.jpg?w=848") no-repeat center center;
            background-size: cover;
            width: 100%;
            height: 100vh;
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="bg-img">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header text-center">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>NAMA</label>
                        <p class="form-control-static"><?php echo $row["nama"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>ALAMAT</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>SALARY</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <a href="../login/data_pegawai.php" class="btn btn-primary">Back</a>
                </div>
            </div>        
        </div>
    </div>
    </div>
</body>
</html>