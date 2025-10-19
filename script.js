document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const products = document.querySelectorAll(".product-card");

  if (searchInput) {
    searchInput.addEventListener("keyup", function () {
      const value = this.value.toLowerCase().trim();
      products.forEach(prod => {
        const name = prod.dataset.name.toLowerCase();
        prod.style.display = name.includes(value) ? "block" : "none";
      });
    });
  }

  let cart = JSON.parse(localStorage.getItem("cartItems")) || [];
  const cartIcon = document.querySelector(".cart-icon");
  const cartSidebar = document.getElementById("cartSidebar");
  const closeCart = document.getElementById("closeCart");
  const cartItemsContainer = document.querySelector(".cart-items");
  const cartCountEl = document.querySelector(".cart-count");
  const cartTotalEl = document.getElementById("cartTotal");
  const overlay = document.getElementById("overlay");

  if (cartIcon) {
    cartIcon.addEventListener("click", (e) => {
      e.stopPropagation();
      if (cartSidebar) cartSidebar.classList.add("open");
      if (overlay) overlay.classList.add("active");
    });
  }

  function closeSidebar() {
    if (cartSidebar) cartSidebar.classList.remove("open");
    if (overlay) overlay.classList.remove("active");
  }

  if (closeCart) closeCart.addEventListener("click", closeSidebar);
  if (overlay) overlay.addEventListener("click", closeSidebar);

  document.addEventListener("click", (e) => {
    if (e.target.closest(".add-cart")) {
      const productCard = e.target.closest(".product-card-inner");
      const name = productCard.querySelector("h5").textContent.trim();
      const priceText = productCard.querySelector("h6").textContent.replace("SAR", "").trim();
      const price = parseInt(priceText);
      const imgSrc = productCard.querySelector("img").src;

      const existing = cart.find(item => item.name === name);
      if (existing) {
        existing.quantity += 1;
      } else {
        cart.push({ name, price, imgSrc, quantity: 1 });
      }

      localStorage.setItem("cartItems", JSON.stringify(cart));
      updateCartUI();

      if (cartSidebar) cartSidebar.classList.add("open");
      if (overlay) overlay.classList.add("active");

      animateAddToCart(e.target.closest(".add-cart"));
    }
  });

  function updateCartUI() {
    if (!cartItemsContainer || !cartTotalEl || !cartCountEl) return;

    cartItemsContainer.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
      total += item.price * item.quantity;
      const div = document.createElement("div");
      div.classList.add("cart-item");
      div.innerHTML = `
        <img src="${item.imgSrc}" alt="${item.name}">
        <div style="flex-grow:1;">
          <h6 style="margin:0; font-size:0.95rem; color:#e0f7ff;">${item.name}</h6>
          <span style="font-size:0.85rem; color:#00d9ff;">${item.price} SAR × ${item.quantity}</span>
        </div>
        <button class="remove-item" data-index="${index}">
          <i class="fa-solid fa-trash"></i>
        </button>
      `;
      cartItemsContainer.appendChild(div);
    });

    cartTotalEl.textContent = total;
    cartCountEl.textContent = cart.length;
    localStorage.setItem("cartItems", JSON.stringify(cart));

    document.querySelectorAll(".remove-item").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        const index = e.target.closest("button").dataset.index;
        cart.splice(index, 1);
        updateCartUI();
      });
    });
  }

  let wishlist = JSON.parse(localStorage.getItem("wishlistItems")) || [];
  const wishlistCountEl = document.querySelector(".wishlist-count");

  if (wishlistCountEl) {
    wishlistCountEl.textContent = wishlist.length;
  }

  document.addEventListener("click", (e) => {
    if (e.target.closest(".wishlist-btn")) {
      const productCard = e.target.closest(".product-card-inner");
      const name = productCard.querySelector("h5").textContent.trim();
      const priceText = productCard.querySelector("h6").textContent.trim();
      const imgSrc = productCard.querySelector("img").src;

      const exists = wishlist.find((item) => item.name === name);
      if (!exists) {
        wishlist.push({ name, price: priceText, imgSrc });
        localStorage.setItem("wishlistItems", JSON.stringify(wishlist));
        if (wishlistCountEl) wishlistCountEl.textContent = wishlist.length;
        showNotification(`${name} added to wishlist`);
      } else {
        showNotification(`${name} is already in wishlist`);
      }

      addGlowEffect(e.target.closest(".wishlist-btn"));
    }
  });

  function addGlowEffect(element) {
    element.style.textShadow = "0 0 20px #00d9ff";
    element.style.transform = "scale(1.2)";
    setTimeout(() => {
      element.style.textShadow = "none";
      element.style.transform = "scale(1)";
    }, 300);
  }

  function animateAddToCart(btn) {
    btn.style.transform = "scale(1.1)";
    setTimeout(() => (btn.style.transform = "scale(1)"), 200);
  }

  function showNotification(message) {
    const notification = document.createElement("div");
    notification.textContent = message;
    notification.style.cssText = `
      position: fixed;
      bottom: 30px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(90deg, #00d9ff, #0077b6);
      color: white;
      padding: 12px 25px;
      border-radius: 30px;
      box-shadow: 0 0 20px rgba(0, 217, 255, 0.5);
      z-index: 99999;
      font-family: 'Tahoma', sans-serif;
      font-size: 0.95rem;
      animation: slideUp 0.3s ease;
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 2500);
  }

  const viewCartBtn = document.getElementById("viewCartBtn");
  if (viewCartBtn) {
    viewCartBtn.addEventListener("click", () => {
      localStorage.setItem("cartItems", JSON.stringify(cart));
      window.location.href = "cart.php";
    });
  }

  updateCartUI();
});

const style = document.createElement('style');
style.textContent = `
  @keyframes slideUp {
    from {
      bottom: -50px;
      opacity: 0;
    }
    to {
      bottom: 30px;
      opacity: 1;
    }
  }
`;
document.head.appendChild(style);