<?php
// Including the database connection file
include("database.php");

// Getting the ID to be deleted from the URL parameter
$sid = $_GET['rn'];

// Query to delete the record with the provided ID
$query = "DELETE FROM reg WHERE id = '$sid'";

// Executing the deletion query
$data = mysqli_query($con, $query);

// Checking if the deletion was successful
if ($data) {
    // Redirecting to display.php after successful deletion
    header("Location: display.php");
    exit(); // Ending script execution after redirection
} else {
    // Displaying an error message if deletion fails
    echo "<h3>Error deleting record: " . mysqli_error($con) . "</h3>";
}

// Closing the database connection
mysqli_close($con);
?>
