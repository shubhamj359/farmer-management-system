<?php
session_start();
include 'db.php';

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM income WHERE income_id=$id");
$data = $res->fetch_assoc();

$updated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $source = $_POST['source'];
    $date = $_POST['date'];

    $conn->query("UPDATE income 
                  SET amount='$amount', source='$source', date='$date'
                  WHERE income_id=$id");

    $updated = true;
}
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="topbar">
    <a href="add_income.php">
        <button class="back-btn">← Back</button>
    </a>
    <h2>💵 Edit Income</h2>
</div>

<div class="card" style="max-width:400px;margin:40px auto;text-align:center;">

<form method="POST">
    <input type="number" name="amount" value="<?php echo $data['amount']; ?>">
    <input type="text" name="source" value="<?php echo $data['source']; ?>">
    <input type="date" name="date" value="<?php echo $data['date']; ?>">

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