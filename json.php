<?php
header('Content-Type: application/json');

$data = array(
    'name' => 'John Doe',
    'age' => 35,
    'email' => 'john.doe@example.com'
);

echo json_encode($data);
?>