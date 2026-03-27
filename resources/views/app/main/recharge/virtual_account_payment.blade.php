<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Complete Payment - {{ env('APP_NAME') }}</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
        
        .page-header {
            background: rgba(10, 14, 26, 0.8);
            backdrop-filter: blur(20px);
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

        .content { padding: 20px 16px; max-width: 600px; margin: 0 auto; }

        .amount-display {
            text-align: center;
            margin: 30px 0 40px;
        }
        .pay-label { font-size: 13px; color: var(--ios-gray); margin-bottom: 8px; text-transform: uppercase; font-weight: 500; }
        .pay-amount { font-size: 42px; font-weight: 800; letter-spacing: -1px; color: #fff; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(241, 196, 15, 0.1); color: var(--ios-blue);
            padding: 6px 12px; border-radius: 20px;
            font-size: 13px; font-weight: 600; margin-top: 10px;
        }
        .spinner {
            width: 14px; height: 14px; border: 2px solid var(--ios-blue);
            border-top-color: transparent; border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { from{transform: rotate(0deg);} to{transform: rotate(360deg);} }

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

        .warning-box {
            background: rgba(255, 59, 48, 0.1);
            color: var(--ios-red);
            padding: 16px; border-radius: 12px;
            font-size: 13px; line-height: 1.5;
            display: flex; gap: 10px;
        }

    </style>
</head>
<body>

    <div class="page-header">
        <a href="{{ route('user.recharge') }}" class="back-btn"><i class="fas fa-chevron-left"></i> Back</a>
        <div class="header-title">Payment</div>
    </div>

    <div class="content">

        <div class="amount-display">
            <div class="pay-label">Total Payable</div>
            <div class="pay-amount">₦{{ number_format($deposit->amount, 2) }}</div>
            <div class="status-badge">
                <div class="spinner"></div> Awaiting Payment
            </div>
        </div>

        <div class="list-group">
            <div class="list-item">
                <div class="item-label">Bank Name</div>
                <div class="item-value">
                    {{ isset(auth()->user()->virtual_bank_name) && auth()->user()->virtual_bank_name !== 'Payrant/PalmPay' ? auth()->user()->virtual_bank_name : 'Palmpay' }}
                </div>
            </div>
            
            <div class="list-item">
                <div class="item-label">Account Number</div>
                <div class="item-value highlight">
                    <span id="accNum">{{ auth()->user()->virtual_account_number }}</span>
                    <button class="copy-btn" onclick="copyToClipboard('accNum')">Copy</button>
                </div>
            </div>

            <div class="list-item">
                <div class="item-label">Account Name</div>
                <div class="item-value">
                    {{ trim(str_replace(['(Payrant)', '(payrant)'], '', auth()->user()->virtual_account_name)) }}
                </div>
            </div>
        </div>

        <!-- Manual Check Button -->
        <button id="checkBtn" onclick="checkPaymentNow()" style="width: 100%; padding: 16px; background: var(--ios-blue); color: #000; border: none; border-radius: 14px; font-size: 17px; font-weight: 600; cursor: pointer; margin-bottom: 20px; transition: all 0.2s;">
            <i class="fas fa-check-circle"></i> I Have Paid
        </button>

        <div class="warning-box">
            <i class="fas fa-exclamation-triangle" style="margin-top: 2px;"></i>
            <div>
                Please transfer the <strong>EXACT</strong> amount shown above. Transfers of different amounts may not be credited automatically.
            </div>
        </div>

    </div>

    @include('alert-message')

    <script>
        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(copyText).then(function() {
                if (typeof iOSAlert !== 'undefined') {
                    iOSAlert.fire({
                        icon: 'success',
                        title: 'Copied',
                        text: 'Account number copied to clipboard',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    alert('Copied!');
                }
            });
        }

        // Manual Payment Check
        function checkPaymentNow() {
            const btn = document.getElementById('checkBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            btn.style.opacity = '0.7';

            fetch("{{ route('user.check_payment_status', $deposit->id) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'approved') {
                        if (typeof iOSAlert !== 'undefined') {
                            iOSAlert.fire({
                                icon: 'success',
                                title: 'Payment Received!',
                                text: 'Your wallet has been funded successfully.',
                                confirmButtonText: 'Continue'
                            }).then(() => {
                                window.location.href = "{{ route('dashboard') }}";
                            });
                        } else {
                            alert('Payment Received!');
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    } else {
                        if (typeof iOSAlert !== 'undefined') {
                            iOSAlert.fire({
                                icon: 'info',
                                title: 'Payment Not Received Yet',
                                text: 'We haven\'t received your payment yet. Please wait a moment and try again.',
                                timer: 3000
                            });
                        } else {
                            alert('Payment not received yet. Please wait and try again.');
                        }
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fas fa-check-circle"></i> I Have Paid';
                        btn.style.opacity = '1';
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error checking payment. Please try again.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-check-circle"></i> I Have Paid';
                    btn.style.opacity = '1';
                });
        }

        // Auto Poll for Payment Status
        setInterval(() => {
            fetch("{{ route('user.check_payment_status', $deposit->id) }}")
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'approved') {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Payment Successful',
                                text: 'Your wallet has been funded.',
                                icon: 'success',
                                confirmButtonText: 'Continue'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('dashboard') }}";
                                }
                            });
                        } else {
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    }
                })
                .catch(err => console.error(err));
        }, 3000);
    </script>
</body>
</html>
