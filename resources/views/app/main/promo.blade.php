<!DOCTYPE html>
<html lang="bn">

<head>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

  <!-- Favicons Icon -->
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">

  <!-- Title -->
  <title>Bonus</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    :root {
        --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
        --theme-primary: #FF9100;
        --text-light: #ffffff;
        --text-dark: #333333;
        --background-color: #f7f8fa;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        user-select: none;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--background-color); 
    }
    
    .page-wraper {
        min-height: 100vh;
        padding-bottom: 20px;
        background-color: transparent; 
    }

    .header {
        background: var(--theme-gradient);
        padding: 15px;
        display: flex;
        align-items: center;
        color: var(--text-light);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .header .main-bar, .header .header-content {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .header .back-btn {
        color: var(--text-light);
        font-size: 20px;
        text-decoration: none;
    }
    .header .mid-content {
        flex-grow: 1;
        text-align: center;
    }
    .header .mb-0 {
        color: var(--text-light);
        font-weight: 600;
        font-size: 18px;
        margin: 0;
    }

    /* Redeem Card Design */
    .redeem-container {
        padding: 20px 15px;
    }
    .redeem-card {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        box-shadow: var(--card-shadow);
        text-align: center;
    }
    .redeem-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background: var(--theme-gradient);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-size: 36px;
        box-shadow: 0 5px 15px rgba(255, 145, 0, 0.4);
    }
    
    .code-input {
        width: 100%;
        height: 55px;
        border: 1px solid #ddd;
        border-radius: 15px;
        font-size: 18px;
        font-weight: 500;
        text-align: center;
        margin-bottom: 20px;
        transition: all 0.3s;
        font-family: 'Poppins', sans-serif;
    }
    .code-input:focus {
        border-color: var(--theme-primary);
        box-shadow: 0 0 0 3px rgba(255, 145, 0, 0.2);
        outline: none;
    }
    .redeem-btn {
        background: var(--theme-gradient);
        color: var(--text-light);
        border: none;
        border-radius: 50px;
        height: 55px;
        font-size: 18px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 145, 0, 0.4);
    }
    .redeem-btn i {
        margin-right: 8px;
    }
  </style>
</head>

<body>
  <div class="page-wraper">
    <!-- Header -->
    <header class="header">
      <div class="main-bar">
        <div class="container">
          <div class="header-content">
            <a href="javascript:history.back()" class="back-btn"><i class="fas fa-chevron-left"></i></a>
            <div class="mid-content">
              <h5 class="mb-0">Gift Code</h5>
            </div>
            <div style="width: 20px;"></div> <!-- Spacer -->
          </div>
        </div>
      </div>
    </header>

    <!-- Redeem Container -->
    <div class="redeem-container">
      <div class="redeem-card">
        <div class="redeem-icon">
          <i class="fas fa-gem"></i>
        </div>
        
        <form action="{{route('submitBonusCode')}}" method="POST">
            @csrf
            <input type="text" class="code-input" name="bonus_code" placeholder="Enter Gift Code" id="giftCode">
            <button class="btn redeem-btn" type="submit">
                <i class="fas fa-check-circle"></i> Redeem Now
            </button>
        </form>
      </div>
    </div>
  </div>

  @include('alert-message')
  <script>
    function checkin_bonus_submit() {
        var form = document.querySelector('form');
        form.submit();
    }

    document.getElementById("giftCode").addEventListener("keypress", function (e) {
      if (e.key === "Enter") {
        e.preventDefault();
        e.target.closest('form').submit();
      }
    });
  </script>

</body>
</html>