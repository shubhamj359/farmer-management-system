<?php
session_start();
include 'db.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.html");
    exit();
}

$id = $_SESSION['farmer_id'];

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $source = $_POST['source'];
    $date = $_POST['date'];

    $conn->query("INSERT INTO income(farmer_id, amount, source, date)
                  VALUES($id, $amount, '$source', '$date')");
}

// FETCH
$res = $conn->query("SELECT * FROM income WHERE farmer_id=$id");
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<h2>💵 Income</h2>

<form method="POST" class="card">
    <input type="number" name="amount" placeholder="Amount" required><br><br>
    <input type="text" name="source" placeholder="Source" required><br><br>
    <input type="date" name="date" required><br><br>

    <button>Add Income</button>
</form>

<h3>All Income</h3>

<?php
while($row = $res->fetch_assoc()) {
    echo "<div class='card'>
            ₹{$row['amount']} - {$row['source']}

            <a href='edit_income.php?id={$row['income_id']}'>
                <button>Edit</button>
            </a>

            <a href='delete_income.php?id={$row['income_id']}' 
               onclick=\"return confirm('Are you sure?')\">
                <button class='delete-btn'>Delete</button>
            </a>
          </div>";
}
?>

</div>