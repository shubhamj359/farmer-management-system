<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$village = $_POST['village'];

// Check if email exists
$check = $conn->query("SELECT * FROM farmers WHERE email='$email'");

if ($check->num_rows > 0) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Error</title>

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
    <h2>⚠️ Email Already Exists</h2>
    <p>Please login instead.</p>
    <a href="login.html">Go to Login</a>
</div>

</body>
</html>

<?php
} else {

$conn->query("INSERT INTO farmers(name,email,password,village)
              VALUES('$name','$email','$password','$village')");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Success</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
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
    color: #27ae60;
}

a {
    display: inline-block;
    margin-top: 15px;
    color: white;
    background: #27ae60;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}
</style>

</head>
<body>

<div class="card">
    <h2>✅ Signup Successful</h2>
    <p>Your account has been created.</p>
    <a href="login.html">Login Now</a>
</div>

</body>
</html>

<?php } ?>