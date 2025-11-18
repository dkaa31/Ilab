<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pilih Laboratorium</title>
  <link rel="stylesheet" href="{{ asset('css/lab.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
</head>
<body>
  <div class="container">
    <!-- Tombol Logout -->
    <div class="logout-area">
      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>

    <h2 class="selector-title">Pilih Laboratorium</h2>
    <div class="lab-grid">
      @foreach($ruangans as $r)
        <a href="{{ route('lab.show', $r->id) }}" class="lab-card">
          {{ $r->nama }}
        </a>
      @endforeach
    </div>
  </div>

  <style>
    body {
      background-color: #0a2647;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      font-family: "Poppins", sans-serif;
      margin: 0;
    }

    .container {
      background: white;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 900px;
      text-align: center;
      position: relative;
    }

    .selector-title {
      font-size: 32px;
      color: #0a2647;
      margin-bottom: 30px;
      font-weight: 700;
    }

    .lab-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 20px;
    }

    .lab-card {
      display: block;
      padding: 25px 15px;
      background: #f8f9fa;
      border-radius: 12px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #0a2647;
      text-decoration: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: all 0.2s ease;
      border: 2px solid transparent;
    }

    .lab-card:hover {
      transform: translateY(-4px);
      background: #e3f2fd;
      border-color: #3b82f6;
      color: #1d4ed8;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    /* === Tombol Logout === */
    .logout-area {
      position: absolute;
      top: 20px;
      right: 20px;
    }

    .logout-btn {
      background-color: #fee2e2;
      color: #b91c1c;
      border: 1px solid #fecaca;
      padding: 8px 16px;
      font-size: 16px;
      border-radius: 8px;
      font-family: "Poppins", sans-serif;
      cursor: pointer;
      transition: all 0.2s;
      font-weight: 500;
    }

    .logout-btn:hover {
      background-color: #fecaca;
      color: #991b1b;
    }
  </style>
</body>
</html>