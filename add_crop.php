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
    $crop = $_POST['crop'];
    $sowing = $_POST['sowing'];
    $harvest = $_POST['harvest'];
    $yield = $_POST['yield'];

    $conn->query("INSERT INTO crop_records(farmer_id, crop_id, sowing_date, harvest_date, yield)
                  VALUES($id, $crop, '$sowing', '$harvest', $yield)");
}

// FETCH crops dropdown
$crops = $conn->query("SELECT * FROM crops");

// FETCH records
$records = $conn->query("
    SELECT cr.*, c.name 
    FROM crop_records cr
    JOIN crops c ON cr.crop_id = c.crop_id
    WHERE cr.farmer_id = $id
");
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<div class="main">

<h2>🌱 Crops</h2>

<form method="POST" class="card">
    <select name="crop">
        <?php while($row = $crops->fetch_assoc()) { ?>
            <option value="<?php echo $row['crop_id']; ?>">
                <?php echo $row['name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    <input type="date" name="sowing" required><br><br>
    <input type="date" name="harvest" required><br><br>
    <input type="number" name="yield" placeholder="Yield" required><br><br>

    <button>Add Crop</button>
</form>

<h3>All Crops</h3>

<?php
while($row = $records->fetch_assoc()) {
    echo "<div class='card'>
            🌱 {$row['name']} | Yield: {$row['yield']}

            <a href='edit_crop.php?id={$row['record_id']}'>
                <button>Edit</button>
            </a>

            <a href='delete_crop.php?id={$row['record_id']}' 
               onclick=\"return confirm('Are you sure?')\">
                <button class='delete-btn'>Delete</button>
            </a>
          </div>";
}
?>

</div>