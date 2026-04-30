<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM income WHERE income_id=$id");

header("Location: add_income.php");
?>