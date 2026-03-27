<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Invite - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --ios-bg: #0A0E1A;
            --ios-card: #161B2D;
            --ios-blue: #F1C40F;
            --ios-gray: #A0AEC0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 90px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        .page-header {
            padding: 10px 20px;
            text-align: center;
            font-size: 17px; font-weight: 600;
            margin-bottom: 20px;
        }

        /* QR Card */
        .qr-card {
            background: #161B2D; border-radius: 20px;
            margin: 0 20px 25px; padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.05);
        }
        
        .invite-title { font-size: 22px; font-weight: 700; margin-bottom: 5px; }
        .invite-desc { font-size: 14px; color: var(--ios-gray); margin-bottom: 25px; }

        /* Copy Buttons */
        .copy-group {
            background: #2D3748; border-radius: 12px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 15px; margin-bottom: 10px;
        }
        .cg-info { text-align: left; overflow: hidden; }
        .cg-lbl { font-size: 10px; font-weight: 700; color: var(--ios-gray); text-transform: uppercase; }
        .cg-val { font-size: 15px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: #fff; }
        
        .cg-btn {
            background: #161B2D; width: 36px; height: 36px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--ios-blue); box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            cursor: pointer; flex-shrink: 0; margin-left: 10px;
        }
        .cg-btn:active { background: var(--ios-blue); color: #000; }

        /* How it Works */
        .steps-container { padding: 0 20px; }
        .sc-title { font-size: 15px; font-weight: 600; margin-bottom: 15px; color: var(--ios-gray); }
        
        .step-row {
            display: flex; gap: 15px; margin-bottom: 20px;
            background: #161B2D; padding: 15px; border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.05);
        }
        .step-icon {
            width: 40px; height: 40px; background: #2D3748; color: var(--ios-blue);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }
        .step-info { flex: 1; }
        .si-head { font-size: 15px; font-weight: 600; margin-bottom: 4px; color: #fff; }
        .si-desc { font-size: 13px; color: #A0AEC0; line-height: 1.4; }

        /* Navigation */
        .ios-tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16, 20, 35, 0.9); backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px); border-top: 0.5px solid rgba(255,255,255,0.1);
            display: flex; justify-content: space-around;
            padding-top: 10px; padding-bottom: max(10px, env(safe-area-inset-bottom));
            z-index: 100;
        }
        .tab-item {
            text-decoration: none; display: flex; flex-direction: column; align-items: center; gap: 4px;
            color: #999; flex: 1;
        }
        .tab-item i { font-size: 22px; }
        .tab-item span { font-size: 10px; font-weight: 600; }
        .tab-item.active { color: var(--ios-blue); }

        #toast-box {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            z-index: 9999; pointer-events: none; width: 90%; max-width: 380px;
        }
        .c-toast {
            background: #1e293b; color: white;
            padding: 14px 20px; border-radius: 50px;
            margin-bottom: 10px; display: flex; align-items: center; gap: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            opacity: 0; transform: translateY(-20px); transition: all 0.3s;
        }
        .c-toast.show { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <div class="page-header">Invite Friends</div>

    <div class="qr-card">
        <div class="invite-title">Refer & Earn</div>
        <div class="invite-desc">Share your code and earn commissions</div>

        <div class="copy-group">
            <div class="cg-info">
                <div class="cg-lbl">Code</div>
                <div class="cg-val">{{ auth()->user()->ref_id }}</div>
            </div>
            <div class="cg-btn" onclick="copyText('{{ auth()->user()->ref_id }}')"><i class="far fa-copy"></i></div>
        </div>

        <div class="copy-group">
            <div class="cg-info">
                <div class="cg-lbl">Link</div>
                <div class="cg-val">{{ route('register') }}?inviteCode={{ auth()->user()->ref_id }}</div>
            </div>
            <div class="cg-btn" onclick="copyText('{{ route('register') }}?inviteCode={{ auth()->user()->ref_id }}')"><i class="fas fa-link"></i></div>
        </div>
    </div>

    <div class="steps-container">
        <div class="sc-title">How it works</div>
        
        <div class="step-row">
            <div class="step-icon"><i class="fas fa-share-alt"></i></div>
            <div class="step-info">
                <div class="si-head">Share Link</div>
                <div class="si-desc">Send your link to friends to register.</div>
            </div>
        </div>
        <div class="step-row">
            <div class="step-icon"><i class="fas fa-user-plus"></i></div>
            <div class="step-info">
                <div class="si-head">They Join</div>
                <div class="si-desc">Friends sign up and make a deposit.</div>
            </div>
        </div>
        <div class="step-row">
            <div class="step-icon"><i class="fas fa-coins"></i></div>
            <div class="step-info">
                <div class="si-head">You Earn</div>
                <div class="si-desc">Get instant commission rewards.</div>
            </div>
        </div>
    </div>

    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>
    
    <div id="toast-box"></div>

    <script>
        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                toast("Copied!");
            }).catch(() => {
                // Fallback
                const el = document.createElement('textarea');
                el.value = text; document.body.appendChild(el);
                el.select(); document.execCommand('copy'); document.body.removeChild(el);
                toast("Copied!");
            });
        }

        function toast(msg) {
            let box = document.getElementById('toast-box');
            let el = document.createElement('div');
            el.className = 'c-toast';
            el.innerHTML = `<i class="fas fa-check-circle" style="color:#4ade80"></i> <span>${msg}</span>`;
            box.appendChild(el);
            void el.offsetWidth; el.classList.add('show');
            setTimeout(() => { el.classList.remove('show'); setTimeout(() => el.remove(), 300); }, 2000);
        }
    </script>
</body>
</html>