<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timetable with Breaks</title>
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
// Function to generate timetable with breaks
function generateTimetable($periods) {
  echo '<table>';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Time</th>';
  echo '<th>Activity</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  $startTime = strtotime('08:00 AM'); // Adjust the start time as needed
  $breakDuration = 15; // Break duration in minutes

  for ($i = 1; $i <= $periods; $i++) {
    $endTime = strtotime("+$breakDuration minutes", $startTime);
    $formattedStartTime = date('h:i A', $startTime);
    $formattedEndTime = date('h:i A', $endTime);

    echo '<tr>';
    echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
    echo '<td>Period ' . $i . '</td>';
    echo '</tr>';

    // Add break after each period, except the last one
    if ($i < $periods) {
      $startTime = strtotime("+{$breakDuration} minutes", $endTime);
      $formattedStartTime = date('h:i A', $startTime);
      $formattedEndTime = date('h:i A', strtotime("+{$breakDuration} minutes", $startTime));

      echo '<tr>';
      echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
      echo '<td>Break</td>';
      echo '</tr>';
    }

    $startTime = strtotime("+$breakDuration minutes", $endTime); // Move to the next period
  }

  echo '</tbody>';
  echo '</table>';
}

// Generate timetable for 4 periods with breaks (adjust as needed)
generateTimetable(4);
?>

</body>
</html>
