<?php
session_start();
include "config.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $results = $stmt->get_result();
} else {
    $results = $conn->query("SELECT * FROM products LIMIT 8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results – Rawan Tech Store</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="images/logo.png" alt="Logo" class="logo me-2" onerror="this.style.display='none'">
      <span>Rawan Tech Store</span>
    </a>

    <div class="d-flex align-items-center gap-3">
      <div class="search-container">
        <form action="search.php" method="get" class="d-flex">
          <input type="text" name="search" class="search-bar" placeholder="Search products..." required value="<?= htmlspecialchars($search) ?>">
          <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
      <a href="index.php" class="btn btn-outline-info btn-sm">Back to Store</a>
    </div>
  </div>
</nav>

<div class="container products-section" style="margin-top:120px;">
  <h2 class="text-info text-center mb-4">
    <?= !empty($search) ? 'Search Results for "' . htmlspecialchars($search) . '"' : 'All Products'; ?>
  </h2>

  <div class="row g-4 justify-content-center">
    <?php if ($results->num_rows > 0): ?>
      <?php while ($item = $results->fetch_assoc()): ?>
        <div class="col-md-4 col-sm-6 product-card">
          <div class="product-card-inner text-center">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="img-fluid">
            <div class="product-info p-3">
              <h5><?= htmlspecialchars($item['name']) ?></h5>
              <p><?= htmlspecialchars($item['description']) ?></p>
              <h6><?= number_format($item['price'], 2) ?> SAR</h6>
              <div class="product-actions">
                <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
                <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="text-center text-info mt-5">
        <i class="fa-solid fa-magnifying-glass fa-3x mb-3"></i>
        <h4>No products found</h4>
        <p>Try searching for another item or <a href="index.php" class="text-info">return to the store</a>.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<footer class="footer text-center mt-5">
  <p>© 2025 Rawan Tech Store – All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>