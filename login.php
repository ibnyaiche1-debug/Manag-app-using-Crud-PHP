<!-- login.html -->

<?php  
session_start();
  if(isset($_SESSION['user_id'])){
  header('location:accueil.php');
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --bg1:#0b1220; --bg2:#101a33;
      --glass: rgba(255,255,255,0.08);
      --glass-border: rgba(255,255,255,0.16);
      --text-dim: rgba(255,255,255,0.72);
    }
    body{
      min-height:100vh;
      background:
        radial-gradient(900px circle at 10% 10%, rgba(110,168,254,.25), transparent 55%),
        radial-gradient(900px circle at 90% 20%, rgba(178,102,255,.22), transparent 50%),
        radial-gradient(900px circle at 40% 90%, rgba(0,209,255,.16), transparent 55%),
        linear-gradient(180deg, var(--bg1), var(--bg2));
      color:#fff;
    }
    .brand{ letter-spacing:.2px; font-weight:700; }
    .auth-card{
      background: var(--glass);
      border: 1px solid var(--glass-border);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 20px;
      box-shadow: 0 18px 50px rgba(0,0,0,.35);
    }
    .form-control{
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.14);
      color:#fff;
      border-radius: 12px;
    }
    .form-control:focus{
      border-color: rgba(110,168,254,.65);
      box-shadow: 0 0 0 .2rem rgba(110,168,254,.18);
      background: rgba(255,255,255,0.08);
      color:#fff;
    }
    .form-control::placeholder{ color: rgba(255,255,255,0.45); }
    .input-group-text{
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.14);
      color: rgba(255,255,255,0.75);
      border-radius: 12px;
    }
    .btn-primary{
      background: linear-gradient(135deg, #6ea8fe, #8b5cf6);
      border: 0;
      border-radius: 12px;
      font-weight: 600;
      letter-spacing: .2px;
    }
    .btn-primary:hover{ filter: brightness(1.05); }
    a.link-soft{ color: var(--text-dim); text-decoration: none; }
    a.link-soft:hover{ color:#fff; text-decoration: underline; }
    .small-dim{ color: var(--text-dim); }
    .floaty{ animation: floaty 6s ease-in-out infinite; }
    @keyframes floaty{ 0%,100%{ transform: translateY(0px);} 50%{ transform: translateY(-6px);} }
    .toast-container{ z-index: 1080; }
  </style>
</head>

<body class="d-flex align-items-center py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
        <div class="auth-card p-4 p-sm-5 floaty">

          <div class="text-center mb-4">
            <div class="brand fs-3">Quick Manag</div>
            <div class="small-dim">Sign in to continue</div>
          </div>

          <form method="POST" action="verif.php" novalidate>
            <div class="mb-3">
              <label for="loginEmail" class="form-label small-dim">Email</label>
              <input type="email" class="form-control"  name="loginEmail" placeholder="name@company.com"
                     autocomplete="username" required />
              <div class="invalid-feedback">Please enter a valid email.</div>
            </div>

            <div class="mb-3">
              <label for="loginPassword" class="form-label small-dim">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" name="loginPassword" placeholder="••••••••"
                       autocomplete="current-password" minlength="6" required />
                <button class="btn btn-outline-light input-group-text" type="button" id="toggleLoginPassword">
                  <span id="toggleLoginIcon">Show</span>
                </button>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label small-dim" for="rememberMe">Remember me</label>
              </div>
              <a class="link-soft small" href="#" id="forgotLink">Forgot password?</a>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">
              <span class="me-2" id="loginBtnText">Sign in</span>
              <span class="spinner-border spinner-border-sm d-none" id="loginSpinner" role="status" aria-hidden="true"></span>
            </button>

            <div class="text-center mt-4 small-dim">
              Don’t have an account?
              <a class="link-soft" href="register.php">Create one</a>
            </div>
          </form>
        </div>

        <div class="text-center mt-4 small small-dim">
          © <span id="year"></span> Quick Manag. All rights reserved.
        </div>
      </div>
    </div>
  </div>

  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="appToast" class="toast text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body" id="toastBody">Hello</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const toast = new bootstrap.Toast(document.getElementById("appToast"), { delay: 2800 });
    const toastBody = document.getElementById("toastBody");
    document.getElementById("year").textContent = new Date().getFullYear();

    function showToast(msg){ toastBody.textContent = msg; toast.show(); }

    // Show/Hide password
    const loginPassword = document.getElementById("loginPassword");
    const toggleLoginIcon = document.getElementById("toggleLoginIcon");
    document.getElementById("toggleLoginPassword").addEventListener("click", () => {
      const hidden = loginPassword.type === "password";
      loginPassword.type = hidden ? "text" : "password";
      toggleLoginIcon.textContent = hidden ? "Hide" : "Show";
    });

    // Forgot password demo
    document.getElementById("forgotLink").addEventListener("click", (e) => {
      e.preventDefault();
      showToast("Password reset would open here.");
    });

    // Submit demo
    const loginForm = document.getElementById("loginForm");
    const loginBtn = document.getElementById("loginBtn");
    const loginBtnText = document.getElementById("loginBtnText");
    const loginSpinner = document.getElementById("loginSpinner");
    const loginEmail = document.getElementById("loginEmail");

    loginForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      let ok = true;
      if (!loginEmail.checkValidity()){ loginEmail.classList.add("is-invalid"); ok = false; }
      else loginEmail.classList.remove("is-invalid");

      if (!loginPassword.checkValidity()){ loginPassword.classList.add("is-invalid"); ok = false; }
      else loginPassword.classList.remove("is-invalid");

      if (!ok) return;

      loginBtn.disabled = true;
      loginSpinner.classList.remove("d-none");
      loginBtnText.textContent = "Signing in...";

      try{
        await new Promise(r => setTimeout(r, 900));
        showToast("Welcome back!");
        // window.location.href = "dashboard.html";
      } finally {
        loginBtn.disabled = false;
        loginSpinner.classList.add("d-none");
        loginBtnText.textContent = "Sign in";
      }
    });
  </script>
</body>
</html>
