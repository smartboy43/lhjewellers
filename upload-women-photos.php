<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Upload Women’s Jewellery - L H Jewellers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fdf6f0;
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
      max-width: 650px;
    }
    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
      color: #333;
    }
    input[type="file"] {
      margin: 10px 0 20px;
    }
    button {
      background-color: #7b3f00;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    .preview {
      margin-top: 20px;
    }
    .preview img {
      width: 150px;
      margin: 10px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

  <h2>Upload Women’s Jewellery Images</h2>

  <form action="" method="POST" enctype="multipart/form-data">
    <label>💍 Ring:</label>
    <input type="file" name="ring">

    <label>✨ Earrings:</label>
    <input type="file" name="earrings">

    <label>📿 Necklace:</label>
    <input type="file" name="necklace">

    <label>🪙 Bangle:</label>
    <input type="file" name="bangle">

    <label>🧵 Mangalsutra:</label>
    <input type="file" name="mangalsutra">

    <label>📛 Pendant:</label>
    <input type="file" name="pendant">

    <button type="submit" name="upload">Upload All</button>
  </form>

  <div class="preview">
    <?php
    if (isset($_POST['upload'])) {
      $categories = ['ring', 'earrings', 'necklace', 'bangle', 'mangalsutra', 'pendant'];
      $uploadDir = 'uploads/women/';
      if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      foreach ($categories as $cat) {
        $file = $_FILES[$cat];
        if ($file['name']) {
          $fileName = basename($file["name"]);
          $target = $uploadDir . $cat . "-" . time() . "-" . $fileName;
          if (move_uploaded_file($file["tmp_name"], $target)) {
            echo "<p style='color:green;'>✅ $cat uploaded!</p>";
            echo "<img src='$target'>";
          } else {
            echo "<p style='color:red;'>❌ Failed to upload $cat.</p>";
          }
        }
      }
    }
    ?>
  </div>

</body>
</html>
