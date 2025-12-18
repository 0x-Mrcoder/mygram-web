<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Make Payment - {{ env('APP_NAME') }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            --shadow-lg: 0 20px 40px rgba(238, 102, 127, 0.15);
            --radius-lg: 24px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Outfit', sans-serif; background: #fff; color: var(--text-main); min-height: 100vh; }
        
        .main-wrapper { 
            max-width: 480px; 
            margin: 0 auto; 
            min-height: 100vh; 
            background: linear-gradient(180deg, #fff0f3 0%, #fff 30%);
            position: relative;
            padding: 20px;
        }

        /* Header */
        .app-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-top: 10px;
        }
        .back-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            text-decoration: none;
            font-size: 18px;
            margin-right: 15px;
        }
        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
        }

        /* Amount Card */
        .amount-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            border-radius: var(--radius-lg);
            padding: 30px 20px;
            text-align: center;
            color: white;
            box-shadow: var(--shadow-lg);
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }
        .amount-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
            pointer-events: none;
        }
        .pay-label { font-size: 14px; opacity: 0.9; font-weight: 500; margin-bottom: 5px; }
        .amount-val { font-size: 42px; font-weight: 800; letter-spacing: -1px; margin-bottom: 5px; }
        .timer-badge {
            background: rgba(255,255,255,0.2);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            backdrop-filter: blur(5px);
        }

        /* Account Details */
        .details-container {
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.03);
        }
        
        .info-row {
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 20px;
            border-bottom: 1px dashed #eee;
        }
        .info-row:last-child { margin-bottom: 0; padding-bottom: 0; border: none; }
        
        .info-label {
            font-size: 12px;
            color: var(--text-sub);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }
        .info-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .bank-logo {
            width: 40px; height: 40px;
            background: #fff0f3;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary);
            font-size: 18px;
            margin-right: 12px;
        }
        .copy-icon {
            color: var(--primary);
            background: #fff0f3;
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .copy-icon:active { transform: scale(0.9); }

        /* Footer Warning */
        .warning-box {
            margin-top: 25px;
            background: #fff8e1;
            border: 1px solid #ffecb3;
            border-radius: 16px;
            padding: 15px;
            font-size: 13px;
            color: #f57f17;
            display: flex;
            gap: 12px;
            line-height: 1.5;
            align-items: flex-start;
        }

        .pulse-dot {
            width: 8px; height: 8px;
            background: white;
            border-radius: 50%;
            animation: blink 1s infinite alternate;
        }
        @keyframes blink { from { opacity: 0.5; } to { opacity: 1; } }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <div class="app-header">
            <a href="{{ route('user.recharge') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
            <div class="page-title">Complete Payment</div>
        </div>

        <div class="amount-card">
            <div class="pay-label">Total Payable Amount</div>
            <div class="amount-val">₦{{ number_format($deposit->amount, 2) }}</div>
            <div class="timer-badge">
                <div class="pulse-dot"></div> Awaiting Payment
            </div>
        </div>

        <div class="details-container">
            <div class="info-row">
                <div class="info-label">Bank Name</div>
                <div class="info-value">
                    <div style="display: flex; align-items: center;">
                        <div class="bank-logo"><i class="fa-solid fa-building-columns"></i></div>
                        {{ isset(auth()->user()->virtual_bank_name) && auth()->user()->virtual_bank_name !== 'Payrant/PalmPay' ? auth()->user()->virtual_bank_name : 'Palmpay' }}
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Account Number</div>
                <div class="info-value">
                    <span id="accNum" style="font-family: monospace; font-size: 22px; letter-spacing: 1px;">{{ auth()->user()->virtual_account_number }}</span>
                    <div class="copy-icon" onclick="copyToClipboard('accNum')">
                        <i class="fa-regular fa-copy"></i>
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-label">Account Name</div>
                <div class="info-value">
                    {{ trim(str_replace(['(Payrant)', '(payrant)'], '', auth()->user()->virtual_account_name)) }}
                </div>
            </div>
        </div>

        <div class="warning-box">
            <i class="fa-solid fa-triangle-exclamation" style="margin-top: 2px;"></i>
            <div>
                <b>Important:</b> Please transfer the <b>EXACT</b> amount shown above. Transfers of different amounts may not be credited automatically.
            </div>
        </div>

    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(copyText).then(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Account Number Copied!'
                });
            });
        }

        // Poll for Payment Status
        setInterval(() => {
            fetch("{{ route('user.check_payment_status', $deposit->id) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'approved') {
                        Swal.fire({
                            title: 'Payment Successful!',
                            text: 'Your wallet has been funded.',
                            icon: 'success',
                            confirmButtonColor: '#ee667f',
                            confirmButtonText: 'Continue',
                            allowOutsideClick: false,
                            background: '#fff',
                            customClass: {
                                popup: 'rounded-4'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        });
                    }
                })
                .catch(err => console.error(err));
        }, 3000); // Check every 3 seconds
    </script>
</body>
</html>
