<?php
include "config.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("<h3 style='color:white; text-align:center; margin-top:50px;'>Invalid product ID.</h3>");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  die("<h3 style='color:white; text-align:center; margin-top:50px;'>Product not found.</h3>");
}

$product = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($product['name']) ?> | Rawan Tech Store</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
  background-color: #0b0f19;
  color: #e0f7ff;
  font-family: 'Cairo', sans-serif;
}
.container {
  margin-top: 80px;
}
.product-image {
  border-radius: 20px;
  box-shadow: 0 0 25px rgba(0,217,255,0.2);
  transition: transform .4s ease;
}
.product-image:hover {
  transform: scale(1.03);
}
.price {
  font-size: 1.6rem;
  font-weight: bold;
  color: #00d9ff;
}
.btn-custom {
  background: linear-gradient(90deg, #00d9ff, #0072ff);
  color: white;
  border: none;
  padding: 10px 25px;
  border-radius: 30px;
  transition: all 0.3s ease;
}
.btn-custom:hover {
  box-shadow: 0 0 20px #00d9ff;
  transform: translateY(-3px);
}
.back-btn {
  text-decoration: none;
  color: #00d9ff;
  font-weight: 500;
}
.back-btn:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<div class="container">
  <a href="index.php" class="back-btn"><i class="fa-solid fa-arrow-left me-2"></i>Back to Store</a>
  <div class="row mt-4 align-items-center">
    <div class="col-md-5 text-center">
      <img src="<?= htmlspecialchars($product['image']) ?>" class="img-fluid product-image" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="col-md-7">
      <h2 class="text-info"><?= htmlspecialchars($product['name']) ?></h2>
      <p class="mt-3"><?= htmlspecialchars($product['description']) ?></p>
      <p class="price"><?= htmlspecialchars($product['price']) ?> SAR</p>
      <div class="mt-4 d-flex gap-3">
        <button class="btn btn-custom"><i class="fa-solid fa-cart-plus me-2"></i>Add to Cart</button>
        <button class="btn btn-outline-info"><i class="fa-solid fa-heart me-2"></i>Add to Wishlist</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>