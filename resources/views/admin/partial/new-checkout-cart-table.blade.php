@foreach(getAllProductFromCart() as $key => $cart)
    <div class="cart-product-container delete-row" data-stock="{{ $cart->product?->quantity }}"> 
        <div class="mb-3 mb-md-0 row gx-1 gx-md-2 order-details py-2 py-md-4 py-xl-5">
            <div class="col-2 col-lg-3 text-center px-1">
                <img src="{{ asset($cart->product->featured_image?->getUrl() ?? 'frontend/images/cart-img.png') }}" alt="" class="w-100 object-fit-cover">
            </div>

            <div class="col-8 col-lg-6 d-flex flex-column justify-content-md-center product-detail px-2 px-md-3 px-lg-1 px-xl-4 position-relative">
                <h2 class="truncate">
                    <a href="{{ route('front.product-detail', $cart->product['slug']) }}" target="_blank" style="font-weight: 600" data-toggle="tooltip" data-placement="top" title="{{ ($cart->product['name']) }}">
                        {{ $cart->product['name'] }}
                    </a>
                </h2>
               @if (checkCustomerLogged() && $cart->shipping_available == true && !session('hide_shipping_different_address')) 
                    <?php
                        // Get current address name with fallback to street_address_1 if nickname is empty
                        $defaultAddress = $shippingAddresses->where('id', getDefaultShipping())->first();
                        $currentAddressName = $cart->shippingAddress ? 
                            ($cart->shippingAddress->nickname ?: $cart->shippingAddress->street_address_1) : 
                            ($defaultAddress ? ($defaultAddress->nickname ?: $defaultAddress->street_address_1) : '');
                    ?>
                    @if(!is_null($currentAddressName))
                    <p class="py-xl-1 d-none d-xl-flex">
                        Selected Address: 
                        <span class="fw-bold" data-toggle="tooltip" data-placement="top" title="{{ ($currentAddressName) }}">
                            {{ \Str::limit($currentAddressName, 10) ?? '' }}
                        </span>
                    </p>
                    @endif

                    <div class="radio-stack d-flex justify-content-start mt-1 shipping-div">
                        <input type="radio"
                            name="dot_{{ $loop->index }}"
                            class="shipping-checkbox mr-2 check-active"
                            data-cartid="{{ $cart->id }}"
                            data-checked="{{ $cart->is_different_shipping_address ? 'true' : 'false' }}"
                            {{ $cart->is_different_shipping_address ? 'checked' : '' }}>
                        <span>Ship to a different address</span>
                    </div>

                    <div class="cart-row justify-content-start align-items-center gap-1 my-2 shippingAddressDiv"
                        id="cart_row_{{ $cart->id }}"
                        data-id="{{ $cart->id }}"
                        style="display: {{ $cart->is_different_shipping_address == false ? 'none' : 'flex' }};">
                        {{-- <label for="product-select" class="addres-label d-none d-xl-flex">Select Address:</label> --}}
                        <div class="nice-select col-4 address-select shipping_address-update">
                            <span class="current">
                                {{ $currentAddressName ?: 'Select Address'}}
                            </span>
                            <ul class="list">
                                <li data-value="" class="option {{ $cart->shipping_address_id ? '' : 'selected focus' }}">Select Address</li>
                                @foreach ($shippingAddresses as $address)
                                    <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                        class="option {{ $address->id == ($cart->shipping_address_id ?? getDefaultShipping()) ? 'selected focus' : '' }}">
                                        {{ $address->nickname ?: $address->street_address_1 }}
                                    </li>
                                @endforeach
                                <li data-value="add_new" class="option text-primary font-weight-bold">➕ Add More</li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if($cart->shipping_available == false)
                <p class="text-danger small">No shipping available.</p>
                @endif
                <a href="{{ route('front.cart-delete', encrypt_decrypt('encrypt', $cart->id)) }}"
                    class="d-flex justify-content-start align-items-center gap-2 bottom-0 not-absolute-lg cart-item-delete">
                    <img src="{{ asset('frontend/images/delete.svg') }}" class="delete-img" alt="">
                    <span class="remove-btn">Remove</span>
                </a>
            </div>

            <div class="col-2 col-lg-3 px-1 d-flex flex-column justify-content-md-center">
                <span class="fw-bold quantity d-none d-xl-block">Quantity</span>
                <div class="counter d-flex flex-column flex-md-row justify-content-center align-items-center my-1 my-md-2 mx-auto">
                    <div class="button plus">
                        <button type="button" data-type="plus" data-field="quant[{{ $loop->index }}]">
                            <i class="ti-plus"></i>
                        </button>
                    </div>
                    <input type="text" name="quant[{{ $loop->index }}]"
                        class="input-number cart-qty-input"
                        data-min="1" data-max="100"
                        value="{{ $cart->quantity }}"
                        data-cart-id="{{ encrypt_decrypt('encrypt', $cart->id) }}">
                    <div class="button minus">
                        <button type="button"
                            data-type="minus"
                            data-field="quant[{{ $loop->index }}]">
                            <i class="ti-minus"></i>
                        </button>
                    </div>
                </div>

            @if ($cart->amount != $cart->real_amount)
            <div class="total d-flex justify-content-between flex-wrap">                        
                <span class="d-none d-xl-flex">Original</span>
                <del class="fw-bold text-danger">${{ number_format($cart->real_amount, 2) }}</del>
            </div>
            <div class="total d-flex justify-content-between flex-wrap">
                <span class="d-none d-xl-flex">Discounted</span>
                <p class="fw-bold">${{ number_format($cart->amount, 2) }}</p>
            </div>
            @else
                <div class="total d-flex justify-content-between flex-wrap">
                    <span class="d-none d-xl-flex">Original</span>
                    <p class="fw-bold">${{ number_format($cart->real_amount, 2) }}</p>
                </div>
            @endif
            @if ($cart->shipping_method_charges > 0 && 1==2)
                <div class="total d-flex justify-content-between flex-wrap">                        
                    <span class="d-none d-xl-flex">Shipping</span>
                    <p class="fw-bold">${{ number_format($cart->shipping_method_charges, 2) }}</p>
                </div>
            @endif
            </div>
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
<div class="col-12 d-lg-flex justify-content-end d-none">
    <form action="{{ route('front.cart') }}">
        <button class="cart-btn fw-normal" type="submit">View Cart</button>
    </form>
</div>