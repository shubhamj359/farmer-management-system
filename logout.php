<?php
session_start();
session_destroy();
header("Location: login.html");
exit();
?>
<script>
function toggleDark() {
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")) {
        localStorage.setItem("darkMode", "on");
    } else {
        localStorage.setItem("darkMode", "off");
    }
}

// Apply saved mode
window.onload = function() {
    if(localStorage.getItem("darkMode") === "on") {
        document.body.classList.add("dark");
    }
}
</script>