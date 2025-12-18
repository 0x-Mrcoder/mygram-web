<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>My Orders - MyGram</title>

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
            background: linear-gradient(135deg, #df506cff 0%, #fff 100%);
            padding: 20px 20px 40px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: -30px;
        }
        .top-nav { display: flex; justify-content: center; align-items: center; margin-bottom: 20px; }
        .logo-img { height: 32px; width: auto; }
        .page-title { text-align: center; font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 10px; }

        /* Content */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }

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
        .plan-img { width: 90px; height: 90px; border-radius: var(--radius-md); object-fit: cover; background: #eee; }
        .plan-info { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .plan-name { font-size: 16px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .plan-price { font-size: 14px; color: var(--text-sub); }
        
        .plan-stats { display: flex; gap: 15px; margin-top: 8px; background: #f8f9fa; padding: 8px; border-radius: 10px; }
        .stat-item { flex: 1; }
        .stat-label { font-size: 10px; color: var(--text-sub); text-transform: uppercase; }
        .stat-value { font-size: 13px; font-weight: 700; color: var(--primary); }

        .action-area { margin-top: 10px; display: flex; justify-content: space-between; align-items: center; }
        .validity-badge { font-size: 12px; font-weight: 600; color: var(--text-main); background: #f0f2f5; padding: 4px 10px; border-radius: 8px; }
        
        .claim-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(238, 102, 127, 0.3);
            text-decoration: none;
            display: inline-block;
        }
        .claim-btn:disabled { background: #e0e0e0; color: #aaa; box-shadow: none; cursor: not-allowed; }
        .countdown-btn { background: #fff0f3; color: var(--primary); border: 1px solid var(--primary); box-shadow: none; }

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
            <!-- <div class="top-nav">
                <img src="/logo.png" alt="MyGram" class="logo-img">
            </div> -->
            <h1 class="page-title">My Orders</h1>
        </div>

        <?php
            $packageOne = \App\Models\Package::where('Status', '!=','inactive')->where('tab','vip')->get();
            $packagetwo = \App\Models\Package::where('Status', '!=','inactive')->where('tab', 'fixed')->get();
        ?>  

        <!-- Content -->
        <div class="section-container">
            
            <div class="custom-tabs">
                <div class="tab-btn active" data-tab="daily">Daily Plans</div>
                <div class="tab-btn" data-tab="welfare">Welfare Plans</div>
            </div>

            <div id="daily" class="tab-content active">
                @if($packageOne->count() > 0)
                    @foreach($packageOne as $element)
                        <?php
                            $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first();
                        ?>  
                        @if($myVip)
                        <div class="plan-card">
                            <img src="{{ asset('assets/images/favion.png') }}" alt="{{ $element->name }}" class="plan-img">
                            <div class="plan-info">
                                <div>
                                    <h3 class="plan-name">{{ $element->name }}</h3>
                                    <p class="plan-price">Price: {{ price($element->price) }}</p>
                                </div>
                                <div class="plan-stats">
                                    <div class="stat-item">
                                        <div class="stat-label">Daily</div>
                                        <div class="stat-value">{{ price($element->daily_limit) }}</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-label">Total</div>
                                        <div class="stat-value">{{ price($element->daily_limit * $element->validity) }}</div>
                                    </div>
                                </div>
                                <div class="action-area">
                                    <span class="validity-badge">{{ $element->validity }} Days</span>
                                    
                                    @php
                                        $last_claim = \App\Models\UserLedger::where(['user_id' => auth()->id(), 'reason' => 'daily_claim_'.$element->id])->latest()->first();
                                        $lastPurchaseDate = $last_claim->created_at ?? $myVip->created_at; 
                                        $diffInHours = $lastPurchaseDate->diffInHours(now());
                                    @endphp

                                    <button class="claim-btn countdown-btn" id="countdown-{{ $element->id }}" style="display: none;">00h 00m 00s</button>
                                    <button class="claim-btn" onclick='window.location.href="/my/vip?vip_id={{$element->id}}"' id="claim-{{ $element->id }}" style="display: none;">Claim</button>
                                    <button class="claim-btn" id="done-{{ $element->id }}" style="display: none; background: #ccc;" disabled>Done</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            (function() {
                                const lastPurchaseDateStr = @json($lastPurchaseDate);
                                const diffInHours = @json($diffInHours);
                                const alreadyClaimedToday = {{ App\Models\UserLedger::where(['user_id' => auth()->id(), 'reason' => 'daily_claim_'.$element->id])->whereDate('created_at', today())->exists() ? 'true' : 'false' }};

                                const countdownBtn = document.getElementById("countdown-{{ $element->id }}");
                                const claimBtn = document.getElementById("claim-{{ $element->id }}");
                                const doneBtn = document.getElementById("done-{{ $element->id }}");

                                if (diffInHours < 24) {
                                    countdownBtn.style.display = 'inline-block';
                                    let purchaseDate = new Date(lastPurchaseDateStr);
                                    let endTime = new Date(purchaseDate.getTime() + 24 * 60 * 60 * 1000);
            
                                    function updateCountdown() {
                                        let now = new Date().getTime();
                                        let distance = endTime - now;
            
                                        if (distance < 0) {
                                            clearInterval(countdownInterval);
                                            countdownBtn.style.display = 'none';
                                            claimBtn.style.display = 'inline-block';
                                            return;
                                        }
            
                                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
                                        countdownBtn.innerText = `${hours}h ${minutes}m ${seconds}s`;
                                    }
                                    let countdownInterval = setInterval(updateCountdown, 1000);
                                    updateCountdown();
                                } else {
                                    if(alreadyClaimedToday) {
                                        doneBtn.style.display = 'inline-block';
                                    } else {
                                        claimBtn.style.display = 'inline-block';
                                    }
                                }
                            })();
                        </script>
                        @endif
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: var(--text-sub);">
                        <i class="fa-regular fa-folder-open" style="font-size: 30px; margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>No active daily plans</p>
                    </div>
                @endif
            </div>

            <div id="welfare" class="tab-content" style="display: none;">
                @if($packagetwo->count() > 0)
                    @foreach($packagetwo as $element1)
                        <?php
                            $myVip = \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element1->id)->where('status', 'active')->first();
                        ?>  
                        @if($myVip)
                        <div class="plan-card">
                            <img src="{{ asset('assets/images/favion.png') }}" alt="{{ $element1->name }}" class="plan-img">
                            <div class="plan-info">
                                <div>
                                    <h3 class="plan-name">{{ $element1->name }}</h3>
                                    <p class="plan-price">Price: {{ price($element1->price) }}</p>
                                </div>
                                <div class="plan-stats">
                                    <div class="stat-item">
                                        <div class="stat-label">Daily</div>
                                        <div class="stat-value">{{ price($element1->daily_limit) }}</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-label">Total</div>
                                        <div class="stat-value">{{ price($element1->daily_limit * $element1->validity) }}</div>
                                    </div>
                                </div>
                                <div class="action-area">
                                    <span class="validity-badge">{{ $element1->validity }} Days</span>
                                    @if($myVip->created_at->addDays($element1->validity) <= now())
                                        <button class="claim-btn" onclick='window.location.href="/my/vip?vip_id={{$element1->id}}"'> Claim </button>
                                    @else
                                        <button class="claim-btn" disabled style="background: #e0e0e0; color: #888;">Running</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @else
                    <div style="text-align: center; padding: 40px; color: var(--text-sub);">
                        <i class="fa-regular fa-folder-open" style="font-size: 30px; margin-bottom: 10px; opacity: 0.5;"></i>
                        <p>No active welfare plans</p>
                    </div>
                @endif
            </div>
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
        <a href="/mine" class="nav-item">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tab-btn').on('click', function() {
                $('.tab-btn').removeClass('active');
                $('.tab-content').hide();
                
                $(this).addClass('active');
                const tabId = $(this).data('tab');
                $('#' + tabId).fadeIn(300);
            });
        });
    </script>
</body>
</html>