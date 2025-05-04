<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "user_db");

    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "❌ Database connection failed."]);
        exit();
    }

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];

            echo json_encode(["status" => "success", "redirect" => "index.php"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Invalid email or password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Invalid email or password."]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(["status" => "error", "message" => "⚠️ Invalid Request Method"]);
}
?>
