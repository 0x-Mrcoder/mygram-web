<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, viewport-fit=cover">
    <title>Bank Account - FortuneFlow</title>

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
            --ios-red: #E74C3C;
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

        .bk-container { padding: 0 20px; }

        /* Wallet Card */
        .u-card {
            background: linear-gradient(135deg, #161B2D, #2D3748);
            border-radius: 16px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative; overflow: hidden;
            height: 200px;
            display: flex; flex-direction: column; justify-content: space-between;
            margin-bottom: 25px;
        }
        .u-card::after {
            content: ''; position: absolute; top: -50px; right: -50px;
            width: 150px; height: 150px; background: rgba(255,255,255,0.05);
            border-radius: 50%; pointer-events: none;
        }
        
        .c-bank { font-size: 18px; font-weight: 700; }
        .c-num { font-size: 24px; letter-spacing: 2px; font-weight: 600; font-family: monospace; text-align: center; }
        .c-name { font-size: 14px; opacity: 0.8; }
        .c-chip { width: 40px; height: 30px; background: rgba(255,255,255,0.2); border-radius: 6px; }

        /* Add Button */
        .add-area {
            text-align: center; padding: 40px 20px;
            background: var(--ios-card); border-radius: 16px;
            border: 1px dashed #2D3748; cursor: pointer;
            color: #fff;
        }
        .add-area:active { background: #2D3748; }
        .aa-icon { font-size: 30px; color: var(--ios-blue); margin-bottom: 10px; }
        .aa-text { font-size: 15px; font-weight: 600; }

        /* Actions */
        .action-row {
            margin-top: 20px;
            display: flex; gap: 15px;
        }
        .act-btn {
            flex: 1; padding: 14px;
            background: var(--ios-card); border-radius: 12px;
            text-align: center; font-weight: 600; font-size: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); color: var(--ios-blue);
            cursor: pointer;
        }
        .act-btn:active { background: #2D3748; }

        /* Modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.4); z-index: 999;
            display: none;
        }
        .modal-overlay.show {
            display: block;
        }
        .modal-sheet {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #161B2D; border-radius: 14px 14px 0 0;
            padding: 20px 20px 40px; 
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
            color: #fff;
        }
        .modal-overlay.show .modal-sheet { 
            transform: translateY(0); 
        }

        .form-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 25px;
        }
        .fh-title { font-size: 17px; font-weight: 600; }
        .fh-close { color: var(--ios-blue); font-weight: 600; cursor: pointer; }

        .inp-group { background: #2D3748; border-radius: 12px; overflow: hidden; margin-bottom: 20px; }
        .inp-row {
            display: flex; align-items: center; padding: 12px 15px;
            border-bottom: 1px solid #161B2D;
        }
        .inp-row:last-child { border-bottom: none; }
        .ir-lbl { width: 100px; font-size: 15px; }
        .ir-field {
            flex: 1; border: none; outline: none; font-size: 15px;
            background: transparent; color: #fff;
        }
        .ir-field::placeholder { color: #C7C7CC; }

        .save-btn {
            width: 100%; padding: 16px; background: var(--ios-blue);
            color: #000; border: none; border-radius: 12px;
            font-size: 16px; font-weight: 600; cursor: pointer;
        }

        /* Navigation */
        .ios-tab-bar {
            position: fixed; bottom: 0; left: 0; width: 100%;
            background: rgba(16, 20, 35, 0.95); backdrop-filter: blur(20px);
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

    <div class="page-header">Bank Account</div>

    <div class="bk-container">
        @if(auth()->user()->gateway_number)
            <div class="u-card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <span class="c-bank">{{ auth()->user()->gateway_method }}</span>
                    <div class="c-chip"></div>
                </div>
                <div class="c-num p-display">{{ substr(auth()->user()->gateway_number, 0, 4) }} **** {{ substr(auth()->user()->gateway_number, -4) }}</div>
                <div class="c-name">{{ auth()->user()->holder_name }}</div>
            </div>
            
            <div class="action-row">
                <div class="act-btn" onclick="openModal()">Edit Account</div>
            </div>
        @else
            <div class="add-area" onclick="openModal()">
                <div class="aa-icon"><i class="fas fa-plus-circle"></i></div>
                <div class="aa-text">Add Bank Account</div>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="bankModal" class="modal-overlay" onclick="closeModal()">
        <div class="modal-sheet" onclick="event.stopPropagation()">
            <div class="form-header">
                <div class="fh-close" onclick="closeModal()">Cancel</div>
                <div class="fh-title">Bank Details</div>
                <div class="fh-close" style="opacity:0;">Done</div>
            </div>

            <form action="{{ route('setup.gateway.submit') }}" method="POST">
                @csrf
                <div class="inp-group">
                    <div class="inp-row">
                        <label class="ir-lbl">Bank</label>
                        <select class="ir-field" name="gateway_method" id="bankSelect" required>
                            <option value="">Select Bank</option>
                            <option value="OPay">OPay</option>
                            <option value="PalmPay">PalmPay</option>
                            <option value="Moniepoint">Moniepoint</option>
                            <option value="Kuda Bank">Kuda Bank</option>
                            <option value="Access Bank">Access Bank</option>
                            <option value="Zenith Bank">Zenith Bank</option>
                            <option value="GTBank">Guaranty Trust Bank</option>
                            <option value="First Bank">First Bank of Nigeria</option>
                            <option value="UBA">United Bank for Africa</option>
                            <option value="Fidelity Bank">Fidelity Bank</option>
                            <option value="Stanbic IBTC">Stanbic IBTC Bank</option>
                            <option value="Sterling Bank">Sterling Bank</option>
                            <option value="Wema Bank">Wema Bank</option>
                            <option value="FCMB">First City Monument Bank</option>
                            <option value="Union Bank">Union Bank</option>
                            <option value="Unity Bank">Unity Bank</option>
                            <option value="Polaris Bank">Polaris Bank</option>
                            <option value="Keystone Bank">Keystone Bank</option>
                            <option value="Heritage Bank">Heritage Bank</option>
                            <option value="Jaiz Bank">Jaiz Bank</option>
                            <option value="Taj Bank">Taj Bank</option>
                            <option value="Lotus Bank">Lotus Bank</option>
                            <option value="Globus Bank">Globus Bank</option>
                            <option value="Providus Bank">Providus Bank</option>
                            <option value="Parallex Bank">Parallex Bank</option>
                            <option value="SunTrust Bank">SunTrust Bank</option>
                            <option value="Titan Trust Bank">Titan Trust Bank</option>
                            <option value="Premium Trust Bank">Premium Trust Bank</option>
                            <option value="VBank">VBank (VFD Microfinance)</option>
                            <option value="FairMoney MFB">FairMoney Microfinance Bank</option>
                            <option value="Carbon">Carbon</option>
                            <option value="Paga">Paga</option>
                            <option value="Chipper Cash">Chipper Cash</option>
                        </select>
                    </div>
                    <div class="inp-row">
                        <label class="ir-lbl">Account</label>
                        <input type="tel" class="ir-field" name="gateway_number" id="accountNumber" placeholder="1234567890" maxlength="10" required>
                    </div>
                    <div class="inp-row">
                        <label class="ir-lbl">Name</label>
                        <input type="text" class="ir-field" name="holdername" id="holderName" placeholder="Enter Account Name" required>
                    </div>
                </div>

                <button type="submit" class="save-btn">Save</button>
            </form>
        </div>
    </div>

    <nav class="ios-tab-bar">
        <a href="/" class="tab-item"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="/my/vip" class="tab-item"><i class="fas fa-layer-group"></i><span>Plans</span></a>
        <a href="/my-team" class="tab-item"><i class="fas fa-users"></i><span>Team</span></a>
        <a href="/mine" class="tab-item"><i class="far fa-user"></i><span>Profile</span></a>
    </nav>
    
    @include('alert-message')

    <script>
        // Global modal functions
        window.openModal = function() { 
            document.getElementById('bankModal').classList.add('show');
        };
        
        window.closeModal = function() { 
            document.getElementById('bankModal').classList.remove('show');
        };
    </script>
</body>
</html>