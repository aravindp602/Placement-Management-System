<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

// Check if a file was uploaded without errors
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) 
{

    // Get the target directory for the uploaded file
    $target_dir = "uploads/";

    // Get the name of the uploaded file
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Get the file type
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Create an array of allowed file types
    $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");

    // Check if the file type is allowed
    if (!in_array($file_type, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
    }else
    {
        // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // File upload success
        $fiename = $_FILES["file"]["name"];
        $filesize = $_FILES["file"]["size"];
        $filetype = $_FILES["file"]["type"];


        $db_host = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "fileuploaddownload";

        $conn = new mysqli($db_host, $db_user,$db_pass,$db_name);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO files(filename, filesize, filetype) VALUES('$filename','$filesize','$filetype') ";

        if($conn->query($sql) === TRUE){
            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and the information has been stored in the database.";
            wind
    } else{
        echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
    }
        $conn->close():
    else 
        {
            echo "Sorry, there was an error uploading your file.";
          }   
    else{
        echo "No file was uploaded.";
        }
    
}

    }
}

    ?>