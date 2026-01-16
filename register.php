<!-- register.php -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>

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
    a.link-soft{ color: rgba(255,255,255,0.72); text-decoration:none; }
    a.link-soft:hover{ color:#fff; text-decoration: underline; }
    .small-dim{ color: rgba(255,255,255,0.72); }
    .floaty{ animation: floaty 6s ease-in-out infinite; }
    @keyframes floaty{ 0%,100%{ transform: translateY(0px);} 50%{ transform: translateY(-6px);} }
  </style>
</head>

<body class="d-flex align-items-center py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
        <div class="auth-card p-4 p-sm-5 floaty">

          <div class="text-center mb-4">
            <div class="brand fs-3">Quick Manag</div>
            <div class="small-dim">Create your account</div>
          </div>

          <?php if (isset($_GET["msg"])): ?>
            <div class="alert alert-warning py-2">
              <?= htmlspecialchars($_GET["msg"]) ?>
            </div>
          <?php endif; ?>

          <form id="registerForm" method="POST" action="inscription.php" novalidate>
            <div class="mb-3">
              <label for="fullName" class="form-label small-dim">Full name</label>
              <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required />
              <div class="invalid-feedback">Please enter your name.</div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label small-dim">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="name@company.com" required />
              <div class="invalid-feedback">Please enter a valid email.</div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label small-dim">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Create a password" minlength="6" required />
                <button class="btn btn-outline-light input-group-text" type="button" id="togglePassword">
                  <span id="toggleIcon">Show</span>
                </button>
                <div class="invalid-feedback">Password must be at least 6 characters.</div>
              </div>
            </div>

            <button class="btn btn-primary w-100 py-2" id="registerBtn" type="submit">
              <span class="me-2" id="registerBtnText">Create account</span>
              <span class="spinner-border spinner-border-sm d-none" id="registerSpinner" role="status" aria-hidden="true"></span>
            </button>

            <div class="text-center mt-4 small-dim">
              Already have an account?
              <a class="link-soft" href="login.php">Back to login</a>
            </div>
          </form>
        </div>

        <div class="text-center mt-4 small small-dim">
          © <span id="year"></span> Quick Manag. All rights reserved.
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("year").textContent = new Date().getFullYear();

    // Show/Hide password
    const password = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");
    document.getElementById("togglePassword").addEventListener("click", () => {
      const hidden = password.type === "password";
      password.type = hidden ? "text" : "password";
      toggleIcon.textContent = hidden ? "Hide" : "Show";
    });

    // Client-side validation ONLY (does not fake-submit)
    const form = document.getElementById("registerForm");
    const btn = document.getElementById("registerBtn");
    const btnText = document.getElementById("registerBtnText");
    const spinner = document.getElementById("registerSpinner");

    form.addEventListener("submit", (e) => {
      let ok = true;

      const fullName = document.getElementById("fullName");
      const email = document.getElementById("email");

      if (!fullName.checkValidity()){ fullName.classList.add("is-invalid"); ok = false; }
      else fullName.classList.remove("is-invalid");

      if (!email.checkValidity()){ email.classList.add("is-invalid"); ok = false; }
      else email.classList.remove("is-invalid");

      if (!password.checkValidity()){ password.classList.add("is-invalid"); ok = false; }
      else password.classList.remove("is-invalid");

      if (!ok) {
        e.preventDefault();
        return;
      }

      // UI loading while real POST happens
      btn.disabled = true;
      spinner.classList.remove("d-none");
      btnText.textContent = "Creating...";
    });
  </script>
</body>
</html>
