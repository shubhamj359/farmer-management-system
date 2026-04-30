<?php
session_start();
include 'db.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.html");
    exit();
}

$id = $_SESSION['farmer_id'];

// Farmer info
$user = $conn->query("SELECT * FROM farmers WHERE farmer_id=$id");
$farmer = $user->fetch_assoc();

// Totals
$exp = $conn->query("SELECT SUM(amount) as total FROM expenses WHERE farmer_id=$id");
$expTotal = $exp->fetch_assoc()['total'] ?? 0;

$inc = $conn->query("SELECT SUM(amount) as total FROM income WHERE farmer_id=$id");
$incTotal = $inc->fetch_assoc()['total'] ?? 0;

$profit = $incTotal - $expTotal;

// Crop count
$crop = $conn->query("SELECT COUNT(*) as total FROM crop_records WHERE farmer_id=$id");
$cropTotal = $crop->fetch_assoc()['total'];
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<!-- TOPBAR -->
<div class="topbar">
    <h2>Hi <?php echo $farmer['name']; ?> 👋</h2>

    <div>
        <span><?php echo date("d M Y"); ?></span>
        <button class="dark-btn" onclick="toggleDark()">🌙</button>
    </div>
</div>

<!-- INFO -->
<div class="card">
    📍 Village: <?php echo $farmer['village']; ?>
</div>

<!-- CARDS -->
<div class="card">
    <h3>💰 Total Expense</h3>
    <p>₹<?php echo $expTotal; ?></p>
</div>

<div class="card">
    <h3>💵 Total Income</h3>
    <p>₹<?php echo $incTotal; ?></p>
</div>

<div class="card">
    <h3>📈 Profit</h3>
    <p>₹<?php echo $profit; ?></p>
</div>

<div class="card">
    <h3>🌱 Crops</h3>
    <p><?php echo $cropTotal; ?></p>
</div>

</div>

<!-- POPUP -->
<div class="popup" id="popup">Welcome Back 👋</div>

<script>
// DARK MODE
function toggleDark() {
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")) {
        localStorage.setItem("darkMode", "on");
    } else {
        localStorage.setItem("darkMode", "off");
    }
}

// LOAD DARK MODE
window.onload = function() {
    if(localStorage.getItem("darkMode") === "on") {
        document.body.classList.add("dark");
    }

    showPopup();
}

// POPUP
function showPopup() {
    let p = document.getElementById("popup");
    p.style.display = "block";
    setTimeout(() => p.style.display = "none", 2000);
}
</script>