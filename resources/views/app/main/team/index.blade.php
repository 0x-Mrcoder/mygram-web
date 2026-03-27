<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>My Team - FortuneFlow</title>

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
            --ios-divider: #2D3748;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 100px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        /* Header */
        .page-header {
            padding: 10px 20px;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Summary Card */
        .summary-card {
            background: var(--ios-card);
            margin: 0 20px 20px;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }
        .sum-block { text-align: center; }
        .sum-val { font-size: 20px; font-weight: 700; color: var(--ios-blue); }
        .sum-lbl { font-size: 11px; font-weight: 600; color: var(--ios-gray); text-transform: uppercase; margin-top: 4px; }

        /* Invite Card */
        .invite-card {
            background: var(--ios-card);
            margin: 0 20px 25px;
            border-radius: 16px;
            padding: 15px 20px;
            display: flex; align-items: center; justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }
        .inv-code { font-family: monospace; font-size: 16px; font-weight: 700; letter-spacing: 1px; }
        .inv-btn {
            background: #2D3748; color: var(--ios-blue);
            border: none; padding: 8px 16px; border-radius: 20px;
            font-size: 13px; font-weight: 600; cursor: pointer;
        }
        .inv-btn:active { opacity: 0.7; }

        /* Segmented Control */
        .segment-wrapper {
            padding: 0 20px; margin-bottom: 20px;
        }
        .segment-control {
            background: #2D3748;
            border-radius: 9px;
            padding: 2px;
            display: flex;
        }
        .segment-btn {
            flex: 1;
            padding: 8px 0;
            text-align: center;
            font-size: 13px; font-weight: 600; color: #fff;
            border-radius: 7px;
            border: none; background: transparent;
            cursor: pointer;
        }
        .segment-btn.active {
            background: #161B2D;
            color: var(--ios-blue);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* List */
        .member-list { padding: 0 20px; display: flex; flex-direction: column; gap: 10px; }
        
        .member-row {
            background: #161B2D;
            padding: 15px;
            border-radius: 12px;
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .m-avatar {
            width: 40px; height: 40px;
            background: #2D3748;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: var(--ios-gray);
        }
        .m-info { flex: 1; }
        .m-phone { font-size: 15px; font-weight: 600; margin-bottom: 2px; }
        .m-date { font-size: 11px; color: var(--ios-gray); }
        .m-stat { text-align: right; }
        .m-amt { font-size: 14px; font-weight: 600; color: var(--ios-blue); }
        .m-lbl { font-size: 10px; color: var(--ios-gray); }

        .empty-list { text-align: center; padding: 40px; color: var(--ios-gray); font-size: 14px; }

        /* Tab Bar */
        .tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16,20,35,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 0.5px solid rgba(255,255,255,0.1);
            display: flex; justify-content: space-around;
            padding-top: 10px;
            padding-bottom: max(10px, env(safe-area-inset-bottom));
            z-index: 100;
        }
        .tab-item {
            text-decoration: none;
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            color: #999;
            flex: 1;
        }
        .tab-item i { font-size: 22px; }
        .tab-item span { font-size: 10px; font-weight: 600; }
        .tab-item.active { color: var(--ios-blue); }

        /* Toast */
        .toast {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            background: #333; color: white; padding: 10px 20px; border-radius: 20px;
            font-size: 13px; font-weight: 600; z-index: 2000;
            opacity: 0; pointer-events: none; transition: opacity 0.3s;
        }
        .toast.show { opacity: 1; }
    </style>
</head>
<body>

    <div class="page-header">My Team</div>

    <div class="summary-card">
        <div class="sum-block">
            <div class="sum-val">{{ ($first_level_users->count() + $second_level_users->count() + $third_level_users->count()) }}</div>
            <div class="sum-lbl">Members</div>
        </div>
        <div class="sum-block">
            <div class="sum-val">₦{{ number_format($totalCommission1 + $totalCommission2 + $totalCommission3) }}</div>
            <div class="sum-lbl">Commission</div>
        </div>
        <div class="sum-block">
            <div class="sum-val">₦{{ number_format($totalDeposit) }}</div>
            <div class="sum-lbl">Team Sales</div>
        </div>
    </div>

    <div class="invite-card">
        <div>
            <div style="font-size:10px; color:#8E8E93; margin-bottom:4px; font-weight:600;">YOUR INVITE CODE</div>
            <div class="inv-code">{{ auth()->user()->ref_id }}</div>
        </div>
        <button class="inv-btn" onclick="copyLink()"><i class="far fa-copy"></i> Copy</button>
    </div>

    <div class="segment-wrapper">
        <div class="segment-control">
            <button class="segment-btn active" onclick="switchTab(1)">Level 1 ({{ $first_level_users->count() }})</button>
            <button class="segment-btn" onclick="switchTab(2)">Level 2 ({{ $second_level_users->count() }})</button>
            <button class="segment-btn" onclick="switchTab(3)">Level 3 ({{ $third_level_users->count() }})</button>
        </div>
    </div>

    <div class="member-list" id="memberList">
        <!-- Rendered by JS -->
    </div>

    <!-- Data Injection -->
    <script>
        const teamData = {
            1: [
                @foreach($first_level_users as $u)
                {
                    phone: "{{ $u->phone }}", date: "{{ $u->created_at->format('d M') }}",
                    deposit: {{ \App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount') }},
                    sales: "₦{{ number_format(\App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount')) }}"
                },
                @endforeach
            ],
            2: [
                @foreach($second_level_users as $u)
                {
                    phone: "{{ $u->phone }}", date: "{{ $u->created_at->format('d M') }}",
                    deposit: {{ \App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount') }},
                    sales: "₦{{ number_format(\App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount')) }}"
                },
                @endforeach
            ],
            3: [
                @foreach($third_level_users as $u)
                {
                    phone: "{{ $u->phone }}", date: "{{ $u->created_at->format('d M') }}",
                    deposit: {{ \App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount') }},
                    sales: "₦{{ number_format(\App\Models\Purchase::where('user_id', $u->id)->where('status','active')->sum('amount')) }}"
                },
                @endforeach
            ]
        };

        const listContainer = document.getElementById('memberList');
        const btns = document.querySelectorAll('.segment-btn');

        function switchTab(lvl) {
            // Update Active State
            btns.forEach((b, i) => {
                if(i === (lvl - 1)) b.classList.add('active');
                else b.classList.remove('active');
            });

            // Render List
            listContainer.innerHTML = '';
            const data = teamData[lvl];

            if(data.length === 0) {
                listContainer.innerHTML = '<div class="empty-list">No members in this level</div>';
                return;
            }

            data.forEach(u => {
                const html = `
                    <div class="member-row">
                        <div class="m-avatar">
                            <i class="fas fa-user" style="${u.deposit > 0 ? 'color:#34C759' : ''}"></i>
                        </div>
                        <div class="m-info">
                            <div class="m-phone">${u.phone}</div>
                            <div class="m-date">Joined ${u.date}</div>
                        </div>
                        <div class="m-stat">
                            <div class="m-amt">${u.sales}</div>
                            <div class="m-lbl">Invested</div>
                        </div>
                    </div>
                `;
                listContainer.insertAdjacentHTML('beforeend', html);
            });
        }

        function copyLink() {
            const link = "{{ route('register') }}?inviteCode={{ auth()->user()->ref_id }}";
            navigator.clipboard.writeText(link).then(() => {
                const t = document.getElementById('toast');
                t.classList.add('show');
                setTimeout(() => t.classList.remove('show'), 2000);
            });
        }
        
        // Init
        switchTab(1);
    </script>

    <!-- Navigation -->
    <nav class="tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item active"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

    <div id="toast" class="toast"><i class="fas fa-check"></i> Copied to clipboard</div>

</body>
</html>