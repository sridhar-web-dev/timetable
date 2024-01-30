<?php
error_reporting(0);
session_start();
include('./config.php');
$email = $_SESSION['email'];
if (empty($_SESSION['email'])) {
    echo "<script>window.location.replace('./login.php');</script>";
}
$select_data = "SELECT * FROM user WHERE email='" . $email . "'";
$result = mysqli_query($con, $select_data);
$row = mysqli_fetch_array($result);
if (isset($_POST['create_table'])) {
    $classname = $_POST['classname'];
    $days = (int)$_POST['days'];
    $periods = $_POST['periods'];
    $username = $_POST['username'];
    $verify = "SELECT * FROM table_details WHERE table_name='$classname'";
    $result = mysqli_query($con, $verify);
    while ($row = mysqli_fetch_assoc($result)) {
        $classname1 = $row['table_name'];
    }
    if ($classname != $classname1) {
        for ($j = 1; $j <= $days; $j++) {

            $sqli = "INSERT INTO table_details (username, table_name, days, periods) VALUES ('$username', '$classname', '$j', '$periods')";
        }
        $result = mysqli_query($con, $sqli);
        if ($result) {
            echo '<script>alert("Table Created Successfully");window.location.replace("user.php");</script>';
        }
    } else {
        echo '<script>alert("Email Address Already Exist");window.location.replace("user.php");</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <section class="my-5">
        <div class="container my-5">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5>User Dashboard</h5>
                            <a href="" class='btn btn-danger btn-sm float-end'>Logout</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>User data</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td><?php echo $row['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email Address</strong></td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone Number</strong></td>
                                        <td><?php echo $row['phone']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Manage Table</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td><?php echo $row['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email Address</strong></td>
                                            <td><?php echo $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone Number</strong></td>
                                            <td><?php echo $row['phone']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create Time Table</h5>
                        </div>
                        <div class="card-body">

                            <form name="add_name" id="add_name">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>#</th>
                                                <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM periods WHERE table_name='".$_GET['tb']."' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <th><?php echo $row['period_data']; ?></th>
                                                    <?php }
                                                ?>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Monday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Monday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                                <tr>
                                                    <td>Tuesday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Tuesday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                                <tr>
                                                    <td>Wednesday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Wednesday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                                <tr>
                                                    <td>Thursday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Thursday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                                <tr>
                                                    <td>Friday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Friday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                                <tr>
                                                    <td>Saturday</td>
                                                    <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE days='Saturday' ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><?php echo $row['period_id']; ?></td>
                                                    <?php }
                                                ?>
                                                </tr>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td width="20%" class="align-middle"><label for="type">Type</label><select name="type[]" class="form-control form-control-sm"><option value="" selected>Choose one</option><option value="Periods">Periods</option><option value="Break">Break</option></select></td><td width="30%"><label for="from">From</label><input type="time" id="start_time" name="start_time[]" class="form-control form-control-sm"></td><td width="30%"><label for="to">To</label><input type="time" id="end_time" name="end_time[]" class="form-control form-control-sm"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $('#submit').click(function() {
                $.ajax({
                    url: "name.php",
                    method: "POST",
                    data: $('#add_name').serialize(),
                    success: function(data) {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });

        });
    </script>
    <script>
        function break_change() {

            var breackinput = document.getElementById("breackinput").value;

            if (breackinput == 1) {
                document.getElementById('bp2').disabled = true;
                document.getElementById('bp3').disabled = true;
                document.getElementById('bd2').disabled = true;
                document.getElementById('bd3').disabled = true;
            } else if (breackinput == 2) {
                document.getElementById('bp2').disabled = false;
                document.getElementById('bp3').disabled = true;
                document.getElementById('bd2').disabled = false;
                document.getElementById('bd3').disabled = true;
            } else if (breackinput == 3) {
                document.getElementById('bp2').disabled = false;
                document.getElementById('bp3').disabled = false;
                document.getElementById('bd2').disabled = false;
                document.getElementById('bd3').disabled = false;
            } else {
                document.getElementById('bp2').disabled = true;
                document.getElementById('bp3').disabled = true;
                document.getElementById('bd2').disabled = true;
                document.getElementById('bd3').disabled = true;
            }

        }
    </script>
</body>

</html>