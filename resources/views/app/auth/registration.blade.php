<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - MyGram</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-color: #ee667f;
            --primary-gradient: linear-gradient(135deg, #ff8fa3 0%, #ee667f 100%);
            --secondary-color: #333;
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --input-bg: #f0f2f5;
            --text-color: #333;
            --text-muted: #888;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); color: var(--text-color); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: var(--card-bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        @media (min-width: 480px) {
            .register-container {
                min-height: auto;
                border-radius: 30px;
                box-shadow: var(--shadow);
                margin: 20px;
            }
        }

        .header { text-align: center; margin-bottom: 1px; }
        .logo { width: 250px; height: auto; margin-bottom: 15px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); }
        .welcome-text { font-size: 22px; font-weight: 700; margin-top: -90px; color: var(--secondary-color); margin-bottom: 5px; }
        .sub-text { font-size: 14px; color: var(--text-muted); }

        .form-group { margin-bottom: 15px; }
        .input-group {
            position: relative;
            background: var(--input-bg);
            border-radius: 15px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .input-group:focus-within {
            background: #fff;
            border-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(238, 102, 127, 0.1);
        }
        .input-icon { color: var(--text-muted); font-size: 18px; margin-right: 10px; width: 20px; text-align: center; }
        .input-group:focus-within .input-icon { color: var(--primary-color); }
        
        .form-control {
            border: none;
            background: transparent;
            width: 100%;
            padding: 12px 0;
            font-size: 15px;
            color: var(--text-color);
            outline: none;
            font-family: inherit;
        }
        .form-control::placeholder { color: #aaa; }

        .password-toggle { cursor: pointer; color: var(--text-muted); padding: 5px; }
        
        .btn-register {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 15px;
            background: var(--primary-gradient);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(238, 102, 127, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }
        .btn-register:active { transform: scale(0.98); box-shadow: 0 5px 10px rgba(238, 102, 127, 0.2); }
        .btn-register:disabled { opacity: 0.7; cursor: not-allowed; }

        .footer-links { text-align: center; margin-top: 25px; font-size: 14px; color: var(--text-muted); }
        .footer-links a { color: var(--primary-color); text-decoration: none; font-weight: 600; }

        /* Toast Styles */
        #toast-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10000;
            width: 90%;
            max-width: 400px;
            pointer-events: none;
        }
        .toast {
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border-left: 5px solid #ddd;
            pointer-events: auto;
        }
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
        .toast-icon {
            font-size: 24px;
            margin-right: 15px;
            display: flex;
            align-items: center;
        }
        .toast-content {
            flex-grow: 1;
        }
        .toast-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 2px;
            color: #333;
        }
        .toast-message {
            font-size: 13px;
            color: #666;
            line-height: 1.4;
        }
        .toast.success { border-left-color: #4CAF50; }
        .toast.success .toast-icon { color: #4CAF50; }
        .toast.error { border-left-color: #F44336; }
        .toast.error .toast-icon { color: #F44336; }

        /* Spinner */
        .spinner { display: inline-block; animation: spin 1s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="header">
            <img src="{{ asset('logo.png') }}" alt="MyGram Logo" class="logo">
            <h1 class="welcome-text">Create Account</h1>
            <p class="sub-text">Join MyGram today</p>
        </div>

        <form id="registerForm" action="{{ route('register') }}" method="POST">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-phone-alt"></i></span>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Mobile Number" required pattern="[0-9]+">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <span class="password-toggle" id="togglePassword"><i class="fas fa-eye"></i></span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                    <span class="password-toggle" id="toggleConfirmPassword"><i class="fas fa-eye"></i></span>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-icon"><i class="fas fa-users"></i></span>
                    <input type="text" name="ref_id" id="ref_id" class="form-control" placeholder="Invitation Code (Optional)" value="{{ $ref_by ?? '' }}">
                </div>
            </div>

            <button type="submit" class="btn-register">
                <span class="btn-text">Sign Up</span>
                <span class="spinner" style="display: none;"><i class="fas fa-circle-notch"></i></span>
            </button>
        </form>

        <div class="footer-links">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>

    <div id="toast-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
            
            // Trigger reflow
            $toast[0].offsetHeight;
            
            $toast.addClass('show');
            
            setTimeout(() => {
                $toast.removeClass('show');
                setTimeout(() => {
                    $toast.remove();
                }, 300);
            }, 3000);
        }

        function notify(status, msg) {
            const title = status === 'success' ? 'Success' : 'Error';
            showToast(status, title, msg);
        }

        function onRequestResponse(response) {
            if (response.status === "success") {
                notify("success", response.msg);
                setTimeout(() => { window.location.href = "/dashboard"; }, 1500);
            } else {
                notify("error", response.msg);
            }
        }

        $(document).ready(function() {
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            function togglePasswordVisibility(fieldId, toggleButtonId) {
                const input = $(fieldId);
                const icon = $(toggleButtonId).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            }

            $('#togglePassword').on('click', function() {
                togglePasswordVisibility('#password', this);
            });

            $('#toggleConfirmPassword').on('click', function() {
                togglePasswordVisibility('#password_confirmation', this);
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                const password = $('#password').val();
                const confirmPassword = $('#password_confirmation').val();

                if (password !== confirmPassword) {
                    notify('error', 'Passwords do not match.');
                    return;
                }

                const form = $(this);
                const btn = form.find('.btn-register');
                const btnText = btn.find('.btn-text');
                const spinner = btn.find('.spinner');

                btn.prop('disabled', true);
                btnText.hide();
                spinner.show();

                const formData = {};
                form.serializeArray().forEach(item => formData[item.name] = item.value);

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        onRequestResponse(response);
                    },
                    error: function(xhr) {
                        let msg = 'Registration failed. Please try again.';
                        if (xhr.responseJSON) {
                            msg = xhr.responseJSON.msg || xhr.responseJSON.message || msg;
                        }
                        notify('error', msg);
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btnText.show();
                        spinner.hide();
                    }
                });
            });
        });
    </script>
</body>
</html>