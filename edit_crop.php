<?php
session_start();
include 'db.php';

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM crop_records WHERE record_id=$id");
$data = $res->fetch_assoc();

$crops = $conn->query("SELECT * FROM crops");

$updated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crop = $_POST['crop'];
    $sowing = $_POST['sowing'];
    $harvest = $_POST['harvest'];
    $yield = $_POST['yield'];

    $conn->query("UPDATE crop_records 
                  SET crop_id=$crop, sowing_date='$sowing', harvest_date='$harvest', yield='$yield'
                  WHERE record_id=$id");

    $updated = true;
}
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<div class="topbar">
    <a href="add_crop.php">
        <button class="back-btn">← Back</button>
    </a>
    <h2>🌱 Edit Crop</h2>
</div>

<div class="card" style="max-width:400px;margin:40px auto;text-align:center;">

<form method="POST">

<select name="crop">
<?php while($row = $crops->fetch_assoc()) { ?>
<option value="<?php echo $row['crop_id']; ?>"
<?php if($row['crop_id'] == $data['crop_id']) echo "selected"; ?>>
<?php echo $row['name']; ?>
</option>
<?php } ?>
</select>

<input type="date" name="sowing" value="<?php echo $data['sowing_date']; ?>">
<input type="date" name="harvest" value="<?php echo $data['harvest_date']; ?>">
<input type="number" name="yield" value="<?php echo $data['yield']; ?>">

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