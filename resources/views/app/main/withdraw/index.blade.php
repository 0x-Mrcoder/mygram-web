<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Withdraw - MyGram</title>
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
            padding: 20px 20px 60px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: -40px;
            text-align: center;
            color: white;
            position: relative;
            z-index: 1;
        }
        .header-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .back-btn { color: white; font-size: 20px; text-decoration: none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); }
        .page-title { font-size: 20px; font-weight: 700; }
        .header-spacer { width: 40px; }

        /* Content */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }

        /* Balance Card */
        .balance-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: var(--shadow-md);
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .balance-label { font-size: 14px; color: var(--text-sub); margin-bottom: 5px; }
        .balance-amount { font-size: 32px; font-weight: 700; color: var(--primary); margin-bottom: 5px; }
        .balance-icon {
            width: 60px; height: 60px;
            background: #fff0f3;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; color: var(--primary);
            margin: 0 auto 15px;
        }

        /* Form */
        .form-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
        }
        .form-group { margin-bottom: 20px; }
        .form-label { font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block; }
        
        .account-select {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .account-select:active { transform: scale(0.98); background: #fff0f3; border-color: var(--primary); }
        .account-icon {
            width: 40px; height: 40px;
            background: white;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary);
            font-size: 18px;
            margin-right: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .account-info { flex: 1; }
        .account-name { font-size: 15px; font-weight: 600; color: var(--text-main); }
        .account-arrow { color: #ccc; font-size: 14px; }

        .input-wrapper {
            position: relative;
            background: #f8f9fa;
            border-radius: var(--radius-md);
            padding: 5px 15px;
            border: 1px solid transparent;
            transition: all 0.3s;
        }
        .input-wrapper:focus-within { background: white; border-color: var(--primary); box-shadow: 0 4px 12px rgba(238, 102, 127, 0.1); }
        .currency-symbol {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: 600;
            color: var(--text-main);
        }
        .amount-input {
            width: 100%;
            border: none;
            background: transparent;
            padding: 15px 15px 15px 30px;
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            outline: none;
        }
        .amount-input::placeholder { color: #ccc; }

        /* Fee Info */
        .fee-info {
            background: #fff0f3;
            border-radius: var(--radius-md);
            padding: 15px;
            margin-top: 20px;
        }
        .fee-row { display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 8px; }
        .fee-row:last-child { margin-bottom: 0; border-top: 1px dashed rgba(238, 102, 127, 0.3); padding-top: 8px; margin-top: 8px; }
        .fee-label { color: var(--text-sub); }
        .fee-value { font-weight: 600; color: var(--text-main); }
        .fee-value.highlight { color: var(--primary); }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #ee667f 0%, #d64d66 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: var(--radius-lg);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(238, 102, 127, 0.3);
            transition: transform 0.2s;
            margin-top: 10px;
        }
        .submit-btn:active { transform: scale(0.98); }

        .notice-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            margin-top: 20px;
        }
        .notice-title { font-size: 14px; font-weight: 600; margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .notice-title i { color: var(--primary); }
        .notice-text { font-size: 12px; color: var(--text-sub); line-height: 1.6; }

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
            <div class="header-top">
                <a href="javascript:history.back()" class="back-btn"><i class="fa-solid fa-chevron-left"></i></a>
                <div class="page-title">Withdraw</div>
                <div class="header-spacer"></div>
            </div>
        </div>

        <!-- Content -->
        <div class="section-container">
            
            <form action="{{route('user.withdraw-confirm-submit')}}" method="POST">
                @csrf

                <!-- Balance Card -->
                <div class="balance-card">
                    <div class="balance-icon"><i class="fa-solid fa-wallet"></i></div>
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount">₦ {{ number_format(auth()->user()->balance, 2) }}</div>
                </div>

                <div class="form-card">
                    <!-- Account Selection -->
                    <div class="form-group">
                        <label class="form-label">Withdrawal Account</label>
                        <div class="account-select" onclick="window.location.href='/add/card'">
                            <div class="account-icon"><i class="fa-solid fa-building-columns"></i></div>
                            <div class="account-info">
                                <div class="account-name">{{ auth()->user()->holder_name ?? 'Add Bank Account' }}</div>
                            </div>
                            <i class="fa-solid fa-chevron-right account-arrow"></i>
                        </div>
                    </div>

                    <!-- Amount Input -->
                    <div class="form-group">
                        <label class="form-label">Withdrawal Amount</label>
                        <div class="input-wrapper">
                            <span class="currency-symbol">₦</span>
                            <input type="number" class="amount-input" name="amount" id="withdrawAmount" placeholder="0.00" min="150" oninput="calculateFee(this.value)" required>
                        </div>
                    </div>

                    <!-- Fee Info -->
                    <div class="fee-info">
                        <div class="fee-row">
                            <span class="fee-label">Handling Fee (6%)</span>
                            <span class="fee-value" id="feeAmount">-₦0.00</span>
                        </div>
                        <div class="fee-row">
                            <span class="fee-label">You Receive</span>
                            <span class="fee-value highlight" id="receiveAmount">₦0.00</span>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        Submit Withdrawal
                    </button>
                </div>

                <!-- Notice -->
                <div class="notice-card">
                    <div class="notice-title">
                        <i class="fa-solid fa-circle-info"></i> Withdrawal Rules
                    </div>
                    <div class="notice-text">
                        1. Minimum withdrawal amount is ₦150.<br>
                        2. Withdrawal handling fee is 6%.<br>
                        3. Withdrawal time: Monday to Friday, 9:00 AM - 6:00 PM.<br>
                        4. Please ensure your bank account information is correct before submitting.
                    </div>
                </div>

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
        <a href="/mine" class="nav-item">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    @include('alert-message')

    <script>
        function calculateFee(amount) {
            const feePercent = 0.06;
            let fee = 0;
            let receive = 0;

            if (amount && !isNaN(amount)) {
                fee = amount * feePercent;
                receive = amount - fee;
            }

            document.getElementById('feeAmount').innerText = '-₦' + fee.toFixed(2);
            document.getElementById('receiveAmount').innerText = '₦' + receive.toFixed(2);
        }
    </script>
</body>
</html>