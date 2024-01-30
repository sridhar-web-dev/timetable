<?php
$con = mysqli_connect("localhost", "root", "", "school");
$type = count($_POST["type"]);
if($type > 1)
{
    $days = ['d1' => 'Monday', 'd2' => 'Tuesday','d3' =>  'Wednesday','d4' =>  'Thursday','d5' =>  'Friday'];
    foreach ($days as $d => $day) {
        
	for($i=0; $i<$type; $i++)
	{
		if(trim($_POST["type"][$i] != ''))
		{
            $types = $_POST["type"][$i];
            $period_id = $day . $i; 
			$sql = "INSERT INTO new_table(days,table_name,period_data,start_time,end_time,period_id) VALUES('".mysqli_real_escape_string($con, $day)."','".mysqli_real_escape_string($con, $_POST["table_name"])."','".mysqli_real_escape_string($con, $types)."','".mysqli_real_escape_string($con, $_POST["start_time"][$i])."','".mysqli_real_escape_string($con, $_POST["end_time"][$i])."','".mysqli_real_escape_string($con, $period_id)."')";
			mysqli_query($con, $sql);
		}
	}
}
	echo "Data Inserted";
}
else
{
	echo "Please Enter Name";
}