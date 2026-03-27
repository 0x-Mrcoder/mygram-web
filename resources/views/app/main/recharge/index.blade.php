<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Fund Wallet - FortuneFlow</title>

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
            --ios-divider: #2D3748;
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
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
        }
        .history-btn {
            position: absolute; right: 20px; top: 10px;
            font-size: 14px; color: var(--ios-blue);
        }

        /* Container */
        .r-container { padding: 0 20px; }

        /* Balance */
        .bal-card {
            text-align: center; margin-bottom: 30px;
        }
        .bal-lbl { font-size: 13px; color: var(--ios-gray); margin-bottom: 5px; }
        .bal-val { font-size: 34px; font-weight: 700; letter-spacing: -1px; }

        /* Input Group */
        .input-group {
            background: var(--ios-card);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex; align-items: center;
        }
        .curr-sym { font-size: 20px; font-weight: 600; color: #fff; margin-right: 10px; }
        .amt-inp {
            flex: 1; border: none; outline: none; background: transparent;
            font-size: 20px; font-weight: 600; color: #fff;
        }
        .amt-inp::placeholder { color: #C7C7CC; }

        /* Chips */
        .chip-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
            margin-bottom: 30px;
        }
        .chip {
            background: var(--ios-card);
            padding: 12px 5px; border-radius: 10px;
            text-align: center; font-size: 14px; font-weight: 600;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03); cursor: pointer;
            transition: all 0.2s; color: #fff;
        }
        .chip:active { transform: scale(0.96); }
        .chip.active { background: var(--ios-blue); color: white; }

        /* Button */
        .pay-btn {
            width: 100%; padding: 16px;
            background: var(--ios-blue); color: white;
            border: none; border-radius: 14px;
            font-size: 16px; font-weight: 700;
            cursor: pointer; margin-bottom: 30px;
        }
        .pay-btn:active { opacity: 0.8; }

        /* Rules */
        .rules-box {
            background: var(--ios-card);
            border-radius: 12px; padding: 20px;
        }
        .rb-title { font-size: 13px; color: var(--ios-gray); text-transform: uppercase; font-weight: 600; margin-bottom: 15px; }
        .rule-item {
            font-size: 13px; color: #fff; margin-bottom: 10px;
            display: flex; gap: 10px; line-height: 1.4;
        }
        .rule-icon { color: var(--ios-gray); margin-top: 2px; }

        /* Navigation */
        .ios-tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16, 20, 35, 0.95);
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

        /* Toast */
        #toast-box {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            z-index: 9999; pointer-events: none; width: 90%; max-width: 380px;
        }
        .c-toast {
            background: #1e293b; color: white;
            padding: 14px 20px; border-radius: 50px;
            margin-bottom: 10px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            opacity: 0; transform: translateY(-20px); transition: all 0.3s;
        }
        .c-toast.show { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <div class="page-header">
        Fund Wallet
        <a href="{{ route('deposit.record') }}" class="history-btn">History</a>
    </div>

    <div class="r-container">
        
        <div class="bal-card">
            <div class="bal-lbl">Current Balance</div>
            <div class="bal-val">₦{{ number_format(auth()->user()->balance, 2) }}</div>
        </div>

        <form id="topupForm" action="/home/create_topup_order" method="POST">
            @csrf
            
                <!-- Normal Payment Flow -->
                <div class="input-group">
                    <span class="curr-sym">₦</span>
                    <input id="topupAmount" type="number" class="amt-inp" name="amount" placeholder="0.00">
                </div>

                <div class="chip-grid">
                    @foreach($packages as $pkg)
                        <div class="chip" onclick="setAmt({{ $pkg->price }})">{{ number_format($pkg->price) }}</div>
                    @endforeach
                </div>

                <button type="button" onclick="goPayment()" class="pay-btn">Proceed</button>

        </form>


        <div class="rules-box">
            <div class="rb-title">Notes</div>
            <div class="rule-item">
                <i class="fas fa-info-circle rule-icon"></i>
                <span>Minimum deposit is <strong>₦{{ number_format($setting->minimum_recharge) }}</strong>.</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-info-circle rule-icon"></i>
                <span>Deposits are credited automatically.</span>
            </div>
            <div class="rule-item">
                <i class="fas fa-info-circle rule-icon"></i>
                <span>Use the exact account details provided on the next screen.</span>
            </div>
        </div>

    </div>

    <!-- Navigation -->
    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

    <div id="toast-box"></div>

    <script>
        function setAmt(val) {
            document.getElementById('topupAmount').value = val;
            document.querySelectorAll('.chip').forEach(el => el.classList.remove('active'));
            event.target.classList.add('active');
        }

        function goPayment(){
            let amount = document.getElementById('topupAmount').value;
            // Use dynamic minimum from server
            let minAmount = {{ $setting->minimum_recharge }};
            
            if (!amount || parseFloat(amount) < minAmount) {
                if (typeof iOSAlert !== 'undefined') {
                    iOSAlert.fire({
                        icon: 'warning',
                        title: 'Minimum Deposit',
                        text: "Minimum deposit is ₦" + minAmount.toLocaleString(),
                        confirmButtonText: 'OK'
                    });
                } else {
                    alert("Minimum deposit is ₦" + minAmount.toLocaleString());
                }
                return;
            }
            document.getElementById('topupForm').submit();
        }

        function toast(msg) {
            let box = document.getElementById('toast-box');
            let el = document.createElement('div');
            el.className = 'c-toast';
            el.innerHTML = `<i class="fas fa-check-circle" style="color:#4ade80"></i> <span>${msg}</span>`;
            box.appendChild(el);
            void el.offsetWidth; el.classList.add('show');
            setTimeout(() => { el.classList.remove('show'); setTimeout(() => el.remove(), 300); }, 3000);
        }
    </script>
    
    @include('alert-message')
</body>
</html>