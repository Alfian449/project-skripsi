@extends('layout.guest')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login</title>

        <style>
            body, html {
                height: 100%;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f8f9fc;
            }

            .login-container {
                display: flex;
                align-items: center;
                background-color: white;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                border-radius: 5px;
                padding: 20px;
            }

            .login-form {
                margin-left: 20px;
                text-align: center;
            }

            .login-form input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .login-form button {
                width: 100%;
                padding: 10px;
                background-color: #4e73df;
                border: none;
                color: white;
                border-radius: 5px;
                cursor: pointer;
            }

            .login-form button:hover {
                background-color: #2e59d9;
            }

            .login-image {
                width: 200px;
                height: auto;
            }
        </style>

    </head>

    <body>
        <div class="login-container">
            <img src="{{ asset('loginimg/logo smk.png') }}" alt="Welcome Image" class="login-image">
            <div class="login-form">
                <h2>Selamat Datang Kembali</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div>
                <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        </div>
        </div>
    </body>

    </html>
@endsection
