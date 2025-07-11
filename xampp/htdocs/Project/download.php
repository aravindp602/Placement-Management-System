<?php

if (isset($_POST['upload'])) {

    $file_name = $_FILES['myfile']['name'];

    $file_tmp_name = $_FILES['myfile']['tmp_name'];

    $file_size = $_FILES['myfile']['size'];

    $file_type = $_FILES['myfile']['type'];

    $file_error = $_FILES['myfile']['error'];

    $upload_dir = "uploads/";

    // Check for file upload errors
    if ($file_error !== 0) {
        echo "Error: File upload failed with error code $file_error";
    } else {
        // Validate file size (you can set a custom size limit)
        $max_file_size = 5 * 1024 * 1024; // 5 MB
        if ($file_size > $max_file_size) {
            echo "Error: File size exceeds the limit of " . ($max_file_size / 1024 / 1024) . " MB";
        } else {
            // Check if the file is of a valid type (you can customize this based on your needs)
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf']; // Add more allowed types if needed
            if (!in_array($file_type, $allowed_types)) {
                echo "Error: Invalid file type. Allowed types are: " . implode(', ', $allowed_types);
            } else {
                // Ensure the destination directory exists, or create it
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                // Move the uploaded file to the desired directory
                $destination = $upload_dir . $file_name;
                if (move_uploaded_file($file_tmp_name, $destination)) {
                    echo "File uploaded successfully.";
                } else {
                    echo "Error: Unable to move the uploaded file to the destination.";
                }
            }
        }
    }
}

?>

<br>

<a download="<?php echo $file_name; ?>" href="<?php echo $destination; ?>">Click here to download</a>
