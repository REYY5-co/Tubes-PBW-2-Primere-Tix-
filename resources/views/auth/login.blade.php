<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

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

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 8px;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 12px;
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

        .captcha-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111827;
            color: white;
            padding: 10px 12px;
            border-radius: 8px;
            letter-spacing: 4px;
            margin-bottom: 10px;
            user-select: none;
        }

        .refresh {
            cursor: pointer;
            font-size: 14px;
            opacity: 0.7;
        }

        .refresh:hover {
            opacity: 1;
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
    <h2>Login</h2>
    <div class="subtitle">Masuk ke sistem PrimeTIX</div>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <!-- CAPTCHA (LOGIKA ASLI, TIDAK DIUBAH) -->
        <div class="captcha-box">
            <span id="captcha-text">----</span>
            <span class="refresh" onclick="loadCaptcha()">↻</span>
        </div>

        <div class="form-group">
            <input type="text" name="captcha_input" placeholder="Masukkan captcha" required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<footer>
    © {{ date('Y') }} PrimeTIX
</footer>

<script>
    function loadCaptcha() {
        fetch('/captcha')
            .then(res => res.json())
            .then(data => {
                document.getElementById('captcha-text').innerText = data.captcha;
            });
    }
    loadCaptcha();
</script>

</body>
</html>
