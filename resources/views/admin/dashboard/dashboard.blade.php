@extends('admin.layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>
                <p>Orders This Month</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>500</h3>
                <p>Active Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>120</h3>
                <p>VIP Customers</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>300</h3>
                <p>Non-VIP Customers</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Recent Orders</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead><tr><th>ID</th><th>Customer</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr><td>101</td><td>John Doe</td><td>Shipped</td></tr>
                        <tr><td>102</td><td>John Doe</td><td>Shipped</td></tr>
                        <tr><td>103</td><td>John Doe</td><td>Shipped</td></tr>
                        <tr><td>104</td><td>John Doe</td><td>Shipped</td></tr>
                        <tr><td>105</td><td>Jane Doe</td><td>Pending</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Recent Sign-ups</div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead><tr><th>ID</th><th>Name</th><th>Email</th></tr></thead>
                    <tbody>
                        <tr><td>501</td><td>Michael</td><td>michael@example.com</td></tr>
                        <tr><td>502</td><td>Susan</td><td>susan@example.com</td></tr>
                        <tr><td>503</td><td>Susan</td><td>susan@example.com</td></tr>
                        <tr><td>504</td><td>Susan</td><td>susan@example.com</td></tr>
                        <tr><td>505</td><td>Susan</td><td>susan@example.com</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('common_script')
@endsection
