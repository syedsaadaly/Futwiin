<style>
    .discount-message {
        width: 350px;
    }
</style>
<div class="container cart-container">
    <div class="row">
        <div class="col-12">
            @if (checkCustomerLogged())
                <div class="row mb-3">
                    <div class="col-6 d-flex">
                        <strong class="mr-2" style="font-size: 10px;">Default Shipping Address:</strong>
                        <span class="font-weight-bold default-shipping-address-text" style="font-size: 10px;">
                            @php
                                $defaultAddress = $shippingAddresses
                                    ? $shippingAddresses->firstWhere('is_default', 1)
                                    : null;
                            @endphp
                            {{ $defaultAddress ? $defaultAddress->nickname : 'No Default Address Set' }}

                        </span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <strong class="mr-2" style="font-size: 10px;">Select Shipping Address:</strong>
                        <select class="form-control shipping-select-top shipping_address-update1"
                            id="selected_shipping_address1" name="selected_shipping_address" style="width: 200px;">
                            <option value="">Select Address</option>

                            @foreach ($shippingAddresses as $address)
                                <option value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                    {{ $address->is_default == 1 ? 'selected' : '' }}>
                                    {{ $address->nickname }}
                                </option>
                            @endforeach

                            <option value="add_new" class="text-primary font-weight-bold">
                                ➕ Add More
                            </option>
                        </select>
                    </div>
                </div>
            @endif
            <form action="{{ route('front.cart-update') }}" method="POST">
                @csrf
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>PRODUCT</th>
                            <th>NAME</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody id="cart_item_list">
                        @if (getAllProductFromCart())
                        {{-- @dd(getAllProductFromCart()) --}}
                            @foreach (getAllProductFromCart() as $key => $cart)
                                <tr class="custome-height delete-row cart-row" id="cart_{{ $loop->iteration }}"
                                    data-id="{{ encrypt_decrypt('encrypt', $cart->id) }}">
                                    <td class="image" data-title="No"><img
                                            src="{{ $cart->product->featured_image?->getUrl() }}"
                                            alt="{{ $cart->product->featured_image?->getUrl() }}">
                                    </td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a
                                                href="{{ route('front.product-detail', $cart->product['slug']) }}"
                                                target="_blank">{{ $cart->product['name'] }}</a></p>
                                        @if (isset($cart->options) && count($cart->options) > 0)
                                            <p class="product-options">
                                                @foreach ($cart->options as $cartItem)
                                                    <strong>{!! $cartItem->input_label !!}:</strong>
                                                    @if ($cartItem->input_type === 'file' && $cartItem->input_value)
                                                        @php
                                                            $decoded = json_decode($cartItem->input_value, true);
                                                            $fileUrls = is_array($decoded) ? $decoded : explode(',', $cartItem->input_value);
                                                        @endphp

                                                        @foreach ($fileUrls as $index => $fileUrl)
                                                            <a href="{{ trim($fileUrl) }}" target="_blank" class="text-info">View File {{ $index + 1 }}</a>
                                                            @if (!$loop->last) | @endif
                                                        @endforeach
                                                    @else
                                                        {{ $cartItem->selected_label }}
                                                    @endif
                                                    <br>
                                                @endforeach
                                            </p>
                                        @endif

                                        <p class="product-des">{!! $cart['summary'] !!}</p>
                                        @if (checkCustomerLogged())
                                            <div class="d-flex align-items-center shipping-div">
                                                <input type="checkbox" id="showShipping_{{ $cart->id }}"
                                                    class="shipping-checkbox mr-2 check-active"
                                                    {{ $cart->shipping_address_id == null ? '' : 'checked' }}>

                                                <label for="showShipping_{{ $cart->id }}"
                                                    class="shipping-label mb-0">Ship to a different address</label>
                                            </div>


                                            <div class="shippingAddressDiv"
                                                style="display: {{ $cart->shipping_address_id == null ? 'none' : 'block' }}">
                                                <select
                                                    class="form-control shipping-select shipping_address-update default-shipping-address"
                                                    id="shipping_address_{{ $cart->id }}" name="shipping_address"
                                                    style="width: 162px;">
                                                    <option value="">Select Address</option>

                                                    @if ($shippingAddresses->isEmpty())
                                                        <option value="">No Shipping Address Available
                                                        </option>
                                                    @else
                                                        @foreach ($shippingAddresses as $address)
                                                            <option
                                                                value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                                                {{ $address->id == ($cart->shipping_address_id != null && $cart->shipping_address_id != '' ? $cart->shipping_address_id : getDefaultShipping()) ? 'selected' : '' }}>
                                                                {{ $address->nickname }}
                                                            </option>
                                                        @endforeach
                                                        <option value="add_new" class="text-primary font-weight-bold">
                                                            ➕ Add More
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        @else
                                        @endif
                                    </td>
                                    <td class="price" data-title="Price">
                                        @php
                                            $originalUnitPrice = $cart['real_price'];
                                            $discountedUnitPrice =
                                                collect(
                                                    session('applied_coupon')['discounted_products'] ?? [],
                                                )->firstWhere('id', encrypt_decrypt('encrypt', $cart->id))[
                                                    'new_unit_price'
                                                ] ?? $originalUnitPrice;
                                        @endphp
                                        {{-- @if ($cart['real_price'] == $cart['price'])
                                        @if ($originalUnitPrice != $discountedUnitPrice)
                                            <span><del>${{ number_format($originalUnitPrice) }}</del></span>
                                            <span
                                                class="text-success font-weight-bold ml-2">${{ number_format($discountedUnitPrice) }}</span>
                                        @endif
                                       @endif --}}
                                        @if ($cart['real_price'] != $cart['price'])
                                            <span><del>${{ number_format($cart['real_price'],2) }}</del></span>
                                            <span
                                                class="text-success font-weight-bold ml-2">${{ number_format($cart['price'],2) }}</span>
                                        @else
                                            <span>${{ number_format($originalUnitPrice,2) }}</span>
                                        @endif
                                    </td>
                                    <td class="qty" data-title="Qty"><!-- Input Order -->
                                        <div class="input-group">
                                            <div class="button minus">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    data-type="minus" data-field="quantity[{{ $key }}]">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="quantity[{{ $key }}]"
                                                class="input-number" data-min="1" data-max="100"
                                                value="{{ $cart->quantity }}">
                                            <input type="hidden" name="qty_id[]" value="{{ $cart->id }}">
                                            <div class="button plus">
                                                <button type="button" class="btn btn-primary btn-number"
                                                    data-type="plus" data-field="quantity[{{ $key }}]">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ End Input Order -->
                                    </td>
                                    <td class="total-amount cart_single_price" data-title="Total"><span
                                            class="money">${{ number_format($cart['amount'],2) }}</span></td>

                                    <td class="action" data-title="Remove">
                                        <a class="cart-item-delete" href="{{ route('front.cart-delete', encrypt_decrypt('encrypt', $cart->id)) }}"><i
                                                class="ti-trash remove-icon"></i></a></td>
                                </tr>
                                @if ($cart->get_free_quantity > 0)
                                    <tr class="custome-height free-item-row bg-light">
                                        <td class="image" data-title="No">
                                            <img src="{{ $cart->product->featured_image?->getUrl() }}"
                                                alt="{{ $cart->product->featured_image?->getUrl() }}">
                                        </td>
                                        <td class="product-des" data-title="Description">
                                            <p class="product-name">
                                                <strong>{{ $cart->product['name'] }} (Free)</strong>
                                            </p>
                                        </td>
                                        <td class="price text-success font-weight-bold" data-title="Price">Free</td>
                                        {{-- <td class="qty" data-title="Qty">
                                            <span class="text-success font-weight-bold">{{ $cart->get_free_quantity }}</span>
                                        </td> --}}
                                        <td class="qty" data-title="Qty"><!-- Input Order -->
                                            <div class="input-group">

                                                <input type="text" class="input-number" readonly
                                                    value="{{ $cart->get_free_quantity }}">
                                                <input type="hidden" value="{{ $cart->id }}">

                                            </div>
                                            <!--/ End Input Order -->
                                        </td>
                                        <td class="total-amount" data-title="Total">-</td>
                                        <td class="action delete-free-item" data-title="Remove"
                                            data-cart-id="{{ $cart->id }}">
                                            <a><i class="ti-trash remove-icon"></i></a>
                                        </td>
                                    </tr>
                                    </tr>
                                @endif
                            @endforeach
                            <track>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="float-right">
                                <button class="btn float-right" type="submit">Update</button>
                            </td>
                            </track>
                        @else
                            <tr>
                                <td class="text-center">
                                    There are no any carts available. <a href="{{ route('front.shop') }}"
                                        style="color:blue;">Continue shopping</a>

                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </form>
            <!--/ End Shopping Summery -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Total Amount -->
            <div class="total-amount">
                <div class="row">
                    <div class="col-lg-8 col-md-5 col-12">
                        <div class="left">
                            @php
                                $appliedCoupon = session('applied_coupon');
                                $isCouponApplied = $appliedCoupon && $appliedCoupon['user_id'] == Auth::id();
                            @endphp

                            <div class="coupon">
                                @if (!$isCouponApplied)
                                    <form class="coupon-form">
                                        @csrf
                                        <input name="code" placeholder="Enter Your Coupon">
                                        <button type="submit" class="btn">Apply</button>
                                    </form>
                                @else
                                    <div class="alert alert-success mt-2 discount-message">
                                        ✅ Coupon applied successfully: <strong>{{ $appliedCoupon['code'] }}</strong>
                                        <button onclick="removeCoupon()" class="ml-2"
                                            style="background: transparent; border: none; color: red; font-size: 12px; cursor: pointer;">❌</button>
                                    </div>
                                @endif

                            </div>
                            {{-- <div class="checkbox">`
                                @php
                                    $shipping=DB::table('shippings')->where('status','active')->limit(1)->get();
                                @endphp
                                <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox" onchange="showMe('shipping');"> Shipping</label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-7 col-12">
                        <div class="right">
                            <ul>
                                <li class="order_subtotal" data-price="{{ totalCartPrice() }}">
                                    Cart
                                    Subtotal<span>${{ number_format(totalCartPrice(), 2) }}</span>
                                </li>
                                {{-- <div id="shipping" style="display:none;">
                                    <li class="shipping">
                                        Shipping {{session('shipping_price')}}
                                        @if (count(\App\Helpers\shipping()) > 0 && \App\Helpers\cartCount() > 0)
                                            <div class="form-select">
                                                <select name="shipping" class="nice-select">
                                                    <option value="">Select</option>
                                                    @foreach (\App\Helpers\shipping() as $shipping)
                                                    <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: ${{$shipping->price}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="form-select">
                                                <span>Free</span>
                                            </div>
                                        @endif
                                    </li>
                                </div>
                                 --}}
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
                                @endphp
                                {{-- @dd($totalDiscountedPrice) --}}

                                @if ($totalSaved > 0)
                                    <li class="coupon_price" data-price="{{ number_format($totalSaved, 2) }}">
                                        You Save: <span><strong>${{ number_format($totalSaved, 2) }}</strong></span>
                                    </li>
                                @endif
                                {{-- @php
                                    $total_amount = totalCartPrice();
                                    if (session()->has('coupon')) {
                                        $total_amount = $total_amount - Session::get('coupon')['value'];
                                    }
                                @endphp
                                @if (session()->has('coupon'))
                                    <li class="last" id="order_total_price">You
                                        Pay<span>${{ number_format($total_amount, 2) }}</span></li>
                                @else
                                    <li class="last" id="order_total_price">You
                                        Pay<span>${{ number_format($total_amount, 2) }}</span></li>
                                @endif --}}
                                <li class="last" id="order_total_price">
                                    You Pay
                                    @php
                                        $couponDiscountType2 = session()->get(
                                            'applied_coupon.discount_amount_type_2',
                                            null,
                                        );
                                        $finalPrice = isset($couponDiscountType2)
                                            ? max(
                                                $totalDiscountedPrice -
                                                    (float) str_replace(',', '', $couponDiscountType2),
                                                0,
                                            )
                                            : $totalDiscountedPrice;
                                    @endphp

                                    <span>
                                        ${{ number_format($finalPrice, 2) }}
                                    </span>

                                </li>
                            </ul>
                            <div class="button5">
                                <a href="{{ route('front.checkout') }}" class="btn">Checkout</a>
                                <a href="{{ route('front.shop') }}" class="btn">Continue shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Total Amount -->
        </div>
    </div>
</div>
