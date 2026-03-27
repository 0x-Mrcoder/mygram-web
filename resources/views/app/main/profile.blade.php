<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>My Profile - FortuneFlow</title>

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
            --ios-red: #FF3B30;
            --ios-divider: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 90px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        /* Header */
        .page-header {
            padding: 10px 20px;
            text-align: center;
            font-size: 17px; font-weight: 600;
            margin-bottom: 10px;
            position: relative;
        }
        .back-btn {
            position: absolute; left: 20px; top: 10px;
            color: var(--ios-blue); font-size: 17px; text-decoration: none;
        }

        /* Apple ID Header */
        .profile-header {
            text-align: center; padding: 20px 0 30px;
        }
        .ph-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: block; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .ph-name { font-size: 22px; font-weight: 600; margin-bottom: 4px; }
        .ph-sub { font-size: 14px; color: var(--ios-gray); }

        /* Grouped Lists */
        .list-group {
            background: var(--ios-card);
            border-radius: 12px;
            overflow: hidden;
            margin: 0 20px 25px;
        }
        
        .list-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 16px;
            background: var(--ios-card);
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            border-bottom: 0.5px solid rgba(255,255,255,0.05);
        }
        .list-item:last-child { border-bottom: none; }
        .list-item:active { background: #2D3748; }
        
        .li-label { font-size: 16px; }
        .li-right { display: flex; align-items: center; gap: 8px; }
        .li-val { font-size: 16px; color: var(--ios-gray); }
        .li-arrow { color: #C7C7CC; font-size: 14px; }

        .section-title {
            padding: 0 35px; margin-bottom: 8px;
            font-size: 13px; color: var(--ios-gray); text-transform: uppercase;
        }

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

    <div class="page-header">
        <a href="/mine" class="back-btn"><i class="fas fa-chevron-left"></i> Back</a>
        My Profile
    </div>

    <div class="profile-header">
        <img src="{{ asset(setting('logo')) }}" alt="Avatar" class="ph-avatar">
        <div class="ph-name">{{ auth()->user()->name }}</div>
        <div class="ph-sub">{{ auth()->user()->phone }}</div>
    </div>

    <!-- Personal Info -->
    <div class="list-group">
        <div class="list-item">
            <div class="li-label">Username</div>
            <div class="li-right">
                <span class="li-val">{{ auth()->user()->username }}</span>
            </div>
        </div>
        <div class="list-item">
            <div class="li-label">Phone</div>
            <div class="li-right">
                <span class="li-val">{{ auth()->user()->phone }}</span>
            </div>
        </div>
        <div class="list-item">
            <div class="li-label">Joined</div>
            <div class="li-right">
                <span class="li-val">{{ auth()->user()->created_at->format('M Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Security -->
    <div class="section-title">Security</div>
    <div class="list-group">
        <a href="{{ route('user.change-password') }}" class="list-item">
            <div class="li-label">Login Password</div>
            <div class="li-right">
                <span class="li-val">Change</span>
                <i class="fas fa-chevron-right li-arrow"></i>
            </div>
        </a>
        <a href="{{ route('user.withdraw-password') }}" class="list-item">
            <div class="li-label">Withdraw Password</div>
            <div class="li-right">
                <span class="li-val">Change</span>
                <i class="fas fa-chevron-right li-arrow"></i>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item active"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>
    
    @include('alert-message')

</body>
</html>
