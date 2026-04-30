<?php
session_start();
include 'db.php';

$id = $_SESSION['farmer_id'];

// Monthly data
$data = $conn->query("
    SELECT MONTH(date) as month, SUM(amount) as total 
    FROM expenses 
    WHERE farmer_id=$id 
    GROUP BY MONTH(date)
");

$months = [];
$totals = [];

while($row = $data->fetch_assoc()) {
    $months[] = $row['month'];
    $totals[] = $row['total'];
}
?>

<link rel="stylesheet" href="style.css">
<?php include 'sidebar.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main">

<h2>📊 Monthly Expense Report</h2>

<canvas id="chart"></canvas>

</div>

<script>
new Chart(document.getElementById("chart"), {
    type: 'line',
    data: {
        labels: <?php echo json_encode($months); ?>,
        datasets: [{
            label: 'Monthly Expense',
            data: <?php echo json_encode($totals); ?>
        }]
    }
});
</script>