<!DOCTYPE html>
<html lang="bn">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>Moments</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
            --theme-primary: #FF9100;
            --text-light: #ffffff;
            --text-dark: #333333;
            --background-color: #f7f8fa;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            padding-bottom: 80px;
            background-color: var(--background-color);
        }

        .page-wraper {
            background-color: transparent;
        }

        /* Header Design */
        .header {
            background: var(--theme-gradient);
            padding: 15px;
            display: flex;
            align-items: center;
            color: var(--text-light);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header .main-bar, .header .header-content {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center; /* Title centered */
        }
        .header .title {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-light);
        }

        /* Moments Container */
        .moments-container {
            padding: 15px;
        }

        .moment-card {
            background: white;
            border-radius: 16px;
            margin-bottom: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            padding: 12px 15px;
        }
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }
        .user-info .user-name {
            font-weight: 600;
            font-size: 15px;
        }
        .user-info .post-time {
            font-size: 12px;
            color: #888;
        }

        .card-body {
            padding: 0 15px 15px 15px;
        }
        .post-text {
            font-size: 14px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 12px;
        }
        .post-image {
            width: 100%;
            border-radius: 12px;
            cursor: pointer;
        }

        .card-footer {
            border-top: 1px solid #f0f0f0;
            padding: 12px 15px;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            font-size: 14px;
            color: #777;
        }
        .footer-action {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-action i {
            font-size: 16px;
        }

        /* Floating Action Button for new post */
        .fab-create-post {
            position: fixed;
            bottom: 85px;
            right: 20px;
            width: 55px;
            height: 55px;
            background: var(--theme-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light);
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            z-index: 101;
        }
        
        /* Menubar */
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
        }
        .menubar-nav .nav-link i {
            font-size: 22px;
            margin-bottom: 4px;
        }
        .menubar-nav .nav-link.active {
            color: var(--theme-primary);
        }
        .nav-link-income {
            position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); width: 60px; height: 60px; background: var(--text-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 -4px 15px rgba(0,0,0,0.1);
        }
        .nav-link-income .icon-bg {
            width: 48px; height: 48px; background: var(--theme-gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center;
        }
        .nav-link-income i { color: var(--text-light); font-size: 24px; margin: 0; }
        .nav-link-income-label { position: absolute; bottom: -15px; font-size: 11px; font-weight: 500; color: var(--theme-primary); }
    </style>
</head>

<body>
    <div class="page-wraper">
        <!-- Header -->
        <header class="header">
            <div class="main-bar">
                <div class="header-content">
                    <div class="title">Moments</div>
                </div>
            </div>
        </header>

        <div class="moments-container">
            <div class="moment-card">
                <div class="card-header">
                    <img src="https://i.pravatar.cc/150?img=5" alt="User Avatar" class="user-avatar">
                    <div class="user-info">
                        <div class="user-name">Israt Jahan</div>
                        <div class="post-time">3 hours ago</div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="post-text">আজকের আয়টা দারুণ ছিল! এই প্ল্যাটফর্মটি সত্যিই অসাধারণ। সবাই এখানে কাজ করতে পারেন।</p>
                    <img src="/smartlab/main/sample-proof.jpg" alt="Post Image" class="post-image">
                </div>
                <div class="card-footer">
                    <div class="footer-action">
                        <i class="far fa-heart"></i>
                        <span>32</span>
                    </div>
                    <div class="footer-action">
                        <i class="far fa-comment"></i>
                        <span>8</span>
                    </div>
                </div>
            </div>

            <div class="moment-card">
                <div class="card-header">
                    <img src="https://i.pravatar.cc/150?img=7" alt="User Avatar" class="user-avatar">
                    <div class="user-info">
                        <div class="user-name">Rahim Ali</div>
                        <div class="post-time">5 hours ago</div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="post-text">আমার প্রথম উইথড্র সফল হয়েছে। যারা ভাবছেন শুরু করবেন, তাদের জন্য শুভকামনা!</p>
                </div>
                <div class="card-footer">
                     <div class="footer-action">
                        <i class="far fa-heart"></i>
                        <span>18</span>
                    </div>
                    <div class="footer-action">
                        <i class="far fa-comment"></i>
                        <span>5</span>
                    </div>
                </div>
            </div>
            

        </div>
        
        <a href="#" class="fab-create-post">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <!-- Menubar Area -->
    <div class="menubar-area">
        <div class="menubar-nav">
            <a href="/" class="nav-link"><i class="fa-solid fa-house"></i>Home</a>
            <a href="/invite" class="nav-link"><i class="fa-solid fa-user-group"></i>Invite</a>
            <a href="#" class="nav-link" style="width: 60px;"></a>
            <a href="/blog" class="nav-link active"><i class="fa-solid fa-images"></i>Moments</a>
            <a href="/mine" class="nav-link"><i class="fa-solid fa-user"></i>My</a>
        </div>
        <a href="/my/vip" class="nav-link-income">
            <div class="icon-bg"><i class="fa-solid fa-arrow-trend-up"></i></div>
            <span class="nav-link-income-label">Ordered</span>
        </a>
    </div>

</body>
</html>