<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Team Report - MyGram</title>

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
            background: linear-gradient(135deg, #e47188ff 0%, #fff 100%);
            padding: 20px 20px 30px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .back-btn { font-size: 20px; color: var(--text-main); text-decoration: none; margin-right: 15px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 50%; box-shadow: var(--shadow-sm); }
        .page-title { font-size: 20px; font-weight: 700; color: var(--text-main); }

        /* Content */
        .section-container { padding: 0 20px; }
        
        .level-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .level-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--primary);
            color: white;
            padding: 5px 15px;
            border-radius: 0 0 0 15px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }
        .stat-item {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .stat-label { font-size: 11px; color: var(--text-sub); font-weight: 500; }
        .stat-value { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .stat-icon { font-size: 20px; color: var(--primary); margin-bottom: 5px; }

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
            <a href="javascript:history.back()" class="back-btn"><i class="fa-solid fa-chevron-left"></i></a>
            <div class="page-title">Team Report</div>
        </div>

        <div class="section-container">
            <!-- Level 1 -->
            <div class="level-card">
                <div class="level-badge">Level 1</div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <i class="fa-solid fa-users stat-icon"></i>
                        <span class="stat-label">Total People</span>
                        <span class="stat-value">{{ $first_level_users->count() ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-hand-holding-dollar stat-icon"></i>
                        <span class="stat-label">Total Revenue</span>
                        <span class="stat-value">{{ $totalDeposit1 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-chart-line stat-icon"></i>
                        <span class="stat-label">Team Income</span>
                        <span class="stat-value">{{ $totalCommission1 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-money-bill-transfer stat-icon"></i>
                        <span class="stat-label">Withdrawal</span>
                        <span class="stat-value">{{ $totalWithdraw1 ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Level 2 -->
            <div class="level-card">
                <div class="level-badge" style="background: var(--accent);">Level 2</div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <i class="fa-solid fa-users stat-icon" style="color: var(--accent);"></i>
                        <span class="stat-label">Total People</span>
                        <span class="stat-value">{{ $second_level_users->count() ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-hand-holding-dollar stat-icon" style="color: var(--accent);"></i>
                        <span class="stat-label">Total Revenue</span>
                        <span class="stat-value">{{ $totalDeposit2 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-chart-line stat-icon" style="color: var(--accent);"></i>
                        <span class="stat-label">Team Income</span>
                        <span class="stat-value">{{ $totalCommission2 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-money-bill-transfer stat-icon" style="color: var(--accent);"></i>
                        <span class="stat-label">Withdrawal</span>
                        <span class="stat-value">{{ $totalWithdraw2 ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Level 3 -->
            <div class="level-card">
                <div class="level-badge" style="background: #b2bec3;">Level 3</div>
                <div class="stats-grid">
                    <div class="stat-item">
                        <i class="fa-solid fa-users stat-icon" style="color: #b2bec3;"></i>
                        <span class="stat-label">Total People</span>
                        <span class="stat-value">{{ $third_level_users->count() ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-hand-holding-dollar stat-icon" style="color: #b2bec3;"></i>
                        <span class="stat-label">Total Revenue</span>
                        <span class="stat-value">{{ $totalDeposit3 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-chart-line stat-icon" style="color: #b2bec3;"></i>
                        <span class="stat-label">Team Income</span>
                        <span class="stat-value">{{ $totalCommission3 ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-money-bill-transfer stat-icon" style="color: #b2bec3;"></i>
                        <span class="stat-label">Withdrawal</span>
                        <span class="stat-value">{{ $totalWithdraw3 ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-item">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Home</span>
        </a>
        <a href="/invite" class="nav-item active">
            <i class="fa-solid fa-users-line"></i>
            <span>Team</span>
        </a>
        <a href="/my/vip" class="nav-center">
            <i class="fa-solid fa-layer-group"></i>
        </a>
        <a href="/history" class="nav-item">
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