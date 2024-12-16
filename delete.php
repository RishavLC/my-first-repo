<?php
require_once('config.php');

if (!isset($_GET['id'])) {
    echo "<h1>ID is required</h1>";
    exit; 
}

$student_id = $_GET['id'];
// deletion
$sql = "DELETE FROM student WHERE sid = '$student_id'";
$row = mysqli_query($conn, $sql);

if ($row) {
    echo "Data deleted";?>
    <a href="read.php">Go Back</a>
    <?php
} else {
    echo "Error deleting data: " . mysqli_error($conn);
}
?>
<form action="" method="get">
    delete <input type="number" name="id" id="del">
</form>