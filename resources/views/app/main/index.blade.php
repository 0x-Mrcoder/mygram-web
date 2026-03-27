<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #0A0E1A;
            --text-primary: #FFFFFF;
            --text-secondary: #A0AEC0;
            --tile-shadow: 0 4px 20px rgba(0,0,0,0.2);
            --ios-blue: #F1C40F; /* Gold */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            padding-bottom: 100px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        /* --- Minimal Header --- */
        .header-top {
            padding: 10px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-greet { font-size: 14px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        .user-pic {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: #E5E5EA;
            display: flex; align-items: center; justify-content: center;
            color: var(--ios-blue);
            text-decoration: none;
            font-size: 18px;
        }

        /* --- Big Balance (No Card) --- */
        .balance-area {
            padding: 20px 24px 30px;
        }
        .bal-label { font-size: 15px; color: var(--text-secondary); font-weight: 500; margin-bottom: 5px; }
        .bal-val { font-size: 42px; font-weight: 800; letter-spacing: -1.5px; line-height: 1; }
        .bal-val small { font-size: 24px; font-weight: 600; color: var(--text-secondary); }

        /* --- The Tile Grid (Apple Home Style) --- */
        .grid-container {
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 30px;
        }

        .tile {
            aspect-ratio: 1;
            border-radius: 18px;
            padding: 10px;
            position: relative;
            text-decoration: none;
            overflow: hidden;
            transition: transform 0.1s;
            box-shadow: var(--tile-shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .tile:active { transform: scale(0.96); }

        .tile-icon-box {
            width: 42px; height: 42px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
            margin-bottom: 6px;
        }
        
        .tile-name {
            font-size: 11px;
            font-weight: 600;
            color: white;
            text-align: center;
            position: static;
        }

        /* Tile Variants */
        .tile.deposit { background: #161B2D; border: 1px solid rgba(255,255,255,0.05); }
        .tile.withdraw { background: linear-gradient(135deg, #F1C40F, #D4AF37); color: #000; }
        .tile.team { background: #161B2D; border: 1px solid rgba(255,255,255,0.05); }
        .tile.invite { background: #161B2D; border: 1px solid rgba(255,255,255,0.05); }

        /* --- Horizontal Plans Carousel --- */
        .section-head {
            padding: 0 24px;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .plans-scroll {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 0 20px 20px;
        }

        .plan-card {
            flex: 1;
            background: #161B2D;
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.05);
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .pc-header { display: flex; align-items: center; gap: 12px; }
        .pc-img { width: 48px; height: 48px; border-radius: 12px; background: #f2f2f7; object-fit: cover; }
        .pc-title { font-size: 16px; font-weight: 700; line-height: 1.2; }
        
        .pc-body { flex: 1; display: flex; justify-content: space-between; align-items: flex-end; }
        .pc-price { font-size: 22px; font-weight: 800; color: var(--ios-blue); }
        .pc-days { font-size: 13px; font-weight: 600; color: var(--text-secondary); background: #2D3748; padding: 4px 10px; border-radius: 8px; }

        .pc-btn {
            background: var(--ios-blue);
            color: #000;
            border: none;
            padding: 14px;
            border-radius: 16px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
        }

        /* --- Tab Bar --- */
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

    /* Modal Refactor */
        .sheet-overlay {
            position: fixed; top:0; left:0; right:0; bottom:0;
            background: rgba(0,0,0,0.4); z-index: 998;
            opacity: 0; visibility: hidden; transition: opacity 0.3s;
            pointer-events: none;
        }
        .sheet-body {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #161B2D; border-radius: 24px 24px 0 0; padding: 30px; z-index: 999;
            transform: translateY(100%); 
            transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            box-shadow: 0 -5px 25px rgba(0,0,0,0.3);
            max-height: 80vh; overflow-y: auto;
            color: #fff;
        }

        .sheet-active .sheet-overlay { opacity: 1; visibility: visible; pointer-events: auto; }
        .sheet-active .sheet-body { transform: translateY(0); }

        .m-handle { width: 40px; height: 5px; background: #E5E5EA; border-radius: 3px; margin: 0 auto 20px; }
        .m-title { font-size: 24px; font-weight: 800; margin-bottom: 8px; }
        .m-price { font-size: 36px; font-weight: 800; color: var(--ios-blue); margin-bottom: 30px; }
        .m-btn { width: 100%; padding: 18px; border-radius: 18px; background: var(--ios-blue); color: #000; font-weight: 700; border: none; font-size: 16px; transition: transform 0.1s; }
        .m-btn:active { transform: scale(0.98); }

    </style>
</head>
<body>

    <!-- Header -->
    <header class="header-top">
        <div class="user-greet">Hello {{ explode(' ', trim(auth()->user()->name))[0] }}</div>
        <a href="/mine" class="user-pic"><i class="far fa-user"></i></a>
    </header>

    <!-- Big Balance -->
    <div class="balance-area">
        <div class="bal-label">Total Balance</div>
        <div class="bal-val">₦{{ number_format(auth()->user()->balance, 0) }}<small>.{{ explode('.', number_format(auth()->user()->balance, 2))[1] }}</small></div>
    </div>

    <!-- Banner -->
    <!-- Banner Slider -->
    <div style="padding: 0 20px 25px;">
        @if($sliders->count() > 0)
            <div class="slider-container" style="overflow: hidden; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: relative;">
                <div class="slider-wrapper" style="display: flex; transition: transform 0.5s ease-in-out;">
                    @foreach($sliders as $slider)
                        <div class="slide" style="min-width: 100%;">
                            <img src="{{ asset(str_replace('/public', '', $slider->photo)) }}" style="width: 100%; display: block;">
                        </div>
                    @endforeach
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const track = document.querySelector('.slider-wrapper');
                    const slides = document.querySelectorAll('.slide');
                    if(slides.length > 1) {
                        let i = 0;
                        setInterval(() => {
                            i++;
                            if (i >= slides.length) i = 0;
                            track.style.transform = `translateX(-${i * 100}%)`;
                        }, 3000); // 3 seconds
                    }
                });
            </script>
        @else
            <!-- Fallback if no sliders -->
            <img src="{{ asset('assets/images/fortuneflow_logo.png') }}" style="width: 100%; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        @endif
    </div>

    <!-- Tile Grid -->
    <section class="grid-container">
        <a href="/user/recharge" class="tile deposit">
            <div class="tile-icon-box"><i class="fas fa-plus"></i></div>
            <div class="tile-name">Deposit</div>
        </a>
        <a href="/withdraw" class="tile withdraw">
            <div class="tile-icon-box"><i class="fas fa-arrow-down"></i></div>
            <div class="tile-name">Withdraw</div>
        </a>
        <a href="/my-team" class="tile team">
            <div class="tile-icon-box"><i class="fas fa-users"></i></div>
            <div class="tile-name">Team</div>
        </a>
        <a href="/invite" class="tile invite">
            <div class="tile-icon-box"><i class="fas fa-user-plus"></i></div>
            <div class="tile-name">Invite</div>
        </a>
    </section>

    <!-- Horizontal Plans -->
    <div class="section-head">Investments</div>
    
    <?php
        use \App\Models\Package;
        $plans = Package::where('Status', '!=','inactive')->where('tab','vip')->get();
        
        // Event Logic
        $eventEndTime = \Carbon\Carbon::parse($setting->event_end_time);
        $eventActive = $setting->event_active && $eventEndTime->isFuture();
        $eventEndTimeTimestamp = $eventActive ? $eventEndTime->timestamp * 1000 : 0;
    ?>

    <div class="plans-scroll">
        @if($plans->count() > 0)
            @foreach($plans as $plan)
                <?php
                    $isLocked = $plan->is_locked;
                    $purchasedCount = isset($userPurchases[$plan->id]) ? $userPurchases[$plan->id]->count() : 0;
                    $limitReached = $plan->purchase_limit > 0 && ($purchasedCount >= $plan->purchase_limit);
                    
                    // Discount Calculation
                    $isDiscounted = $eventActive && $plan->is_event_active;
                    $price = $plan->price;
                    $displayPrice = $price;
                    if($isDiscounted) {
                        $discount = ($price * $setting->event_discount_percent) / 100;
                        $displayPrice = $price - $discount;
                    }
                ?>
                <div class="plan-card" style="position: relative; overflow: visible;">
                    @if($isDiscounted)
                        <div style="position: absolute; top: -10px; right: -10px; background: #FF3B30; color: white; padding: 5px 10px; border-radius: 20px; font-weight: 800; font-size: 12px; z-index: 10; box-shadow: 0 4px 10px rgba(255, 59, 48, 0.3);">
                            -{{ $setting->event_discount_percent }}% OFF
                        </div>
                    @endif

                    <div class="pc-header">
                        <img src="{{ asset('assets/images/vip_cartoon.png') }}" class="pc-img">
                        <div>
                            <div class="pc-title">{{ $plan->name }}</div>
                            <div style="font-size:12px; color:#8E8E93;">Daily: {{ price($plan->daily_limit) }}</div>
                        </div>
                    </div>
                    <div class="pc-body">
                        <div>
                            @if($isDiscounted)
                                <div style="font-size: 14px; text-decoration: line-through; color: #8E8E93;">{{ price($price) }}</div>
                                <div class="pc-price" style="color: #FF3B30;">{{ price($displayPrice) }}</div>
                            @else
                                <div class="pc-price">{{ price($price) }}</div>
                            @endif
                        </div>
                        <div class="pc-days">{{ $plan->validity }} Days</div>
                    </div>
                    
                    @if($isDiscounted)
                         <div class="event-timer-small" data-endtime="{{ $eventEndTimeTimestamp }}" style="font-size: 11px; color: #FF3B30; font-weight: 600; text-align: center; margin-top: -10px; margin-bottom: 5px;">
                            Ends in: <span class="t-d">0d</span> <span class="t-h">00h</span> <span class="t-m">00m</span> <span class="t-s">00s</span>
                        </div>
                    @endif

                    @if($isLocked)
                        <button class="pc-btn" style="background: #8E8E93; cursor: not-allowed;" disabled>Locked</button>
                    @elseif($limitReached)
                        <button class="pc-btn" style="background: #8E8E93; cursor: not-allowed;" disabled>Limit Reached</button>
                    @else
                        <button class="pc-btn" onclick="openSheet({{ json_encode($plan) }}, {{ $isDiscounted ? $displayPrice : 'null' }})">Invest Now</button>
                    @endif
                </div>
            @endforeach
        @else
            <div style="padding: 20px; color: #999;">No plans available.</div>
        @endif
    </div>

    <!-- Tab Bar -->
    <nav class="tab-bar">
        <a href="/" class="tab-item active"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

    <!-- Buy Sheet Refactored -->
    <div id="sheetBackdrop" class="sheet-overlay" onclick="closeSheet()"></div>
    <div id="buySheet" class="sheet-body">
        <div class="m-handle"></div>
        <h2 id="mName" class="m-title">Plan Name</h2>
        <div id="mPrice" class="m-price">₦0.00</div>
        <div style="margin-bottom:20px; font-size:15px; color:#555;">
            Get daily returns of <strong id="mDaily">₦0.00</strong> for <strong id="mDays">0</strong> days.
        </div>
        <button id="mConfirmBtn" class="m-btn">Confirm Purchase</button>
    </div>

    <!-- Event Popup -->
    @if($eventActive)
    <div id="eventPopup" class="sheet-overlay" style="z-index: 2000; align-items: center; justify-content: center; display: flex;">
        <div style="background: white; width: 90%; max-width: 320px; border-radius: 24px; padding: 0; text-align: center; position: relative; animation: popUp 0.4s cubic-bezier(0.16, 1, 0.3, 1); overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            <div style="background: #FF3B30; padding: 20px;">
                <div style="color: white; font-weight: 800; font-size: 24px;">{{ $setting->event_title ?? 'FLASH SALE' }}</div>
                <div style="color: rgba(255,255,255,0.9); font-size: 14px; margin-top: 5px;">Limited Time Offer!</div>
            </div>
            
            <div style="padding: 25px;">
                <div style="font-size: 48px; font-weight: 800; color: #FF3B30; line-height: 1;">
                    {{ $setting->event_discount_percent }}%
                </div>
                <div style="font-size: 16px; font-weight: 600; color: #000; margin-bottom: 20px;">DISCOUNT ON SELECTED ITEMS</div>
                
                <div class="event-timer-main" data-endtime="{{ $eventEndTimeTimestamp }}" style="background: #161B2D; border: 1px solid rgba(255,255,255,0.05); padding: 10px; border-radius: 12px; display: flex; justify-content: center; gap: 10px; margin-bottom: 20px;">
                    <div class="t-box">
                        <span class="t-val t-d">00</span>
                        <span class="t-lbl">Days</span>
                    </div>
                    <div class="t-sep">:</div>
                    <div class="t-box">
                        <span class="t-val t-h">00</span>
                        <span class="t-lbl">Hrs</span>
                    </div>
                    <div class="t-sep">:</div>
                    <div class="t-box">
                        <span class="t-val t-m">00</span>
                        <span class="t-lbl">Min</span>
                    </div>
                     <div class="t-sep">:</div>
                    <div class="t-box">
                        <span class="t-val t-s">00</span>
                        <span class="t-lbl">Sec</span>
                    </div>
                </div>

                <style>
                    .t-box { display: flex; flex-direction: column; align-items: center; width: 40px; }
                    .t-val { font-size: 18px; font-weight: 800; color: #000; }
                    .t-lbl { font-size: 10px; color: #8E8E93; text-transform: uppercase; }
                    .t-sep { font-size: 18px; font-weight: 800; color: #E5E5EA; margin-top: -2px; }
                </style>

                <button onclick="closeEventPopup()" style="width: 100%; padding: 14px; background: #000; color: white; border-radius: 16px; border: none; font-weight: 700; font-size: 16px;">Check Offers</button>
            </div>
        </div>
    </div>
    @endif

    <!-- Welcome Popup (Only show if Event Popup is NOT shown) -->
    @if(!$eventActive)
    <div id="welcomePopup" class="sheet-overlay" style="z-index: 2000; align-items: center; justify-content: center; display: flex;">
        <div style="background: #161B2D; width: 90%; max-width: 320px; border-radius: 24px; padding: 30px; text-align: center; position: relative; animation: popUp 0.4s cubic-bezier(0.16, 1, 0.3, 1); box-shadow: 0 10px 40px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05);">
            <div style="font-size: 24px; font-weight: 800; margin-bottom: 12px; color: #fff;">Welcome!</div>
            
            @if($setting->registration_bonus > 0)
                <div style="margin-bottom: 20px; font-size: 15px; color: #A0AEC0;">
                    Sign up bonus: <strong style="color: var(--ios-blue); font-size: 18px;">₦{{ number_format($setting->registration_bonus) }}</strong>
                </div>
            @endif

            @if($setting->notice)
                <div style="background: #2D3748; padding: 18px; border-radius: 16px; margin-bottom: 25px; font-size: 14px; color: #eee; text-align: left; max-height: 180px; overflow-y: auto; line-height: 1.5;">
                    {!! nl2br(e($setting->notice)) !!}
                </div>
            @endif

            @if($setting->telegram_channel)
                <a href="{{ $setting->telegram_channel }}" target="_blank" style="display: block; width: 100%; padding: 16px; background: var(--ios-blue); color: #000; border-radius: 14px; text-decoration: none; font-weight: 700; margin-bottom: 12px; transition: transform 0.2s;">
                    <i class="fab fa-telegram-plane"></i> Join Telegram Channel
                </a>
            @endif

            <button onclick="closeWelcome()" style="width: 100%; padding: 16px; background: transparent; color: #fff; border-radius: 14px; border: 1.5px solid var(--ios-blue); font-weight: 700; cursor: pointer; transition: opacity 0.2s;">Close</button>
        </div>
    </div>
    @endif

    <style>
        @keyframes popUp {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for Event Popup first
            let eventPopup = document.getElementById('eventPopup');
            if (eventPopup) {
                eventPopup.style.opacity = '1';
                eventPopup.style.visibility = 'visible';
                eventPopup.style.pointerEvents = 'auto';
                startTimers(); // Start countdowns
            } else {
                // Otherwise check for Welcome Popup
                let welcomePopup = document.getElementById('welcomePopup');
                if (welcomePopup) {
                    welcomePopup.style.opacity = '1';
                    welcomePopup.style.visibility = 'visible';
                    welcomePopup.style.pointerEvents = 'auto';
                }
            }
        });

        function closeEventPopup() {
            let popup = document.getElementById('eventPopup');
            if(popup) {
                popup.style.opacity = '0';
                popup.style.visibility = 'hidden';
                setTimeout(() => { popup.style.pointerEvents = 'none'; }, 300);
            }
        }

        function closeWelcome() {
            let popup = document.getElementById('welcomePopup');
            if(popup) {
                popup.style.opacity = '0';
                popup.style.visibility = 'hidden';
                setTimeout(() => { popup.style.pointerEvents = 'none'; }, 300);
            }
        }

        // Timer Logic
        function startTimers() {
            const timers = document.querySelectorAll('[data-endtime]');
            if(timers.length === 0) return;

            function update() {
                const now = new Date().getTime();
                
                timers.forEach(timer => {
                    const end = parseInt(timer.getAttribute('data-endtime'));
                    const diff = end - now;

                    if(diff <= 0) {
                        timer.innerHTML = "Event Ended";
                        return;
                    }

                    const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                    const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const s = Math.floor((diff % (1000 * 60)) / 1000);

                    // Update main popup timer
                    if(timer.classList.contains('event-timer-main')) {
                        timer.querySelector('.t-d').innerText = d < 10 ? '0'+d : d;
                        timer.querySelector('.t-h').innerText = h < 10 ? '0'+h : h;
                        timer.querySelector('.t-m').innerText = m < 10 ? '0'+m : m;
                        timer.querySelector('.t-s').innerText = s < 10 ? '0'+s : s;
                    } 
                    // Update small card timer
                    else if(timer.classList.contains('event-timer-small')) {
                         timer.innerHTML = `Ends in: ${d}d ${h}h ${m}m ${s}s`;
                    }
                });
            }
            
            update();
            setInterval(update, 1000);
        }

        const mName = document.getElementById('mName');
        const mPrice = document.getElementById('mPrice');
        const mDaily = document.getElementById('mDaily');
        const mDays = document.getElementById('mDays');
        const mBtn = document.getElementById('mConfirmBtn');

        function openSheet(plan, discountedPrice = null) {
            mName.innerText = plan.name;
            
            if(discountedPrice !== null) {
                mPrice.innerHTML = `<span style='color:#FF3B30'>₦${Number(discountedPrice).toLocaleString()}</span> <small style='text-decoration:line-through; color:#999; font-size:16px;'>₦${Number(plan.price).toLocaleString()}</small>`;
            } else {
                mPrice.innerText = '₦' + Number(plan.price).toLocaleString();
            }
            
            mDaily.innerText = '₦' + Number(plan.daily_limit).toLocaleString();
            mDays.innerText = plan.validity;
            
            mBtn.onclick = function() {
                window.location.href = '/purchase/confirmation/' + plan.id;
            };

            document.body.classList.add('sheet-active');
        }

        function closeSheet() {
            document.body.classList.remove('sheet-active');
        }
    </script>
    
    @include('alert-message')
</body>
</html>