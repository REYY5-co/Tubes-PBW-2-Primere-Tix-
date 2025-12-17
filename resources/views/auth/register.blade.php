<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <style>
        * {
            font-family: poppins, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: url("{{ asset('images/cursor-popcorn.png') }}") 16 16, auto;
        }

        header {
            width: 100%;
            padding: 20px 40px;
            display: flex;
            justify-content: flex-start;
        }

        header img {
            height: 32px;
        }

        .card {
            margin-top: 80px;
            background: #fff;
            width: 380px;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            text-align: center;
        }

        h2 {
            margin-bottom: 6px;
            color: #111827;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        input {
            width: 100%;
            padding: 11px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #111827;
        }

        button {
            width: 100%;
            padding: 11px;
            background: #000000ff;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 6px;
        }

        button:hover {
            background: #383838ff;
        }

        .footer {
            margin-top: 14px;
            font-size: 14px;
            color: #6b7280;
        }

        .footer a {
            color: #111827;
            text-decoration: none;
            font-weight: 500;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        footer {
            margin-top: auto;
            padding: 20px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ asset('images/primetix-logo.png') }}" alt="PrimeTIX">
</header>

<div class="card">
    <h2>Register</h2>
    <div class="subtitle">Buat akun baru PrimeTIX</div>

    <form method="POST" action="/register">
        @csrf

        <div class="form-group">
            <input type="text" name="name" placeholder="Nama Lengkap" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Register</button>
    </form>

    <div class="footer">
        Sudah punya akun? <a href="/login">Login</a>
    </div>
</div>

<footer>
    © {{ date('Y') }} PrimeTIX
</footer>

</body>
</html>
