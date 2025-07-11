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

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get values from the form
    $applicationId = $_POST['applicationId'];
    $applicationDate = $_POST['applicationDate'];
    $studentId = $_POST['studentId'];
    $companyId = $_POST['companyId'];

    // SQL query to insert data into the applications table
    $sql = "INSERT INTO applications (application_id, application_date, student_ID, company_id) VALUES ('$applicationId', '$applicationDate', '$studentId', '$companyId')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Application Information Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height:100vh">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-center">Application Information Form</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="applicationId">Application ID:</label>
                        <input type="text" name="applicationId" class="form-control" id="applicationId" required>
                    </div>
                    <div class="form-group">
                        <label for="applicationDate">Application Date:</label>
                        <input type="date" name="applicationDate" class="form-control" id="applicationDate" required>
                    </div>
                    <div class="form-group">
                        <label for="studentId">Student ID:</label>
                        <input type="text" name="studentId" class="form-control" id="studentId" required>
                    </div>
                    <div class="form-group">
                        <label for="companyId">Company ID:</label>
                        <input type="text" name="companyId" class="form-control" id="companyId" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                    <button type="reset" class="btn btn-warning btn-block">Reset</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
