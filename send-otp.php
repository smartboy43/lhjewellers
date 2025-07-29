
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone = $_POST['phone'];
  $otp = rand(100000, 999999);
  $_SESSION['otp'] = $otp;
  $_SESSION['phone'] = $phone;

  // You would send the OTP using Fast2SMS here (hidden for security)
  $message = "✅ OTP sent to $phone";
} else {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Verify OTP - L H Jewellers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      color: green;
      font-size: 16px;
      margin-bottom: 25px;
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
  </style>
</head>
<body>

  <div class="otp-box">
    <h2>Enter OTP</h2>
    <p><?= $message ?></p>
    <form method="POST" action="verify-otp.php">
      <input type="text" name="otp" placeholder="Enter 6-digit OTP" required>
      <br>
      <button type="submit">Verify OTP</button>
    </form>
  </div>

</body>
</html>
