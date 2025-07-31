<div class="container">
    @if (checkCustomerLogged())
        <div class="row address mt-3 mt-lg-5 mb-2 mb-lg-4">
            <div class="col-12 col-lg-8 col-xl-7">
                <div class="d-flex flex-column flex-sm-row justify-content-between">
                    @php
                        $defaultAddress = $shippingAddresses
                            ? $shippingAddresses->firstWhere('is_default', 1)
                            : null;
                    @endphp

                    <p>
                        Selected Address
                        <span class="fw-bold">:
                            {{ $defaultAddress ? ($defaultAddress->nickname ?: $defaultAddress->street_address_1) : 'No Default Address Set' }}
                        </span>
                    </p>

                    <div class="divider d-none d-sm-flex"></div>
                 
                    <div class="d-flex flex-row gap-2 ship-select align-items-center">
                        <label for="options" class="shiplabel">Select a different address</label>

                        <div class="nice-select form-select shipping-select-top shipping_address-update1"
                            id="selected_shipping_address1" name="selected_shipping_address" tabindex="0"
                            style="width: 130px !important;">
                            <span class="current">
                                {{ $defaultAddress ? ($defaultAddress->nickname ?: $defaultAddress->street_address_1). ' (Default)' : 'Select Address' }}
                            </span>
                            <ul class="list" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                                <li data-value="" class="option {{ !$defaultAddress ? 'selected focus' : '' }}">
                                    Select Address
                                </li>

                                @foreach ($shippingAddresses as $address)
                                    <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                        class="option {{ $address->is_default == 1 ? 'selected focus' : '' }}">
                                        {{ $address->nickname ?: $address->street_address_1 }}
                                    </li>
                                @endforeach

                                <li data-value="add_new" value="add_new" class="option text-primary font-weight-bold">
                                    ➕ Add More
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-lg-7 px-0">
            @foreach(getAllProductFromCart() as $key => $cart)
                <div class="delete-row my-2 row gx-1 gx-md-3 order-details  mb-2 mb-lg-4" data-stock="{{ $cart->product?->quantity }}">
                    <div class="col-2 col-lg-3 text-center px-1">
                        <img src="{{ asset( $cart->product->featured_image?->getUrl() ?? 'frontend/images/cart-img.png') }}" alt="" class="w-100 object-fit-cover">
                    </div>
                    <div class="col-8 col-lg-5 d-flex flex-column justify-content-md-center product-detail px-2 px-md-3 px-lg-2 px-xl-4 position-relative">
                        <h2 class="truncate-2"><a
                            href="{{ route('front.product-detail', $cart->product['slug']) }}" data-toggle="tooltip" data-placement="top" title="{{ ($cart->product['name']) }}"
                            target="_blank" style="font-weight: 600">{{ $cart->product['name'] }}</a></h2>

                        @if($cart->options)
                            @if($cart->options()->exists())
                                <p class="card-selected-items view-cart-detail" data-url="{{ route('front.cart-details', $cart->id) }}">View Selected Options</p>
                            @endif
                        @endif
        
                        @if (checkCustomerLogged() && $cart->shipping_available == true && !session('hide_shipping_different_address'))
                        @php
                            $selectedAddress = null;
                        
                            $selectedAddress = \App\Models\ShippingAddress::find(getDefaultShipping());
                            if ($cart->shipping_address_id) {
                                $selectedAddress = \App\Models\ShippingAddress::find($cart->shipping_address_id);
                            }
                        @endphp
                        @if($selectedAddress)
                            <p class="py-xl-1 d-none d-lg-block">Selected Address:
                                <span class="fw-bold" data-toggle="tooltip" data-placement="top" title="{{ ($selectedAddress->nickname ?: $selectedAddress->street_address_1) }}">
                                    {{ $selectedAddress->nickname ?: $selectedAddress->street_address_1 }}
                                </span>
                            </p>
                        @endif
                    
                        <div class="radio-stack d-flex justify-content-start shipping-div">
                            <input type="radio"
                            name="dot_{{ $loop->index }}"
                            class="shipping-checkbox mr-2 check-active"
                            data-cartid="{{ $cart->id }}"
                            data-checked="{{ $cart->is_different_shipping_address ? 'true' : 'false' }}"
                            {{ $cart->is_different_shipping_address ? 'checked' : '' }}>

                            <span>Ship to a different address</span>
                        </div>
                        
        
                        <div class="justify-content-start align-items-center gap-1 my-xl-2 shippingAddressDiv cart-row"
                        id="cart_row_{{ $cart->id }}"
                        data-id="{{ $cart->id }}"
                        style="display: {{ $cart->is_different_shipping_address == false ? 'none' : 'flex' }}">
                        
                       <label for="shipping_address_{{ $cart->id }}" class="addres-label">Select Address:</label>
                   
                       <div class="nice-select col-4 address-select shipping_address-update"
                            id="shipping_address_{{ $cart->id }}"
                            tabindex="0"
                            style="width: 150px !important;">
                   
                           <span class="current">
                               {{ (($selectedAddress->nickname ?? null) ?: ($selectedAddress->street_address_1 ?? 'Select Address')) ?? 'Select Address' }}
                           </span>
                   
                           <ul class="list" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                               <li data-value="" class="option {{ $cart->shipping_address_id ? '' : 'selected focus' }}">
                                   Select Address
                               </li>
                   
                               @if ($shippingAddresses->isEmpty())
                                   <li data-value="" class="option">No Shipping Address Available</li>
                               @else
                                   @foreach ($shippingAddresses as $address)
                                       <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                           class="option {{ $address->id == ($cart->shipping_address_id ?? getDefaultShipping()) ? 'selected focus' : '' }}">
                                           {{ $address->nickname ?: $address->street_address_1 }}
                                       </li>
                                   @endforeach
                   
                                   <li data-value="add_new" class="option text-primary font-weight-bold">
                                       ➕ Add More
                                   </li>
                               @endif
                           </ul>
                       </div>
                   </div>
                   @endif
                   @if($cart->shipping_available == false)
                   <p class="text-danger small">No shipping available.</p>
                   @endif                   
                        <a href="{{ route('front.cart-delete', encrypt_decrypt('encrypt', $cart->id)) }}" class="d-flex justify-content-start align-items-center gap-2 cart-item-delete">
                            <img src="{{ asset('frontend/images/delete.svg') }}" class="delete-img" alt="">
                            <span class="remove-btn">Remove</span>
                        </a>
                    </div>
                    <div class="col-2 col-lg-3 px-1 d-flex flex-column justify-content-md-center">
                        <span class="fw-bold quantity d-none d-lg-block">Quantity</span>
                        <div class="counter d-flex flex-column flex-md-row justify-content-center align-items-center my-1 my-md-2 mx-auto">
                            <div class="button plus">
                                <button type="button" class="" data-type="plus" data-field="quant[{{ $loop->index }}]">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                            <input type="text"
                            name="quant[{{ $loop->index }}]"
                            class="input-number cart-qty-input"
                            data-min="1"
                            data-max="100"
                            value="{{ $cart->quantity }}"
                            data-cart-id="{{ encrypt_decrypt('encrypt', $cart->id) }}">
                            <div class="button minus">
                                <button type="button" class="" data-type="minus" data-field="quant[{{ $loop->index }}]">
                                    <i class="ti-minus"></i>
                                </button>
                            </div>
                        </div>
                        @if ($cart->amount != $cart->real_amount)
                        <div class="total d-flex flex-wrap justify-content-between">                        
                            <span class="d-none d-lg-flex">Original</span>
                            <del class="fw-bold text-danger">${{ number_format($cart->real_amount, 2) }}</del>
                        </div>
                        <div class="total d-flex flex-wrap justify-content-between">
                            <span class="d-none d-lg-flex">Discounted</span>
                            <p class="fw-bold">${{ number_format($cart->amount, 2) }}</p>
                        </div>
                        @else
                        <div class="total d-flex flex-wrap justify-content-between">
                            <span class="d-none d-lg-flex">Original</span>
                            <p class="fw-bold">${{ number_format($cart->real_amount, 2) }}</p>
                        </div>
                        @endif
                        @if ($cart->shipping_method_charges > 0 && 1==2)
                        <div class="total d-flex flex-wrap justify-content-between">                        
                            <span class="d-none d-lg-flex">Shipping</span>
                            <p class="fw-bold">${{ number_format($cart->shipping_method_charges, 2) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @if ($cart->get_free_quantity > 0)
                    <div class="delete-row my-2 row gx-1 gx-md-3 order-details bg-light mb-2 mb-lg-4">
                        <div class="col-2 col-lg-3 text-center px-1">
                            <img src="{{ asset($cart->product->featured_image?->getUrl() ?? 'frontend/images/cart-img.png') }}" alt="" class="w-100 object-fit-cover">
                        </div>
                        <div class="col-8 col-lg-5 d-flex flex-column justify-content-md-center product-detail px-2 px-md-3 px-lg-2 px-xl-4 position-relative">
                            <h2 class="truncate-2">
                                <a href="{{ route('front.product-detail', $cart->product['slug']) }}" target="_blank" style="font-weight: 600">
                                    {{ $cart->product['name'] }} (Free)
                                </a>
                            </h2>
                            <p class="py-xl-1 d-none d-lg-block">Free Item with Purchase</p>
                        </div>
                        <div class="col-2 col-lg-3 px-1 d-flex flex-column justify-content-md-center">
                            <span class="fw-bold quantity d-none d-lg-block">Quantity</span>
                            <div class="counter d-flex flex-column flex-md-row justify-content-center align-items-center my-1 my-md-2 mx-auto">
                                <input type="text" class="input-number bg-white text-success fw-bold text-center" readonly value="{{ $cart->get_free_quantity }}">
                            </div>
                            <div class="total d-flex flex-wrap justify-content-between">
                                <span class="d-none d-lg-flex">Price</span>
                                <p class="fw-bold text-success">Free</p>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        </div>
        
        <div class="col-12 col-lg-5  mt-3 mt-lg-0 ">
            <div class="order-summary">
                <span class="form-title">Order Summary</span>
                {{-- <div class="discount-form my-2 my-lg-4 d-flex gap-2">
                    <input type="number" placeholder="Discount Code">
                    <button>Apply</button>
                </div> --}}
                @php
                    $appliedCoupon = session('applied_coupon');
                    $isCouponApplied = $appliedCoupon && $appliedCoupon['user_id'] == Auth::id();
                @endphp

                {{-- <div class="discount-form my-2 my-lg-4 d-flex gap-2"> --}}
                    @if (!$isCouponApplied)
                    <form class="coupon-form  discount-form my-2 my-lg-4 d-flex gap-2">
                        @csrf
                        <input type="text" name="code" placeholder="Discount Code">
                        <button type="submit">Apply</button>
                    </form>
                    @else
                        <div class="alert alert-success w-100 d-flex align-items-center justify-content-between px-3 py-2 m-0 my-4" style="border-radius: 20px">
                            <div>
                                Coupon applied: <strong>{{ $appliedCoupon['code'] }}</strong>
                            </div>
                            <button onclick="removeCoupon()" class="ml-2"
                                style="background: transparent; border: none; color: red; font-size: 16px; cursor: pointer;">❌</button>
                        </div>
                    @endif
                {{-- </div> --}}
                
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center total-summary">
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

                            $totalShipping = $cartItems->sum('shipping_method_charges');
                            $finalPrice += $totalShipping;
                        @endphp

                        <span>
                            Sub Total
                        </span>
                        <p class="sub-total">${{ number_format($totalOriginalPrice, 2) }}</p>
                    </div>
                    @if ($totalSaved > 0)
                        <div class="d-flex justify-content-between align-items-center total-summary">

                            <span>
                                You Save:
                            </span>
                            <p class="sub-total text-success">${{ number_format($totalSaved, 2) }}</p>
                            
                            
                        </div>
                    @endif

                    @if (!empty($stateTaxes))
                        @foreach ($stateTaxes as $stateName => $stateTax)
                            @if (!is_null($stateTax) && $stateTax > 0)
                                <div class="d-flex justify-content-between align-items-center total-summary">
                                    <span>{{ $stateName ?? '' }} Tax</span>
                                    <p class="tax">${{ number_format($stateTax, 2) }}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    @if ($totalShipping > 0)
                        <div class="d-flex justify-content-between align-items-center total-summary">
                            <span>Shipping</span>
                            <p class="sub-total">${{ number_format($totalShipping, 2) }}</p>
                        </div>
                    @endif
                </div>
                <div class="radio-stack d-flex justify-content-between total-container mt-3">
                    <span class="fw-bold fs-4">Total</span>
                    <p class="m-0 p-0 fw-bolder fs-4">${{ number_format($finalPrice, 2) }}</p>
                </div>
                <div class="col-12 d-flex ">
                    <form action="{{ route('front.checkout') }}" method="GET" class="col-12 d-flex">
                        <button type="submit" class="submit-btn fw-normal">
                            Proceed To Checkout
                        </button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>