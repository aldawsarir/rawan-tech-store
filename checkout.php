<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $total = $_POST['total'];
  $payment_method = $_POST['payment_method'];

  $stmt = $conn->prepare("INSERT INTO orders (fullname, email, phone, address, total, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssis", $fullname, $email, $phone, $address, $total, $payment_method);
  if ($stmt->execute()) {
    header("Location: invoice.php?success=1&name=" . urlencode($fullname) . "&total=" . urlencode($total) . "&method=" . urlencode($payment_method));
    exit();
  } else {
    echo "<script>alert('An error occurred while processing the order.');</script>";
  }
  $stmt->close();
  $conn->close();
}
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout – Rawan Tech Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
body {
  background: radial-gradient(circle at top right, #081229, #000);
  color: #e0f7ff;
  font-family: 'Cairo', sans-serif;
  min-height: 100vh;
}

.checkout-box {
  max-width: 650px;
  margin: 80px auto;
  background: rgba(255,255,255,0.05);
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 0 25px rgba(0,217,255,0.25);
  border: 1px solid rgba(0,217,255,0.4);
}

.form-control {
  background-color: rgba(255,255,255,0.08);
  color: #fff;
  border: 1px solid #00d9ff;
}
.form-control:focus {
  border-color: #00ffff;
  box-shadow: 0 0 10px #00ffff44;
}

.btn-custom {
  background: linear-gradient(90deg, #00d9ff, #0072ff);
  color: white;
  border: none;
  border-radius: 30px;
  padding: 10px 20px;
  transition: 0.3s;
  font-weight: 500;
}
.btn-custom:hover {
  box-shadow: 0 0 20px #00d9ff;
  transform: scale(1.05);
}

.payment-info {
  background: rgba(255,255,255,0.08);
  padding: 15px;
  border-radius: 10px;
  margin-top: 10px;
  display: none;
  color: #00d9ff;
}

.payment-icon {
  color: #00d9ff;
  margin-right: 10px;
  font-size: 1.4em;
  text-shadow: 0 0 10px #00d9ff;
}
</style>
</head>
<body>

<div class="checkout-box">
  <h2 class="text-center mb-4" style="color:#00d9ff;text-shadow:0 0 10px #00d9ff;">
    <i class="fa-solid fa-credit-card me-2"></i>Checkout
  </h2>

  <form method="POST" action="">
    <div class="mb-3">
      <label class="form-label" for="fullname">Full Name</label>
      <input type="text" id="fullname" class="form-control" name="fullname" required autocomplete="name">
    </div>

    <div class="mb-3">
      <label class="form-label" for="email">Email Address</label>
      <input type="email" id="email" class="form-control" name="email" required autocomplete="email">
    </div>

    <div class="mb-3">
      <label class="form-label" for="phone">Phone Number</label>
      <input type="tel" id="phone" class="form-control" name="phone" required autocomplete="tel">
    </div>

    <div class="mb-3">
      <label class="form-label" for="address">Address</label>
      <textarea id="address" class="form-control" name="address" rows="2" required autocomplete="address-line1"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" for="totalInput">Total (SAR)</label>
      <input type="number" class="form-control" id="totalInput" name="total" step="0.01" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Payment Method</label><br>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_method" id="mada" value="Mada" required>
        <label class="form-check-label" for="mada">
          <i class="fa-solid fa-credit-card payment-icon"></i> Mada Card
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_method" id="apple" value="Apple Pay">
        <label class="form-check-label" for="apple">
          <i class="fa-brands fa-apple payment-icon"></i> Apple Pay
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="Cash on Delivery">
        <label class="form-check-label" for="cash">
          <i class="fa-solid fa-money-bill-wave payment-icon"></i> Cash on Delivery
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_method" id="tamara" value="Tamara">
        <label class="form-check-label" for="tamara">
          <i class="bi bi-calendar4-week payment-icon"></i> Tamara (4 Payments)
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment_method" id="tabby" value="Tabby">
        <label class="form-check-label" for="tabby">
          <i class="bi bi-calendar3 payment-icon"></i> Tabby (3 Payments)
        </label>
      </div>
    </div>

    <div id="paymentInfo" class="payment-info"></div>

    <button type="submit" class="btn btn-custom w-100 mt-4 fs-5">Complete Payment</button>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const totalInput = document.getElementById("totalInput");
  const cart = JSON.parse(localStorage.getItem("cartItems")) || [];

  let total = 0;
  cart.forEach(item => {
    total += parseFloat(item.price) * (item.quantity || 1);
  });

  totalInput.value = cart.length === 0 ? "0.00" : total.toFixed(2);

  const radios = document.querySelectorAll('input[name="payment_method"]');
  const info = document.getElementById('paymentInfo');

  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.id === 'tamara' && total > 0) {
        const installment = (total / 4).toFixed(2);
        info.innerHTML = `Tamara: 4 payments with 0% interest – <strong>${installment} SAR</strong> each.`;
        info.style.display = 'block';
      } else if (radio.id === 'tabby' && total > 0) {
        const installment = (total / 3).toFixed(2);
        info.innerHTML = `Tabby: 3 payments with 0% interest – <strong>${installment} SAR</strong> each.`;
        info.style.display = 'block';
      } else {
        info.style.display = 'none';
      }
    });
  });
});
</script>

</body>
</html>