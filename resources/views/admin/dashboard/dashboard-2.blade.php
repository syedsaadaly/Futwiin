@extends('admin.layouts.admin')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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

    /* Table Card Styles */
    .table-card {
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        height: 100%;
        display: flex;
        flex-direction: column;
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
    }

    .table-card .card-header {
        border-radius: 10px 10px 0 0 !important;
        padding: 14px 18px;
        border-bottom: 1px solid var(--border-color);
        background-color: var(--secondary-bg);
        color: var(--text-primary);
    }

    .table-card .card-body {
        padding: 0;
        flex-grow: 1;
    }

    .table-card .table {
        margin-bottom: 0;
    }

    .table-card .card-footer {
        border-radius: 0 0 10px 10px;
        padding: 10px 18px;
        background-color: var(--secondary-bg);
        border-top: 1px solid var(--border-color);
    }

    /* Table Styles */
    .table-responsive {
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }

    .table {
        width: 100%;
        color: var(--text-primary);
        background-color: var(--card-bg);
    }

    .table th {
        font-weight: 600;
        padding: 12px 14px;
        background-color: var(--secondary-bg);
        border-bottom: 1px solid var(--border-color) !important;
        color: var(--text-primary);
    }

    .table td {
        padding: 10px 14px;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color) !important;
        color: var(--text-primary);
    }

    .table tr:last-child td {
        border-bottom: none !important;
    }

    .table tr:hover {
        background-color: rgba(0,0,0,0.02);
    }

    /* Button Styles */
    .btn {
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s;
        font-size: 0.85rem;
    }

    .btn-sm {
        padding: 5px 10px;
    }

    .btn-primary {
        background-color: black;
        border-color: black;
    }

    .btn-success {
        background-color: black;
        border-color: black;
    }

    .btn-info {
        background-color: black;
        border-color: black;
    }

    .btn-warning {
        background-color: black;
        border-color: black;
        color: white
    }

    .btn-danger {
        background-color: black;
        border-color: black;
    }

    .btn-custom {
        background-color: black;
        border-color: black;
        color: white
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
            {{-- <h2 class="main-title">Admin Dashboard</h2> --}}
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <!-- Users Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value">{{ $stats['users'] ?? '-' }}</div>
                        <div class="stat-footer">{{ $stats['active_users'] ?? '-' }} active</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plans Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Subscription Plans</div>
                        <div class="stat-value">{{ $stats['plans'] ?? '-' }}</div>
                        <div class="stat-footer">{{ $stats['active_plans'] ?? '-' }} active</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Predictions Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Predictions</div>
                        <div class="stat-value">{{ $stats['predictions'] ?? '-' }}</div>
                        {{-- <div class="stat-footer">{{ $stats['upcoming_predictions'] ?? '-' }} upcoming</div> --}}
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leagues Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Leagues</div>
                        <div class="stat-value">{{ $stats['leagues'] ?? '-' }}</div>
                        {{-- <div class="stat-footer">{{ $stats['active_leagues'] ?? '-' }} active</div> --}}
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teams Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Teams</div>
                        <div class="stat-value">{{ $stats['teams'] ?? '-' }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscriptions Card -->
        <div class="stats-card">
            <div class="card-body">
                <div class="stat-content">
                    <div class="stat-text">
                        <div class="stat-title">Active Subs</div>
                        <div class="stat-value">{{ $stats['active_user_plans'] ?? '-' }}</div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Tables -->
    <div class="row">
        <!-- Recent Users -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users mr-2"></i>Recent Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Wallet</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->first_name ?? '-' }} {{ $user->last_name ?? '-' }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td>${{ number_format($user->wallet, 2) ?? '-' }}</td>
                                    <td>{{ $user->created_at->format('m/d/Y') ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Recent Plans -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-credit-card mr-2"></i>Recent Plans</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPlans as $plan)
                                <tr>
                                    <td>{{ $plan->name ?? '-' }}</td>
                                    <td>${{ number_format($plan->price, 2) ?? '-' }}</td>
                                    <td>{{ $plan->points ?? '-' }}</td>
                                    <td>{{ $plan->created_at->format('m/d/Y') ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.plans.index') }}" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Predictions -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>Recent Predictions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Match</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentPredictions as $prediction)
                                <tr>
                                    <td>{{ $prediction->team1->name ?? '-' }} vs {{ $prediction->team2->name ?? '-' }}</td>
                                    <td>
                                        {{ $prediction->match_date->format('m/d/Y') ?? '-' }}<br>
                                        {{ $prediction->match_time ?? '-' }}
                                    </td>
                                    <td>{{ $prediction->is_teaser ? 'Teaser' : 'Regular' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.predictions.index') }}" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Recent Leagues -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-trophy mr-2"></i>Recent Leagues</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLeagues as $league)
                                <tr>
                                    <td>{{ Str::limit($league->title, 30) ?? '-' }}</td>
                                <td>
                                    @if($league->type == 1)
                                        International
                                    @elseif($league->type == 2)
                                        Domestic
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($league->league_date)
                                        {{ \Carbon\Carbon::parse($league->league_date)->format('m/d/Y') ?? '-' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.leagues.index') }}" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Teams -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tshirt mr-2"></i>Recent Teams</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTeams as $team)
                                <tr>
                                    <td>{{ $team->name ?? '-' }}</td>
                                    <td>{{ $team->created_at->format('m/d/Y') ?? '-'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>

        <!-- Recent Subscriptions -->
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-star mr-2"></i>Recent Subscriptions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Plan</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUserPlans as $subscription)
                                <tr>
                                    <td>{{ $subscription->user->first_name ?? '-' }}</td>
                                    <td>{{ $subscription->plan->name ?? '-' }}</td>
                                    <td>${{ number_format($subscription->price, 2) ?? '-' }}</td>
                                    <td>{{ $subscription->created_at->format('m/d/Y') ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-sm btn-warning">View All <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('common_script')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush
@endsection
