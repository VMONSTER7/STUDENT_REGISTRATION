<?php
// Include database connection
include("database.php");

// Define the columns in your table
$columns = array(
    0 => 'id',
    1 => 'name',
    2 => 'email',
    3 => 'mobile',
    4 => 'address',
);

// Set the table name
$table = 'reg';

// Ordering
$order_column = $_POST['order'][0]['column'];
$order_dir = $_POST['order'][0]['dir'];
$order_by = $columns[$order_column];

// Search
$search_value = $_POST['search']['value'];

// Get all records without filtering
$sql_total = "SELECT * FROM $table";
$total_records = mysqli_num_rows(mysqli_query($con, $sql_total));

// Total records with filtering
$total_filtered = $total_records;

// Get the data for the table
$sql = "SELECT * FROM $table WHERE name LIKE '%$search_value%' OR email LIKE '%$search_value%' OR mobile LIKE '%$search_value%' OR address LIKE '%$search_value%' ORDER BY $order_by $order_dir";
$result = mysqli_query($con, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $subdata = array();
    $subdata['id'] = $row['id'];
    $subdata['name'] = $row['name'];
    $subdata['email'] = $row['email'];
    $subdata['mobile'] = $row['mobile'];
    $subdata['address'] = $row['address'];
    $subdata['edit'] = '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning">EDIT</a>';
    $subdata['delete'] = '<button class="btn btn-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row['id'] . '">DELETE</button>';
    $data[] = $subdata;
}

// Prepare data for DataTables
$output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $total_records,
    "recordsFiltered" => $total_filtered,
    "data" => $data,
);

// Output as JSON
echo json_encode($output);

// Close the database connection
mysqli_close($con);
?>
