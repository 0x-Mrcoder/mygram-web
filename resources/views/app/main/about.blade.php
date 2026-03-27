<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>About Us - FortuneFlow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

        /* About Card */
        .about-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 25px;
            box-shadow: var(--shadow-md);
            margin-bottom: 25px;
            border: 1px solid rgba(255,255,255,0.5);
        }
        
        .about-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            background: #eee;
        }

        .about-title { font-size: 20px; font-weight: 700; color: var(--text-main); margin-bottom: 15px; text-align: center; }
        
        .about-text {
            font-size: 14px;
            line-height: 1.6;
            color: var(--text-sub);
            margin-bottom: 20px;
            text-align: justify;
        }

        .section-heading {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin: 25px 0 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-heading::before {
            content: ''; width: 4px; height: 16px; background: var(--primary); border-radius: 2px;
        }

        .highlight-box {
            background: #fff0f3;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid var(--primary);
        }
        .highlight-text { font-size: 13px; font-style: italic; color: var(--text-main); font-weight: 500; }

        .timeline-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .timeline-date {
            font-size: 12px; font-weight: 700; color: var(--primary);
            width: 80px; flex-shrink: 0; padding-top: 2px;
        }
        .timeline-content { font-size: 13px; color: var(--text-sub); line-height: 1.5; }

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
            <h1 class="page-title">About Us</h1>
            <p class="page-subtitle">Our story and mission</p>
        </div>

        <!-- Content -->
        <div class="section-container">
            <div class="about-card">
                <img src="/resources/views/app/main/IMG_20250918_172854_134.jpg" alt="Office" class="about-image" onerror="this.src='https://via.placeholder.com/400x200?text=FortuneFlow+Office'">
                
                <h2 class="about-title">{{ env('APP_NAME') }}</h2>
                
                <p class="about-text">
                    {{ env('APP_NAME') }} AI builds practical AI products that help businesses understand data faster and make smarter decisions. Our platform blends state‑of‑the‑art models with a clean developer workflow, so teams can go from idea to production without the usual friction. We focus on privacy, reliability, and real outcomes, not hype.
                </p>

                <div class="section-heading">Our Mission</div>
                <p class="about-text">
                    Make advanced AI usable for everyone. We design tools that feel simple, respect user data, and scale from side projects to the enterprise. If it doesn’t make your day easier, we don’t ship it.
                </p>

                <div class="highlight-box">
                    <p class="highlight-text">“Great AI should disappear into your workflow and let your work shine.” — TEAM {{ env('APP_NAME') }}</p>
                </div>

                <div class="section-heading">What We Do</div>
                <p class="about-text">
                    <strong>Data to Decisions:</strong> Ingest documents, chats, and logs, then query them safely with guardrails.<br><br>
                    <strong>Automation:</strong> Trigger actions across your stack using natural language and typed functions.<br><br>
                    <strong>Trust:</strong> Transparent evaluations, versioned prompts, and audit logs out of the box.
                </p>

                <div class="section-heading">Recent Highlights</div>
                <div class="timeline-item">
                    <div class="timeline-date">Aug 2025</div>
                    <div class="timeline-content">Shipped {{ env('APP_NAME') }} Workflows with human‑in‑the‑loop review and SOC 2 friendly logging.</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">Jun 2025</div>
                    <div class="timeline-content">Opened our Bangalore office and launched a free developer tier.</div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">Apr 2025</div>
                    <div class="timeline-content">Released typed function calling SDKs for PHP, Node, and Python.</div>
                </div>

                <div class="section-heading">Contact</div>
                <p class="about-text">
                    Want a demo or to explore partnerships? Reach out via the contact form or say hello on Telegram from the homepage. We usually reply within one business day.
                </p>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>