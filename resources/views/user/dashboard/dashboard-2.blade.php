@extends('user.layouts.admin')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Global Styles */
    :root {
        --primary-bg: #ffffff;
        --secondary-bg: #f8f9fa;
        --card-bg: #ffffff;
        --text-primary: #212529;
        --text-secondary: #6c757d;
        --accent-color: #3a86ff;
        --success-color: #28a745;
        --info-color: #17a2b8;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --purple-color: #6f42c1;
        --border-color: #e9ecef;
    }

    body {
        background-color: var(--primary-bg);
        color: var(--text-primary);
    }

    /* Card Container Styles */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    /* Card Styles */
    .stats-card {
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        min-height: 140px;
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .stats-card .card-body {
        padding: 18px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-grow: 1;
    }

    .stat-text {
        flex: 1;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-left: 12px;
        flex-shrink: 0;
        background-color: rgba(0,0,0,0.03);
        color: var(--text-primary);
    }

    .stat-title {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
    }

    .stat-footer {
        font-size: 0.8rem;
        margin-top: 8px;
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Premium Plan Styles */
    .premium-card {
        border-left: 4px solid var(--accent-color);
        background-color: rgba(58, 134, 255, 0.05);
    }

    .premium-icon {
        background-color: rgba(58, 134, 255, 0.1) !important;
        color: var(--accent-color) !important;
    }

    /* Title Styles */
    .main-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.25rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 1199.98px) {
        .stats-container {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .stats-container {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            font-size: 1.3rem;
        }

        .stat-value {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 575.98px) {
        .stats-container {
            grid-template-columns: 1fr 1fr;
        }

        .main-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="wrapper px-xl-2">
    <div class="row">
        <div class="col-12">
            <h2 class="main-title">Welcome, {{ Auth::user()->first_name }}!</h2>
        </div>
    </div>
   <div class="stats-container">
    <div class="stats-card {{ Auth::user()->plan_id ? 'premium-card' : '' }}">
        <div class="card-body">
            <div class="stat-content">
                <div class="stat-text">
                    <div class="stat-title">Current Plan</div>
                    <div class="stat-value" style="font-size:20px;">
                        @if(Auth::user()->plan)
                            {{ Str::limit(Auth::user()->plan->name, 14, '...') }}
                        @else
                            No Active Plan
                        @endif
                    </div>
                    <div class="stat-footer">
                        @if(Auth::user()->plan)
                            Active Plan
                        @else
                            <a href="{{ route('front.pricing') }}" target="_blank" class="text-primary">Get a Plan</a>
                        @endif
                    </div>
                </div>
                <div class="stat-icon {{ Auth::user()->plan_id ? 'premium-icon' : '' }}">
                    <i class="fas fa-{{ Auth::user()->plan_id ? 'crown' : 'user' }}"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-card">
        <div class="card-body">
            <div class="stat-content">
                <div class="stat-text">
                    <div class="stat-title">Wallet Balance</div>
                    <div class="stat-value">${{ number_format(Auth::user()->wallet, 2) }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
