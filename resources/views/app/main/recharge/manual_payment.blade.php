<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <title>MyGram Pay Bank Transfer</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            --shadow-md: 0 10px 40px rgba(238, 102, 127, 0.15);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        body {
            background-color: var(--bg-body);
            margin: 0;
            padding: 0;
            font-family: "Outfit", sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .checkout-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            position: relative;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header-section {
            background: linear-gradient(135deg, #ecccdeff 0%, #fff 100%);
            padding: 30px 20px;
            text-align: center;
        }

        .brand-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 5px;
            background: linear-gradient(45deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .amount-text {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-main);
            margin: 10px 0 5px;
        }

        .sub-text {
            color: var(--text-sub);
            font-size: 14px;
            font-weight: 500;
        }

        /* TIMER */
        .timer-box {
            margin-top: 15px;
            display: inline-block;
            background: rgba(238, 102, 127, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        .timer-box.expired {
            background: #ffe5e5;
            color: #d10000;
        }

        .content-section {
            padding: 24px;
        }

        .section-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-sub);
            margin-bottom: 15px;
            text-align: center;
        }

        .bank-details-box {
            background: var(--bg-body);
            border-radius: var(--radius-md);
            padding: 5px;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            padding: 16px;
            margin-bottom: 2px;
            border-radius: 12px;
        }
        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-size: 12px;
            color: var(--text-sub);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .copy-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(238, 102, 127, 0.1);
            color: var(--primary);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .copy-btn:active {
            transform: scale(0.9);
            background: var(--primary);
            color: white;
        }

        .action-area {
            padding: 0 24px 24px;
        }

        .pay-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 16px;
            font-size: 16px;
            font-weight: 700;
            border-radius: var(--radius-md);
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(238, 102, 127, 0.3);
            transition: transform 0.2s;
        }
        .pay-btn:active {
            transform: scale(0.98);
        }
        .pay-btn:disabled {
            background: #ccc;
            box-shadow: none;
            cursor: not-allowed;
        }

        .footer-badge {
            text-align: center;
            padding-bottom: 20px;
        }
        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-sub);
            opacity: 0.7;
        }

    </style>
</head>
<body>

<div class="main-container">

    <div class="checkout-card">
        
        <div class="header-section">
            <div class="brand-title">MyGram Pay</div>
            <div class="amount-text">₦{{ number_format($order->amount) }}</div>
            <div class="sub-text">{{ Auth::user()->email }}</div>

            <div id="timerBox" class="timer-box">
                <i class="fa-regular fa-clock"></i> Expires in <span id="countdown">10:00</span>
            </div>
        </div>

        <div class="content-section">
            <div class="section-label">Transfer Details</div>

            <div class="bank-details-box">
                
                <div class="detail-row">
                    <div>
                        <div class="detail-label">Bank Name</div>
                        <div class="detail-value">{{ env('BANK', 'Moniepoint MFB') }}</div>
                    </div>
                    <button onclick="copyText('{{ env('BANK', 'Moniepoint MFB') }}')" class="copy-btn">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>

                <div class="detail-row">
                    <div>
                        <div class="detail-label">Account Number</div>
                        <div class="detail-value">{{ env('BANK_NUMBER', '6483318695') }}</div>
                    </div>
                    <button onclick="copyText('{{ env('BANK_NUMBER', '6483318695') }}')" class="copy-btn">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>

                <div class="detail-row">
                    <div>
                        <div class="detail-label">Account Name</div>
                        <div class="detail-value">{{ env('BANK_NAME', 'Samuel Obi Uchechi') }}</div>
                    </div>
                    <button onclick="copyText('{{ env('BANK_NAME', 'Samuel Obi Uchechi') }}')" class="copy-btn">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>

            </div>
        </div>

        <div class="action-area">
            <form action="{{ url('/home/confirm_payment/' . $order->id) }}" method="POST">
                @csrf
                <button id="payBtn" type="submit" class="pay-btn">
                    I Have Made This Transfer
                </button>
            </form>
        </div>

        <div class="footer-badge">
            <div class="secure-badge">
                <i class="fa-solid fa-lock"></i> SECURED BY MYGRAM PAY
            </div>
        </div>

    </div>

</div>

<script>
    /* === COPY FUNCTION === */
    function copyText(text) {
        navigator.clipboard.writeText(text);
        // Toast notification logic could be added here if needed
        alert("Copied: " + text); 
    }

    /* === COUNTDOWN TIMER === */
    let totalSeconds = 600; // 10 minutes

    let countdownEl = document.getElementById("countdown");
    let timerBox = document.getElementById("timerBox");
    let payBtn = document.getElementById("payBtn");

    let timer = setInterval(() => {
        let minutes = Math.floor(totalSeconds / 60);
        let seconds = totalSeconds % 60;

        seconds = seconds < 10 ? "0" + seconds : seconds;
        countdownEl.textContent = `${minutes}:${seconds}`;

        if (totalSeconds <= 0) {
            clearInterval(timer);
            countdownEl.textContent = "Expired";
            timerBox.classList.add("expired");
            timerBox.innerHTML = "<i class='fa-solid fa-circle-exclamation'></i> Session Expired";
            payBtn.disabled = true;
            payBtn.innerText = "Payment Session Expired";
        }
        totalSeconds--;
    }, 1000);
</script>

</body>
</html>

