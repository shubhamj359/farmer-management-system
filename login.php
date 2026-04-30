<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM farmers WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['farmer_id'] = $row['farmer_id'];
    header("Location: dashboard.php");
} else {
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login Failed</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e74c3c, #ff7675);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    width: 300px;
}

.card h2 {
    color: #e74c3c;
}

a {
    display: inline-block;
    margin-top: 15px;
    color: white;
    background: #e74c3c;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}
</style>

</head>
<body>

<div class="card">
    <h2>❌ Invalid Credentials</h2>
    <p>Please try again.</p>
    <a href="login.html">Back to Login</a>
</div>

</body>
</html>

<?php } ?>