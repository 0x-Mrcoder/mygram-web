<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Bank Info - MyGram</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            padding: 20px 20px 60px;
            border-radius: 0 0 40px 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            margin-bottom: -40px;
            text-align: center;
            color: white;
        }
        .page-title { font-size: 22px; font-weight: 700; margin-bottom: 5px; }
        .page-subtitle { font-size: 13px; opacity: 0.9; }

        /* Content */
        .section-container { padding: 0 20px; position: relative; z-index: 10; }

        /* Add Card Box */
        .add-card-box {
            background: white;
            border-radius: var(--radius-lg);
            padding: 40px 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-bottom: 25px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px dashed rgba(238, 102, 127, 0.3);
        }
        .add-card-box:active { transform: scale(0.98); background: #fff0f3; }
        .add-icon {
            width: 70px; height: 70px; background: #fff0f3; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px; color: var(--primary); font-size: 28px;
            box-shadow: 0 5px 15px rgba(238, 102, 127, 0.2);
        }
        .add-text { font-size: 16px; font-weight: 600; color: var(--text-main); }
        .add-subtext { font-size: 12px; color: var(--text-sub); margin-top: 5px; }

        /* Form */
        .bank-form {
            display: none;
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px 20px;
            box-shadow: var(--shadow-sm);
            animation: slideUp 0.4s ease forwards;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group { margin-bottom: 20px; }
        .form-label { font-size: 14px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; display: block; }
        .form-control {
            width: 100%;
            height: 50px;
            border: 2px solid #f0f2f5;
            border-radius: 16px;
            padding: 0 20px;
            font-size: 15px;
            color: var(--text-main);
            outline: none;
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
            background: #fcfcfc;
        }
        .form-control:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(238, 102, 127, 0.1); }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ee667f' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 20px center; background-size: 16px; }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            height: 55px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(238, 102, 127, 0.3);
            transition: all 0.3s;
            font-family: 'Outfit', sans-serif;
            margin-top: 10px;
        }
        .submit-btn:active { transform: scale(0.98); box-shadow: 0 5px 10px rgba(238, 102, 127, 0.2); }

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
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Header -->
        <div class="hero-header">
            <h1 class="page-title">Bank Info</h1>
            <p class="page-subtitle">Manage your withdrawal method</p>
        </div>

        <!-- Content -->
        <div class="section-container">
            
            <div class="add-card-box" onclick="showBankForm()">
                <div class="add-icon"><i class="fa-solid fa-credit-card"></i></div>
                <div class="add-text">Add Bank Card</div>
                <div class="add-subtext">Click to add your bank details</div>
            </div>

            <div class="bank-form" id="bankForm">
                <form action="{{ route('setup.gateway.submit') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Select Bank</label>
                        <select class="form-control" name="gateway_method" id="bankSelect" required>
                            <option value="">Choose your bank</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank['bankCode'] }}">{{ $bank['bankName'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Account Number</label>
                        <input class="form-control" name="gateway_number" id="accountNumber" value="{{ auth()->user()->gateway_number }}" placeholder="e.g. 1234567890" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Account Holder Name</label>
                        <input class="form-control" name="holdername" id="holderName" value="{{ auth()->user()->holder_name }}" placeholder="e.g. John Doe" required readonly>
                    </div>

                    <button type="submit" class="submit-btn">
                        Save Details <i class="fa-solid fa-check-circle" style="margin-left: 8px;"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Floating Navigation -->
    <div class="floating-nav">
        <a href="/" class="nav-item">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Home</span>
        </a>
        <a href="/invite" class="nav-item">
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

    @include('alert-message')

    <script>
        function showBankForm() {
            document.querySelector('.add-card-box').style.display = 'none';
            document.getElementById('bankForm').style.display = 'block';
        }

        const bankSelect = document.getElementById('bankSelect');
        const accountNumberInput = document.getElementById('accountNumber');
        const holderNameInput = document.getElementById('holderName');

        function validateAccount() {
            const bankCode = bankSelect.value;
            const accountNumber = accountNumberInput.value;

            if (bankCode && accountNumber.length >= 10) {
                holderNameInput.value = 'Validating...';
                
                fetch('{{ route("validate.bank.account") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        bank_code: bankCode,
                        account_number: accountNumber
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        holderNameInput.value = data.account_name;
                        Swal.fire({
                            icon: 'success',
                            title: 'Account Verified',
                            text: 'Account name: ' + data.account_name,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        holderNameInput.value = '';
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Failed',
                            text: data.message || 'Could not validate account details.',
                            confirmButtonColor: '#ee667f'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    holderNameInput.value = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during validation',
                        confirmButtonColor: '#ee667f'
                    });
                });
            }
        }

        bankSelect.addEventListener('change', validateAccount);
        accountNumberInput.addEventListener('input', validateAccount);
    </script>
</body>
</html>