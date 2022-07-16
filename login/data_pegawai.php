<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 80%;
            margin: 0 auto;
        }
        .btn {
            margin-right: 10px;
            margin-top: 16px;
        }
        .bg-img {
            background: url('https://jayaimperialpark.com/wp-content/uploads/2019/02/14.png') no-repeat center center;
            width: 100%;
            height: 100vh;
            background-size: cover;
        }
        tr {
            background-color: darkolivegreen;
            color: white;
        }
        td:hover {
            background-color: darkolivegreen;
            color: white;
        }
        td {
            background-color: darkkhaki;
            color: black;
        }
        .page-header h2{
            text-align: center;
            color: whitesmoke;
            text-shadow: 2px 2px 3px black;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    
    <div class="bg-img">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Informasi Pegawai</h2>
                        <div><a href="create.php" class="btn btn-success pull-right">Tambah Baru</a></div>
                        <div><a href="../login/halaman_admin.php" class="btn btn-success pull-right">Kembali</a></div>
                    </div>
                    <?php
                    // Include config file
                    require_once "koneksi.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM data_user";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-dark table-hover'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>NAMA</th>";
                                        echo "<th>ALAMAT</th>";
                                        echo "<th>SALARY</th>";
                                        echo "<th>PENGATURAN</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>