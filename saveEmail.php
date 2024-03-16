<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    $email = $conn->real_escape_string($email);

    $insertEmailQuery = "INSERT INTO emails (email) VALUES (?)";
    $insertEmailStmt = $conn->prepare($insertEmailQuery);
    $insertEmailStmt->bind_param("s", $email);

    if ($insertEmailStmt->execute()) {
        echo "E-mail успешно сохранен!";
        header("Location: index.php");
    } else {
        echo "Ошибка при сохранении e-mail: " . $conn->error;
    }

    $insertEmailStmt->close();
}

$conn->close();
?>
