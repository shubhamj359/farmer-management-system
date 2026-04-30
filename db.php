<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "farmer-system";
$port = 3307; // IMPORTANT: your MySQL port

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<script>
function toggleDark() {
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")) {
        localStorage.setItem("darkMode", "on");
    } else {
        localStorage.setItem("darkMode", "off");
    }
}

// Apply saved mode
window.onload = function() {
    if(localStorage.getItem("darkMode") === "on") {
        document.body.classList.add("dark");
    }
}
</script>

