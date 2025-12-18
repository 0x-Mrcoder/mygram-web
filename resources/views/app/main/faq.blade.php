<!DOCTYPE html>
<html lang="bn">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <title>FAQ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
            --theme-primary: #FF9100;
            --text-light: #ffffff;
            --text-dark: #333333;
            --background-color: #f7f8fa;
            --card-shadow: 0 4px Rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--background-color);
        }
        
        .page-wraper {
            min-height: 100vh;
            background-color: transparent;
        }

        /* Header Design */
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

        /* FAQ Container */
        .faq-container {
            padding: 20px 15px;
        }

        .faq-item {
            background: white;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden; 
            transition: all 0.3s ease;
        }

        .faq-question {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
        }

        .faq-icon {
            font-size: 16px;
            color: var(--theme-primary);
            transition: transform 0.3s ease;
        }
        
        .faq-answer {
            max-height: 0; 
            opacity: 0;
            overflow: hidden;
            padding: 0 20px;
            font-size: 14px;
            color: #555;
            line-height: 1.7;
            transition: max-height 0.4s ease, padding 0.4s ease, opacity 0.3s ease;
        }
        
        /* Active State */
        .faq-item.active .faq-answer {
            max-height: 200px;
            opacity: 1;
            padding: 0 20px 20px 20px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
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
              <h5 class="mb-0">FAQ</h5>
            </div>
            <div style="width: 20px;"></div> <!-- Spacer -->
          </div>
        </div>
      </div>
    </header>

    <div class="faq-container">
        
        <!-- FAQ Item 1 -->
        <div class="faq-item">
            <div class="faq-question">
                <span>কিভাবে রিচার্জ করবো?</span>
                <i class="fas fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>রিচার্জ করার জন্য, প্রথমে 'My' পেজে যান, তারপর 'Recharge' বাটনে ক্লিক করুন। আপনার পছন্দের পরিমাণ লিখুন এবং পেমেন্ট পদ্ধতি নির্বাচন করে নির্দেশনা অনুসরণ করুন।</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>উইথড্র করতে কত সময় লাগে?</span>
                <i class="fas fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>সাধারণত, উইথড্র রিকোয়েস্ট দেওয়ার পর ১০ মিনিট থেকে ২৪ ঘণ্টার মধ্যে আপনার অ্যাকাউন্টে টাকা জমা হয়ে যায়। তবে বিশেষ ক্ষেত্রে এটি ৪৮ ঘণ্টা পর্যন্ত সময় নিতে পারে।</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>আমার দৈনিক আয় কখন যোগ হবে?</span>
                <i class="fas fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>আপনার কেনা প্যাকেজের দৈনিক আয় প্রতিদিন সার্ভার সময় অনুযায়ী রাত ১২টার পর স্বয়ংক্রিয়ভাবে আপনার মূল ব্যালেন্সে যোগ হয়ে যায়।</p>
            </div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">
                <span>আমি কি একাধিক প্যাকেজ কিনতে পারবো?</span>
                <i class="fas fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>হ্যাঁ, আপনি আপনার পছন্দ অনুযায়ী একাধিক প্যাকেজ একসাথে কিনতে এবং সক্রিয় রাখতে পারবেন। প্রতিটি প্যাকেজের আয় আলাদাভাবে গণনা করা হবে।</p>
            </div>
        </div>

        <!-- FAQ Item 5 -->
        <div class="faq-item">
            <div class="faq-question">
                <span>আমার অ্যাকাউন্ট সুরক্ষিত রাখতে কি করবো?</span>
                <i class="fas fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>আপনার অ্যাকাউন্ট সুরক্ষিত রাখতে, একটি শক্তিশালী পাসওয়ার্ড ব্যবহার করুন এবং আপনার পাসওয়ার্ড বা ব্যক্তিগত তথ্য কারো সাথে শেয়ার করবেন না। প্রয়োজনে 'Security' অপশন থেকে পাসওয়ার্ড পরিবর্তন করতে পারেন।</p>
            </div>
        </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const parentItem = question.parentElement;
                
                parentItem.classList.toggle('active');

                faqQuestions.forEach(otherQuestion => {
                    if (otherQuestion !== question) {
                        otherQuestion.parentElement.classList.remove('active');
                    }
                });
            });
        });
    });
  </script>

</body>
</html>