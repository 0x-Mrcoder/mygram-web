<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>My Investments - FortuneFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --ios-bg: #0A0E1A;
            --ios-blue: #F1C40F;
            --ios-green: #27AE60;
            --ios-gray: #A0AEC0;
            --card-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
            margin-bottom: 20px;
        }

        /* List */
        .invest-list { padding: 0 20px; display: flex; flex-direction: column; gap: 15px; }

        .invest-card {
            background: #161B2D;
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            position: relative;
        }

        .ic-head { display: flex; gap: 15px; align-items: center; margin-bottom: 15px; }
        .ic-img { width: 50px; height: 50px; border-radius: 12px; object-fit: cover; }
        .ic-info { flex: 1; }
        .ic-name { font-size: 16px; font-weight: 700; margin-bottom: 2px; }
        .ic-cost { font-size: 13px; color: var(--ios-gray); }

        .ic-stats {
            display: flex; gap: 15px; margin-bottom: 20px;
            background: #2D3748; padding: 12px; border-radius: 12px;
        }
        .stat-item { flex: 1; }
        .stat-lbl { font-size: 11px; color: var(--ios-gray); text-transform: uppercase; font-weight: 600; margin-bottom: 4px; }
        .stat-val { font-size: 15px; font-weight: 600; color: #fff; }
        .stat-val.green { color: var(--ios-green); }

        .btn-claim {
            width: 100%;
            background: var(--ios-blue);
            color: #000;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-claim:active { opacity: 0.8; }

        .btn-cd {
            width: 100%;
            background: #2D3748;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: default;
        }
        
        .btn-done {
            width: 100%;
            background: transparent;
            color: var(--ios-gray);
            border: 1px solid #E5E5EA;
            padding: 14px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            cursor: default;
        }

        .empty-state { text-align: center; padding: 40px; color: var(--ios-gray); }

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
            background: #333; color: white; padding: 12px 24px; border-radius: 30px;
            font-size: 14px; font-weight: 600; z-index: 2000;
            opacity: 0; pointer-events: none; transition: opacity 0.3s, transform 0.3s;
        }
        .toast.show { opacity: 1; transform: translateX(-50%) translateY(10px); }
    </style>
</head>
<body>

    <div class="page-header">My Investments</div>

    <?php
        $purchases = \App\Models\Purchase::where('user_id', auth()->id())->where('status', 'active')->latest()->get();
    ?>  

    <div class="invest-list">
        @if($purchases->count() > 0)
            @foreach($purchases as $purchase)
                @php $plan = $purchase->package; @endphp
                @if($plan)
                    <div class="invest-card">
                        <div class="ic-head">
                            <img src="{{ asset('assets/images/vip_cartoon.png') }}" class="ic-img">
                            <div class="ic-info">
                                <div class="ic-name">{{ $plan->name }}</div>
                                <div class="ic-cost">Invested: {{ price($purchase->amount ?? $plan->price) }}</div>
                            </div>
                            <div style="font-size:12px; font-weight:600; background:#E5E5EA; color:#555; padding:4px 8px; border-radius:6px;">
                                {{ $plan->validity }} Days
                            </div>
                        </div>

                        <div class="ic-stats">
                            <div class="stat-item">
                                <div class="stat-lbl">Daily ROI</div>
                                <div class="stat-val green">{{ price($purchase->daily_limit ?? $plan->daily_limit) }}</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-lbl">Total ROI</div>
                                @php
                                    $daily = (float)($purchase->daily_limit ?? $plan->daily_limit ?? 0);
                                    $valid = (int)($plan->validity ?? 0);
                                    $totalROI = $daily * $valid;
                                @endphp
                                <div class="stat-val">{{ price($totalROI) }}</div>
                            </div>
                        </div>

                        <!-- Action Logic -->
                        @php
                            $reason = 'daily_claim_purchase_' . $purchase->id;
                            $last_claim = \App\Models\UserLedger::where(['user_id' => auth()->id(), 'reason' => $reason])->latest()->first();
                            $lastActionDate = $last_claim->created_at ?? $purchase->created_at; 
                            $claimedToday = \App\Models\UserLedger::where(['user_id' => auth()->id(), 'reason' => $reason])->whereDate('created_at', today())->exists();
                        @endphp

                        <div id="wrapper-{{ $purchase->id }}">
                            <button class="btn-cd" id="cd-{{ $purchase->id }}" style="display:none">00:00:00</button>
                            <button class="btn-claim" id="claim-{{ $purchase->id }}" style="display:none" onclick="window.location.href='/my/vip?purchase_id={{$purchase->id}}'">Receive Income</button>
                            <button class="btn-done" id="done-{{ $purchase->id }}" style="display:none">Collected Today</button>
                        </div>

                        <script>
                            (function() {
                                const lastTime = new Date(@json($lastActionDate)).getTime();
                                const claimedToday = @json($claimedToday);
                                const now = new Date().getTime();
                                const nextClaim = lastTime + (24 * 60 * 60 * 1000);
                                
                                const btnCd = document.getElementById("cd-{{ $purchase->id }}");
                                const btnClaim = document.getElementById("claim-{{ $purchase->id }}");
                                const btnDone = document.getElementById("done-{{ $purchase->id }}");

                                if (now < nextClaim) {
                                    // Priority 1: Countdown if 24 hours haven't passed
                                    btnCd.style.display = 'block';
                                    function update() {
                                        const curr = new Date().getTime();
                                        const diff = nextClaim - curr;
                                        if (diff <= 0) {
                                            btnCd.style.display = 'none';
                                            // Once timer is up, check if we can claim or if calendar day blocks us
                                            if (claimedToday) {
                                                btnDone.style.display = 'block';
                                            } else {
                                                btnClaim.style.display = 'block';
                                            }
                                            return;
                                        }
                                        const h = Math.floor((diff % (86400000)) / 3600000);
                                        const m = Math.floor((diff % 3600000) / 60000);
                                        const s = Math.floor((diff % 60000) / 1000);
                                        btnCd.innerText = `Next claim: ${h}h ${m}m ${s}s`;
                                        setTimeout(update, 1000);
                                    }
                                    update();
                                } else if (claimedToday) {
                                    // Priority 2: 24 hours passed, but already claimed today (calendar day restriction)
                                    btnDone.style.display = 'block';
                                } else {
                                    // Priority 3: Can claim
                                    btnClaim.style.display = 'block';
                                }
                            })();
                        </script>
                    </div>
                @endif
            @endforeach
        @else
            <div class="empty-state">No active investments found.</div>
        @endif
    </div>

    <!-- Tab Bar -->
    <nav class="tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item active"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>
    @if(session('success')) 
        <script>
            const t = document.getElementById('toast');
            t.innerText = "{{ session('success') }}";
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        </script>
    @endif

</body>
</html>