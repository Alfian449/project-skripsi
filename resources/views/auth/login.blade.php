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
            flex-direction: column;
            align-items: center;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            box-sizing: border-box;
        }

        .login-form {
            width: 100%;
            text-align: center;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        /* Media Queries for Tablets */
        @media (min-width: 768px) {
            .login-container {
                flex-direction: row; /* Change layout to row for larger screens */
                padding: 30px;
                max-width: 800px; /* Increase max-width for larger screens */
            }

            .login-image {
                margin-right: 20px; /* Add space between image and form */
                margin-bottom: 0; /* Remove bottom margin */
            }

            .login-form {
                text-align: left; /* Align form text to the left */
                width: auto; /* Allow form to take up available space */
            }
        }

        /* Media Queries for Larger Desktops */
        @media (min-width: 1200px) {
            .login-container {
                padding: 40px;
                max-width: 1000px; /* Increase max-width for very large screens */
            }
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
