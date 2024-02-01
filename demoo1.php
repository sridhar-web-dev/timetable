<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the timetable input from the form
    $timetableInput = $_POST['timetable'];

    // Split the input into lines
    $lines = explode("\n", $timetableInput);

    // Display the timetable
    echo "<h2>Timetable</h2>";
    echo "<ul>";

    $currentTime = strtotime("09:00 AM"); // Starting time

    foreach ($lines as $line) {
        // Split each line into event
        $event = trim($line);

        if ($event === "Break") {
            // Handle break, add 15 minutes
            $currentTime += 15 * 60; // 15 minutes in seconds
            echo "<li><strong>" . date("h:i A", $currentTime) . ":</strong> Break</li>";
        } else {
            // Display the event, add 45 minutes
            echo "<li><strong>" . date("h:i A", $currentTime) . ":</strong> $event</li>";
            $currentTime += 45 * 60; // 45 minutes in seconds
        }
    }

    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Form</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="timetable">Enter your timetable:</label><br>
        <textarea id="timetable" name="timetable" rows="5" cols="50"></textarea><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
