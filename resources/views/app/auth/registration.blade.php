<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Join - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            /* Royal Gold & Midnight Navy */
            --ios-bg: #0A0E1A; 
            --ios-card: #161B2D;
            --ios-separator: #2D3748;
            --ios-blue: #F1C40F; /* Gold */
            --ios-text: #FFFFFF;
            --ios-text-secondary: #A0AEC0;
            --ios-danger: #E74C3C;
            --ios-success: #27AE60;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--ios-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--ios-text);
        }

        /* Hero Banner */
        .hero-banner {
            width: 100%;
            background: #fff;
            padding-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 1px 0 rgba(0,0,0,0.05);
        }
        .banner-img {
            width: 100%;
            max-width: 500px;
            height: auto;
            object-fit: cover;
        }

        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
            padding: 32px 16px;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .section-header {
            margin-bottom: 15px;
            padding-left: 16px;
            text-transform: uppercase;
            font-size: 13px;
            color: var(--ios-text-secondary);
            font-weight: 400;
        }

        /* iOS Grouped List */
        .ios-list-group {
            background: var(--ios-card);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .list-item {
            display: flex;
            align-items: center;
            padding-left: 16px;
            background: var(--ios-card);
            min-height: 50px;
        }

        .list-item:not(:last-child) .item-inner {
            border-bottom: 0.5px solid var(--ios-separator);
        }

        .item-inner {
            flex: 1;
            display: flex;
            align-items: center;
            padding-right: 16px;
            height: 50px;
        }

        .list-icon {
            font-size: 20px;
            color: var(--ios-blue);
            width: 30px;
            text-align: left;
        }

        .ios-input {
            flex: 1;
            border: none;
            outline: none;
            font-size: 17px;
            height: 100%;
            font-family: inherit;
            color: var(--ios-text);
            background: transparent !important;
        }
        .ios-input::placeholder { color: #8E8E93; }

        /* Fix for White/Yellow Autofill Background */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px var(--ios-card) inset !important;
            -webkit-text-fill-color: var(--ios-text) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .item-btn {
            background: none;
            border: none;
            color: var(--ios-blue);
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
        }

        /* Submit Button */
        .primary-btn {
            width: 100%;
            background: var(--ios-blue);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .primary-btn:active { opacity: 0.6; }

        .bottom-actions { margin-top: 20px; text-align: center; }
        .text-link { color: var(--ios-blue); text-decoration: none; font-weight: 600; }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 20px; left: 50%; transform: translateX(-50%);
            z-index: 2000;
            width: 90%; max-width: 400px;
            pointer-events: none;
        }
        .toast {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 16px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 10px;
            opacity: 0; transform: translateY(-20px);
            transition: all 0.4s ease;
        }
        .toast.show { opacity: 1; transform: translateY(0); }
        .t-icon { font-size: 22px; }
        .t-success { color: var(--ios-success); }
        .t-error { color: var(--ios-danger); }
        .t-body { font-size: 15px; font-weight: 500; }

        .spinner {
            width: 20px; height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: none;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

    </style>
</head>
<body>

    <div class="hero-banner">
        <img src="{{ asset('assets/images/fortuneflow_logo.png') }}" class="banner-img" alt="Banner">
    </div>

    <div class="content-wrapper">
        
        <div class="section-header">CREATE ACCOUNT</div>
        
        <form id="regForm" action="{{ route('register') }}" method="POST">
            
            <div class="ios-list-group">
                <!-- Username -->
                <div class="list-item">
                    <div class="list-icon"><i class="fas fa-user"></i></div>
                    <div class="item-inner">
                        <input type="text" name="username" class="ios-input" placeholder="Desired Username" required>
                    </div>
                </div>

                <!-- Phone -->
                <div class="list-item">
                    <div class="list-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="item-inner">
                        <input type="tel" name="phone" class="ios-input" placeholder="Phone Number" required>
                    </div>
                </div>
                
                <!-- Password -->
                <div class="list-item">
                    <div class="list-icon"><i class="fas fa-lock"></i></div>
                    <div class="item-inner">
                        <input type="password" name="password" id="password" class="ios-input" placeholder="Create Password" required>
                        <button type="button" class="item-btn toggler" data-target="#password">Show</button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="list-item">
                    <div class="list-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="item-inner">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="ios-input" placeholder="Confirm Password" required>
                    </div>
                </div>

                <!-- Referral -->
                <div class="list-item">
                    <div class="list-icon"><i class="fas fa-user-tag"></i></div>
                    <div class="item-inner">
                        <input type="text" name="ref_id" class="ios-input" placeholder="Referral Code (Optional)" value="{{ $ref_by ?? '' }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="primary-btn">
                <span class="btn-text">Sign Up</span>
                <div class="spinner"></div>
            </button>

            <div class="bottom-actions">
                <span style="color:var(--ios-text-secondary); font-size:15px;">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-link">Log In</a>
            </div>

        </form>

    </div>

    <div class="toast-container" id="toastCont"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Utils
        const showToast = (msg, isErr = false) => {
            const icon = isErr ? 'fa-exclamation-circle t-error' : 'fa-check-circle t-success';
            const el = $(`
                <div class="toast">
                    <i class="fas ${icon} t-icon"></i>
                    <div class="t-body">${msg}</div>
                </div>
            `);
            $('#toastCont').append(el);
            el[0].offsetHeight; 
            el.addClass('show');
            setTimeout(() => {
                el.removeClass('show');
                setTimeout(() => el.remove(), 400);
            }, 3000);
        };

        $('.toggler').on('click', function() {
            const target = $(this).data('target');
            const inp = $(target);
            const type = inp.attr('type') === 'password' ? 'text' : 'password';
            inp.attr('type', type);
            $(this).text(type === 'password' ? 'Show' : 'Hide');
        });

        $('#regForm').on('submit', function(e) {
            e.preventDefault();

            // Client Validation
            const p1 = $('#password').val();
            const p2 = $('#password_confirmation').val();
            if(p1 !== p2) { showToast("Passwords do not match", true); return; }

            const btn = $('.primary-btn');
            const txt = $('.btn-text');
            const spin = $('.spinner');

            if(btn.prop('disabled')) return;

            btn.prop('disabled', true).css('opacity', '0.7');
            txt.hide(); spin.show();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: JSON.stringify(Object.fromEntries(new FormData(this))),
                contentType: 'application/json',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(res) {
                    if(res.status === 'success') {
                        showToast('Account Created!');
                        setTimeout(() => window.location.href = "/dashboard", 1000);
                    } else {
                        showToast(res.msg || 'Error', true);
                        reset();
                    }
                },
                error: function(e) {
                    showToast(e.responseJSON?.msg || 'Registration failed', true);
                    reset();
                }
            });

            function reset() {
                btn.prop('disabled', false).css('opacity', '1');
                txt.show(); spin.hide();
            }
        });
    </script>
</body>
</html>