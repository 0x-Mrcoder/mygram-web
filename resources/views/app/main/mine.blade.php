<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Profile - MyGram</title>
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
            background: linear-gradient(135deg, #ca526aff 0%, #528f9eff 100%);
            padding: 30px 20px 50px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: -30px;
            text-align: center;
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .user-avatar {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            font-size: 30px; color: white;
            border: 2px solid rgba(255,255,255,0.5);
        }
        .user-name { font-size: 22px; font-weight: 700; margin-bottom: 5px; text-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .user-id { 
            font-size: 13px; 
            background: rgba(255, 255, 255, 0.2); 
            padding: 4px 12px; 
            border-radius: 20px; 
            display: inline-block;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Content */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }

        /* Menu List */
        .menu-list {
            background: white;
            border-radius: var(--radius-lg);
            padding: 10px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
        }
        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px;
            text-decoration: none;
            color: var(--text-main);
            border-bottom: 1px solid #f5f5f5;
            transition: background 0.2s;
            border-radius: 12px;
        }
        .menu-item:last-child { border-bottom: none; }
        .menu-item:active { background: #f9f9f9; }
        
        .menu-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: #fff0f3;
            color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            margin-right: 15px;
        }
        .menu-info { flex: 1; }
        .menu-title { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
        .menu-desc { font-size: 12px; color: var(--text-sub); }
        .menu-arrow { color: #ccc; font-size: 14px; }

        /* Logout Button */
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
            background: #fff;
            color: #ff4757;
            border: none;
            border-radius: var(--radius-lg);
            font-size: 16px;
            font-weight: 600;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            text-decoration: none;
            gap: 10px;
            margin-bottom: 20px;
        }

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
            <div class="user-avatar">
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="user-name">{{ auth()->user()->phone }}</div>
            <div class="user-id">ID: {{ auth()->user()->id }}</div>
        </div>

        <!-- Content -->
        <div class="section-container">
            
            <!-- Financial -->
            <div class="menu-list">
                <a href="/user/recharge" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-wallet"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Recharge</div>
                        <div class="menu-desc">Add funds to wallet</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/withdraw" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Withdraw</div>
                        <div class="menu-desc">Cash out earnings</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/add/card" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-credit-card"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Bank Card</div>
                        <div class="menu-desc">Manage withdrawal methods</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/deposit/record" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Deposits</div>
                        <div class="menu-desc">View deposit history</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
            </div>

            <!-- Team & Activity -->
            <div class="menu-list">
                <a href="/invite" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-user-group"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Invite</div>
                        <div class="menu-desc">Refer friends</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/my-team" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">My Team</div>
                        <div class="menu-desc">View team members</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/history" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">History</div>
                        <div class="menu-desc">Transaction records</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="/my/vip" class="menu-item">
                    <div class="menu-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Orders</div>
                        <div class="menu-desc">View purchased plans</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
            </div>

            <!-- App & Support -->
            <div class="menu-list">
                <a href="https://wa.me/+2347074462141" class="menu-item">
                    <div class="menu-icon"><i class="fa-brands fa-whatsapp"></i></div>t
                    <div class="menu-info">
                        <div class="menu-title">Support</div>
                        <div class="menu-desc">Contact customer service</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>
                <a href="https://t.me/mygramoffi" class="menu-item">
                    <div class="menu-icon"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="menu-info">
                        <div class="menu-title">Telegram</div>
                        <div class="menu-desc">Official group</div>
                    </div>
                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                </a>

                <!--<a href="/download-apk" class="menu-item">-->
                <!--    <div class="menu-icon"><i class="fa-brands fa-android"></i></div>-->
                <!--    <div class="menu-info">-->
                <!--        <div class="menu-title">Download App</div>-->
                <!--        <div class="menu-desc">Get the latest version</div>-->
                <!--    </div>-->
                <!--    <i class="fa-solid fa-chevron-right menu-arrow"></i>-->
                <!--</a>-->
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i> Log Out
                </button>
            </form>

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
        <a href="/history" class="nav-item">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
        </a>
        <a href="/mine" class="nav-item active">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>