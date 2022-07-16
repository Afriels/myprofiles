<?php
    require_once "koneksi.php";

    // variabel data dan inisialisasi empty values
    $nama = $address = $salary = "";
    $nama_err = $address_err = $salary_err = "";

    // proses form data ketika di submit
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // VALIDASI NAMA
        $input_nama = trim($_POST["nama"]);
        if(empty($input_nama)){
            $nama_err = "Please enter a name.";
        } elseif(!filter_var($input_nama, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $nama_err = "Please enter a valid name.";
        } else{
            $name = $input_nama;
        }

        // validasi alamat
        $input_address = trim($_POST["address"]);
        if(empty($input_address)){
            $address_err = "Please enter an address..";
        } else {
            $address = $input_address;
        }
        // validasi salary
        $input_salary = trim($_POST["salary"]);
        if(Empty($input_salary)){
            $salary_err = "Please enter salary amount";
        } elseif(!ctype_digit($input_salary)){
            $salary_err = "Please enter a positive integer value";
        } else {
            $salary =$input_salary;
        }

        // check input error sebelum memasukkan ke database
        if(empty($nama_err) && empty($alamat_err) && empty($salary_err)){
            // prepare an insert statement
            $sql = "INSERT INTO data_user (nama, address, salary) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Record</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data pegawai ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../login/data_pegawai.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>