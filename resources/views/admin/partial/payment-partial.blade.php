@php
    $appliedCoupon = session('applied_coupon');
    $isCouponApplied = $appliedCoupon && $appliedCoupon['user_id'] == Auth::id();
@endphp
@if (!$isCouponApplied)
<form class="coupon-form discount-form my-2 my-lg-4 d-flex gap-2">
    @csrf
    <div class="discount-form mb-3 d-flex">
        <input type="text" name="code"  id="coupon_code_input" placeholder="Discount Code">
        <button type="button" class="apply-coupon-btn">Apply</button>
    </div>
</form>
@else
    <div class="alert alert-success w-100 d-flex align-items-center justify-content-between px-3 py-2 m-0 mb-4" style="border-radius: 10px; height:50px;">
        <div>
            Coupon applied: <strong>{{ $appliedCoupon['code'] }}</strong>
        </div>
        <button onclick="removeCoupon()" class="ml-2" type="button"
            style="background: transparent; border: none; color: red; font-size: 16px; cursor: pointer;">❌</button>
    </div>
@endif
@php
    $userId = Auth::id();
    $sessionId = session()->get('session_id');

    $cartItems = \App\Models\Cart::where(function ($query) use ($userId, $sessionId) {
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }
    })->whereNull('order_id')->get();

    $totalOriginalPrice = $cartItems->sum('real_amount');
    $totalDiscountedPrice = $cartItems->sum('amount');
    $totalSaved = max($totalOriginalPrice - $totalDiscountedPrice, 0);

    $couponDiscount = 0;
    if (session()->has('applied_coupon')) {
        $couponData = session('applied_coupon');
        $couponDiscount = isset($couponData['discount_amount_type_2'])
            ? (float) str_replace(',', '', $couponData['discount_amount_type_2'])
            : 0;
    }

    $totalSaved += $couponDiscount;

    $couponDiscountType2 = session()->get('applied_coupon.discount_amount_type_2', null);
    $finalPrice = isset($couponDiscountType2)
        ? max($totalDiscountedPrice - (float) str_replace(',', '', $couponDiscountType2), 0)
        : $totalDiscountedPrice;

        $stateTaxes = groupTaxesByState($cartItems);
        $finalTaxTotal = array_sum($stateTaxes);
        $finalPrice += $finalTaxTotal;
        $finalPrice += $cartItems->sum('shipping_method_charges');
@endphp
<span class="form-title mb-0 ">Order Details</span>
<div class="col-12 mt-2 mt-lg-3">
    <div class="radio-stack d-flex justify-content-between mb-1 ">
        <span>Sub Total</span>
        <p class="m-0 p-0  order-price">${{ number_format($totalOriginalPrice, 2) }}</p>
    </div>
    @if ($totalSaved > 0)
       <div class="radio-stack d-flex justify-content-between mb-1 ">
            <span>
                You Save:
            </span>
            <p class="m-0 p-0  order-price text-success">${{ number_format($totalSaved, 2) }}</p>
        </div>
    @endif
    @foreach ($stateTaxes as $state => $taxAmount)
        @if (!is_null($taxAmount) && $taxAmount > 0)
            <div class="radio-stack d-flex justify-content-between mb-1">
                <span>{{ $state ?? '' }} Tax</span>
                <p class="m-0 p-0 order-price">${{ number_format($taxAmount, 2) }}</p>
            </div>
        @endif
    @endforeach
    @if($cartItems->sum('shipping_method_charges') > 0)
    <div class="radio-stack d-flex justify-content-between mb-1">
        <span>Shipping</span>
        <p class="m-0 p-0 order-price">${{ number_format($cartItems->sum('shipping_method_charges'), 2) }}</p>
    </div>
    @endif
    <div class="radio-stack d-flex justify-content-between total-container mt-3">
        <span class="fw-bold fs-5">Total</span>
        <p class="m-0 p-0 fw-bold fs-5">${{ number_format($finalPrice, 2) }}</p>
    </div>
</div>