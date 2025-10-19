<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation – Rawan Tech Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background-color: #0b0f19;
      color: #e0f7ff;
      font-family: 'Cairo', sans-serif;
      text-align: center;
      padding: 60px 20px;
    }
    .glow-box {
      background: rgba(15, 20, 35, 0.9);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 0 25px rgba(0, 217, 255, 0.4);
      max-width: 600px;
      margin: 0 auto;
    }
    .btn-custom {
      background: #00d9ff;
      border: none;
      color: #0b0f19;
      font-weight: 600;
      transition: 0.3s;
    }
    .btn-custom:hover {
      background: #08f3ff;
      box-shadow: 0 0 15px #00d9ff;
    }
    .btn-outline-info:hover {
      background: #00d9ff;
      color: #0b0f19;
      box-shadow: 0 0 15px #00d9ff;
    }
    canvas.qr-glow {
      border: 2px solid rgba(0, 217, 255, 0.4);
      box-shadow: 0 0 25px rgba(0, 217, 255, 0.7);
      border-radius: 15px;
      margin-top: 15px;
    }
    @media print {
      body {
        background: white;
        color: black;
      }
      .btn, .qr-glow {
        display: none;
      }
      .glow-box {
        box-shadow: none;
        border: 1px solid #ccc;
      }
    }
  </style>
</head>
<body>

  <div id="invoiceArea" class="glow-box">
    <h2 class="text-info mb-3"><i class="fa-solid fa-check-circle me-2"></i>Thank you for your purchase!</h2>
    <p class="mb-4">Your order has been successfully placed. We appreciate you shopping with <strong>Rawan Tech Store</strong>.</p>

    <hr class="border-info">

    <div class="text-start mt-4 mb-4">
      <h5 class="text-info"><i class="fa-solid fa-receipt me-2"></i>Order Details</h5>
      <p><strong>Date:</strong> <span id="orderDate"></span></p>
      <p><strong>Time:</strong> <span id="orderTime"></span></p>
      <p><strong>Payment Method:</strong> <span id="paymentMethod">Apple Pay</span></p>
      <p><strong>Order ID:</strong> <span id="orderID"></span></p>
    </div>

    <hr class="border-info">

    <h5 class="text-info mt-4">Connect with me on LinkedIn</h5>
    <canvas id="linkedinQR" class="qr-glow"></canvas>

    <div class="d-flex justify-content-center gap-3 mt-4">
      <a href="index.php" class="btn btn-custom"><i class="fa-solid fa-store me-2"></i>Back to Store</a>
      <button onclick="printInvoice()" class="btn btn-outline-info"><i class="fa-solid fa-print me-2"></i>Print Invoice</button>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

  <script>
    const now = new Date();
    document.getElementById("orderDate").textContent = now.toLocaleDateString();
    document.getElementById("orderTime").textContent = now.toLocaleTimeString();
    const orderID = "RT-" + Math.floor(100000 + Math.random() * 900000);
    document.getElementById("orderID").textContent = orderID;
    const qr = new QRious({
      element: document.getElementById("linkedinQR"),
      value: "https://www.linkedin.com/in/aldawsarir/",
      size: 180,
      background: "transparent",
      foreground: "#00d9ff"
    });
    function printInvoice() {
      window.print();
    }
  </script>

</body>
</html>