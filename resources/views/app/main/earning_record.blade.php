<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover" />
    <title>Earnig Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            height: 100%;
            font-size: calc(100vw/375 * 16);
        }
        
        .g-navigation {
            height: 3.5rem;
            color: #fff;
            background-color: #161B2D;
            font-weight: 600;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            border-bottom: 0.5px solid rgba(255,255,255,0.1);
        }
        .record-card {
            background: #161B2D;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            border: 1px solid rgba(255,255,255,0.05);
        }
    </style>
</head>

<body class="bg-[#0A0E1A] text-white">
    <div id="app">
        <div>
            <header class="g-navigation grid grid-cols-12 overflow-hidden backdrop-blur">
                <div class="col-span-2 flex items-center justify-center">
                    <a href="/" class="px-2 py-1"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                            class="w-5 h-5 font-bold text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"></path>
                        </svg></a>
                </div>
                <div class="col-span-8 flex items-center justify-center">
                    <div class="text-ellipsis overflow-hidden whitespace-nowrap text-white">Earning Record</div>
                </div>
                <div class="col-span-2 flex items-center justify-end pr-5 text-sm text-right font-medium"></div>
            </header>
            <div class="px-5 pt-5">
                <div class="g-load-more overflow-hidden min-h-40 ">
                @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->whereNotIn('reason', ['payment_approved', 'withdraw_request', 'withdraw_approved', 'payment_rejected', 'user_deposit'])->orderByDesc('id')->get() as $element)
                    <div class="record-card flex items-center justify-between">
                        <div>
                            <p class="text-lg font-bold text-[#F1C40F]">{{price($element->amount)}}</p>
                            <p class="mt-1 text-xs text-gray-400">{{$element->created_at}}</p>
                        </div>
                        <div class="text-sm font-semibold text-white">
                            {{$element->perticulation}}
                        </div>
                    </div>
                @endforeach
                </div>
                
            </div>
        </div>
        
    </div>
</body>

</html>
