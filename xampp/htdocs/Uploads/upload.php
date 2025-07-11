<?php

//creating directory to store files
//designing user interface


?>

<form method="POST"cenctype="multipart/form-data" action="upload.php">
    <input type="file" name="file">
    <input type="submit" value="Upload"
</form>


<?php

//creating file to upload

$files = scandir("Uploads")
print_r($files)