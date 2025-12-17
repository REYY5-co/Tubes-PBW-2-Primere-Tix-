<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Akun</title>

    <style>
        body {
            margin: 0;
            font-family: poppins, sans-serif;
            background: #f1f5f9;
            cursor: url("{{ asset('images/cursor-popcorn.png') }}") 16 16, auto;
        }

        .header {
            height: 220px;
            padding: 20px 40px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.65), rgba(255, 255, 255, 0.6)),
                url("{{ asset('images/cinema-images.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        .back-btn {
            background: #374151;
            color: white;
            padding: 8px 16px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: -50px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }

        .avatar {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .avatar img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            object-fit: cover;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }

        .helper {
            font-size: 12px;
            color: #6b7280;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            background: #4b5563;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="header">
    <a href="{{ route('akun') }}" class="back-btn">← Kembali</a>
    <h1>Edit Akun</h1>
</div>

<div class="container">
    <div class="card">

        @if(session('success_profile'))
            <div class="success">{{ session('success_profile') }}</div>
        @endif

        <!-- UPDATE PROFIL + AVATAR -->
        <h2>Update Profil</h2>

        <form method="POST" action="{{ route('akun.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="avatar">
                <img src="{{ $user->avatar 
                    ? asset('storage/' . $user->avatar) 
                    : asset('images/avatar-default.png') }}">

                <label style="margin-top:8px; font-size:13px; color:#2563eb; cursor:pointer;">
                    Ganti Foto
                    <input type="file" name="avatar" accept="image/*" hidden>
                </label>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
                <div class="helper">Digunakan untuk login dan notifikasi</div>
            </div>

            <button class="btn" type="submit">Simpan Perubahan</button>
        </form>

        <hr style="margin:35px 0;">

        <!-- GANTI PASSWORD -->
        <h2>Ganti Password</h2>

        @if($errors->has('old_password'))
            <div class="error">{{ $errors->first('old_password') }}</div>
        @endif

        @if(session('success_password'))
            <div class="success">{{ session('success_password') }}</div>
        @endif

        <form method="POST" action="{{ route('akun.password') }}">
            @csrf

            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="old_password" required>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="newPassword" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
                <div class="helper">Minimal 8 karakter</div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required>
            </div>

            <button class="btn" type="submit">Ganti Password</button>
        </form>

    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('newPassword');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
