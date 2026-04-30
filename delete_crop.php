<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM crop_records WHERE record_id=$id");

header("Location: add_crop.php");
?>