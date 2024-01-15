<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
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

        .dataTables_wrapper .dt-buttons {
            white-space: nowrap;
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
    ?>
        <table id='myTable' class='display'>
            <thead>
                <tr style='text-align:center;'>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>MOBILE</th>
                    <th>ADDRESS</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </tr>
            </thead>
            <tbody>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["mobile"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td style='opacity:1;'><a href='edit.php?id=<?= $row["id"] ?>' class='btn btn-warning'>EDIT</a></td>
                    <td style='opacity:1;'><button class='btn btn-danger deleteBtn' data-bs-toggle='modal'
                            data-bs-target='#deleteModal<?= $row["id"] ?>'>DELETE</button></td>
                </tr>
    
                <!-- Confirmation modal triggered for each record for deleting the record using its id -->
                <div class='modal fade' id='deleteModal<?= $row["id"] ?>' tabindex='-1'
                    aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title' id='exampleModalLabel'>Are you sure?</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'
                                    aria-label='Close'></button>
                            </div>
                            <div class='modal-footer'>
                                <a href='delete.php?rn=<?= $row["id"] ?>' class='btn btn-danger'>Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
    }
    ?>
        </tbody>
        </table>
        <!-- jQuery script for handling delete button click -->
        <script>
            $(document).ready(function() {
                var deleteId;
    
                $('.deleteBtn').click(function() {
                    deleteId = $(this).closest('tr').find('td:first').text();
                });
            });
        </script>
    <?php
    } else {?>
        <p>No data in the database</p>
        <?php
    }
    
    mysqli_close($con);
    ?>

    <a href="index.php" class="btn btn-primary">Add New Student</a>

    <!-- DataTables initialization with export buttons -->
    <script>
       $(document).ready(function () {
            $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "script.php",
                    "type": "POST"
                },
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "mobile"},
                    {"data": "address"},
                    {"data": "edit", "orderable": false, "searchable": false},
                    {"data": "delete", "orderable": false, "searchable": false}
                ],
                "columnDefs": [
                    {"targets": [3, 5, 6], "orderable": false} // Disable sorting for the Action (Edit and Delete) columns
                ],
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    }
                ]
            });
        });
    </script>

    <!-- Bootstrap JavaScript Bundle (Bootstrap JS and Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
