<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Transaction History - FortuneFlow</title>

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
            --ios-green: #34C759;
            --ios-red: #FF3B30;
            --ios-orange: #FF9500;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--ios-bg);
            color: #fff;
            padding-bottom: 90px;
            padding-top: max(20px, env(safe-area-inset-top));
        }

        /* Header */
        .page-header {
            padding: 15px 20px 20px;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 8px;
            padding: 0 20px 15px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .filter-tabs::-webkit-scrollbar { display: none; }
        .filter-tab {
            padding: 8px 16px;
            background: #161B2D;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ios-gray);
            white-space: nowrap;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .filter-tab.active {
            background: var(--ios-blue);
            color: #000;
        }

        /* Transaction List */
        .hist-list { padding: 0 20px; }
        
        .hist-item {
            background: #161B2D;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            text-decoration: none;
            color: inherit;
            transition: transform 0.2s;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .hist-item:active { transform: scale(0.98); }
        
        .h-left { display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0; overflow: hidden; }
        .h-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }
        
        /* Icon Colors by Type */
        .h-icon.deposit { background: rgba(52, 199, 89, 0.1); color: var(--ios-green); }
        .h-icon.withdrawal { background: rgba(255, 59, 48, 0.1); color: var(--ios-red); }
        .h-icon.commission { background: rgba(255, 149, 0, 0.1); color: var(--ios-orange); }
        .h-icon.earning { background: rgba(52, 199, 89, 0.1); color: var(--ios-green); }
        .h-icon.bonus { background: rgba(241, 196, 15, 0.1); color: var(--ios-blue); }
        .h-icon.purchase { background: rgba(255, 59, 48, 0.1); color: var(--ios-red); }
        .h-icon.default { background: #2D3748; color: var(--ios-gray); }

        .h-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            min-width: 0;
        }
        .h-title {
            font-weight: 600;
            font-size: 15px;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .h-desc {
            font-size: 12px;
            color: var(--ios-gray);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .h-time {
            font-size: 11px;
            color: #C7C7CC;
        }

        .h-right {
            text-align: right;
            display: flex;
            flex-direction: column;
            gap: 4px;
            align-items: flex-end;
            flex-shrink: 0;
        }
        .h-amount {
            font-weight: 700;
            font-size: 15px;
            white-space: nowrap;
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .h-amount.plus { color: var(--ios-green); }
        .h-amount.minus { color: var(--ios-red); }
        
        .h-badge {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 6px;
        }
        .h-badge.approved { background: rgba(52, 199, 89, 0.1); color: var(--ios-green); }
        .h-badge.pending { background: rgba(255, 149, 0, 0.1); color: var(--ios-orange); }
        .h-badge.rejected { background: rgba(255, 59, 48, 0.1); color: var(--ios-red); }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--ios-gray);
        }
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        /* Tab Bar */
        .ios-tab-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(16, 20, 35, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 0.5px solid rgba(255,255,255,0.1);
            display: flex;
            justify-content: space-around;
            padding-top: 10px;
            padding-bottom: max(10px, env(safe-area-inset-bottom));
            z-index: 100;
        }
        .tab-link {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: #999;
            font-size: 10px;
            font-weight: 600;
        }
        .tab-link i { font-size: 22px; }
        .tab-link.active { color: var(--ios-blue); }
    </style>
</head>
<body>

    <div class="page-header">Transaction History</div>

    <div class="filter-tabs">
        <div class="filter-tab active" onclick="filterTransactions('all')">All</div>
        <div class="filter-tab" onclick="filterTransactions('deposit')">Deposits</div>
        <div class="filter-tab" onclick="filterTransactions('withdrawal')">Withdrawals</div>
        <div class="filter-tab" onclick="filterTransactions('commission')">Commissions</div>
        <div class="filter-tab" onclick="filterTransactions('earning')">Earnings</div>
        <div class="filter-tab" onclick="filterTransactions('purchase')">Purchases</div>
    </div>

    <div class="hist-list">
        @php
            $transactions = \App\Models\UserLedger::where('user_id', auth()->id())
                ->orderByDesc('created_at')
                ->get();
        @endphp

        @if($transactions->count() > 0)
            @foreach($transactions as $log)
                @php
                    // Categorize transaction
                    $category = 'default';
                    $icon = 'fa-exchange-alt';
                    $title = ucwords(str_replace('_', ' ', $log->reason));
                    $description = $log->perticulation ?? '';
                    $link = '#';
                    $isCredit = false;
                    
                    // Deposits
                    if (str_contains($log->reason, 'deposit') || $log->credit > 0 && str_contains(strtolower($log->perticulation ?? ''), 'deposit')) {
                        $category = 'deposit';
                        $icon = 'fa-arrow-down';
                        $title = 'Deposit';
                        $link = route('deposit.record');
                        $isCredit = true;
                    }
                    
                    // Withdrawals
                    elseif (str_contains($log->reason, 'withdraw') || str_contains($log->reason, 'withdrawal')) {
                        $category = 'withdrawal';
                        $icon = 'fa-arrow-up';
                        $title = 'Withdrawal';
                        $link = route('withdraw.record');
                        $isCredit = false;
                    }
                    
                    // Referral Commissions
                    elseif (str_contains($log->reason, 'referral_commission') || str_contains($log->reason, 'commission')) {
                        $category = 'commission';
                        $icon = 'fa-users';
                        if (str_contains($log->reason, 'level1')) {
                            $title = 'Level 1 Commission';
                        } elseif (str_contains($log->reason, 'level2')) {
                            $title = 'Level 2 Commission';
                        } elseif (str_contains($log->reason, 'level3')) {
                            $title = 'Level 3 Commission';
                        } else {
                            $title = 'Referral Commission';
                        }
                        $link = '/my-team';
                        $isCredit = true;
                    }
                    
                    // Daily Claims / Earnings
                    elseif (str_contains($log->reason, 'daily_claim') || str_contains($log->reason, 'daily_return')) {
                        $category = 'earning';
                        $icon = 'fa-coins';
                        $title = 'Daily Income';
                        $link = '/my/vip';
                        $isCredit = true;
                    }
                    
                    // Bonuses
                    elseif (str_contains($log->reason, 'bonus') || str_contains($log->reason, 'reward')) {
                        $category = 'bonus';
                        $icon = 'fa-gift';
                        $title = str_contains($log->reason, 'registration') ? 'Welcome Bonus' : 'Bonus';
                        $isCredit = true;
                    }
                    
                    // Purchases
                    elseif (str_contains($log->reason, 'purchase') || $log->debit > 0) {
                        $category = 'purchase';
                        $icon = 'fa-shopping-cart';
                        $title = 'Package Purchase';
                        $link = '/my/vip';
                        $isCredit = false;
                    }
                    
                    // Determine amount display
                    $amount = $log->amount;
                    $sign = '';
                    $amountClass = 'minus';
                    
                    if ($isCredit || $log->credit > 0) {
                        $sign = '+';
                        $amountClass = 'plus';
                        $amount = $log->credit > 0 ? $log->credit : $amount;
                    } else {
                        $sign = '-';
                        $amount = $log->debit > 0 ? $log->debit : $amount;
                    }
                @endphp

                <a href="{{ $link }}" class="hist-item" data-category="{{ $category }}">
                    <div class="h-left">
                        <div class="h-icon {{ $category }}">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="h-info">
                            <div class="h-title">{{ $title }}</div>
                            @if($description)
                                <div class="h-desc">{{ Str::limit($description, 40) }}</div>
                            @endif
                            <div class="h-time">{{ $log->created_at->format('M d, Y • h:i A') }}</div>
                        </div>
                    </div>
                    <div class="h-right">
                        <div class="h-amount {{ $amountClass }}">
                            {{ $sign }}₦{{ number_format($amount, 2) }}
                        </div>
                        @if($log->status)
                            <div class="h-badge {{ strtolower($log->status) }}">
                                {{ $log->status }}
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        @else
            <div class="empty-state">
                <i class="far fa-clock-rotate-left"></i>
                <p>No transactions yet</p>
            </div>
        @endif
    </div>

    <!-- Navigation -->
    <div class="ios-tab-bar">
        <a href="/" class="tab-link">
            <i class="fas fa-house"></i>
            <span>Home</span>
        </a>
        <a href="/my-team" class="tab-link">
            <i class="fas fa-users"></i>
            <span>Team</span>
        </a>
        <a href="/my/vip" class="tab-link">
            <i class="fas fa-layer-group"></i>
            <span>Plans</span>
        </a>
        <a href="/history" class="tab-link active">
            <i class="fas fa-clock-rotate-left"></i>
            <span>History</span>
        </a>
        <a href="/mine" class="tab-link">
            <i class="far fa-user"></i>
            <span>Me</span>
        </a>
    </div>

    <script>
        function filterTransactions(category) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Filter items
            const items = document.querySelectorAll('.hist-item');
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>