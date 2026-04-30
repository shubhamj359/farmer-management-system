<?php
session_start();
include 'db.php';

// Check login
if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.html");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

// INSERT EXPENSE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $date = $_POST['date'];

    $sql = "INSERT INTO expenses(farmer_id, amount, type, date)
            VALUES('$farmer_id', '$amount', '$type', '$date')";
    $conn->query($sql);
}

// FETCH EXPENSES
$res = $conn->query("SELECT * FROM expenses WHERE farmer_id='$farmer_id'");

?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="topbar">
    <h2>💰 Expenses</h2>
</div>

<!-- ADD FORM -->
<div class="card">
    <form method="POST">
        <input type="number" name="amount" placeholder="Amount" required><br><br>
        <input type="text" name="type" placeholder="Type (Seeds, Fertilizer)" required><br><br>
        <input type="date" name="date" required><br><br>
        <button>Add Expense</button>
    </form>
</div>

<!-- DISPLAY DATA -->
<h3>All Expenses</h3>

<?php
if ($res && $res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        echo "<div class='card'>
                ₹{$row['amount']} - {$row['type']} ({$row['date']})

                <div style='margin-top:10px;'>
                    <a href='edit_expense.php?id={$row['expense_id']}'>
                        <button class='edit-btn'>Edit</button>
                    </a>

                    <a href='delete_expense.php?id={$row['expense_id']}'
                       onclick=\"return confirm('Delete this expense?')\">
                        <button class='delete-btn'>Delete</button>
                    </a>
                </div>
              </div>";
    }
} else {
    echo "<div class='card'>No expenses added yet.</div>";
}
?>

</div>