<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once('config.php'); // Make sure config.php connects to the database

    $sname = $_POST['name1'];  // Match the form field name
    $address = $_POST['address1']; // Match the form field name
    $created_at = date('Y-m-d');
    $updated_at = date('Y-m-d');

    // Correct SQL query to insert data
    $sql = "INSERT INTO student (sname, address, created_at, updated_at, disabled) 
            VALUES ('$sname', '$address', '$created_at', '$updated_at', 0)";
    $row = mysqli_query($conn, $sql);

    if ($row) {
        echo "Data Added Sucessfully";?>
        <a href="read.php">Go Back</a>
        <?php
        // header("Location: /web/labs/lab11/read.php"); // Redirect after successful insertion
    } else {
        echo "Error: " . mysqli_error($conn); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Student</title>
</head>
<body>
    <h1>Create New Student</h1>
    <form action="" method="post" onsubmit="return addRole(event)"> <!-- Form with POST method -->
        Student name: <input type="text" name="name1" id="name1" required><br>
        Student address: <input type="text" name="address1" id="address1" required><br>
        <input type="submit" value="Create Student"> <!-- Submit button -->
    </form>
    <div id="response page"></div>
</body>
</html>
<?php 
mysqli_close($conn);
 ?>
<script>
    function addRole(e){
        e.preventDefault();
        const name = document.getElementById("name1");
        const stataddressus = document.getElementById("address1");
        if(name.trim() == ""){
            alert("Name field cannot be empty");
            return;
        }
        console.log(name,address);
        // formData = new FormData();

    const formData = new FormData();
        formData.append('name1',name)
        formData.append('address1',address);

      const xhr= new XMLHttpRequest();
      xhr.open("POST","create.php","true");
      xhr.onload = function(){
    if(xhr.status==200){
        // handle sucess
        document.getElementById('responseMessage').innerText="success"
        '<p style="color: green:">${xhr.responseText}</p>';
        }
        else{
            // handle error
            document.getElementById('responseMessage').innerText="failed"
            '<p style="color: red:">${xhr.responseText}</p>';
        }
    };
        xhr.send(formData);
}
</script>

