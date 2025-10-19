<?php
session_start();
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pro – Rawan Tech Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: radial-gradient(circle at top right, #050b1a, #000);
      color: #e0f7ff;
      font-family: "Cairo", sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
    }
    .navbar {
      background: rgba(10,10,20,0.8);
      border-bottom: 1px solid rgba(0,217,255,0.3);
      backdrop-filter: blur(10px);
    }
    .dashboard-container {
      max-width: 1200px;
      margin: 100px auto;
      background: rgba(10,10,20,0.85);
      border: 1.5px solid rgba(0,217,255,0.4);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 0 30px rgba(0,217,255,0.3);
    }
    .stat-card {
      background: rgba(0,217,255,0.05);
      border: 1px solid rgba(0,217,255,0.4);
      border-radius: 15px;
      text-align: center;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0,217,255,0.2);
      transition: 0.3s;
    }
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 25px rgba(0,217,255,0.5);
    }
    .stat-card h3 {
      color: #00d9ff;
      margin-bottom: 10px;
    }
    .table {
      color: #e0f7ff;
      border-color: rgba(0,217,255,0.3);
    }
    .table-hover tbody tr:hover {
      background: rgba(0,217,255,0.1);
    }
    footer {
      text-align: center;
      margin-top: 50px;
      padding: 20px;
      color: #00d9ff;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand text-info" href="index.php">
      <i class="fa-solid fa-store me-2"></i>Rawan Tech Store
    </a>
    <a href="index.php" class="btn btn-outline-info btn-sm">Back to Store</a>
  </div>
</nav>

<div class="dashboard-container">
  <h2 class="text-center text-info mb-5">
    <i class="fa-solid fa-chart-line me-2"></i>Dashboard Overview
  </h2>

  <?php
  $userCount = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'] ?? 0;
  $msgCount = $conn->query("SELECT COUNT(*) AS total FROM messages")->fetch_assoc()['total'] ?? 0;
  $orderCount = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'] ?? 0;
  $totalSales = $conn->query("SELECT SUM(total) AS total FROM orders")->fetch_assoc()['total'] ?? 0;
  ?>

  <div class="row g-4 text-center mb-5">
    <div class="col-md-3">
      <div class="stat-card">
        <h3><i class="fa-solid fa-users"></i></h3>
        <h4>Users</h4>
        <h2><?= $userCount ?></h2>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h3><i class="fa-solid fa-envelope"></i></h3>
        <h4>Messages</h4>
        <h2><?= $msgCount ?></h2>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h3><i class="fa-solid fa-cart-shopping"></i></h3>
        <h4>Orders</h4>
        <h2><?= $orderCount ?></h2>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h3><i class="fa-solid fa-sack-dollar"></i></h3>
        <h4>Total Sales (SAR)</h4>
        <h2><?= number_format($totalSales, 2) ?></h2>
      </div>
    </div>
  </div>

  <canvas id="statsChart" height="100" class="mb-5"></canvas>

  <h4 class="text-info mb-3"><i class="fa-solid fa-receipt me-2"></i>Recent Orders</h4>
  <div class="table-responsive">
    <table class="table table-hover table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Customer</th>
          <th>Total (SAR)</th>
          <th>Payment</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 10");
        if ($orders->num_rows > 0):
          while ($o = $orders->fetch_assoc()):
        ?>
          <tr>
            <td><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['fullname']) ?></td>
            <td><?= number_format($o['total'], 2) ?></td>
            <td><?= htmlspecialchars($o['payment_method']) ?></td>
            <td><?= $o['created_at'] ?></td>
          </tr>
        <?php endwhile; else: ?>
          <tr><td colspan="5" class="text-muted">No orders yet</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <h4 class="text-info mb-3 mt-5"><i class="fa-solid fa-comment-dots me-2"></i>Latest Messages</h4>
  <div class="list-group">
    <?php
    $msgs = $conn->query("SELECT name, message FROM messages ORDER BY id DESC LIMIT 5");
    if ($msgs->num_rows > 0):
      while ($m = $msgs->fetch_assoc()):
    ?>
      <div class="list-group-item bg-transparent border-info text-light mb-2">
        <strong class="text-info"><?= htmlspecialchars($m['name']) ?>:</strong>
        <span><?= htmlspecialchars($m['message']) ?></span>
      </div>
    <?php endwhile; else: ?>
      <p class="text-muted">No messages yet</p>
    <?php endif; ?>
  </div>
</div>

<footer>© 2025 Rawan Tech Store – All Rights Reserved</footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  fetch("chart_data.php")
    .then(res => res.json())
    .then(data => {
      const labels = data.map(item => item.date);
      const values = data.map(item => item.sales);

      new Chart(document.getElementById("statsChart"), {
        type: "line",
        data: {
          labels: labels,
          datasets: [{
            label: "Daily Sales (SAR)",
            data: values,
            fill: true,
            backgroundColor: "rgba(0,217,255,0.15)",
            borderColor: "#00d9ff",
            borderWidth: 2,
            pointBackgroundColor: "#00ffaa",
            tension: 0.4
          }]
        },
        options: {
          plugins: {
            legend: { labels: { color: "#e0f7ff" } }
          },
          scales: {
            x: {
              ticks: { color: "#e0f7ff" },
              grid: { color: "rgba(0,217,255,0.1)" }
            },
            y: {
              ticks: { color: "#e0f7ff" },
              grid: { color: "rgba(0,217,255,0.1)" }
            }
          }
        }
      });
    })
    .catch(err => console.error("Error loading chart data:", err));
});
</script>
</body>
</html>