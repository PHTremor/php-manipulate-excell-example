<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "from_java";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$sql = "SELECT * FROM employees";
$result = mysqli_query($conn, $sql);

// Generate the HTML table
$table = '<table class="table table-striped">';
$table .= '<thead>';
$table .= '<tr>';
$table .= '<th>ID</th>';
$table .= '<th>Username</th>';
$table .= '<th>First Name</th>';
$table .= '<th>Surname</th>';
$table .= '<th>Password</th>';
$table .= '<th>Contact</th>';
$table .= '</tr>';
$table .= '</thead>';
$table .= '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    $table .= '<tr>';
    $table .= '<td>' . $row['id'] . '</td>';
    $table .= '<td>' . $row['username'] . '</td>';
    $table .= '<td>' . $row['firstname'] . '</td>';
    $table .= '<td>' . $row['surname'] . '</td>';
    $table .= '<td>' . $row['password'] . '</td>';
    $table .= '<td>' . $row['contact'] . '</td>';
    $table .= '</tr>';
}

$table .= '</tbody>';
$table .= '</table>';

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Spreadsheet Example with Bootstrap 5</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Include the navbar file -->
    <?php include 'nav_bar.php'; ?>
    
    <div class="container">
        <h1>Employee Table</h1>
        <?php echo $table; ?>
    </div>
</body>
</html>