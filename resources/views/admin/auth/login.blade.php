<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Access | {{env('APP_NAME')}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body {
            background: #0f1c2e;
            background-image: radial-gradient(circle at top right, #1e3a8a 0%, transparent 40%),
                              radial-gradient(circle at bottom left, #0f1c2e 0%, transparent 40%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-header p {
            font-size: 14px;
            color: #94a3b8;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #cbd5e1;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            color: white;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <h1>Brother Panel</h1>
        <p>Sign in to continue</p>
    </div>

    @if(session('error'))
        <div class="alert">
            {{ session('error') }}
        </div>
    @endif

    @foreach($errors->all() as $error)
        <div class="alert">
            {{ $error }}
        </div>
    @endforeach

    <form method="POST" action="{{route('admin.login-submit')}}">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" value="my@gmail.com" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="12345678" required>
        </div>
        
        <button type="submit" class="btn-submit">Secure Login</button>
    </form>
</div>

</body>
</html>
