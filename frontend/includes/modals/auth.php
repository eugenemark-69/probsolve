<!-- frontend/includes/modals/auth.php -->
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="loginForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="password" required>
          </div>
          <div class="alert alert-danger d-none" id="loginError"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Registration Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="registerForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="registerName" class="form-label">Name</label>
            <input type="text" class="form-control" id="registerName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="registerEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="registerEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="registerPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="registerPassword" name="password" required>
          </div>
          <div class="alert alert-danger d-none" id="registerError"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
