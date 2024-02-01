<?php 

if(isset($_POST['submit']))
{
    $time = $_POST['time'];
    $mins = $_POST['mins'];
    $periods = $_POST['periods'];
    $inputs = [2, 4];
    // $dataArray = [];
    
    $t = date('h:i A', strtotime($time));
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

   // Adjust the start time as needed
  //  $startTime = date('h:i A', strtotime($time));
  $startTime = strtotime('$t');
  $breakDuration = 15;
  for ($i = 1; $i <= $periods; $i++) {
    $endTime = strtotime("+30 minutes", $startTime);
    $formattedStartTime = date('h:i A', $startTime);
    $formattedEndTime = date('h:i A', $endTime);

    echo '<tr>';
    echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
    echo '<td>Period ' . $i . '</td>';
    echo '</tr>';
    if (in_array($i, $inputs)) {
      $startTime = $endTime;
      $endTime = strtotime("+15 minutes", $startTime);
      $formattedStartTime = date('h:i A', $startTime);
      $formattedEndTime = date('h:i A', strtotime("+{$breakDuration} minutes", $startTime));
      echo '<tr>';
    echo '<td>' . $formattedStartTime . ' - ' . $formattedEndTime . '</td>';
    echo '<td>Break ' . $i . '</td>';
    echo '</tr>';
    }
    $startTime = $formattedEndTime; 
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
        <input type="text" name="break" id="break" placeholder="break">
        <input type="text" name="break1" id="break1" placeholder="break1">
        <input type="submit" name="submit" value="submit">
    </form>

</body>
</html>