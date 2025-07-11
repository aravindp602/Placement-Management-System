<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>File Upload and Download</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4; /* Set your desired background color */
      background-image: url('background.jpg'); /* Set the path to your background image */
      background-size: cover; /* Cover the entire viewport */
    }

    .container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #ffffff; /* Set the background color for the form container */
    }

    h2 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 8px;
    }

    input[type="file"] {
      margin-bottom: 16px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Professional File Upload and Download</h2>
    <form action="download.php" method="post" enctype="multipart/form-data">
      <label for="myfile">Choose a file:</label>
      <input type="file" name="myfile" id="myfile"><br>
      <input type="submit" name="upload" value="Upload File">
    </form>
  </div>
</body>
</html>
