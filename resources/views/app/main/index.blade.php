<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Dashboard - MyGram</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
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
            --glass-border: rgba(255, 255, 255, 0.5);
            --shadow-sm: 0 4px 6px rgba(0,0,0,0.02);
            --shadow-md: 0 10px 20px rgba(238, 102, 127, 0.15);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Outfit', sans-serif; background-color: var(--bg-body); color: var(--text-main); padding-bottom: 100px; }
        
        .main-wrapper { max-width: 480px; margin: 0 auto; background: var(--bg-body); min-height: 100vh; position: relative; }

        /* Header Section */
        .hero-header {
            background: linear-gradient(135deg, #ecccdeff 0%, #fff 100%);
            padding: 1px 20px 1px;
            padding-top: -10px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }
        
        .top-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: -20px; }
        .logo-img { height: 140px; width: auto; }
        .user-actions { display: flex; gap: 15px; }
        .action-btn { width: 40px; height: 40px; border-radius: 50%; background: white; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); color: var(--text-main); text-decoration: none; font-size: 18px; transition: transform 0.2s; }
        .action-btn:active { transform: scale(0.9); }

        /* Balance Card */
        .balance-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
        }
        .balance-label { font-size: 13px; opacity: 0.9; margin-bottom: 5px; font-weight: 500; }
        .balance-amount { font-size: 32px; font-weight: 700; margin-bottom: 15px; letter-spacing: -0.5px; }
        .balance-actions { display: flex; gap: 10px; }
        .balance-btn {
            flex: 1;
            padding: 10px;
            border-radius: 12px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .balance-btn:active { transform: scale(0.95); }
        .balance-btn.deposit { background: white; color: var(--primary); }
        .balance-btn.withdraw { background: rgba(255, 255, 255, 0.2); color: white; border: 1px solid rgba(255, 255, 255, 0.4); }

        /* Swiper */
        .swiper-container { width: 100%; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md); }
        .swiper-slide img { width: 100%; height: 180px; object-fit: cover; display: block; }
        .swiper-pagination-bullet-active { background: var(--primary) !important; width: 20px; border-radius: 10px; }

        /* Quick Actions Grid */
        .action-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; padding: 0 20px; margin-bottom: 30px; }
        .grid-item { display: flex; flex-direction: column; align-items: center; gap: 8px; text-decoration: none; }
        .icon-box {
            width: 60px; height: 60px;
            background: white;
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            color: var(--primary);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.5);
        }
        .grid-item:active .icon-box { transform: translateY(2px); box-shadow: none; background: var(--primary); color: white; }
        .grid-label { font-size: 12px; font-weight: 500; color: var(--text-sub); }

        /* Content Section */
        .section-container { padding: 0 20px; }
        .section-title { font-size: 18px; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; }
        .section-title span { background: linear-gradient(45deg, var(--primary), var(--accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Tabs */
        .custom-tabs { background: white; padding: 6px; border-radius: 50px; display: flex; margin-bottom: 20px; box-shadow: var(--shadow-sm); }
        .tab-btn { flex: 1; padding: 10px; border-radius: 40px; text-align: center; font-size: 14px; font-weight: 600; color: var(--text-sub); cursor: pointer; transition: all 0.3s; }
        .tab-btn.active { background: var(--primary); color: white; box-shadow: 0 4px 10px rgba(238, 102, 127, 0.3); }

        /* Plan Cards */
        .plan-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            display: flex;
            gap: 15px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.03);
        }
        .plan-card::before { content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%; background: var(--primary); }
        .plan-img { width: 100px; height: 100px; border-radius: var(--radius-md); object-fit: cover; background: #eee; }
        .plan-info { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .plan-name { font-size: 16px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .plan-price { font-size: 18px; font-weight: 800; color: var(--primary); }
        .plan-meta { display: flex; gap: 15px; margin-top: 8px; }
        .meta-item { display: flex; flex-direction: column; }
        .meta-label { font-size: 10px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.5px; }
        .meta-value { font-size: 13px; font-weight: 600; color: var(--text-main); }
        
        .action-button {
            background: var(--text-main);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            margin-top: 10px;
            width: fit-content;
            align-self: flex-end;
            cursor: pointer;
        }
        .action-button.primary { background: var(--primary); box-shadow: 0 4px 10px rgba(238, 102, 127, 0.3); }
        .action-button:disabled { background: #e0e0e0; color: #aaa; box-shadow: none; }

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

        /* Toast */
        #toast-container { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 10000; width: 90%; max-width: 400px; pointer-events: none; }
        .toast { background: white; padding: 16px 20px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); display: flex; align-items: center; margin-bottom: 10px; opacity: 0; transform: translateY(-20px); transition: all 0.3s; border-left: 5px solid #ddd; pointer-events: auto; }
        .toast.show { opacity: 1; transform: translateY(0); }
        .toast-icon { font-size: 24px; margin-right: 15px; }
        .toast-content { flex-grow: 1; }
        .toast-title { font-weight: 700; font-size: 15px; margin-bottom: 2px; color: var(--text-main); }
        .toast-message { font-size: 13px; color: var(--text-sub); }
        .toast.success { border-left-color: #00b894; } .toast.success .toast-icon { color: #00b894; }
        .toast.error { border-left-color: #d63031; } .toast.error .toast-icon { color: #d63031; }
    </style>
</head>

<body>
    <!-- Mandatory Name Modal -->
    <div id="nameModal" style="display: {{ (auth()->check() && !auth()->user()->virtual_account_number) ? 'flex' : 'none' }}; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 99999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <div style="background: white; padding: 30px; border-radius: 24px; width: 90%; max-width: 400px; text-align: center; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
            <div style="width: 60px; height: 60px; background: #fff0f3; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: var(--primary); font-size: 24px;">
                <i class="fa-regular fa-user"></i>
            </div>
            <h2 style="font-size: 20px; font-weight: 700; margin-bottom: 10px; color: var(--text-main);">Action Required</h2>
            <p style="font-size: 14px; color: var(--text-sub); margin-bottom: 25px; line-height: 1.5;">
                Please confirm your <b>Full Name</b> to generate your dedicated bank account.
            </p>
            
            @if(session('error'))
                <div style="background: #ffe6e6; color: #d63031; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; text-align: left;">
                    <i class="fa-solid fa-circle-exclamation" style="margin-right: 5px;"></i> {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div style="background: #e6fffa; color: #00b894; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 20px; text-align: left;">
                    <i class="fa-solid fa-circle-check" style="margin-right: 5px;"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.update_name') }}" method="POST">
                @csrf
                <div style="margin-bottom: 20px; text-align: left;">
                    <label style="font-size: 12px; font-weight: 600; margin-bottom: 8px; display: block; color: var(--text-main);">Full Legal Name</label>
                    <input type="text" name="name" required value="{{ (auth()->user()->name && auth()->user()->name != 'User') ? auth()->user()->name : '' }}" placeholder="e.g. Usman Umar" minlength="3"
                        style="width: 100%; height: 50px; padding: 0 15px; border: 2px solid #eee; border-radius: 12px; font-size: 16px; outline: none; transition: all 0.3s; font-family: 'Outfit', sans-serif;">
                </div>
                
                <button type="submit" style="width: 100%; height: 50px; background: var(--primary); color: white; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 15px rgba(238, 102, 127, 0.4);">
                    Save & Generate Account
                </button>
            </form>
        </div>
    </div>

    <div class="main-wrapper">
        
        <!-- Header -->
       <div class="hero-header">
            <div class="top-nav">
                <img src="{{ asset('as/images/logo.png') }}" alt="MyGram" class="logo-img">
                <div class="user-actions">
                    <a href="https://whatsapp.com/channel/0029VbBkxEMGehEQByl6tu3j" class="action-btn"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            
            <!-- Balance Card -->
            <div class="balance-card">
                <div class="balance-label">Total Balance</div>
                <div class="balance-amount">₦{{ number_format(auth()->user()->balance, 2) }}</div>
                <div class="balance-actions">
                    <a href="/user/recharge" class="balance-btn deposit">Deposit</a>
                    <a href="/withdraw" class="balance-btn withdraw">Withdraw</a>
                </div>
            </div>

            <!-- <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="/photo_2025-09-16_22-00-27.jpg" alt="Banner 1"></div>
                    <div class="swiper-slide"><img src="/photo_2025-09-16_18-21-33.jpg" alt="Banner 2"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div> -->
        </div>

        <!-- Quick Actions -->

        <!-- Quick Actions -->
        <div class="action-grid">
            <a href="/invite" class="grid-item">
                <div class="icon-box"><i class="fa-solid fa-user-plus"></i></div>
                <span class="grid-label">Invite</span>
            </a>
            <a href="/user/recharge" class="grid-item">
                <div class="icon-box"><i class="fa-solid fa-wallet"></i></div>
                <span class="grid-label">Deposit</span>
            </a>
            <a href="/withdraw" class="grid-item">
                <div class="icon-box"><i class="fa-solid fa-money-bill-transfer"></i></div>
                <span class="grid-label">Withdraw</span>
            </a>
            <a href="https://whatsapp.com/channel/0029VbBkxEMGehEQByl6tu3j" class="grid-item">
                <div class="icon-box"><i class="fa-solid fa-newspaper"></i></div>
                <span class="grid-label">Group</span>
            </a>
        </div>

        <!-- Plans Section -->
        <div class="section-container">
            <div class="section-title">
                <span>Mygram Plans</span>
            </div>

            <?php
                use \App\Models\Package;
                $dailyPlans = Package::where('Status', '!=','inactive')->where('tab','vip')->get();
                $welfarePlans = Package::where('Status', '!=','inactive')->where('tab', 'fixed')->get();
            ?>

            <div class="custom-tabs">
                <div class="tab-btn active" data-tab="daily">Daily Plans</div>
                <div class="tab-btn" data-tab="welfare">Easy Plans</div>
            </div>

            <div id="daily" class="tab-content active">
                @if(isset($dailyPlans) && $dailyPlans->count() > 0)
                    @foreach($dailyPlans as $element)
                        <?php
                            $myVip = auth()->check() ? \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first() : null;
                        ?>
                        <div class="plan-card">
                            <img src="{{ asset('assets/images/favion.png') }}" alt="{{ $element->name }}" class="plan-img">
                            <div class="plan-info">
                                <div>
                                    <h3 class="plan-name">{{ $element->name }}</h3>
                                    <div class="plan-price">{{ price($element->price) }}</div>
                                </div>
                                <div class="plan-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Daily</span>
                                        <span class="meta-value">{{ price($element->daily_limit) }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Cycle</span>
                                        <span class="meta-value">{{ $element->validity }} Days</span>
                                    </div>
                                </div>
                                @if($myVip)
                                    <button class="action-button" disabled>Active</button>
                                @else
                                    @if($element->status == 'coming')
                                        <button class="action-button" disabled>Coming Soon</button>
                                    @else
                                        <button class="action-button primary" onclick="window.location.href='/purchase/confirmation/{{ $element->id }}'">Invest</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: var(--text-sub);">
                        <i class="fa-regular fa-folder-open" style="font-size: 30px; margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>No plans available</p>
                    </div>
                @endif
            </div>

            <div id="welfare" class="tab-content" style="display: none;">
                @if(isset($welfarePlans) && $welfarePlans->count() > 0)
                    @foreach($welfarePlans as $element)
                        <?php
                            $myVip = auth()->check() ? \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first() : null;
                        ?>
                        <div class="plan-card">
                            <img src="{{ asset('assets/images/favion.png') }}" alt="{{ $element->name }}" class="plan-img">
                            <div class="plan-info">
                                <div>
                                    <h3 class="plan-name">{{ $element->name }}</h3>
                                    <div class="plan-price">{{ price($element->price) }}</div>
                                </div>
                                <div class="plan-meta">
                                    <div class="meta-item">
                                        <span class="meta-label">Daily</span>
                                        <span class="meta-value">{{ price($element->daily_limit) }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-label">Cycle</span>
                                        <span class="meta-value">{{ $element->validity }} Days</span>
                                    </div>
                                </div>
                                @if($myVip)
                                    <button class="action-button" disabled>Active</button>
                                @else
                                    @if($element->status == 'coming')
                                        <button class="action-button" disabled>Coming Soon</button>
                                    @else
                                        <button class="action-button primary" onclick="window.location.href='/purchase/confirmation/{{ $element->id }}'">Invest</button>

                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: var(--text-sub);">
                        <i class="fa-regular fa-folder-open" style="font-size: 30px; margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>No plans available</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-item active">
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
        <a href="/mine" class="nav-item">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <div id="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Toast Logic
        function showToast(type, title, message) {
            const icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';
            const toastHtml = `
                <div class="toast ${type}">
                    <div class="toast-icon">${icon}</div>
                    <div class="toast-content">
                        <div class="toast-title">${title}</div>
                        <div class="toast-message">${message}</div>
                    </div>
                </div>
            `;
            const $toast = $(toastHtml);
            $('#toast-container').append($toast);
            $toast[0].offsetHeight; // Trigger reflow
            $toast.addClass('show');
            setTimeout(() => {
                $toast.removeClass('show');
                setTimeout(() => $toast.remove(), 300);
            }, 3000);
        }

        function notify(status, msg) {
            const title = status === 'success' ? 'Success' : 'Error';
            showToast(status, title, msg);
        }

        $(document).ready(function() {
            // Swiper
            new Swiper('.swiper-container', {
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
                effect: 'fade',
                fadeEffect: { crossFade: true }
            });

            // Tabs
            $('.tab-btn').on('click', function() {
                $('.tab-btn').removeClass('active');
                $('.tab-content').hide();
                
                $(this).addClass('active');
                const tabId = $(this).data('tab');
                $('#' + tabId).fadeIn(300);
            });

            // Trigger Toasts from Session
            @if(session()->has('success'))
                notify('success', "{{ session()->get('success') }}");
            @endif

            @if(session()->has('error'))
                notify('error', "{{ session()->get('error') }}");
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    notify('error', "{{ $error }}");
                @endforeach
            @endif
        });
    </script>
</body>
</html>