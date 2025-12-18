<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

  <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
   
  <title>VIP Plans</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <div class="page-wraper">

    <style>
        :root {
            --theme-gradient: linear-gradient(135deg, #FFB74D, #FF9100);
            --accent-color: #310d64; /* বেগুনি রঙ */
            --background-color: #f7f8fa;
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            --text-dark: #333;
            --text-light: #666;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--background-color); 
            color: var(--text-dark); 
            padding-bottom: 100px; 
        }
        .container { padding: 0 15px; }

        .header-area-wrapper {
            background: #fff;
            border-radius: 0 0 25px 25px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: var(--theme-gradient);
            padding: 15px;
        }
        .header h5 {
            color: #fff;
            text-align: center;
            font-weight: 600;
            font-size: 18px;
        }
        .tab-container {
            display: flex;
            background: #f0f0f0;
            border-radius: 12px;
            padding: 5px;
            margin: 15px auto;
            max-width: 90%;
        }
        .tab {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .tab.active {
            background: var(--theme-gradient);
            color: white;
            box-shadow: 0 3px 8px rgba(255,145,0,0.4);
        }
        
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .products-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            position: relative;
        }
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(49, 13, 100, 0.8); 
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            z-index: 2;
        }
        .product-image-container {
            height: 180px;
            overflow: hidden;
        }
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-content { padding: 15px; }
        .product-description {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
            min-height: 24px;
        }
        .product-stats {
            display: flex;
            justify-content: space-between;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .stat-item { text-align: left; flex: 1; }
        .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .stat-label {
            font-size: 12px;
            color: var(--text-light);
        }
        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .product-price strong {
            font-weight: 500;
            font-size: 14px;
            color: var(--text-light);
        }
        .invest-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .invest-btn:hover {
            background: #4a1e8a;
        }
        .invest-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .menubar-area {
            position: fixed;
            bottom: 15px;
            left: 15px;
            right: 15px;
            background: #ffffff;
            z-index: 1000;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }
        .menubar-nav {
            display: flex;
            justify-content: space-around;
        }
        .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            color: #888; /* Inactive রঙ */
            flex: 1;
        }
        .nav-link i {
            font-size: 22px;
            margin-bottom: 4px;
        }
        .nav-link.active {
            color: var(--accent-color); /* Active রঙ */
        }
        .nav-link.active i {
            color: var(--accent-color);
        }
    </style>
    
    <div class="header-area-wrapper">
        <!-- Header -->
        <header class="header">
          <h5>Investment Plans</h5>
        </header>
        
        <!-- Tab Container -->
        <div class="tab-container">
          <div class="tab active" data-tab="daily">
            Daily Plans
          </div>
          <div class="tab" data-tab="welfare">
            Welfare Plans
          </div>
        </div>
    </div>

     <?php
        use \App\Models\Package;
        $packageOne = Package::where('Status', '!=','inactive')->where('tab','vip')->get();
        $packagetwo = Package::where('Status', '!=','inactive')->where('tab', 'fixed')->get();
     ?>  
        
    <div class="container">
      <!-- Daily Plans -->
      <div id="daily" class="tab-content active">
        <div class="products-grid">
           @if(isset($packageOne) && $packageOne->count() > 0)
                @foreach($packageOne as $key=>$element)
                    <?php
                        $myVip = auth()->check() ? \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element->id)->where('status', 'active')->first() : null;
                    ?>  
              <div class="product-card">
                <span class="product-badge">{{ $element->validity }} Days</span>
                <div class="product-image-container">
                  <img src="{{asset($element->photo)}}" class="product-image" alt="{{ $element->name }}">
                </div>
                <div class="product-content">
                  <p class="product-description">{{ $element->name }}</p>
    
                  <div class="product-stats">
                    <div class="stat-item">
                      <div class="stat-value">{{price($element->daily_limit)}}</div>
                      <div class="stat-label">Daily Income</div>
                    </div>
                    <div class="stat-item">
                      <div class="stat-value">{{ $element->daily_limit * $element->validity }}</div>
                      <div class="stat-label">Total Income</div>
                    </div>
                  </div>
    
                  <div class="product-footer">
                    <div class="product-price"><strong>Price:</strong> {{price($element->price)}}</div>
                   
                    @if($myVip)
                    <button class="invest-btn">Current</button>
                    @else
                     @if($element->status == 'coming')
                      <button class="invest-btn" disabled>Coming</button>
                     @else
                      <button class="invest-btn" onclick="window.location.href = '/purchase/confirmation/{{ $element->id }}'">Invest Now</button>
                      @endif
                     @endif
                  </div>
                </div>
              </div>
              @endforeach
          @else
              <p>No daily plans available.</p>
          @endif
        </div>
      </div>

      <!-- Welfare Plans -->
      <div id="welfare" class="tab-content">
        <div class="products-grid">
          @if(isset($packagetwo) && $packagetwo->count() > 0)
                @foreach($packagetwo as $key=>$element1)
                    <?php
                        $myVip = auth()->check() ? \App\Models\Purchase::where('user_id', auth()->id())->where('package_id', $element1->id)->where('status', 'active')->first() : null;
                    ?>  
              <div class="product-card">
                <span class="product-badge">{{ $element1->validity }} Days</span>
                <div class="product-image-container">
                  <img src="{{asset($element1->photo)}}" class="product-image" alt="{{ $element1->name }}">
                </div>
                <div class="product-content">
                  <p class="product-description">{{ $element1->name }}</p>
    
                  <div class="product-stats">
                    <div class="stat-item">
                      <div class="stat-value">{{price($element1->daily_limit)}}</div>
                      <div class="stat-label">Daily Income</div>
                    </div>
                    <div class="stat-item">
                      <div class="stat-value">{{ $element1->daily_limit * $element1->validity }}</div>
                      <div class="stat-label">Total Income</div>
                    </div>
                  </div>
    
                  <div class="product-footer">
                    <div class="product-price"><strong>Price:</strong> {{price($element1->price)}}</div>
                    @if($myVip)
                    <button class="invest-btn">Current</button>
                      @else
                        @if($element1->status == 'coming')
                          <button class="invest-btn" disabled>Coming</button>
                         @else
                          <button class="invest-btn" onclick="window.location.href = '/purchase/confirmation/{{ $element1->id }}'">Invest Now</button>
                        @endif
                     @endif
                  </div>
                </div>
              </div>
              @endforeach
            @else
              <p>No welfare plans available.</p>
            @endif
        </div>
      </div>
    </div>

    <div class="menubar-area">
      <div class="menubar-nav">
        <a href="/" class="nav-link">
          <i class="fa-solid fa-house"></i>
          <label>Home</label>
        </a>
        <a href="/vip" class="nav-link active">
          <i class="fa-solid fa-store"></i>
          <label>Product</label>
        </a>
        <a href="/my-team" class="nav-link">
          <i class="fa-solid fa-user-group"></i>
          <label>Promotion</label>
        </a>
        <a href="/mine" class="nav-link">
          <i class="fas fa-user-circle"></i>
          <label>Profile</label>
        </a>
      </div>
    </div>

    <script>
      document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function () {
          document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
          document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
          this.classList.add('active');
          const tabId = this.getAttribute('data-tab');
          document.getElementById(tabId).classList.add('active');
        });
      });
    </script>
  </div>
</body>
</html>