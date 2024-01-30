<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the period count from the form
    $periodCount = $_POST["periodCount"];

    // Days of the week
    $days = ['d1' => 'Monday', 'd2' => 'Tuesday','d3' =>  'Wednesday','d4' =>  'Thursday','d5' =>  'Friday'];

    // Clear existing data in the tables
    // $conn->query("TRUNCATE TABLE days");
    // $conn->query("TRUNCATE TABLE timetable");

    // Insert days into the 'days' table
    foreach ($days as $day_id => $day) {
        $sql = "INSERT INTO days (day_name, day_id) VALUES ('$day', '$day_id')";
        $conn->query($sql);
    }

    // Generate timetable data based on the period count
    for ($period = 1; $period <= $periodCount; $period++) {
        foreach ($days as $day) {
            $startTime = date('H:i', strtotime("09:00:00") + ($period - 1) * 60 * 45);
            $endTime = date('H:i', strtotime("05:00:00") + ($period - 1) * 60 * 45);

            $className = "Class $period";
            $teacherName = "Teacher $period";
            $subjectName = "Subject $period";

            // Get day_id from 'days' table
            $result = $conn->query("SELECT day_id, day_name FROM days WHERE day_name = '$day'");
            $row = $result->fetch_assoc();
            $dayId = $row['day_id'];
            $day_name = $row['day_name'];

            // Insert data into 'timetable' table
            $sql = "INSERT INTO timetable (day_id, day_name, start_time, end_time, class_name, teacher_name, subject_name)
                    VALUES ('$dayId', '$day_name',  '$startTime', '$endTime', '$className', '$teacherName', '$subjectName')";
            $conn->query($sql);
        }
    }

    echo "Timetable created successfully!";
} 

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Timetable Generator</title>
</head>
<body>
    <h2>Dynamic Timetable Generator</h2>
    
    <form action="" method="post">
        <label for="periodCount">Enter the number of periods:</label>
        <input type="number" name="periodCount" id="periodCount" required>
        
        <br>
        
        <input type="submit" value="Generate Timetable">
    </form>
</body>
</html>
