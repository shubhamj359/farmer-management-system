<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: add_expense.php");
    exit();
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM expenses WHERE expense_id=$id");
$data = $res->fetch_assoc();

$updated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $date = $_POST['date'];

    $conn->query("UPDATE expenses 
                  SET amount='$amount', type='$type', date='$date'
                  WHERE expense_id=$id");

    $updated = true;
}
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="topbar">
    <a href="add_expense.php">
        <button class="back-btn">← Back</button>
    </a>
    <h2>✏️ Edit Expense</h2>
</div>

<div class="card" style="max-width:400px;margin:40px auto;text-align:center;">

<form method="POST">
    <input type="number" name="amount" value="<?php echo $data['amount']; ?>" required>
    <input type="text" name="type" value="<?php echo $data['type']; ?>" required>
    <input type="date" name="date" value="<?php echo $data['date']; ?>" required>

    <button class="edit-btn">Update</button>
</form>

</div>

</div>

<div class="popup" id="popup">Updated Successfully ✅</div>

<script>
function showPopup() {
    let p = document.getElementById("popup");
    p.style.display = "block";
    setTimeout(() => p.style.display = "none", 2000);
}

<?php if($updated){ ?>
showPopup();
<?php } ?>
</script>