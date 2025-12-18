<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Recharge - MyGram</title>
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
        }
        .page-title { font-size: 22px; font-weight: 700; margin-bottom: 5px; }
        .page-subtitle { font-size: 13px; opacity: 0.9; }

        /* Content */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }

        /* Balance Card */
        .balance-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.5);
        }
        .balance-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }
        .balance-label { font-size: 13px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .balance-amount { font-size: 32px; font-weight: 700; color: var(--primary); }

        /* Form */
        .recharge-form {
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px 20px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
        }
        .form-label { font-size: 14px; font-weight: 600; color: var(--text-main); margin-bottom: 10px; display: block; }
        .input-group { position: relative; margin-bottom: 20px; }
        .currency-symbol {
            position: absolute; left: 20px; top: 50%; transform: translateY(-50%);
            font-size: 18px; color: var(--primary); font-weight: 600;
        }
        .amount-input {
            width: 100%;
            height: 55px;
            border: 2px solid #f0f2f5;
            border-radius: 16px;
            padding: 0 20px 0 45px;
            font-size: 20px;
            font-weight: 600;
            color: var(--text-main);
            outline: none;
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
        }
        .amount-input:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(238, 102, 127, 0.1); }

        /* Quick Amounts */
        .quick-amounts {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 25px;
        }
        .amount-btn {
            background: #f8f9fa;
            border: 1px solid transparent;
            border-radius: 12px;
            padding: 12px 5px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-sub);
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Outfit', sans-serif;
        }
        .amount-btn:active { transform: scale(0.95); }
        .amount-btn.active {
            background: rgba(238, 102, 127, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            height: 55px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(238, 102, 127, 0.3);
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
        }
        .submit-btn:active { transform: scale(0.98); box-shadow: 0 5px 10px rgba(238, 102, 127, 0.2); }

        /* Info Box */
        .info-box {
            background: #fff0f3;
            border-radius: 16px;
            padding: 20px;
            border: 1px dashed var(--accent);
        }
        .info-title { font-size: 14px; font-weight: 700; color: var(--primary-dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .info-list { list-style: none; }
        .info-list li {
            font-size: 12px; color: var(--text-sub); margin-bottom: 8px;
            padding-left: 15px; position: relative; line-height: 1.5;
        }
        .info-list li::before {
            content: ''; position: absolute; left: 0; top: 6px; width: 4px; height: 4px;
            background: var(--primary); border-radius: 50%;
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
            <h1 class="page-title">Recharge</h1>
            <p class="page-subtitle">Add funds to your wallet</p>
        </div>

        <!-- Content -->
        <div class="section-container">
            <!-- Balance Card -->
            <div class="balance-card">
                <div class="balance-label">Current Balance</div>
                <div class="balance-amount">₦{{ number_format(auth()->user()->balance, 2) }}</div>
            </div>

            <!-- Virtual Account Section -->
            <div class="balance-card" style="background: linear-gradient(135deg, #fff0f3 0%, #fff 100%); border-color: var(--primary);">
                @if(auth()->user()->virtual_account_number)
                    <div style="text-align: left;">
                        <div class="balance-label" style="color: var(--primary);">Personal Virtual Account</div>
                        
                        <div style="margin-top: 15px;">
                            <label style="font-size: 11px; color: #636e72;">Bank Name</label>
                            <div style="font-weight: 700; font-size: 16px; margin-bottom: 10px;">
                                {{ auth()->user()->virtual_bank_name }}
                            </div>

                            <label style="font-size: 11px; color: #636e72;">Account Number</label>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div style="font-weight: 700; font-size: 20px; letter-spacing: 1px;">
                                    {{ auth()->user()->virtual_account_number }}
                                </div>
                                <button onclick="copyText('{{ auth()->user()->virtual_account_number }}')" style="border: none; background: none; color: var(--primary); cursor: pointer;">
                                    <i class="fa-regular fa-copy"></i> Copy
                                </button>
                            </div>

                            <label style="font-size: 11px; color: #636e72;">Account Name</label>
                            <div style="font-weight: 600; font-size: 14px;">
                                {{ auth()->user()->virtual_account_name }}
                            </div>
                        </div>
                        <div style="margin-top: 15px; font-size: 12px; color: var(--text-sub); background: white; padding: 10px; border-radius: 10px;">
                            <i class="fa-solid fa-circle-info" style="color: var(--primary);"></i> 
                            Transfer to this account to fund your wallet instantly.
                        </div>
                    </div>
                @else
                    <div class="balance-label" style="margin-bottom: 10px;">Dedicated Account</div>
                    <p style="font-size: 13px; color: var(--text-sub); margin-bottom: 15px;">
                        Get your own personal bank account number for instant wallet funding.
                    </p>
                    <form action="{{ route('user.generate_virtual_account') }}" method="POST">
                        @csrf
                        <button type="submit" class="submit-btn" style="height: 45px; font-size: 14px; background: var(--text-main);">
                            Generate Permanent Account
                        </button>
                    </form>
                @endif
            </div>

            <!-- Recharge Form -->
            <div class="recharge-form">
                <form id="topupForm" action="/home/create_topup_order" method="POST">
                    @csrf
                    <label class="form-label">Enter Amount</label>
                    <div class="input-group">
                        <span class="currency-symbol">₦</span>
                        <input id="topupAmount" type="number" class="amount-input" name="amount" placeholder="3000">
                    </div>

                    <label class="form-label">Quick Select</label>
                    <div class="quick-amounts">
                        <button type="button" class="amount-btn" data-amount="150">₦150</button>
                        <button type="button" class="amount-btn" data-amount="5000">₦5,000</button>
                        <button type="button" class="amount-btn" data-amount="12000">₦12,000</button>
                        <button type="button" class="amount-btn" data-amount="40000">₦40,000</button>
                        <button type="button" class="amount-btn" data-amount="70,000">₦70,000</button>
                        <button type="button" class="amount-btn" data-amount="100000">₦100,000</button>
                    </div>

                    <button type="button" onclick="goPayment()" class="submit-btn">
                        Recharge Now <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                    </button>
                </form>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <div class="info-title"><i class="fa-solid fa-circle-info"></i> Recharge Policy</div>
                <ul class="info-list">
                    <li>Minimum deposit amount is <b>3,000 ₦</b>.</li>
                    <li>Payment must be made according to the exact order amount.</li>
                    <li>Balance will be credited within 5 minutes after successful payment.</li>
                    <li>If not credited within 30 minutes, please contact Customer Service.</li>
                </ul>
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

    @include('alert-message')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Quick Amount Selection
            $('.amount-btn').on('click', function() {
                $('.amount-btn').removeClass('active');
                $(this).addClass('active');
                
                // Remove non-numeric characters for value
                const amount = $(this).data('amount');
                $('#topupAmount').val(amount);
            });

            // Input Change
            $('#topupAmount').on('input', function() {
                $('.amount-btn').removeClass('active');
                const currentAmount = $(this).val();
                $(`.amount-btn[data-amount="${currentAmount}"]`).addClass('active');
            });
        });

        function goPayment(){
            let amount = document.querySelector('#topupAmount').value;

            if (!amount || amount < 100) {
                alert('Minimum recharge amount is 100 ₦');
                return;
            }

            document.getElementById('topupForm').submit();
        }
        function copyText(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Account number copied!');
            }, function(err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
    </script>
</body>
</html>