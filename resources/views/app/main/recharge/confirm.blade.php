<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund Transfer</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('IMG_20250918_172903_494.jpg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* হোম পেজের থিম এখানে প্রয়োগ করা হয়েছে */
        :root {
            --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
            --theme-primary: #FF9100;
            --text-light: #ffffff;
            --text-dark: #333333;
            --background-color: #f7f8fa;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        body {
            padding: 0;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
        }

        .main-container {
            width: 100%;
            margin: auto;
            min-height: 100vh;
            position: relative;
        }

        .transfer-container {
            min-height: 100vh;
            position: relative;
        }

        .background-top {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: var(--theme-gradient);
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .transfer-timer {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 15px;
            color: var(--text-light);
            text-align: center;
        }
        .timer-title {
            font-size: 18px;
            font-weight: 600;
        }
        .timer-count {
            font-size: 28px;
            font-weight: 700;
            margin: 5px 0;
        }
        .timer-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .transfer-body {
            position: absolute;
            top: 120px;
            left: 15px;
            right: 15px;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
        }

        .body-logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .body-logo img {
            height: 60px; /* লোগোর সাইজ সামঞ্জস্য করা হয়েছে */
        }
        
        .body-label {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .body-table table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .body-table table td {
            padding: 10px 5px;
            vertical-align: middle;
        }
        .td-label {
            width: 40%;
            font-weight: 500;
            color: #666;
        }
        .td-value {
            font-weight: 600;
            color: var(--theme-primary);
            font-size: 16px;
        }
        .copy-icon {
            width: 20px;
            height: 20px;
            cursor: pointer;
            opacity: 0.7;
        }
        .td-input input {
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            width: 100%;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .body-button {
            margin-top: 25px;
            text-align: center;
        }
        .body-button button {
            color: var(--text-light);
            padding: 12px;
            width: 100%;
            max-width: 300px;
            background: var(--theme-gradient);
            border-radius: 50px;
            border: 0;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(255, 145, 0, 0.4);
            cursor: pointer;
        }
        
        .secure-logo {
            margin-top: 20px;
            text-align: center;
        }
        .secure-logo img {
            height: 20px;
            opacity: 0.6;
        }
        
    </style>
</head>
<body>
<div class="main-container">
    <div class="transfer-container">
        <div class="background-top"></div>
        <div class="transfer-timer">
            <div class="timer-title">সেন্ড মানি</div>
            <div class="timer-count" id="timer">00:00</div>
            <div class="timer-subtitle">অবশিষ্ট সময়</div>
        </div>
        <div class="transfer-body">
            <div class="body-logo">
                <img src="{{ asset($methods->photo) }}" alt="Payment Method"/>
            </div>
            
            <div class="body-label">
                নিচের নম্বরে অনুরোধকৃত পরিমাণ টাকা সেন্ড মানি করুন এবং সঠিক লেনদেন আইডি প্রবেশ করান।
            </div>
            
            <div class="body-table">
                <form action="{{ url('external-deposit') }}" method="post" id="payment_submit">
                    @csrf
                    <input type="hidden" name="methods" value="{{ $methods->name }}">
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <table>
                        <tr>
                            <td class="td-label">পরিমাণ:</td>
                            <td class="td-value" colspan="2">{{ price($amount) }}</td>
                        </tr>
                        <tr>
                            <td class="td-label">নাম্বার:</td>
                            <td class="td-value">{{ $methods->address }}</td>
                            <td style="width:25px; text-align:right;">
                                <img src="{{ asset('public/asset/copy.png') }}" alt="copy" onclick="copyNumber('{{ $methods->address }}')" class="copy-icon"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">ট্রানজেকশন আইডি:</td>
                            <td class="td-input" colspan="2">
                                <input type="text" placeholder="ট্রানজেকশন আইডি লিখুন" name="trx" required/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="body-button">
                <button onclick="payment_submit_confirm()">সাবমিট করুন</button>
            </div>
            
            <div class="secure-logo">
                <img src="{{ asset('public/asset/check.png') }}" alt="Secure"/>
            </div>
        </div>
    </div>
</div>

@include('alert-message')

<script>
    function payment_submit_confirm() {
        // Basic validation
        const trxInput = document.querySelector('input[name="trx"]');
        if (!trxInput.value) {
            alert('অনুগ্রহ করে ট্রানজেকশন আইডি দিন।');
            return;
        }
        document.getElementById('payment_submit').submit();
    }

    function copyNumber(text) {
        const tempInput = document.createElement("input");
        tempInput.value = text.replaceAll(' ', '');
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert('নাম্বার সফলভাবে কপি করা হয়েছে।');
    }
</script>

<script>
    // আগের টাইমার কোড অপরিবর্তিত রাখা হয়েছে
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;
            
            sessionStorage.setItem('remainingTime', timer);

            if (--timer < 0) {
                clearInterval(interval);
                display.textContent = "সময় শেষ";
                // Optionally disable the submit button
                document.querySelector('.body-button button').disabled = true;
                sessionStorage.removeItem('remainingTime');
            }
        }, 1000);
    }

    window.onload = function () {
        var fiveMinutes = 59 * 60, // 59 minutes
            display = document.querySelector('#timer');
            
        var remainingTime = sessionStorage.getItem('remainingTime');
        
        if (remainingTime) {
            startTimer(parseInt(remainingTime, 10), display);
        } else {
            startTimer(fiveMinutes, display);
        }
    };
</script>

</body>
</html>