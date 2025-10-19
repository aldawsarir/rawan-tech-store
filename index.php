<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rawan Tech Store – Futuristic Coding Gadgets</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="images/logo.png" alt="Logo" class="logo me-2" onerror="this.style.display='none'">
      <span>Rawan Tech Store</span>
    </a>

    <ul class="navbar-nav mx-auto d-none d-lg-flex">
      <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
      <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
    </ul>

    <div class="d-flex align-items-center gap-3">
      <div class="search-container">
        <form action="search.php" method="get" class="d-flex">
          <input type="text" name="search" class="search-bar" placeholder="Search products..." required>
          <button class="search-btn" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
      </div>

      <div class="wishlist-icon position-relative">
        <a href="wishlist.html" class="text-decoration-none text-info">
          <i class="fa-solid fa-heart"></i>
          <span class="wishlist-count">0</span>
        </a>
      </div>

      <div class="cart-icon position-relative">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-count">0</span>
      </div>

      <?php if (isset($_SESSION['user'])): ?>
        <div class="d-flex align-items-center gap-2 text-light">
          <i class="fa-solid fa-user text-info fs-5"></i>
          <span>Hi, <?= htmlspecialchars($_SESSION['user']) ?></span>
          <a href="logout.php" class="btn btn-sm btn-outline-danger px-2 py-0 ms-2">
            <i class="fa-solid fa-right-from-bracket"></i>
          </a>
        </div>
      <?php else: ?>
        <div class="d-flex align-items-center gap-3">
          <i class="fa-solid fa-right-to-bracket fs-5 text-info" role="button" data-bs-toggle="modal" data-bs-target="#loginModal" title="Login"></i>
          <i class="fa-solid fa-user-plus fs-5 text-info" role="button" data-bs-toggle="modal" data-bs-target="#signupModal" title="Sign Up"></i>
          <i class="fa-solid fa-envelope fs-5 text-info" role="button" data-bs-toggle="modal" data-bs-target="#contactModal" title="Contact"></i>
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>

<section class="hero-banner d-flex align-items-center justify-content-center text-center">
  <div class="hero-content">
    <h1>Welcome to Rawan Tech Store</h1>
    <p>Explore futuristic gadgets designed for creative coders and AI enthusiasts</p>
    <a href="#products" class="btn btn-custom mt-3">Shop Now</a>
  </div>
</section>

<div class="container products-section" id="products">
  <div class="row g-4 justify-content-center" id="productGrid">
    <div class="col-md-4 col-sm-6 product-card" data-name="vorachip ai study assistant">
      <div class="product-card-inner text-center">
        <img src="images/vorachip.jpg" alt="VoraChip" class="img-fluid">
        <div class="product-info p-3">
          <h5>VoraChip – AI Study Assistant</h5>
          <p>AI-powered chip that helps you study smarter.</p>
          <h6>599 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="code candle smart scented ai">
      <div class="product-card-inner text-center">
        <img src="images/code-candle.jpg" alt="Code Candle" class="img-fluid">
        <div class="product-info p-3">
          <h5>Code Candle</h5>
          <p>Smart candle that changes scent based on your coding project.</p>
          <h6>149 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="bug detector bracelet ai">
      <div class="product-card-inner text-center">
        <img src="images/bug-bracelet.jpg" alt="Bug Detector Bracelet" class="img-fluid">
        <div class="product-info p-3">
          <h5>Bug Detector Bracelet</h5>
          <p>Smart bracelet that vibrates when coding errors appear.</p>
          <h6>379 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="sleep code pillow led">
      <div class="product-card-inner text-center">
        <img src="images/sleep-pillow.jpg" alt="Sleep Code Pillow" class="img-fluid">
        <div class="product-info p-3">
          <h5>Sleep Code Pillow</h5>
          <p>LED pillow that displays new code lines daily.</p>
          <h6>229 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="neural mug ai mug">
      <div class="product-card-inner text-center">
        <img src="images/neural-mug.jpg" alt="Neural Mug" class="img-fluid">
        <div class="product-info p-3">
          <h5>Neural Mug</h5>
          <p>The mug that understands your mood, powered by AI.</p>
          <h6>199 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="focus sphere productivity ball">
      <div class="product-card-inner text-center">
        <img src="images/focus-sphere.jpg" alt="FocusSphere" class="img-fluid">
        <div class="product-info p-3">
          <h5>FocusSphere</h5>
          <p>Smart orb that glows based on your focus level.</p>
          <h6>299 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="quantum key security device">
      <div class="product-card-inner text-center">
        <img src="images/quantum-key.jpg" alt="Quantum Key" class="img-fluid">
        <div class="product-info p-3">
          <h5>Quantum Key</h5>
          <p>Quantum encryption device for next-level security.</p>
          <h6>749 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 product-card" data-name="syntax sneakers light up shoes">
      <div class="product-card-inner text-center">
        <img src="images/syntax-sneakers.jpg" alt="Syntax Sneakers" class="img-fluid">
        <div class="product-info p-3">
          <h5>Syntax Sneakers</h5>
          <p>Light-up sneakers that display dynamic code lines as you walk.</p>
          <h6>499 SAR</h6>
          <div class="product-actions">
            <button class="btn btn-custom add-cart"><i class="fa-solid fa-cart-plus"></i></button>
            <button class="wishlist-btn"><i class="fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="cartSidebar" class="cart-sidebar">
  <div class="cart-header">
    <h5>Your Cart</h5>
    <button id="closeCart"><i class="fa-solid fa-xmark"></i></button>
  </div>
  <div class="cart-items"></div>
  <div class="cart-footer text-center">
    <h6>Total: <span id="cartTotal">0</span> SAR</h6>
    <button class="btn btn-custom w-100 mt-3" id="viewCartBtn">
      <i class="fa-solid fa-cart-shopping me-2"></i> View Cart
    </button>
  </div>
</div>

<div id="overlay" class="overlay"></div>

<hr class="my-5 text-info opacity-50">

<section id="about" class="container py-5">
  <div class="product-card-inner text-center p-5 mt-4">
    <h2 class="text-info mb-4"><i class="fa-solid fa-user-astronaut me-2"></i> About Rawan Tech Store</h2>
    <p class="fs-5 mx-auto text-light" style="max-width: 850px; line-height: 1.9;">
      Welcome to <strong>Rawan Tech Store</strong>, a futuristic concept born from my passion for <strong>technology, design, and innovation</strong>.<br>
      I am <strong>Rawan Aldawsari</strong>, a Computer Science student and aspiring <strong>AI Engineer</strong> who believes that technology should not only be functional but also inspiring.<br>
      Every gadget here represents a mix of imagination and functionality, designed to make learning and productivity feel magical.
    </p>
  </div>
</section>

<hr class="my-5 text-info opacity-50">

<section id="contact" class="container py-5">
  <div class="product-card-inner text-center p-5 mt-4">
    <h2 class="text-info mb-3"><i class="fa-solid fa-paper-plane me-2"></i> Contact</h2>
    <p class="fs-5 mb-4 text-light">Let's connect and create something amazing together</p>
    <div class="social-icons d-flex justify-content-center gap-4 mt-3">
      <a href="mailto:Raldawsari.cs@gmail.com" class="text-info fs-4" target="_blank"><i class="fa-solid fa-envelope"></i></a>
      <a href="https://linkedin.com/in/aldawsarir" class="text-info fs-4" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
      <a href="https://github.com/aldawsarir" class="text-info fs-4" target="_blank"><i class="fa-brands fa-github"></i></a>
      <a href="https://twitter.com/Rawan_Aldawsari" class="text-info fs-4" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
    </div>
  </div>
</section>

<footer class="footer mt-5 text-center">
  <p>© 2025 Rawan Tech Store – All Rights Reserved</p>
</footer>

<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</h4>
      <form action="login.php" method="post">
        <div class="mb-3">
          <label for="loginEmail">Email</label>
          <input type="email" id="loginEmail" name="email" class="form-control" autocomplete="email" required>
        </div>
        <div class="mb-3">
          <label for="loginPassword">Password</label>
          <input type="password" id="loginPassword" name="password" class="form-control" autocomplete="current-password" required>
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Login</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3"><i class="fa-solid fa-user-plus me-2"></i>Create Account</h4>
      <form action="signup.php" method="post">
        <div class="mb-3">
          <label for="signupName">Full Name</label>
          <input type="text" id="signupName" name="fullname" class="form-control" autocomplete="name" required>
        </div>
        <div class="mb-3">
          <label for="signupEmail">Email</label>
          <input type="email" id="signupEmail" name="email" class="form-control" autocomplete="email" required>
        </div>
        <div class="mb-3">
          <label for="signupPassword">Password</label>
          <input type="password" id="signupPassword" name="password" class="form-control" autocomplete="new-password" required>
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Sign Up</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3"><i class="fa-solid fa-paper-plane me-2"></i>Contact Us</h4>
      <form action="contact.php" method="post">
        <div class="mb-3">
          <label for="contactName">Name</label>
          <input type="text" id="contactName" name="name" class="form-control" autocomplete="name" required>
        </div>
        <div class="mb-3">
          <label for="contactEmail">Email</label>
          <input type="email" id="contactEmail" name="email" class="form-control" autocomplete="email" required>
        </div>
        <div class="mb-3">
          <label for="contactMessage">Message</label>
          <textarea id="contactMessage" name="message" rows="4" class="form-control" required></textarea>
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Send</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  if (params.get("showLogin") === "1") {
    const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
    loginModal.show();
    history.replaceState({}, document.title, "index.php");
  }
});
</script>

</body>
</html>