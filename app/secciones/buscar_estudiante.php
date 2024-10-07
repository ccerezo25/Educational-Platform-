<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alumnos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];
$response = array();

$sql = "SELECT * FROM alumnos WHERE cedula = ? OR nombre LIKE ?";
$stmt = $conn->prepare($sql);
$param = "%" . $query . "%";
$stmt->bind_param("ss", $query, $param);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $response = $row;
}

echo json_encode($response);

$conn->close();
?>
