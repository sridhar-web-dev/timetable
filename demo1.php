<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timetable</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>

<?php
// Function to generate timetable HTML
function generateTimetable($periods) {
  echo '<table>';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Time</th>';
  echo '<th>Period</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  $startTime = strtotime('08:00 AM'); // Adjust the start time as needed

  for ($i = 1; $i <= $periods; $i++) {
    $endTime = strtotime("+45 minutes", $startTime);
    $formattedStartTime = date('h:i A', $startTime);
    $formattedEndTime = date('h:i A', $endTime);

    echo '<tr>';
    echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
    echo '<td>Period ' . $i . '</td>';
    echo '</tr>';

    $startTime = $endTime; // Move to the next period
  }

  echo '</tbody>';
  echo '</table>';
}

// Generate timetable for 8 periods (adjust as needed)
generateTimetable(8);
?>

</body>
</html>
