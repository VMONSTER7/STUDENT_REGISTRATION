<!DOCTYPE html>
<head>
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            color: white;
        }
        p {
            background-color: black;
            padding: 10px;
            margin: 0;
            opacity: 0.5;
        }
        td {
            background-color: black;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <h1>STUDENT DETAILS</h1>

    <?php
    include("database.php");

    $sql = "SELECT * FROM reg";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr style='text-align:center;'>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th colspan='2'>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["mobile"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td style='opacity:1;'><a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning'>EDIT</a></td>";
            // Delete button triggering modal
            echo "<td style='opacity:1;'><button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal" . $row["id"] . "'>DELETE</button></td>";
            echo "</tr>";
            // Confirmation modal for each record
            echo "<div class='modal fade' id='deleteModal" . $row["id"] . "' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h1 class='modal-title' id='exampleModalLabel'>Are you sure?</h1>";
            echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<a href='delete.php?rn=" . $row["id"] . "' class='btn btn-danger'>Delete</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        echo "</table>";

    } else {
        echo "<p>No data in the database</p>";
    }

    mysqli_close($con);
    ?>
    <a href="index.php" class="btn btn-primary">Add New Student</a>

    <!-- Bootstrap JavaScript Bundle (Bootstrap JS and Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
