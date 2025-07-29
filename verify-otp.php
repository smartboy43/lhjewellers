
<?php
session_start();

if (!isset($_SESSION['otp']) || !isset($_SESSION['phone'])) {
  header("Location: login.html");
  exit();
}

$success = null;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {
  $user_otp = $_POST['otp'];
  if ($user_otp == $_SESSION['otp']) {
    $message = "✅ OTP Verified. Welcome " . $_SESSION['phone'];
    $success = true;
  } else {
    $message = "❌ Invalid OTP. Please try again.";
    $success = false;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Verify OTP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #fff9f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .otp-box {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    .otp-box h2 {
      color: #7b3f00;
      margin-bottom: 10px;
    }

    .otp-box p {
      font-size: 16px;
      margin-bottom: 20px;
      color: <?= $success === true ? 'green' : ($success === false ? 'red' : '#444') ?>;
    }

    .otp-box input[type="text"] {
      padding: 12px;
      width: 80%;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .otp-box button {
      padding: 10px 25px;
      background: #7b3f00;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
    }

    .otp-box button:hover {
      background: #5a2d00;
    }

    #resend-btn {
      display: none;
      margin-top: 15px;
      background-color: #444;
    }
  </style>
</head>
<body>

  <div class="otp-box">
    <h2>Verify OTP</h2>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form method="POST">
      <input type="text" name="otp" placeholder="Enter OTP" required>
      <br>
      <button type="submit">Submit OTP</button>
    </form>

    <form method="POST" action="send-otp-resend.php">
      <input type="hidden" name="phone" value="<?= htmlspecialchars($_SESSION['phone']) ?>">
      <button id="resend-btn" type="submit">Resend OTP</button>
    </form>

    <script>
      setTimeout(function() {
        document.getElementById("resend-btn").style.display = "inline-block";
      }, 120000);
    </script>
  </div>

</body>
</html>
