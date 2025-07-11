<?php
// Set database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "playground";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}

// Check if form is submitted for updating
if (isset($_POST['update'])) {
    // Get values from the form
    $placementIdToUpdate = $_POST['update'];
    $updatedSalaryAmount = $_POST['updatedSalaryAmount'];
    $updatedEmploymentType = $_POST['updatedEmploymentType'];

    // SQL query to update data in the salary_details table
    $updateSql = "UPDATE salary_details SET salary_amount = '$updatedSalaryAmount', employement_type = '$updatedEmploymentType' WHERE placement_id = $placementIdToUpdate";

    // Execute the query
    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
}

// Check if form is submitted for deleting
if (isset($_POST['delete'])) {
    // Get placement ID to delete
    $placementIdToDelete = $_POST['delete'];

    // SQL query to delete data from the salary_details table
    $deleteSql = "DELETE FROM salary_details WHERE placement_id = $placementIdToDelete";

    // Execute the query
    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }
}

// SQL query to select all records from the salary_details table
$sql = "SELECT * FROM salary_details";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Details</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Salary Details</h2>
        <?php
        // Check if there are any records
        if ($result->num_rows > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Placement ID</th>
                            <th>Salary Amount</th>
                            <th>Employment Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["placement_id"] . '</td>
                        <td>' . $row["salary_amount"] . '</td>
                        <td>' . $row["employement_type"] . '</td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="update" value="' . $row["placement_id"] . '">
                                <input type="text" name="updatedSalaryAmount" placeholder="New Salary Amount" required>
                                <input type="text" name="updatedEmploymentType" placeholder="New Employment Type" required>
                                <button type="submit" class="btn btn-warning btn-sm">Update</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <button type="submit" name="delete" value="' . $row["placement_id"] . '" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "No records found";
        }
        $conn->close();
        ?>

        <!-- Bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
