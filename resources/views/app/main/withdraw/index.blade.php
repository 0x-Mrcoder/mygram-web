<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Withdraw - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --ios-bg: #0A0E1A;
            --ios-card: #161B2D;
            --ios-blue: #F1C40F;
            --ios-gray: #A0AEC0;
            --ios-red: #E74C3C;
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
            font-size: 14px; color: var(--ios-blue); text-decoration: none;
        }

        /* Container */
        .w-container { padding: 0 20px; }

        /* Balance */
        .bal-card {
            text-align: center; margin-bottom: 30px;
        }
        .bal-lbl { font-size: 13px; color: var(--ios-gray); margin-bottom: 5px; }
        .bal-val { font-size: 34px; font-weight: 700; letter-spacing: -1px; }

        /* Bank Selector Group */
        .list-group {
            background: var(--ios-card);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
        }
        .list-item {
            display: flex; align-items: center;
            padding: 12px 16px;
            background: var(--ios-card);
            text-decoration: none;
            color: #fff;
            cursor: pointer;
        }
        .list-item:active { background: #2D3748; }
        
        .li-icon {
            width: 30px; height: 30px;
            border-radius: 7px; background: var(--ios-blue);
            color: white; display: flex; align-items: center; justify-content: center;
            font-size: 14px; margin-right: 12px;
        }
        .li-content { flex: 1; }
        .li-title { font-size: 16px; margin-bottom: 2px; }
        .li-sub { font-size: 13px; color: var(--ios-gray); }
        .li-arrow { color: #C7C7CC; font-size: 14px; }

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

        /* Button */
        .w-btn {
            width: 100%; padding: 16px;
            background: var(--ios-blue); color: #000;
            border: none; border-radius: 14px;
            font-size: 16px; font-weight: 700;
            cursor: pointer; margin-bottom: 30px;
        }
        .w-btn:active { opacity: 0.8; }

        /* Rules */
        .rules-box {
            padding: 0 10px;
        }
        .rb-title { font-size: 13px; color: var(--ios-gray); text-transform: uppercase; font-weight: 600; margin-bottom: 10px; }
        .rule-item {
            font-size: 13px; color: var(--ios-gray); margin-bottom: 8px;
            line-height: 1.4;
        }

        /* Modal Sheet */
        .sheet-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4); z-index: 999;
            opacity: 0; pointer-events: none; transition: opacity 0.3s;
        }
        .sheet-panel {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #161B2D; border-radius: 14px 14px 0 0;
            padding: 20px 20px 40px; transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
            color: #fff;
        }
        .sheet-active .sheet-overlay { opacity: 1; pointer-events: auto; }
        .sheet-active .sheet-panel { transform: translateY(0); }

        .sheet-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px;
        }
        .sh-title { font-size: 17px; font-weight: 600; }
        .sh-cancel { color: var(--ios-blue); font-size: 16px; cursor: pointer; }

        .confirm-list {
            background: #2D3748; border-radius: 12px;
            padding: 0 15px; margin-bottom: 25px;
        }
        .cl-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 0; border-bottom: 0.5px solid #161B2D;
        }
        .cl-row:last-child { border-bottom: none; }
        .cl-lbl { font-size: 15px; }
        .cl-val { font-size: 15px; color: var(--ios-gray); }
        .cl-val.highlight { color: #fff; font-weight: 600; }

        .confirm-btn {
            width: 100%; padding: 16px; background: var(--ios-blue);
            color: #000; border: none; border-radius: 12px;
            font-size: 16px; font-weight: 600; cursor: pointer;
        }

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

    </style>
</head>
<body>

    <div class="page-header">
        Withdraw
        <a href="{{ route('withdraw.record') }}" class="history-btn">History</a>
    </div>

    <div class="w-container">
        
        <div class="bal-card">
            <div class="bal-lbl">Available Balance</div>
            <div class="bal-val">₦{{ number_format(auth()->user()->balance, 2) }}</div>
        </div>

        <form action="{{route('user.withdraw-confirm-submit')}}" method="POST" id="withdrawForm">
            @csrf

            <!-- Bank Selector -->
            <div class="list-group">
                <a href="/add/card" class="list-item">
                    <div class="li-icon"><i class="fas fa-university"></i></div>
                    <div class="li-content">
                        <div class="li-title">Withdraw To</div>
                        <div class="li-sub">{{ auth()->user()->holder_name ?? 'Select Bank Account' }}</div>
                    </div>
                    <i class="fas fa-chevron-right li-arrow"></i>
                </a>
            </div>

            <!-- Amount Input -->
            <div class="input-group">
                <span class="curr-sym">₦</span>
                <input type="number" name="amount" id="wAmount" class="amt-inp" placeholder="0.00" required>
            </div>

            <button type="button" class="w-btn" onclick="openConfirm()">Withdraw</button>

            <!-- Rules -->
            <div class="rules-box">
                <div class="rb-title">Information</div>
                <div class="rule-item">Min withdrawal: ₦{{ number_format($setting->minimum_withdraw) }}</div>
                <div class="rule-item">Handling fee: {{ $setting->withdraw_charge }}%</div>
                <div class="rule-item">Maximum withdrawal: ₦{{ number_format($setting->maximum_withdraw) }}</div>
                <div class="rule-item">Processing time: 10:00 AM - 5:40 PM (Mon-Fri)</div>
            </div>

        </form>

    </div>

    <!-- Confirm Sheet -->
    <div id="confirmSheet" class="sheet-overlay">
        <div class="sheet-panel">
            <div class="sheet-header">
                <div class="sh-cancel" onclick="closeConfirm()">Cancel</div>
                <div class="sh-title">Confirm</div>
                <div style="width:50px;"></div> <!-- Spacer -->
            </div>

            <div class="confirm-list">
                <div class="cl-row">
                    <span class="cl-lbl">Withdraw Amount</span>
                    <span class="cl-val highlight" id="cAmount">₦0.00</span>
                </div>
                <div class="cl-row">
                    <span class="cl-lbl">Fee ({{ $setting->withdraw_charge }}%)</span>
                    <span class="cl-val" id="cFee">₦0.00</span>
                </div>
                <div class="cl-row">
                    <span class="cl-lbl">You Receive</span>
                    <span class="cl-val highlight" id="cReceive" style="color:var(--ios-blue);">₦0.00</span>
                </div>
            </div>

            <button class="confirm-btn" onclick="submitForm()">Confirm Withdrawal</button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

    @include('alert-message')

    <script>
        // Use the global iOSAlert from alert-message
        
        function openConfirm() {
            let val = document.getElementById('wAmount').value;
            let minWithdraw = {{ $setting->minimum_withdraw }};
            let withdrawCharge = {{ $setting->withdraw_charge }};

            if(!val || parseFloat(val) < minWithdraw) {
                if(typeof iOSAlert !== 'undefined') {
                    iOSAlert.fire({ 
                        icon: 'warning', 
                        title: 'Invalid Amount', 
                        text: 'Minimum withdrawal is ₦' + minWithdraw.toLocaleString() 
                    });
                } else {
                    alert('Minimum withdrawal is ₦' + minWithdraw.toLocaleString());
                }
                return;
            }

            let amt = parseFloat(val);
            let fee = amt * (withdrawCharge / 100);
            let rec = amt - fee;

            document.getElementById('cAmount').innerText = "₦" + amt.toLocaleString();
            document.getElementById('cFee').innerText = "₦" + fee.toLocaleString(undefined, {minimumFractionDigits:2});
            document.getElementById('cReceive').innerText = "₦" + rec.toLocaleString(undefined, {minimumFractionDigits:2});

            document.getElementById('confirmSheet').classList.add('sheet-active');
            document.querySelector('.sheet-overlay').style.pointerEvents = 'auto';
            document.querySelector('.sheet-overlay').style.opacity = '1';
        }

        function closeConfirm() {
            document.getElementById('confirmSheet').classList.remove('sheet-active');
            document.querySelector('.sheet-overlay').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.sheet-overlay').style.pointerEvents = 'none';
            }, 300);
        }

        function submitForm() {
            document.getElementById('withdrawForm').submit();
        }
    </script>
</body>
</html>