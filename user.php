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
        echo '<script>alert("Table Already Exist in this name");window.location.replace("user.php");</script>';
    }
}
if (isset($_POST['get_table'])) {
    $selected_table = $_POST['selected_table'];
    echo '<script>window.location.replace("table.php?tb=' . $selected_table . '");</script>';
}
if (isset($_POST['submit'])) {

    $table_name = $_POST['table_name'];
    $username = $_SESSION['email'];
    $type = count($_POST["type"]);


    if ($type > 1) {
        for ($i1 = 0; $i1 < $type; $i1++) {
            if (trim($_POST["type"][$i1] != '')) {
                $types = $_POST["type"][$i1];
                $sql1 = "INSERT INTO periods(username, table_name,period_data,start_time,end_time) VALUES('" . mysqli_real_escape_string($con, $username) . "','" . mysqli_real_escape_string($con, $table_name) . "','" . mysqli_real_escape_string($con, $types) . "','" . mysqli_real_escape_string($con, $_POST["start_time"][$i1]) . "','" . mysqli_real_escape_string($con, $_POST["end_time"][$i1]) . "')";
                mysqli_query($con, $sql1);
            }
        }

        $days = ['d1' => 'Monday', 'd2' => 'Tuesday', 'd3' =>  'Wednesday', 'd4' =>  'Thursday', 'd5' =>  'Friday', 'd6' =>  'Saturday'];
        foreach ($days as $d => $day) {

            for ($i = 0; $i < $type; $i++) {
                if (trim($_POST["type"][$i] != '')) {
                    $types = $_POST["type"][$i];
                    $period_id = $day . $i;
                    $sql = "INSERT INTO new_table(username,days,table_name,period_data,start_time,end_time,period_id) VALUES('" . mysqli_real_escape_string($con, $username) . "','" . mysqli_real_escape_string($con, $day) . "','" . mysqli_real_escape_string($con, $_POST["table_name"]) . "','" . mysqli_real_escape_string($con, $types) . "','" . mysqli_real_escape_string($con, $_POST["start_time"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["end_time"][$i]) . "','" . mysqli_real_escape_string($con, $period_id) . "')";
                    mysqli_query($con, $sql);
                }
            }
        }
        echo "<script>window.location.replace('table.php?tb=$table_name');</script>";
    } else {
        echo "Please Enter Name";
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
                            <a href="./logout.php?session=true" class='btn btn-danger btn-sm '>Logout</a>
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
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5>Search Table</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Select Table</label>
                                            <select name="selected_table" id="selected_table" class="form-control" required>
                                                <option value="" selected>Choose one</option>
                                                <?php
                                                include('./config.php');
                                                $query = "SELECT * FROM new_table WHERE username='".$_SESSION['email']."'  GROUP BY table_name ORDER BY id ASC";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>

                                                    <option value="<?php echo $row['table_name']; ?>"><?php echo $row['table_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-3">
                                            <input type="submit" name="get_table" id="get_table" class="btn btn-primary float-end" value="Show Table">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Create Time Table</h5>
                        </div>
                        <div class="card-body">
                            <form name="add_name" id="add_name" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['email']; ?>">
                                            <label for="classname" class="form-label">Enter Table Name</label>
                                            <input type="text" class="form-control form-control-sm" name="table_name" id="table_name" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h5>Periods </h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <tr>
                                                    <td width="20%" class="align-middle">
                                                        <label for="type">Type</label><select name="type[]" class='form-control form-control-sm' required>
                                                            <option value="" selected>Choose one</option>
                                                            <option value="Periods">Periods</option>
                                                            <option value="Break">Break</option>
                                                        </select>
                                                    </td>
                                                    <td width="30%">
                                                        <label for="from">From</label>
                                                        <input type="time" id="start_time" name="start_time[]" class='form-control form-control-sm'>
                                                    </td>
                                                    <td width="30%">
                                                        <label for="to">To</label>
                                                        <input type="time" id="end_time" name="end_time[]" class='form-control form-control-sm'>
                                                    </td>

                                                    <td width="10%" class="align-middle"><button type="button" name="add" id="add" class="btn btn-success btn-sm">Add</button></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" />
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

            // $('#submit').click(function() {
            //     $.ajax({
            //         url: "name.php",
            //         method: "POST",
            //         data: $('#add_name').serialize(),
            //         success: function(data) {
            //             // alert(data);
            //             // $('#add_name')[0].reset();
            //             $value = $('#table_name').val();
            //             window.location.replace("table.php?tb=$value");
            //         }
            //     });
            // });

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