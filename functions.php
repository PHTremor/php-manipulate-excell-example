<?php

function dbConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "from_java";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

function dbQuery($conn, $sql) {
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result;
}

function dbClose($conn) {
    mysqli_close($conn);
}

// adds an employee
function addEmployee($conn, $name, $email, $phone) {
    $sql = "INSERT INTO employees (name, email, phone) VALUES ('$name', '$email', '$phone')";

    if (dbQuery($conn, $sql)) {
        echo "Record added successfully.<br>";
    } else {
        echo "Error adding record: " . mysqli_error($conn) . "<br>";
    }
}

// updates an employee
function updateEmployee($conn, $id, $name, $email, $phone) {
    $sql = "UPDATE employees SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if (dbQuery($conn, $sql)) {
        echo "Record updated successfully.<br>";
    } else {
        echo "Error updating record: " . mysqli_error($conn) . "<br>";
    }
}

// gets employees
function getEmployees($conn) {
    $sql = "SELECT * FROM employees";
    $result = dbQuery($conn, $sql);

    $employees = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }

    return $employees;
}

// displays employees in a table 
function displayEmployees($employees) {
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($employees as $employee) {
        echo "<tr>";
        echo "<td>{$employee['id']}</td>";
        echo "<td>{$employee['name']}</td>";
        echo "<td>{$employee['email']}</td>";
        echo "<td>{$employee['phone']}</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

?>
