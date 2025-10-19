<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart – Rawan Tech Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: radial-gradient(circle at top right, #081229, #000);
      color: #e0f7ff;
      font-family: "Tahoma", sans-serif;
      min-height: 100vh;
      padding: 20px;
    }

    .cart-container {
      max-width: 1200px;
      margin: 50px auto;
      background: rgba(10, 10, 20, 0.85);
      border: 1.5px solid rgba(0, 217, 255, 0.6);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 0 30px rgba(0, 217, 255, 0.4);
    }

    .cart-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .cart-header h2 {
      color: #00d9ff;
      text-shadow: 0 0 15px #00d9ff;
      font-size: 2.5rem;
    }

    .cart-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .cart-table thead {
      background: rgba(0, 217, 255, 0.2);
      border-bottom: 2px solid #00d9ff;
    }

    .cart-table th {
      padding: 15px;
      color: #00d9ff;
      font-size: 1.1rem;
      text-align: center;
    }

    .cart-table td {
      padding: 20px;
      text-align: center;
      border-bottom: 1px solid rgba(0, 217, 255, 0.2);
      vertical-align: middle;
    }

    .cart-table img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 217, 255, 0.4);
    }

    .product-info {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
    }

    .quantity-btn {
      background: rgba(0, 217, 255, 0.2);
      border: 1px solid #00d9ff;
      color: #00d9ff;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.2rem;
      transition: 0.3s;
    }

    .quantity-btn:hover {
      background: #00d9ff;
      color: #000;
    }

    .remove-btn {
      background: transparent;
      border: 1px solid #ff5c5c;
      color: #ff5c5c;
      padding: 8px 15px;
      border-radius: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .remove-btn:hover {
      background: #ff5c5c;
      color: white;
    }

    .cart-total {
      text-align: right;
      font-size: 1.5rem;
      color: #00d9ff;
      margin-bottom: 30px;
    }

    .cart-actions {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .btn-custom {
      background: linear-gradient(90deg, #00d9ff, #0077b6);
      color: white;
      border: none;
      border-radius: 30px;
      padding: 12px 30px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 0 15px rgba(0, 217, 255, 0.3);
    }

    .btn-custom:hover {
      box-shadow: 0 0 25px rgba(0, 217, 255, 0.6);
      transform: scale(1.05);
    }

    .btn-outline {
      background: transparent;
      border: 2px solid #00d9ff;
      color: #00d9ff;
      border-radius: 30px;
      padding: 12px 30px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-outline:hover {
      background: #00d9ff;
      color: #000;
    }

    .empty-cart {
      text-align: center;
      padding: 60px 20px;
    }

    .empty-cart img {
      width: 150px;
      opacity: 0.6;
      margin-bottom: 20px;
    }

    .empty-cart h3 {
      color: #00d9ff;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="cart-container">
  <div class="cart-header">
    <h2><i class="fa-solid fa-cart-shopping me-2"></i>Your Shopping Cart</h2>
  </div>

  <div id="cartContent"></div>

  <div id="cartFooter" style="display: none;">
    <div class="cart-total">
      <strong>Total: <span id="grandTotal">0</span> SAR</strong>
    </div>

    <div class="cart-actions">
      <button class="btn-outline" onclick="window.location.href='index.php'">
        <i class="fa-solid fa-arrow-left me-2"></i>Continue Shopping
      </button>
      <button class="btn-custom" onclick="proceedToCheckout()">
        <i class="fa-solid fa-credit-card me-2"></i>Proceed to Checkout
      </button>
    </div>
  </div>
</div>

<script>
  let cart = JSON.parse(localStorage.getItem("cartItems")) || [];

  function renderCart() {
    const cartContent = document.getElementById("cartContent");
    const cartFooter = document.getElementById("cartFooter");
    const grandTotalEl = document.getElementById("grandTotal");

    if (cart.length === 0) {
      cartContent.innerHTML = `
        <div class="empty-cart">
          <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart">
          <h3>Your cart is empty</h3>
          <button class="btn-custom mt-3" onclick="window.location.href='index.php'">
            <i class="fa-solid fa-store me-2"></i>Back to Store
          </button>
        </div>
      `;
      cartFooter.style.display = "none";
      return;
    }

    let total = 0;
    let tableHTML = `
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
    `;

    cart.forEach((item, index) => {
      const subtotal = item.price * item.quantity;
      total += subtotal;

      tableHTML += `
        <tr>
          <td>
            <div class="product-info">
              <img src="${item.imgSrc}" alt="${item.name}">
              <span>${item.name}</span>
            </div>
          </td>
          <td>${item.price} SAR</td>
          <td>
            <div class="quantity-controls">
              <button class="quantity-btn" onclick="decreaseQuantity(${index})">−</button>
              <span style="font-size:1.1rem; min-width:30px;">${item.quantity}</span>
              <button class="quantity-btn" onclick="increaseQuantity(${index})">+</button>
            </div>
          </td>
          <td>${subtotal} SAR</td>
          <td>
            <button class="remove-btn" onclick="removeItem(${index})">
              <i class="fa-solid fa-trash me-1"></i> Remove
            </button>
          </td>
        </tr>
      `;
    });

    tableHTML += `
        </tbody>
      </table>
    `;

    cartContent.innerHTML = tableHTML;
    grandTotalEl.textContent = total;
    cartFooter.style.display = "block";
  }

  function increaseQuantity(index) {
    cart[index].quantity += 1;
    localStorage.setItem("cartItems", JSON.stringify(cart));
    renderCart();
  }

  function decreaseQuantity(index) {
    if (cart[index].quantity > 1) {
      cart[index].quantity -= 1;
    } else {
      cart.splice(index, 1);
    }
    localStorage.setItem("cartItems", JSON.stringify(cart));
    renderCart();
  }

  function removeItem(index) {
    cart.splice(index, 1);
    localStorage.setItem("cartItems", JSON.stringify(cart));
    renderCart();
  }

  function proceedToCheckout() {
    if (cart.length === 0) {
      alert("Your cart is empty!");
      return;
    }
    alert("Proceeding to checkout...");
    window.location.href = "checkout.php";
  }

  renderCart();
</script>

</body>
</html>