<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Invite - MyGram</title>

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
            padding: 0px 0px 0px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: -50px;
        }
        .top-nav { display: flex; justify-content: center; align-items: center; margin-bottom: 0px; }
        .logo-img { height: 250px; width: auto; }

        /* Invite Card */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }
        
        .invite-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 30px 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(255,255,255,0.5);
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        .invite-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .qr-placeholder {
            width: 120px; height: 120px;
            background: #f8f9fa;
            border-radius: 20px;
            margin: 0 auto 20px;
            display: flex; align-items: center; justify-content: center;
            border: 2px dashed var(--primary);
            color: var(--primary);
            font-size: 40px;
        }

        .invite-title { font-size: 22px; font-weight: 700; margin-bottom: 8px; color: var(--text-main); }
        .invite-desc { font-size: 14px; color: var(--text-sub); margin-bottom: 25px; line-height: 1.5; }

        .copy-box {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .copy-content { text-align: left; overflow: hidden; }
        .copy-label { font-size: 11px; color: var(--text-sub); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .copy-value { font-size: 16px; font-weight: 700; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .copy-btn {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: white;
            border: none;
            color: var(--primary);
            font-size: 16px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
            flex-shrink: 0;
            margin-left: 10px;
        }
        .copy-btn:active { transform: scale(0.9); background: var(--primary); color: white; }

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

        /* Toast */
        #toast-container { position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 10000; width: 90%; max-width: 400px; pointer-events: none; }
        .toast { background: white; padding: 16px 20px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); display: flex; align-items: center; margin-bottom: 10px; opacity: 0; transform: translateY(-20px); transition: all 0.3s; border-left: 5px solid #ddd; pointer-events: auto; }
        .toast.show { opacity: 1; transform: translateY(0); }
        .toast-icon { font-size: 24px; margin-right: 15px; }
        .toast-content { flex-grow: 1; }
        .toast-title { font-weight: 700; font-size: 15px; margin-bottom: 2px; color: var(--text-main); }
        .toast-message { font-size: 13px; color: var(--text-sub); }
        .toast.success { border-left-color: #00b894; } .toast.success .toast-icon { color: #00b894; }
        .toast.error { border-left-color: #d63031; } .toast.error .toast-icon { color: #d63031; }
    </style>
</head>

<body>
    <div class="main-wrapper">
        
        <!-- Header -->
        <div class="hero-header">
            <div class="top-nav">
                <img src="/logo.png" alt="MyGram" class="logo-img">
            </div>
        </div>

        <!-- Content -->
        <div class="section-container">
            <div class="invite-card">
                <div class="qr-placeholder">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
                <h2 class="invite-title">Invite Friends</h2>
                <p class="invite-desc">Share your referral code with friends and earn rewards when they join MyGram.</p>

                <div class="copy-box">
                    <div class="copy-content">
                        <div class="copy-label">Referral Code</div>
                        <div class="copy-value">{{auth()->user()->ref_id ?? '9610911'}}</div>
                    </div>
                    <button class="copy-btn" onclick="copyToClipboard('{{auth()->user()->ref_id ?? '9610911'}}')">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>

                <div class="copy-box">
                    <div class="copy-content">
                        <div class="copy-label">Referral Link</div>
                        <div class="copy-value">{{url('register').'?inviteCode='.(auth()->user()->ref_id ?? '9610911')}}</div>
                    </div>
                    <button class="copy-btn" onclick="copyToClipboard('{{url('register').'?inviteCode='.(auth()->user()->ref_id ?? '9610911')}}')">
                        <i class="fa-solid fa-link"></i>
                    </button>
                    </div>
            </div>
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-item">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Home</span>
        </a>
        <a href="/invite" class="nav-item active">
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

    <div id="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toast Logic
        function showToast(type, title, message) {
            const icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';
            const toastHtml = `
                <div class="toast ${type}">
                    <div class="toast-icon">${icon}</div>
                    <div class="toast-content">
                        <div class="toast-title">${title}</div>
                        <div class="toast-message">${message}</div>
                    </div>
                </div>
            `;
            const $toast = $(toastHtml);
            $('#toast-container').append($toast);
            $toast[0].offsetHeight; // Trigger reflow
            $toast.addClass('show');
            setTimeout(() => {
                $toast.removeClass('show');
                setTimeout(() => $toast.remove(), 300);
            }, 3000);
        }

        function notify(status, msg) {
            const title = status === 'success' ? 'Success' : 'Error';
            showToast(status, title, msg);
        }

        function copyToClipboard(text) {
            if (!text) {
                notify("error", "Nothing to copy!");
                return;
            }
            navigator.clipboard.writeText(text).then(() => {
                notify("success", "Copied to clipboard!");
            }).catch(err => {
                // Fallback for some browsers
                const textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    notify("success", "Copied to clipboard!");
                } catch (err) {
                    notify("error", "Failed to copy!");
                }
                document.body.removeChild(textArea);
            });
        }
    </script>
</body>
</html>