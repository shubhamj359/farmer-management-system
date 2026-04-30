<?php
include 'db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM expenses WHERE expense_id=$id");

header("Location: add_expense.php");
?>