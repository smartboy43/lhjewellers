<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Ring Photo - L H Jewellers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff9f5;
      padding: 40px;
    }
    h2 {
      color: #7b3f00;
    }
    form {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
      max-width: 400px;
    }
    input[type="file"] {
      padding: 10px;
    }
    button {
      margin-top: 15px;
      background-color: #7b3f00;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    img.preview {
      margin-top: 20px;
      max-width: 300px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <h2>Upload Men’s Ring Photo</h2>

  <form action="" method="POST" enctype="multipart/form-data">
    <label>Select image (jpg/png):</label><br><br>
    <input type="file" name="ringImage" accept="image/*" required>
    <br><br>
    <button type="submit" name="upload">Upload</button>
  </form>

  <?php
    if (isset($_POST['upload'])) {
      $targetDir = "uploads/";
      $fileName = basename($_FILES["ringImage"]["name"]);
      $targetFile = $targetDir . $fileName;

      if (!file_exists("uploads")) {
        mkdir("uploads");
      }

      if (move_uploaded_file($_FILES["ringImage"]["tmp_name"], $targetFile)) {
        echo "<p style='color:green;'>✅ Uploaded successfully!</p>";
        echo "<img src='$targetFile' class='preview'>";
      } else {
        echo "<p style='color:red;'>❌ Upload failed.</p>";
      }
    }
  ?>

</body>
</html>
