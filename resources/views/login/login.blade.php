<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ asset('index2.html') }}"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

    @if (session('failed'))
        <div class="alert alert-danger">{{session('failed')}}</div>
    @endif
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="/login" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name='email' class="form-control" placeholder="Email" required>
          @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name='password' id="password" class="form-control" placeholder="Password" required>
          @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
          <div class="input-group-append">
            <div class="input-group-text" style="cursor: pointer;" id="togglePassword">
              <span class="fas fa-eye-slash" id="eyeIcon"></span>
            </div>
          </div>
        </div>

        <!-- Remember Me -->
        <div class="mb-3">
          <div class="icheck-primary">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">
              Remember Me
            </label>
          </div>
        </div>

        <!-- Tombol di bawah -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
      </form>

      <p class="mb-1 mt-3 text-center">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

<!-- Script show/hide password -->
<script>
  document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    }
  });
</script>
</body>
</html>
