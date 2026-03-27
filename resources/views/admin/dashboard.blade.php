@extends('admin.partials.master')
@section('admin_content')

<style>
    .dashboard-header { margin-bottom: 30px; }
    .dashboard-title { font-family: 'Rubik', sans-serif; font-weight: 700; color: #475f7b; font-size: 24px; }
    
    .dashboard-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 25px 0 rgba(0,0,0,0.05);
        border: none;
        transition: all 0.3s ease;
        margin-bottom: 24px;
        height: calc(100% - 24px);
        position: relative;
        overflow: hidden;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .card-body-custom { padding: 25px; }
    
    .d-flex-between { display: flex; justify-content: space-between; align-items: center; }
    
    .card-icon {
        width: 50px; height: 50px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
    }
    
    .bg-light-primary { background: rgba(90, 141, 238, 0.15); color: #5A8DEE; }
    .bg-light-success { background: rgba(57, 218, 138, 0.15); color: #39DA8A; }
    .bg-light-danger { background: rgba(255, 91, 92, 0.15); color: #FF5B5C; }
    .bg-light-warning { background: rgba(253, 172, 65, 0.15); color: #FDAC41; }
    .bg-light-info { background: rgba(0, 207, 221, 0.15); color: #00CFDD; }
    .bg-light-secondary { background: rgba(71, 95, 123, 0.15); color: #475F7B; }

    .stat-value { font-size: 26px; font-weight: 700; color: #475f7b; margin-top: 15px; margin-bottom: 5px; }
    .stat-label { font-size: 13px; color: #828D99; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    
    .welcome-card {
        background: linear-gradient(135deg, #5A8DEE 0%, #3e6ec7 100%);
        color: white;
    }
    .welcome-text h3 { color: white; font-weight: 700; }
    .welcome-text p { color: rgba(255,255,255,0.8); }
</style>

<div class="dashboard-header">
    <h2 class="dashboard-title">Overview Dashboard</h2>
</div>

<section id="dashboard-ecommerce">
    
    <!-- Welcome Section -->
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="card dashboard-card welcome-card">
                <div class="card-body card-body-custom d-flex align-items-center justify-content-between">
                    <div class="welcome-text">
                        <h3 class="mb-1">Welcome back, {{admin()->user()->name ?? 'Admin'}}!</h3>
                        <p class="mb-0">Here's what's happening with your store today.</p>
                        <div class="mt-4">
                            <h2 class="mb-0" style="color:white; font-weight:700;">{{\App\Models\User::count()}}</h2> <!-- Using Total Users here as a highlight -->
                            <span style="font-size:12px; opacity:0.8;">Total Registered Users</span>
                        </div>
                    </div>
                    <div class="welcome-img d-none d-md-block">
                         <img src="{{asset(admin_file_root())}}/app-assets/images/icon/cup.png" height="140" alt="Dashboard"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-12">
             <div class="card dashboard-card">
                 <div class="card-body card-body-custom">
                     <div class="d-flex-between mb-3">
                        <h5 class="mb-0" style="color:#475f7b;">Active Bonus</h5>
                         <div class="card-icon bg-light-warning">
                            <i class="bx bx-gift"></i>
                        </div>
                     </div>
                      <?php $b = \App\Models\Bonus::where('status', 'active')->first(); ?>
                     <h4 class="text-primary mb-1">{{$b ? $b->bonus_name : 'No Active Bonus'}}</h4>
                     <p class="text-muted font-small-3 mb-0">Current running promotion</p>
                 </div>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="row">
        <!-- Total Purchases -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-primary">
                            <i class="bx bx-cart"></i>
                        </div>
                        <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                    <div class="stat-value">{{\App\Models\Purchase::count()}}</div>
                    <div class="stat-label">Total Purchases</div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-md-6 col-12">
             <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-secondary">
                            <i class="bx bx-user"></i>
                        </div>
                         <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                    <div class="stat-value">{{\App\Models\User::count()}}</div>
                     <div class="stat-label">Total Users</div>
                </div>
            </div>
        </div>

        <!-- Pending Withdraw -->
        <div class="col-xl-3 col-md-6 col-12">
             <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-warning">
                            <i class="bx bx-time-five"></i>
                        </div>
                         <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                     <div class="stat-value">{{\App\Models\Withdrawal::where('status', 'pending')->count()}}</div>
                    <div class="stat-label">Pending Withdrawals</div>
                </div>
            </div>
        </div>

        <!-- Approved Withdraw -->
        <div class="col-xl-3 col-md-6 col-12">
             <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-success">
                            <i class="bx bx-check-circle"></i>
                        </div>
                         <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                     <div class="stat-value">{{\App\Models\Withdrawal::where('status', 'approved')->count()}}</div>
                    <div class="stat-label">Approved Withdrawals</div>
                </div>
            </div>
        </div>

         <!-- Pending Deposit -->
        <div class="col-xl-3 col-md-6 col-12">
             <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-info">
                            <i class="bx bx-down-arrow-circle"></i>
                        </div>
                         <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                     <div class="stat-value">{{\App\Models\Deposit::where('status', 'pending')->count()}}</div>
                    <div class="stat-label">Pending Deposits</div>
                </div>
            </div>
        </div>

        <!-- Approved Deposit -->
        <div class="col-xl-3 col-md-6 col-12">
             <div class="card dashboard-card">
                <div class="card-body card-body-custom">
                    <div class="d-flex-between">
                        <div class="card-icon bg-light-success">
                             <i class="bx bx-money"></i>
                        </div>
                         <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer text-muted"></i>
                    </div>
                     <div class="stat-value">{{\App\Models\Deposit::where('status', 'approved')->count()}}</div>
                    <div class="stat-label">Approved Deposits</div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
