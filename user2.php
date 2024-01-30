
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
                            <form action="" method='POST'>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['email']; ?>">
                                            <label for="classname" class="form-label">Enter Class Name</label>
                                            <input type="text" class="form-control" name="classname" id="classname" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="days" class="form-label">Number of days</label>
                                            <input type="text" class="form-control" name="days" id="days" aria-describedby="emailHelp" value='7'>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="periods" class="form-label">Number of Periods</label>
                                            <input type="number" class="form-control" name="periods" id="periods" min="1" max="10" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Periods start with</label>
                                            <input type="time" class="form-control" name="name" id="name" min="1" max="10" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Periods duration (in Mins)</label>
                                            <input type="number" class="form-control" name="name" id="name" min="1" max="10" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="breackinput" class="form-label">No of Breaks</label>
                                            <select class="form-select" name="breackinput" id="breackinput" aria-label="Default select example" onchange="break_change()">

                                                <option value="1" selected>One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Break 1:after the period of</label>
                                            <input type="number" class="form-control" name="bp1" id="bp1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Duration of this break(in mins)</label>
                                            <input type="text" class="form-control" name="bd1" id="bd1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Break 2:after the period of</label>
                                            <input type="text" class="form-control" name="bp2" id="bp2" aria-describedby="emailHelp" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Duration of this break(in mins)</label>
                                            <input type="text" class="form-control" name="bd2" id="bd2" aria-describedby="emailHelp" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Break 3:after the period of</label>
                                            <input type="text" class="form-control" name="bp3" id="bp3" aria-describedby="emailHelp" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">
                                            <label for="name" class="form-label">Duration of this break(in mins)</label>
                                            <input type="text" class="form-control" name="bd3" id="bd3" aria-describedby="emailHelp" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-2">

                                            <input type="submit" class="btn btn-sm- btn-info my-3" name="create_table" id="create_table" value="Create Table">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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