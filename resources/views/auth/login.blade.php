<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - FortuneFlow</title>

    <!-- Google Fonts: Syne (Headings) + Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --brand-primary: #0f1c2e; /* Very Dark Blue */
            --brand-accent: #f59e0b;  /* Amber/Orange */
            --surface: #ffffff;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --input-fill: #f3f4f6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--brand-primary);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 20px; /* Slight padding at bottom */
        }

        /* 
           LAYOUT PATTERN: Split View 
           Top: Identity (35%)
           Bottom: Form Sheet (65%)
        */
        
        /* Top Section: Branding */
        .brand-section {
            height: 35vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            background: radial-gradient(circle at top right, #1e3a8a, var(--brand-primary));
        }

        .orb-decor {
            position: absolute;
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, var(--brand-accent), transparent);
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.15;
            top: -100px;
            right: -100px;
        }

        .logo-wrap {
            width: 90px;
            height: 90px;
            background: white;
            padding: 10px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            z-index: 2;
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .logo-img { width: 100%; height: 100%; object-fit: contain; }

        /* Bottom Section: Sheet */
        .auth-sheet {
            flex: 1;
            background: var(--surface);
            border-radius: 30px 30px 0 0;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            animation: slideUp 0.6s ease-out;
            position: relative;
            z-index: 10;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.2);
        }

        /* Typography */
        .headline {
            font-family: 'Syne', sans-serif;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--brand-primary);
            line-height: 1.1;
        }
        .subheadline {
            font-size: 15px;
            color: var(--text-light);
            margin-bottom: 30px;
        }

        /* Form Styling */
        .form-group { margin-bottom: 20px; }

        .input-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-light);
            margin-bottom: 8px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .nice-input {
            width: 100%;
            background: var(--input-fill);
            border: 2px solid transparent;
            border-radius: 16px;
            padding: 16px 16px 16px 45px;
            font-size: 16px;
            font-weight: 600;
            color: var(--brand-primary);
            transition: all 0.2s;
        }
        
        .nice-input:focus {
            background: white;
            border-color: var(--brand-primary);
            outline: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 18px;
            transition: color 0.2s;
        }
        .nice-input:focus + .input-icon { color: var(--brand-primary); }

        .pass-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            padding: 5px;
        }

        /* Buttons & Actions */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .pill-check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-light);
            cursor: pointer;
        }
        .pill-check input { accent-color: var(--brand-primary); width: 16px; height: 16px; }

        .big-btn {
            width: 100%;
            background: var(--brand-primary);
            color: white;
            padding: 18px;
            border-radius: 18px;
            border: none;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.1s;
        }
        .big-btn:active { transform: scale(0.98); }
        .arrow-box {
            background: rgba(255,255,255,0.2);
            width: 30px; height: 30px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
        }

        /* Footer */
        .bottom-links {
            margin-top: auto;
            text-align: center;
            padding-top: 20px;
            font-size: 14px;
            color: var(--text-light);
        }
        .bottom-links a {
            color: var(--brand-primary);
            font-weight: 700;
            text-decoration: none;
        }

        /* Loading */
        .spinner { animation: spin 1s linear infinite; display: none; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        
        @keyframes slideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
        @keyframes bounceIn { 
            0% { transform: scale(0); opacity: 0; } 
            60% { transform: scale(1.1); opacity: 1; } 
            100% { transform: scale(1); } 
        }

        /* Toast */
        #toast-cont {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; max-width: 400px; z-index: 9999;
        }
        .toast {
            background: #1f2937; color: white;
            padding: 14px 20px; border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 10px; opacity: 0; transform: translateY(-20px);
            transition: all 0.3s;
        }
        .toast.show { opacity: 1; transform: translateY(0); }

    </style>
</head>
<body>

    <!-- Top: Brand Area -->
    <section class="brand-section">
        <div class="orb-decor"></div>
        <div class="logo-wrap">
            <img src="https://www.feefo.com/api/merchant-image/homespares-centres-limited-logo.jpg" alt="Logo" class="logo-img">
        </div>
    </section>

    <!-- Bottom: Interactive Sheet -->
    <section class="auth-sheet">
        
        <div>
            <h1 class="headline">Let's Sign You In.</h1>
            <p class="subheadline">Welcome back first timer? <br>You've been missed!</p>
        </div>

        <form id="loginForm" action="{{ route('login') }}" method="POST">
            
            <div class="form-group">
                <label class="input-label">Phone</label>
                <div class="input-wrapper">
                    <input type="tel" name="phone" class="nice-input" placeholder="080 123 4567" required>
                    <i class="fas fa-phone input-icon"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label">Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" class="nice-input" placeholder="••••••••" required>
                    <i class="fas fa-lock input-icon"></i>
                    <i class="fas fa-eye pass-toggle" id="togglePassword"></i>
                </div>
            </div>

            <div class="action-bar">
                <label class="pill-check">
                    <input type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>
                <!-- <a href="#" style="font-size:13px; color:var(--brand-primary); font-weight:600; text-decoration:none;">Forgot?</a> -->
            </div>

            <button type="submit" class="big-btn">
                <span class="btn-text">Sign In</span>
                <div class="arrow-box"><i class="fas fa-arrow-right"></i></div>
                <i class="fas fa-circle-notch spinner"></i>
            </button>

        </form>

        <div class="bottom-links">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>

    </section>

    <div id="toast-cont"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Utils
        const showToast = (msg, isErr = false) => {
            const el = $(`<div class="toast" style="border-left: 4px solid ${isErr?'#ef4444':'#22c55e'}">
                <i class="fas ${isErr?'fa-times-circle':'fa-check-circle'}" style="color:${isErr?'#ef4444':'#22c55e'}"></i>
                <span>${msg}</span>
            </div>`);
            $('#toast-cont').append(el);
            el[0].offsetHeight; el.addClass('show');
            setTimeout(() => { el.removeClass('show'); setTimeout(() => el.remove(), 300); }, 3000);
        };

        // Logic
        $('#togglePassword').on('click', function() {
            const input = $('#password');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            const btn = $('.big-btn');
            const txt = $('.btn-text');
            const arr = $('.arrow-box');
            const spin = $('.spinner');

            btn.prop('disabled', true);
            txt.hide(); arr.hide(); spin.show();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: JSON.stringify(Object.fromEntries(new FormData(this))),
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(res) {
                    if(res.status === 'success') {
                        showToast('Login Successful!');
                        setTimeout(() => window.location.href = "/dashboard", 1000);
                    } else {
                        showToast(res.msg || 'Error', true);
                        reset();
                    }
                },
                error: function(e) {
                    showToast(e.responseJSON?.msg || 'Connection Error', true);
                    reset();
                }
            });

            function reset() {
                btn.prop('disabled', false);
                txt.show(); arr.show(); spin.hide();
            }
        });
    </script>
</body>
</html>
