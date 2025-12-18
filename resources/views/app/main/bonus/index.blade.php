@extends('app.layout.app')

@section('app_content')
    <div class="mypage-section">
        <div class="container">
            {{-- আপনার spain.css ফাইলের লিংক ঠিক রাখা হয়েছে --}}
            <link rel="stylesheet" href="{{asset('public/spin/spain.css')}}">
            
            <style>
                :root {
                    --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
                    --theme-primary: #FF9100;
                    --text-light: #ffffff;
                    --text-dark: #333333;
                    --background-color: #f7f8fa;
                    --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
                }

                body {
                    font-family: 'Poppins', sans-serif;
                    background-color: var(--background-color); /* fallback color */
                    background-image: url("{{ assets('/smartlab/main/bg.png') }}"); /* আপনার ইমেজ path দিন */
                    background-size: cover;       /* পুরো পেজে কভার করবে */
                    background-repeat: no-repeat; /* রিপিট হবে না */
                    background-attachment: fixed; /* স্ক্রল করলে ফিক্স থাকবে */
                    background-position: center;  /* মাঝখানে সেট হবে */
                }
                
                .spin_banner {
                    background: var(--theme-gradient) !important;
                    padding: 15px;
                    text-align: center;
                    color: var(--text-light);
                }
                
                .spin_back {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 15px;
                }
                
                .spin_back i {
                    font-size: 20px;
                    cursor: pointer;
                }

                h1.l_wheel {
                    font-size: 24px;
                    font-weight: 700;
                    margin: 0;
                }

                .bonus-code-container {
                    background: #fff;
                    width: 90%;
                    margin: 25px auto;
                    padding: 25px 15px;
                    border-radius: 16px;
                    box-shadow: var(--card-shadow);
                }

                .bonus-code-container label {
                    text-align: left;
                    display: block;
                    margin-bottom: 10px;
                    font-weight: 600;
                    color: var(--text-dark);
                }
                
                .bonus-code-container input[type="text"] {
                    display: block;
                    width: 100%;
                    padding: 12px 15px;
                    border: 1px solid #ddd;
                    background: #f7f8fa;
                    border-radius: 10px;
                    font-family: 'Poppins', sans-serif;
                    font-size: 16px;
                }
                
                .bonus-code-container button {
                    border: none;
                    background: var(--theme-gradient);
                    color: var(--text-light);
                    padding: 12px 50px;
                    font-size: 16px;
                    font-weight: 600;
                    border-radius: 50px;
                    margin-top: 20px;
                    cursor: pointer;
                    box-shadow: 0 4px 10px rgba(255,152,0,0.4);
                }

                .marquee-wrapper {
                    background: #fff;
                    height: 237px;
                    width: 90%;
                    margin: 30px auto;
                    border-radius: 10px;
                    padding: 10px 16px;
                    box-shadow: var(--card-shadow);
                }

                .single-purchase p {
                    color: var(--text-dark) !important;
                }
            </style>

            <div class="spin_banner">
                <div class="spin_back">
                    <div onclick="window.location.href='{{route('dashboard')}}'"><i class="fa fa-chevron-left"></i></div>
                    <div><h1 class="l_wheel">Gift Bonus</h1></div>
                    <div style="width: 20px;"></div> {{-- for alignment --}}
                </div>
            </div>

            <div class="bonus-code-container">
                <label for="code">Bonus Code</label>
                <input type="text" name="code" id="code" placeholder="Enter your bonus code">
                <button type="button" onclick="checkin_bonus_submit()">Submit</button>
            </div>
            
            <div class="marquee-wrapper">
                <marquee behavior="scroll" direction="up" height="100%">
                    @for($i=0; $i < 300; $i++)
                        <div class="single-purchase">
                            <div class="info" style="overflow: hidden; padding: 5px 0;">
                                <p style="width: 50%; float: left;">********</p>
                                <p style="width: 50%; float: left; text-align: right;">{{number_format(rand(7,50), 2)}}</p>
                            </div>
                        </div>
                    @endfor
                </marquee>
            </div>

        </div>
    </div>

    @include('alert-message')
    <meta name="csrf-token" content="{{csrf_token()}}">

    <script>
        function checkin_bonus_submit() {
            var URL = '{{route('user.submit-bonus')}}';
            var secret = document.querySelector('input[name="code"]').value;
            if (secret == ''){
                message('Secret code required'); 
                return true;
            }
            fetch(URL, {
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({bonus_code: secret}),
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            }).then(response => response.json())
              .then(res => {
                message(res.message);
                document.querySelector('input[name="code"]').value='';
            }).catch(error => console.log(error));
        }
    </script>
@endsection
