<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Profile - FortuneFlow</title>

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
            --ios-red: #E74C3C;
            --ios-green: #27AE60;
            --ios-orange: #F39C12;
            --ios-purple: #8E44AD;
            --ios-indigo: #2980B9;
            --ios-divider: #2D3748;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 100px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        /* Header */
        .profile-header {
            padding: 30px 20px 25px;
            text-align: center;
            background: var(--ios-bg);
        }
        .avatar-circle {
            width: 86px; height: 86px;
            background: #E5E5EA; /* Fallback */
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 36px; color: var(--ios-gray);
            overflow: hidden;
            position: relative;
        }
        .avatar-img { width: 100%; height: 100%; object-fit: cover; }
        
        .p-name { font-size: 24px; font-weight: 700; margin-bottom: 4px; color: #fff; }
        .p-detail { font-size: 14px; color: var(--ios-gray); }

        /* Stats Row */
        .stats-container {
            display: flex; gap: 12px; padding: 0 20px 25px;
        }
        .stat-card {
            flex: 1;
            background: var(--ios-card);
            padding: 15px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            display: flex; flex-direction: column; gap: 4px;
        }
        .st-val { font-size: 17px; font-weight: 700; color: #fff; }
        .st-lbl { font-size: 11px; color: var(--ios-gray); text-transform: uppercase; font-weight: 600; }
        
        /* Grouped List */
        .list-group {
            background: var(--ios-card);
            border-radius: 12px;
            margin: 0 20px 20px;
            overflow: hidden;
        }
        .list-item {
            display: flex; align-items: center;
            padding: 12px 16px;
            text-decoration: none;
            background: var(--ios-card);
            position: relative;
            cursor: pointer;
        }
        .list-item:active { background: #E5E5EA; }
        
        /* Divider inside group */
        .list-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 56px; /* Icon width + spacing */
            right: 0;
            bottom: 0;
            height: 0.5px;
            background: #C6C6C8;
        }

        .item-icon {
            width: 30px; height: 30px;
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 14px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .bg-blue { background: var(--ios-blue); }
        .bg-green { background: var(--ios-green); }
        .bg-orange { background: var(--ios-orange); }
        .bg-red { background: var(--ios-red); }
        .bg-purple { background: var(--ios-purple); }
        .bg-indigo { background: var(--ios-indigo); }

        .item-label { flex: 1; font-size: 16px; color: #fff; }
        .item-arrow { color: #C7C7CC; font-size: 14px; }
        
        .logout-btn {
            display: block; width: 100%;
            background: var(--ios-card);
            color: var(--ios-red);
            font-size: 16px; font-weight: 600;
            text-align: center;
            padding: 14px;
            border: none;
            cursor: pointer;
        }
        .logout-btn:active { background: #E5E5EA; }

        /* Modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            opacity: 0; pointer-events: none; transition: opacity 0.3s;
        }
        .modal-sheet {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #161B2D;
            border-top: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px 14px 0 0;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
        }
        .modal-active .modal-overlay { opacity: 1; pointer-events: auto; }
        .modal-active .modal-sheet { transform: translateY(0); }

        /* Tab Bar */
        .tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16,20,35,0.9);
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

    <div class="profile-header">
        <div class="avatar-circle">
            <i class="fas fa-user-circle" style="font-size:86px; color:#C7C7CC;"></i>
            <!-- Can replace with img if available -->
        </div>
        <!-- <div class="p-name">U</div> -->
        <div class="p-detail">{{ auth()->user()->phone }}</div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="st-val">₦{{ number_format(auth()->user()->balance, 2) }}</div>
            <div class="st-lbl">Balance</div>
        </div>
        <div class="stat-card">
            <div class="st-val">{{ \App\Models\Purchase::where('user_id', auth()->id())->where('status','active')->count() }}</div>
            <div class="st-lbl">Active Plans</div>
        </div>
    </div>

    <!-- Finance Group -->
    <div class="list-group">
        <a href="/user/recharge" class="list-item">
            <div class="item-icon bg-blue"><i class="fas fa-wallet"></i></div>
            <div class="item-label">Deposit</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        <a href="/withdraw" class="list-item">
            <div class="item-icon bg-orange"><i class="fas fa-money-bill-transfer"></i></div>
            <div class="item-label">Withdraw</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        <a href="/add/card" class="list-item">
            <div class="item-icon bg-purple"><i class="fas fa-university"></i></div>
            <div class="item-label">Bank Account</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        <a href="/history" class="list-item">
            <div class="item-icon bg-indigo"><i class="fas fa-clock-rotate-left"></i></div>
            <div class="item-label">Transaction History</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
    </div>

    <!-- Social Group -->
    <div class="list-group">
        <a href="/invite" class="list-item">
            <div class="item-icon bg-green"><i class="fas fa-user-plus"></i></div>
            <div class="item-label">Invite Friends</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        @if($setting->telegram_channel)
        <a href="{{ $setting->telegram_channel }}" class="list-item" target="_blank">
            <div class="item-icon bg-blue"><i class="fab fa-telegram-plane"></i></div>
            <div class="item-label">Telegram Channel</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        @endif
        @if($setting->telegram_group)
        <a href="{{ $setting->telegram_group }}" class="list-item" target="_blank">
            <div class="item-icon bg-green"><i class="fab fa-whatsapp"></i></div>
            <div class="item-label">WhatsApp Group</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
        @endif
        <a href="/user/redeem" class="list-item">
            <div class="item-icon bg-red"><i class="fas fa-gift"></i></div>
            <div class="item-label">Redeem Code</div>
            <i class="fas fa-chevron-right item-arrow"></i>
        </a>
    </div>

    <!-- System Group -->
    <div class="list-group">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Log Out</button>
        </form>
    </div>

    <!-- Navigation -->
    <nav class="tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item active"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>


</body>
</html>