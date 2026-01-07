<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            justify-content: space-between;
            align-items: center;
        }

        header img {
            height: 32px;
        }

        .logout-btn {
            border: none;
            background: none;
            color: #555;
            cursor: pointer;
            font-size: 14px;
        }

        .card {
            margin-top: 80px;
            background: #fff;
            width: 380px;
            border-radius: 14px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .card h2 {
            margin: 10px 0 4px;
            font-size: 20px;
        }

        .card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .menu a {
            text-decoration: none;
            background: #000000ff;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            transition: 0.2s;
        }

        .menu a:hover {
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

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </header>

    <div class="card">
        <h2>Halo, Admin 👋</h2>
        <p>Selamat datang di dashboard admin</p>

        <div class="menu">
            <a href="{{ route('admin.films.index') }}"
                class="block text-center px-6 py-3 bg-black text-white rounded-xl hover:bg-gray-800">
                Kelola Film
            </a>


        </div>
    </div>

    <footer>
        © {{ date('Y') }} PrimeTIX Admin Panel
    </footer>

</body>

</html>