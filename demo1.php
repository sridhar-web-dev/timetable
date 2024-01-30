<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Time Input Mask</title>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Inputmask library -->
  <script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2>Time Input Mask</h2>
  
  <form>
    <div class="form-group">
      <label for="timeInput">Enter Time:</label>
      <input type="text" class="form-control" id="timeInput" placeholder="HH:mm" required>
    </div>
  </form>
</div>

<script>
  $(document).ready(function(){
    // Apply input mask for time
    $('#timeInput').inputmask('99:99 AM/PM', { placeholder: 'hh:mm AM/PM' });
  });
</script>

</body>
</html>
