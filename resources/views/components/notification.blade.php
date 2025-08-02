@if(session()->has('error'))
<div class="notification error" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="notification-content">
        <div class="notification-icon">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <div class="notification-message">
            {{ session('error') }}
        </div>
        <button class="notification-close" @click="show = false">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session()->has('success'))
<div class="notification success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
    <div class="notification-content">
        <div class="notification-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="notification-message">
            {{ session('success') }}
        </div>
        <button class="notification-close" @click="show = false">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
