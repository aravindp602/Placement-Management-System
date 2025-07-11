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

// Function to sanitize user input
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

// Perform actions based on form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $applicationIDToDelete = sanitize($_POST['delete']);
        $deleteSql = "DELETE FROM applications WHERE application_id = $applicationIDToDelete";
        $conn->query($deleteSql);
    } elseif (isset($_POST['update'])) {
        $applicationIDToUpdate = sanitize($_POST['update']);
        $updateSql = "SELECT * FROM applications WHERE application_id = $applicationIDToUpdate";
        $result = $conn->query($updateSql);
        $row = $result->fetch_assoc();
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">
                <input type="hidden" name="applicationID" value="' . $row["application_id"] . '">
                <input type="text" name="applicationDate" value="' . $row["application_date"] . '">
                <input type="text" name="studentID" value="' . $row["student_ID"] . '">
                <input type="text" name="companyID" value="' . $row["company_id"] . '">
                <button type="submit" name="submitUpdate">Update Record</button>
            </form>';
    }
}

// Check if form is submitted for updating after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitUpdate'])) {
    $applicationIDToUpdate = $_POST['applicationID'];
    $applicationDate = $_POST['applicationDate'];
    $studentID = $_POST['studentID'];
    $companyID = $_POST['companyID'];

    // SQL query to update record in the applications table
    $updateSql = "UPDATE applications SET application_date='$applicationDate', student_ID=$studentID, company_id=$companyID WHERE application_id=$applicationIDToUpdate";
    $conn->query($updateSql);
}

// SQL query to select all records from the applications table
$sql = "SELECT * FROM applications";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications Records</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Applications Records</h2>
        <?php
        // Check if there are any records
        if ($result->num_rows > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Application ID</th>
                            <th>Application Date</th>
                            <th>Student ID</th>
                            <th>Company ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["application_id"] . '</td>
                        <td>' . $row["application_date"] . '</td>
                        <td>' . $row["student_ID"] . '</td>
                        <td>' . $row["company_id"] . '</td>
                        <td>
                            <form method="post" style="display:inline;">
                                <button type="submit" name="delete" value="' . $row["application_id"] . '" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <button type="submit" name="update" value="' . $row["application_id"] . '" class="btn btn-primary btn-sm">Update</button>
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
