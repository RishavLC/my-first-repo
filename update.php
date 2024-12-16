<?php
require_once('config.php');

// Process the form submission (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sid = $_POST['sid'];
    $sname = $_POST['name'];
    $address = $_POST['address'];

    // Update the student record in the database along with updated_date
    $sql = "UPDATE student SET sname = '$sname', address = '$address', updated_at = NOW() WHERE sid = '$sid'";
    $row = mysqli_query($conn, $sql);

    if ($row) {
        echo "Data updated Successfully";?>
        <a href="read.php">Go Back</a>
        <?php
        // header("Location: /web/labs/lab11/read.php");
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
} else {
    // Check if the 'id' is set in the URL
    if (!isset($_GET['id'])) {
        echo "<h1>ID is required</h1>";
    } else {
        $student_id = $_GET['id'];

        // Fetch the student's details from the database
        $q = "SELECT * FROM student WHERE sid = '$student_id'";
        $result = mysqli_query($conn, $q);

        if (mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "ID not found";
            exit;  // Exit if ID not found
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>
<?php if (isset($student)): ?>
    <h1>Update Student Information</h1>
    <!-- Use GET['id'] in the action attribute to retain the ID -->
    <form action="update.php?id=<?php echo $student['sid']; ?>" method="POST">
        <input type="hidden" name="sid" value="<?php echo $student['sid']; ?>"> <!-- Pass the student ID -->
        Student Name: <input type="text" name="name" id="name" value="<?php echo $student['sname']; ?>"><br>
        Address: <input type="text" name="address" id="address" value="<?php echo $student['address']; ?>"><br>
        <input type="submit" value="Update">
    </form>
<?php endif; ?>
</body>
</html>
