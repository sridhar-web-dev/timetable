 <?php  
 //fetch.php  
 $con = mysqli_connect("localhost", "root", "", "school");  
 if(isset($_POST["tableedit"]))  
 {  
      $query = "SELECT * FROM new_table WHERE period_id = '".$_POST["tableedit"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>