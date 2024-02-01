<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all input fields are set and not empty
    $inputs = ['input1', 'input2', 'input3', 'input4'];
    $dataArray = [];

    // $allInputsProvided = true;

    foreach ($inputs as $inputName) {
        if (isset($_POST[$inputName])) {
            // Trim spaces from the input
            $dataArray[$inputName] = trim($_POST[$inputName]);
        } else {
            $allInputsProvided = false;
            break;
        }
    }

    // if ($allInputsProvided) {
        // Now, $dataArray contains the values from all four input fields
        // $value = array_values($dataArray);
        // print_r($value);
        echo $dataArray['input1'];
    // } else {
    //     echo "Please fill in all four input fields.";
    // }
}
?>
<form method="post" action="">
    <label for="input1">Input 1: </label>
    <input type="text" name="input1" id="input1"><br>

    <label for="input2">Input 2: </label>
    <input type="text" name="input2" id="input2"><br>

    <label for="input3">Input 3: </label>
    <input type="text" name="input3" id="input3"><br>

    <label for="input4">Input 4: </label>
    <input type="text" name="input4" id="input4"><br>

    <input type="submit" value="Submit">
</form>

