<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>History - MyGram</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ee667f;
            --primary-dark: #d64d66;
            --accent: #ff8fa3;
            --bg-body: #f0f2f5;
            --surface: #ffffff;
            --text-main: #2d3436;
            --text-sub: #636e72;
            --glass: rgba(255, 255, 255, 0.9);
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.02);
            --shadow-md: 0 10px 20px rgba(238, 102, 127, 0.15);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Outfit', sans-serif; background-color: var(--bg-body); color: var(--text-main); padding-bottom: 100px; }
        
        .main-wrapper { max-width: 480px; margin: 0 auto; background: var(--bg-body); min-height: 100vh; position: relative; }

        /* Header */
        .hero-header {
            background: linear-gradient(135deg, #eb6681ff 0%, #fff 100%);
            padding: 30px 20px 40px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }
        
        .back-btn {
            position: absolute;
            left: 20px;
            top: 30px;
            font-size: 20px;
            color: var(--text-main);
            text-decoration: none;
        }

        /* History List */
        .section-container { padding: 0 20px; }
        
        .transaction-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .transaction-card:active { transform: scale(0.98); }

        .t-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .t-icon {
            width: 45px; height: 45px;
            background: #fff0f3;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            color: var(--primary);
        }
        
        .t-details h4 { font-size: 16px; font-weight: 600; color: var(--text-main); margin-bottom: 4px; }
        .t-details p { font-size: 12px; color: var(--text-sub); }
        
        .t-amount {
            text-align: right;
        }
        .amount-val { font-size: 16px; font-weight: 700; color: var(--primary); display: block; margin-bottom: 4px; }
        .status-badge {
            font-size: 10px;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-approved { background: #e6f9f0; color: #00b894; }
        .status-pending { background: #fff8e1; color: #ffb300; }
        .status-rejected { background: #ffebee; color: #ff7675; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-sub);
        }
        .empty-icon { font-size: 40px; color: #dfe6e9; margin-bottom: 15px; }

        /* Floating Navigation */
        .floating-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            z-index: 1000;
            border: 1px solid rgba(255,255,255,0.5);
        }
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #b2bec3;
            font-size: 10px;
            font-weight: 500;
            gap: 4px;
            transition: all 0.3s;
            width: 50px;
        }
        .nav-item i { font-size: 20px; transition: transform 0.2s; }
        .nav-item.active { color: var(--primary); }
        .nav-item.active i { transform: translateY(-2px); }
        
        .nav-center {
            width: 56px;
            height: 56px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: -30px;
            box-shadow: 0 8px 20px rgba(238, 102, 127, 0.4);
            border: 4px solid var(--bg-body);
            color: white;
            font-size: 22px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        
        <!-- Header -->
        <div class="hero-header">
            <!-- <a href="/" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a> -->
            <h1 class="page-title">History</h1>
        </div>

        <!-- Content -->
        <div class="section-container">
            @if(\App\Models\UserLedger::where('user_id', auth()->id())->count() > 0)
                @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
                <div class="transaction-card">
                    <div class="t-info">
                        <div class="t-icon">
                            @if($element->reason == 'withdraw_request')
                                <i class="fa-solid fa-money-bill-transfer"></i>
                            @elseif($element->reason == 'deposit')
                                <i class="fa-solid fa-wallet"></i>
                            @elseif(str_contains($element->reason, 'commission'))
                                <i class="fa-solid fa-users"></i>
                            @else
                                <i class="fa-solid fa-receipt"></i>
                            @endif
                        </div>
                        <div class="t-details">
                            <h4>{{ ucwords(str_replace('_', ' ', $element->reason)) }}</h4>
                            <p>{{ $element->created_at->format('d M, h:i A') }}</p>
                        </div>
                    </div>
                    <div class="t-amount">
                        <span class="amount-val">{{ price($element->amount) }}</span>
                        <span class="status-badge status-{{ strtolower($element->status) }}">{{ $element->status }}</span>
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fa-regular fa-clock empty-icon"></i>
                    <p>No transactions yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-item">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Home</span>
        </a>
        <a href="/invite" class="nav-item">
            <i class="fa-solid fa-users-line"></i>
            <span>Team</span>
        </a>
        <a href="/my/vip" class="nav-center">
            <i class="fa-solid fa-layer-group"></i>
        </a>
        <a href="/history" class="nav-item active">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
        </a>
        <a href="/mine" class="nav-item">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>