<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Spreadsheet Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
</html>
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// var_dump($_POST);


// Connect to the database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "from_java";

// $conn = mysqli_connect($servername, $username, $password, $dbname);

include 'functions.php';

// Connect to the database
$conn = dbConnect();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if (isset($_POST["submit"])) {
    // Get the uploaded file
    $file = $_FILES["file"]["tmp_name"];

    // Load the Excel file using PhpSpreadsheet
    require_once('vendor/autoload.php');
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

    // Get the first sheet
    $worksheet = $spreadsheet->getActiveSheet();

    // Loop through each row in the sheet
    $rowIterator = $worksheet->getRowIterator();
    //skip the first row which has headers
    $rowIterator->next();

    // Sucess message
    $successMessage = '';
    $ErrorMessage = '';

    while ($rowIterator->valid()) {
        // Get the cell data as an array
        $cellIterator = $rowIterator->current()->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        $cellData = [];
        foreach ($cellIterator as $cell) {
            $cellData[] = $cell->getValue();
        }

        // Insert the data into the database
        $sql = "INSERT INTO `employees`(`username`, `firstname`, `surname`, `password`, `contact`)
        VALUES ('" . $cellData[0] . "', '" . $cellData[1] . "', '" . $cellData[2] . "', '" . $cellData[3] . "', '" . $cellData[4] . "')";

        if (mysqli_query($conn, $sql)) {
            $successMessage = "Record updated successfully.<br>";  
        } else {
            $ErrorMessage .= mysqli_error($conn);
        }

        $rowIterator->next();
    }

    // Check if any records were added or updated
    if (!empty($successMessage)) {
        // Display the success message
        echo '<div class="alert alert-success" role="alert">' . $successMessage . '</div>';
        header("Location: employee_table.php");
        exit;
    }

    // Check if any records were not added or updated
    if (!empty($ErrorMessage)) {
        // Display the success message
        echo '<div class="alert alert-danger" role="alert">' . $ErrorMessage . '</div>';
    }

        // Close the Excel file
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

} else {
    echo '<div class="alert alert-danger" role="alert">File not uploaded.</div>';
}

// Close the database connection
mysqli_close($conn);
?>