<?php
$insert = false;
if(isset($_POST['name'])) {
    include("database.php");

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $sql = "INSERT INTO `reg` (`id`, `name`, `email`, `mobile`, `address`) VALUES ('$id', '$name', '$email', '$mobile', '$address')";
    if($con->query($sql) == TRUE) {
        $insert = true;
        // Redirect to display.php upon successful insertion
        header("Location: display.php");
        exit();
    } else {
        echo "ERROR: $con <br> $con->error";
    }

    mysqli_close($con);
}
?>



<!DOCTYPE html>
<head>
    <title>
student registration
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>
        STUDENT REGISTRATION FORM 
    </h1>
    <div class="login">
    <form id="form" name="form" action="index.php" method="POST">
            <div class="input-box">
                <label for="id">STUDENT ID</label>
                <input name="id" id="id" type="text" placeholder="ID" required>
            </div>
            <div class="input-box">
                <label for="name">STUDENT NAME</label>
                <input name="name" id="name" type="text" placeholder="NAME" required>
            </div>
            <div class="input-box">
                <label for="email">STUDENT EMAIL</label>
                <input name="email" id="email" type="text" placeholder="EMAIL" required>
            </div>
            <div class="input-box">
            <label for="mobile">STUDENT MOBILE NO.</label>
                <input name="mobile" id="mobile" type="phone" placeholder="MOB NO." required>
            </div>
            <div class="input-box">
                <label for="address">STUDENT ADDRESS</label>
                <input name="address" id="address" type="text" placeholder="ADDRESS" required>
            </div>
            <div class="input-box">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
</div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="index.js"></script>
</body>
</html>