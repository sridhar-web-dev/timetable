<?php 

if(isset($_POST['submit']))
{
    $time = $_POST['time'];
    $mins = $_POST['mins'];
    $periods = $_POST['periods'];
    echo date('h:i A', strtotime($time));
    echo $mins;
    echo $periods; 
    echo '<table>';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Time</th>';
  echo '<th>Period</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

  $startTime = strtotime('h:i A', strtotime($time)); // Adjust the start time as needed

  for ($i = 1; $i <= $periods; $i++) {
    $endTime = strtotime("+$mins minutes", $startTime);
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="time" name="time" id="time">
        <input type="text" name="mins" id="mins" placeholder='mins'>
        <input type="text" name="periods" id="periods" placeholder="periods">
        <input type="submit" name="submit" value="submit">
    </form>

</body>
</html>