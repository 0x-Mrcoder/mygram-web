<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Redeem Gift - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --ios-bg: #0A0E1A;
            --ios-card: #161B2D;
            --ios-blue: #F1C40F;
            --ios-gray: #A0AEC0;
            --ios-red: #F1C40F;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 90px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        .page-header {
            padding: 10px 20px;
            text-align: center;
            font-size: 17px; font-weight: 600;
            margin-bottom: 20px;
        }

        .r-container { padding: 0 20px; }

        .input-card {
            background: var(--ios-card);
            border-radius: 12px;
            padding: 30px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.05);
            text-align: center;
        }

        .gift-icon {
            font-size: 40px; color: var(--ios-red);
            margin-bottom: 15px;
        }

        .desc { font-size: 14px; color: var(--ios-gray); margin-bottom: 20px; }

        .code-input {
            width: 100%; height: 50px;
            background: #2D3748; border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px; padding: 0 15px;
            font-size: 16px; font-weight: 600; text-align: center;
            outline: none; margin-bottom: 20px; color: #fff;
        }
        .code-input:focus { border-color: var(--ios-blue); background: #2D3748; }

        .redeem-btn {
            width: 100%; padding: 16px;
            background: var(--ios-blue); color: #000;
            border: none; border-radius: 12px;
            font-size: 16px; font-weight: 700;
            cursor: pointer;
        }
        .redeem-btn:active { transform: scale(0.98); }

        /* Navigation */
        .ios-tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16, 20, 35, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 0.5px solid rgba(255,255,255,0.1);
            display: flex; justify-content: space-around;
            padding-top: 10px;
            padding-bottom: max(10px, env(safe-area-inset-bottom));
            z-index: 100;
        }
        .tab-item {
            text-decoration: none;
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            color: #999;
            flex: 1;
        }
        .tab-item i { font-size: 22px; }
        .tab-item span { font-size: 10px; font-weight: 600; }
        .tab-item.active { color: var(--ios-blue); }

    </style>
</head>
<body>

    <div class="page-header">Redeem Gift</div>

    <div class="r-container">
        
        <form action="{{ route('user.gift_usage') }}" method="POST">
            @csrf
            <div class="input-card">
                <i class="fas fa-gift gift-icon"></i>
                <div class="desc">Enter your promo code below to receive your gift instantly.</div>
                
                <input type="text" name="code" class="code-input" placeholder="Enter code" required autofocus>
                
                <button type="submit" class="redeem-btn">Redeem Now</button>
            </div>
        </form>

    </div>

    <!-- Navigation -->
    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>
    
    @include('alert-message')

</body>
</html>
