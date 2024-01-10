<!DOCTYPE html>
<head>
    <title>Edit Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>EDIT STUDENT DETAILS</h1>

    <?php
    include("database.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $student_id = $_GET["id"];

        // Fetch the student details based on the ID
        $sql = "SELECT * FROM reg WHERE id = '$student_id'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <div class="login">
                <form id="editForm" name="editForm" action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="input-box">
                        <label for="name">STUDENT NAME</label>
                        <input name="name" id="name" type="text" placeholder="NAME" value="<?php echo $row['name']; ?>" required>
                    </div>

                    <div class="input-box">
                        <label for="email">STUDENT EMAIL</label>
                        <input name="email" id="email" type="text" placeholder="EMAIL" value="<?php echo $row['email']; ?>" required>
                    </div>

                    <div class="input-box">
                        <label for="mobile">STUDENT MOBILE NO.</label>
                        <input name="mobile" id="mobile" type="phone" placeholder="MOB NO." value="<?php echo $row['mobile']; ?>" required>
                    </div>

                    <div class="input-box">
                        <label for="address">STUDENT ADDRESS</label>
                        <input name="address" id="address" type="text" placeholder="ADDRESS" value="<?php echo $row['address']; ?>" required>
                    </div>

                    <div class="input-box">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
    <?php
        } else {
            echo "<p>No student found with the given ID.</p>";
        }
    } else {
        echo "<p>Invalid request.</p>";
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        // Update query
        $update_sql = "UPDATE reg SET name = '$name', email = '$email', mobile = '$mobile', address = '$address' WHERE id = '$id'";
        
        if ($con->query($update_sql) === TRUE) {
            // Redirect to display.php upon successful update
            header("Location: display.php");
            exit();
        } else {
            echo "Error updating record: " . $con->error;
        }
    }

    // Close the database connection
    mysqli_close($con);
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="index.js"></script>


    
</body>
</html>
