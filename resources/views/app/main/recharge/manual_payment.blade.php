<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Transfer to Account - FortuneFlow</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --ios-bg: #0A0E1A;
            --ios-card: #161B2D;
            --ios-blue: #F1C40F;
            --ios-gray: #A0AEC0;
            --ios-red: #FF3B30;
            --ios-border: rgba(255, 255, 255, 0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Inter', sans-serif; background: var(--ios-bg); color: #fff; min-height: 100vh; padding-bottom: 40px; }
        
        /* Header */
        .page-header {
            background: rgba(10, 14, 26, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: sticky; top: 0; z-index: 100;
            padding: 10px 16px;
            display: flex; align-items: center; justify-content: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .header-title { font-size: 17px; font-weight: 600; }
        .back-btn { 
            position: absolute; left: 16px; 
            color: var(--ios-blue); font-size: 17px; text-decoration: none; 
            display: flex; align-items: center; gap: 5px;
        }

        /* Content */
        .content { padding: 20px 16px; max-width: 600px; margin: 0 auto; }

        /* Amount Display */
        .amount-display {
            text-align: center;
            margin: 30px 0 30px;
        }
        .pay-label { font-size: 13px; color: var(--ios-gray); margin-bottom: 8px; text-transform: uppercase; font-weight: 500; }
        .pay-amount { font-size: 42px; font-weight: 800; letter-spacing: -1px; margin-bottom: 10px; color: #fff; }
        
        /* Timer Badge */
        .timer-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(241, 196, 15, 0.1); color: var(--ios-blue);
            padding: 6px 12px; border-radius: 20px;
            font-size: 13px; font-weight: 600;
        }
        .timer-badge.expired { background: rgba(255, 59, 48, 0.1); color: var(--ios-red); }

        /* List Group */
        .list-group {
            background: var(--ios-card);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .list-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px;
            border-bottom: 0.5px solid var(--ios-border);
            font-size: 17px;
        }
        .list-item:last-child { border-bottom: none; }
        .item-label { color: #fff; font-weight: 400; }
        .item-value { color: var(--ios-gray); font-weight: 400; display: flex; align-items: center; gap: 8px; }
        .item-value.highlight { color: #fff; font-weight: 500; }

        /* Copy Button */
        .copy-btn {
            background: #2D3748;
            color: var(--ios-blue);
            border: none;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 13px; font-weight: 600;
            cursor: pointer;
        }
        .copy-btn:active { opacity: 0.7; }

        /* Form Input */
        .form-group { margin-bottom: 25px; }
        .form-label {
            font-size: 13px; color: var(--ios-gray); text-transform: uppercase;
            margin-bottom: 8px; margin-left: 16px; display: block;
        }
        .form-input {
            width: 100%; padding: 16px;
            background: #161B2D; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px;
            font-size: 17px; color: #fff; font-family: 'Inter', sans-serif;
        }
        .form-input:focus { outline: none; }

        /* Action Button */
        .pay-btn {
            width: 100%; padding: 16px;
            background: var(--ios-blue); color: #000;
            border: none; border-radius: 14px;
            font-size: 17px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            opacity: 0.5; pointer-events: none; /* Disabled by default */
        }
        .pay-btn.active { opacity: 1; pointer-events: auto; }
        .pay-btn:active { transform: scale(0.98); }

        /* Secure Badge */
        .secure-badge {
            text-align: center; margin-top: 20px;
            font-size: 12px; color: var(--ios-gray);
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }

    </style>
</head>
<body>

    <div class="page-header">
        <a href="{{ route('user.recharge') }}" class="back-btn"><i class="fas fa-chevron-left"></i> Back</a>
        <div class="header-title">Manual Transfer</div>
    </div>

    <div class="content">

        <form action="{{ url('/home/confirm_payment/' . $order->id) }}" method="POST" id="confirmForm">
            @csrf

            <div class="amount-display">
                <div class="pay-label">Total Payable</div>
                <div class="pay-amount">₦{{ number_format($order->amount) }}</div>
                <div class="timer-badge" id="timerBox">
                    <i class="far fa-clock"></i> Expires in <span id="countdown" style="margin-left:4px;">10:00</span>
                </div>
            </div>

            <!-- Payment Methods List -->
            @if($methods->count() > 0)
                @foreach($methods as $method)
                <div class="list-group" style="margin-bottom: 20px; border-radius: 14px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <!-- Bank Name -->
                    <div class="list-item">
                        <div class="item-label">Bank Name</div>
                        <div class="item-value highlight">{{ $method->name }}</div>
                        <!-- Optional: Copy button for bank name if needed? Usually not needed but consistent -->
                        <button type="button" class="copy-btn" onclick="copyText('{{ $method->name }}')">Copy</button>
                    </div>

                    <!-- Account Number -->
                    <div class="list-item">
                        <div class="item-label">Account No</div>
                        <div class="item-value highlight" style="font-family: monospace; font-size: 16px;">{{ $method->address }}</div>
                        <button type="button" class="copy-btn" onclick="copyText('{{ $method->address }}')">Copy</button>
                    </div>

                    <!-- Account Name (Optional) -->
                    @if($method->account_name)
                    <div class="list-item">
                        <div class="item-label">Account Name</div>
                        <div class="item-value highlight">{{ $method->account_name }}</div>
                        <button type="button" class="copy-btn" onclick="copyText('{{ $method->account_name }}')">Copy</button>
                    </div>
                    @endif
                </div>
                @endforeach
            @else
                <div class="list-group" style="padding: 30px; text-align: center; color: var(--ios-red);">
                    <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                    No active payment methods found.<br>Please contact support.
                </div>
            @endif

            <div class="form-group">
                <label class="form-label">Sender Name (Required)</label>
                <input type="text" id="senderName" name="sender_name" class="form-input" placeholder="Enter your bank account name" required>
            </div>

            <button id="payBtn" type="submit" class="pay-btn">
                I Have Sent The Money
            </button>
            
            <div class="secure-badge">
                 <i class="fas fa-lock"></i> Secured 256-bit Encryption
            </div>

        </form>

    </div>

    @include('alert-message')

    <script>
        /* === COPY FUNCTION === */
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                if (typeof iOSAlert !== 'undefined') {
                    iOSAlert.fire({
                        icon: 'success',
                        title: 'Copied',
                        text: 'Copied to clipboard',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    alert('Copied!');
                }
            });
        }
    
        /* === COUNTDOWN TIMER === */
        let totalSeconds = 600; // 10 minutes
        let countdownEl = document.getElementById("countdown");
        let timerBox = document.getElementById("timerBox");
        let payBtn = document.getElementById("payBtn");
        let senderInput = document.getElementById("senderName");
    
        let timer = setInterval(() => {
            let minutes = Math.floor(totalSeconds / 60);
            let seconds = totalSeconds % 60;
    
            seconds = seconds < 10 ? "0" + seconds : seconds;
            countdownEl.textContent = `${minutes}:${seconds}`;
    
            if (totalSeconds <= 0) {
                clearInterval(timer);
                countdownEl.textContent = "Expired";
                timerBox.classList.add("expired");
                payBtn.disabled = true;
                payBtn.classList.remove('active');
                payBtn.innerText = "Payment Expired";
                senderInput.disabled = true;
            }
            totalSeconds--;
        }, 1000);
    
        /* === INPUT VALIDATION === */
        senderInput.addEventListener('input', function() {
            if (totalSeconds <= 0) return; // Don't enable if expired
    
            if (this.value.trim().length > 0) {
                payBtn.disabled = false;
                payBtn.classList.add('active');
            } else {
                payBtn.disabled = true;
                payBtn.classList.remove('active');
            }
        });
    </script>
</body>
</html>
