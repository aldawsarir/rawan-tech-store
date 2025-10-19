<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3">
        <i class="fa-solid fa-right-to-bracket me-2"></i>Login
      </h4>
      <form action="login.php" method="post">
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" required autocomplete="email">
        </div>
        <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Login</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3">
        <i class="fa-solid fa-user-plus me-2"></i>Create Account
      </h4>
      <form action="signup.php" method="post">
        <div class="mb-3">
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" class="form-control" required autocomplete="name">
        </div>
        <div class="mb-3">
          <label for="signupEmail">Email</label>
          <input type="email" id="signupEmail" name="email" class="form-control" required autocomplete="email">
        </div>
        <div class="mb-3">
          <label for="signupPassword">Password</label>
          <input type="password" id="signupPassword" name="password" class="form-control" required autocomplete="new-password">
        </div>
        <button class="btn btn-info w-100 mt-2" type="submit">Sign Up</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-4 text-light" style="background:#0b0f19; border-radius:20px; border:1px solid #00d9ff55;">
      <h4 class="text-center text-info mb-3">
        <i class="fa-solid fa-paper-plane me-2"></i>Contact Us
      </h4>
      <form action="contact.php" method="post">
        <div class="mb-3">
          <label for="contactName">Name</label>
          <input type="text" id="contactName" name="name" class="form-control" required autocomplete="name">
        </div>
        <div class="mb-3">
          <label for="contactEmail">Email</label>
          <input type="email" id="contactEmail" name="email" class="form-control" required autocomplete="email">
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