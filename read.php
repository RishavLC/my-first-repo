<!DOCTYPE html>
<html lang="en">
<head>
    <title>Read Operation</title>
</head>
<body>
    <?php include('menu.php'); ?>
    <?php
    require_once('config.php');
    $q = "SELECT * FROM student";
    $result = mysqli_query($conn, $q);
    ?>
    <table border="1">
        <caption>Student Records</caption>
        <thead>
            <tr>
                <th>Sid</th>
                <th>Sname</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Disabled</th>
                <th>Actions</th> <!-- Added Actions column for Edit and Delete -->
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($student = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$student['sid']."</td>";
                echo "<td>".$student['sname']."</td>";
                echo "<td>".$student['address']."</td>";
                echo "<td>".$student['created_at']."</td>";
                echo "<td>".$student['updated_at']."</td>";
                echo "<td>".$student['disabled']."</td>";
                echo "<td><a href='update.php?id=".$student['sid']."'>Update</a> | 
                      <a href='delete.php?id=".$student['sid']."'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</body>
</html>
