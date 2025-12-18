<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* 기본 পেজ স্টাইল */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding-bottom: 80px; /* নেভিগেশন বারের জন্য জায়গা */
        }

        /* নেভিগেশন বারের CSS */
        :root {
            --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
            --theme-primary: #FF9100;
            --text-light: #ffffff;
        }
        .menubar-area { 
            position: fixed; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            height: 70px; 
            background: var(--text-light); 
            z-index: 1000; 
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.08); 
        }
        .menubar-nav { 
            display: flex; 
            justify-content: space-around; 
            align-items: center; 
            height: 100%; 
        }
        .menubar-nav .nav-link { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            text-decoration: none; 
            color: #888; 
            font-size: 11px; 
            font-weight: 500; 
            position: relative; 
        }
        .menubar-nav .nav-link i { 
            font-size: 22px; 
            margin-bottom: 4px; 
        }
        .menubar-nav .nav-link.active { 
            color: var(--theme-primary); 
        }
        .nav-link-income { 
            position: absolute; 
            bottom: 15px; 
            left: 50%; 
            transform: translateX(-50%); 
            width: 60px; 
            height: 60px; 
            background: var(--text-light); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            box-shadow: 0 -4px 15px rgba(0,0,0,0.1); 
            text-decoration: none;
        }
        .nav-link-income .icon-bg { 
            width: 48px; 
            height: 48px; 
            background: var(--theme-gradient); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .nav-link-income i { 
            color: var(--text-light); 
            font-size: 24px; 
            margin: 0; 
        }
        .nav-link-income-label { 
            position: absolute; 
            bottom: -15px; 
            font-size: 11px; 
            font-weight: 500; 
            color: #888; 
        }
    </style>
</head>
<body>

    <!-- আপনার পেজের মূল কন্টেন্ট এখানে থাকবে -->
    <div style="padding: 20px; text-align: center;">
        <h1>Page Content Goes Here</h1>
        <p>This is a sample page to demonstrate the navigation bar.</p>
    </div>
    <!-- আপনার পেজের মূল কন্টেন্ট এখানে শেষ -->


    <!-- ========== নতুন নেভিগেশন মেন্যু ========== -->
    <div class="menubar-area">
        <div class="menubar-nav">
            {{-- Home (active class যুক্ত করা হয়েছে) --}}
            <a href="#" class="nav-link active">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>

            {{-- Team --}}
            <a href="#" class="nav-link">
                <i class="fa-solid fa-user-group"></i>
                <span>Team</span>
            </a>
            
            {{-- মাঝের ফাঁকা স্থান --}}
            <a href="#" class="nav-link" style="width: 60px;"></a> 

            {{-- Moments --}}
            <a href="#" class="nav-link">
                <i class="fa-solid fa-images"></i>
                <span>Moments</span>
            </a>

            {{-- My --}}
            <a href="#" class="nav-link">
                <i class="fa-solid fa-user"></i>
                <span>My</span>
            </a>
        </div>

        {{-- মাঝের বড় বাটন (Mining) --}}
        <a href="#" class="nav-link-income">
            <div class="icon-bg"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <span class="nav-link-income-label">Mining</span>
        </a>
    </div>

</body>
</html>