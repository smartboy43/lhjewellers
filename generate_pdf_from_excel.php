<?php
require 'vendor/autoload.php'; // for mPDF and PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;
use Mpdf\Mpdf;

// Load Excel
$spreadsheet = IOFactory::load("billing_data.xlsx");
$sheet = $spreadsheet->getActiveSheet();
$data = $sheet->toArray();

// Skip header row
for ($i = 1; $i < count($data); $i++) {
    $row = $data[$i];

    list($inv, $name, $phone, $address, $city, $product, $weight, $price, $gst, $pan, $gst_no, $aadhaar) = $row;

    $gst_amount = $price * $gst / 100;
    $total = $price + $gst_amount;

    $html = "
    <style>
      body { font-family: sans-serif; }
      h2 { color: #D97706; }
      table { width: 100%; border-collapse: collapse; margin-top: 20px; }
      td { padding: 6px; vertical-align: top; }
      .label { font-weight: bold; width: 30%; }
    </style>

    <h2>L H JEWELLERS Invoice</h2>

    <table>
      <tr><td class='label'>Invoice No:</td><td>$inv</td></tr>
      <tr><td class='label'>Customer Name:</td><td>$name</td></tr>
      <tr><td class='label'>Phone Number:</td><td>$phone</td></tr>
      <tr><td class='label'>Address:</td><td>$address</td></tr>
      <tr><td class='label'>City:</td><td>$city</td></tr>
      <tr><td class='label'>PAN Number:</td><td>$pan</td></tr>
      <tr><td class='label'>GST Number:</td><td>$gst_no</td></tr>
      <tr><td class='label'>Aadhaar Number:</td><td>$aadhaar</td></tr>
    </table>

    <hr style='margin-top: 20px;'>

    <table>
      <tr><td class='label'>Product:</td><td>$product</td></tr>
      <tr><td class='label'>Weight:</td><td>$weight gms</td></tr>
      <tr><td class='label'>Price:</td><td>₹" . number_format($price) . "</td></tr>
      <tr><td class='label'>GST ($gst%):</td><td>₹" . number_format($gst_amount) . "</td></tr>
      <tr><td class='label'>Total:</td><td><b>₹" . number_format($total) . "</b></td></tr>
    </table>

    <p style='text-align:right;'>Generated on: " . date("d M Y") . "</p>
    ";

    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output("invoice_$inv.pdf", "F"); // Save PDF in current directory
}

echo "✅ All Invoices Generated from Excel.";
?>
