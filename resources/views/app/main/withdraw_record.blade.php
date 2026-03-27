<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Withdraw History - FortuneFlow</title>

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
            --ios-green: #27AE60;
            --ios-red: #E74C3C;
            --ios-orange: #F39C12;
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
            margin-bottom: 15px;
            position: relative;
        }
        .back-btn {
            position: absolute; left: 20px; top: 10px;
            color: var(--ios-blue); font-size: 17px; text-decoration: none;
        }

        .list-container { padding: 0 20px; }

        .d-card {
            background: var(--ios-card);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            display: flex; justify-content: space-between; align-items: center;
        }
        
        .dc-left { display: flex; align-items: center; gap: 12px; }
        .dc-icon {
            width: 40px; height: 40px;
            background: #E5E5EA; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 16px;
        }
        
        .dc-info { display: flex; flex-direction: column; gap: 2px; }
        .dc-title { font-size: 15px; font-weight: 600; }
        .dc-date { font-size: 13px; color: var(--ios-gray); }

        .dc-right { text-align: right; display: flex; flex-direction: column; gap: 2px; }
        .dc-amount { font-size: 15px; font-weight: 600; }
        .dc-status { font-size: 12px; font-weight: 500; }
        
        .st-approved { color: var(--ios-green); }
        .st-pending { color: var(--ios-orange); }
        .st-rejected { color: var(--ios-red); }

        .empty-state {
            text-align: center; padding: 50px 20px; color: var(--ios-gray);
        }

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

    </style>
</head>
<body>

    <div class="page-header">
        <a href="/withdraw" class="back-btn"><i class="fas fa-chevron-left"></i> Back</a>
        Withdraw History
    </div>

    <div class="list-container">
        @php
            $withdrawals = \App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get();
        @endphp

        @forelse($withdrawals as $item)
            <div class="d-card">
                <div class="dc-left">
                    <div class="dc-icon"><i class="fas fa-arrow-up"></i></div>
                    <div class="dc-info">
                        <span class="dc-title">Withdrawal</span>
                        <span class="dc-date">{{ $item->created_at->format('M d, H:i') }}</span>
                    </div>
                </div>
                <div class="dc-right">
                    <span class="dc-amount">-₦{{ number_format($item->amount, 2) }}</span>
                    <span class="dc-status st-{{ $item->status }}">
                        @if($item->status == 'approved') Success
                        @elseif($item->status == 'pending') Processing
                        @else Failed
                        @endif
                    </span>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>No withdrawal records found</p>
            </div>
        @endforelse
    </div>

    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>

</body>
</html>
