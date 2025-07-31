{{-- <div class="row">

    <div class="col-12">
        <h2 class="my-4 main-title" style="color: #000;">Shipping &amp; Payment</h2>
    </div>
    <div class="col-lg-6 col-12 order-2 order-lg-1">
        <div class="checkout-form">
            <!-- Form -->
            <form action="" method="POST">
                @csrf
                <div class="accordion  custom-accordion rounded-3" id="billingAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingBilling">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseBilling" aria-expanded="true"
                                aria-controls="collapseBilling">
                                Billing Details
                            </button>
                        </h2>
                        <div id="collapseBilling" class="accordion-collapse collapse show"
                            aria-labelledby="headingBilling" data-bs-parent="#billingAccordion">
                            <div class="accordion-body">
                                <div class="form billing-form">

                                    <div class="row ">

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">First Name<span>*</span></label>
                                                <input type="text" name="name" placeholder="Neil"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Last Name<span>*</span></label>
                                                <input type="text" name="name" placeholder="Godwin"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Email Address<span>*</span></label>
                                                <input type="email" name="email"
                                                    placeholder="john@gamil.com" required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Company Name<span>*</span></label>
                                                <input type="text" name="text" placeholder="John Builders"
                                                    required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Phone Number<span>*</span></label>
                                                <input type="number" name="number"
                                                    placeholder="123 456 7890" required="required">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Street Address<span>*</span></label>
                                                <input type="text" name="address"
                                                    placeholder="854 Kent Circle" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">City<span>*</span></label>
                                                <input type="text" name="city" id="city"
                                                    placeholder="Bartlett">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">State <span>*</span></label>
                                                <select name="state-province" id="state-province"
                                                    style="display: none;">
                                                    <option value="divition" selected="selected">Il
                                                    </option>
                                                    <option>Los Angeles</option>
                                                    <option>Chicago</option>
                                                    <option>Houston</option>
                                                    <option>San Diego</option>
                                                    <option>Dallas</option>
                                                    <option>Charlotte</option>
                                                </select>
                                                <div class="nice-select" tabindex="0"><span
                                                        class="current">New Yourk
                                                    </span>
                                                    <ul class="list">
                                                        <li data-value="divition" class="option selected">
                                                            New Yourk
                                                        </li>
                                                        <li data-value="Los Angeles" class="option">Los
                                                            Angeles</li>
                                                        <li data-value="Chicago" class="option">Chicago</li>
                                                        <li data-value="Houston" class="option">Houston</li>
                                                        <li data-value="San Diego" class="option">San Diego
                                                        </li>
                                                        <li data-value="Dallas" class="option">Dallas</li>
                                                        <li data-value="Charlotte" class="option">Charlotte
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Zip Code<span>*</span></label>
                                                <input type="number" name="zip code" placeholder="60103"
                                                    required="required">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="billing-btn fw-normal">
                                                Next
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion custom-accordion rounded-3 mt-4" id="shippingAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingShipping">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseShipping" aria-expanded="true"
                                aria-controls="collapseShipping">
                                Shipping Method
                            </button>
                        </h2>
                        <div id="collapseShipping" class="accordion-collapse collapse "
                            aria-labelledby="headingShipping" data-bs-parent="#shippingAccordion" style="">
                            <div class="accordion-body">
                                <div class="form billing-form">

                                    <div class="row gy-2">

                                        <div class="col-12">
                                            <p class="my-2 my-lg-3">Select Fedex Package</p>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                                <div class="radio-stack">
                                                    <input type="radio" name="dot" id="dot1">
                                                    <span>Ground Commercial</span>
                                                </div>
                                                <p class="m-0 p-0 ">$45</p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                                <div class="radio-stack">
                                                    <input type="radio" name="dot" id="dot2">
                                                    <span>Express Saver</span>
                                                </div>
                                                <p class="m-0 p-0 ">$65</p>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                                <div class="radio-stack">
                                                    <input type="radio" name="dot" id="dot3">
                                                    <span>Overnight</span>
                                                </div>
                                                <p class="m-0 p-0 ">$85</p>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end mt-4">
                                            <button class="billing-btn fw-normal">
                                                Next
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion custom-accordion rounded-3 mt-4" id="contactAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingContact">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseContact" aria-expanded="true"
                                aria-controls="collapseContact">
                                Primary Contact
                            </button>
                        </h2>
                        <div id="collapseContact" class="accordion-collapse collapse "
                            aria-labelledby="headingContact" data-bs-parent="#contactAccordion" style="">
                            <div class="accordion-body">
                                <div class="form billing-form pt-0">

                                    <div class="row gy-2">
                                        <div class="col-12">
                                            <div class="form-check my-4">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="check1">
                                                <label class="form-check-label" for="check1">
                                                    Check this box if someone other than you will be the
                                                    primary
                                                    contact for this order
                                                </label>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact " class="mb-2">Select
                                                        Contact</label>
                                                    <select name="contact" id="contact"
                                                        style="display: none;">
                                                        <option value="divition" selected="selected">Choose
                                                            Primary Contact
                                                        </option>
                                                        <option>Los Angeles</option>
                                                        <option>Chicago</option>
                                                        <option>Houston</option>
                                                        <option>San Diego</option>
                                                        <option>Dallas</option>
                                                        <option>Charlotte</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="billing-btn fw-normal">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="accordion custom-accordion rounded-3 mt-4" id="additionalInfoAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingAdditionalInfo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseAdditionalInfo" aria-expanded="true"
                                aria-controls="collapseAdditionalInfo">
                                Additional Information
                            </button>
                        </h2>
                        <div id="collapseAdditionalInfo" class="accordion-collapse collapse "
                            aria-labelledby="headingAdditionalInfo"
                            data-bs-parent="#additionalInfoAccordion" style="">
                            <div class="accordion-body">
                                <div class="form billing-form pt-0">

                                    <div class="row gy-2">
                                        <div class="col-12">
                                            <div class="my-4">
                                                <label class="my-2 order-label">Order Notes
                                                    (Optional)</label>
                                                <textarea placeholder="write your notes here" rows="6"
                                                    name="" id=""></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="billing-btn fw-normal">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form payment-details mt-4">
                    <div class="discount-form mb-4 d-flex">
                        <input type="number" placeholder="Discount Code">
                        <button>Apply</button>
                    </div>

                    <span class="form-title">Order Details</span>
                    <div class="col-12">
                        <div class="radio-stack d-flex justify-content-between mb-3">
                            <span>Sub Total</span>
                            <p class="m-0 p-0 fw-bold">$ 1,124.76</p>
                        </div>
                        <div class="radio-stack d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <p class="m-0 p-0 fw-bold">$ 75.00</p>
                        </div>
                        <div class="radio-stack d-flex justify-content-between mb-3">
                            <span>Delivery &amp; Shipping</span>
                            <p class="m-0 p-0 fw-bold">$ 110.50</p>
                        </div>
                        <div class="radio-stack d-flex justify-content-between total-container mt-3">
                            <span class="fw-bold fs-4">Total</span>
                            <p class="m-0 p-0 fw-bolder fs-4">$ 1,310.26</p>
                        </div>
                    </div>

                    <div class="row gy-2">

                        <div class="col-12">
                            <h2 class="fs-4 mt-3">
                                Payment Info
                            </h2>
                            <p class="my-3">Choose your payment method.</p>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                <div class="radio-stack">
                                    <input type="radio" name="dot" id="dot1">
                                    <span>Purchase Order</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                <div class="radio-stack">
                                    <input type="radio" name="dot" id="dot2">
                                    <span>Paypal</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="radio-stack">
                                <input type="radio" name="dot" id="dot3">
                                <span>Credit / Debit Card</span>
                            </div>

                        </div>

                        <div class="col-12 my-3">

                            <div class="d-flex  gap-3">
                                <button type="button" class="pay-btn w-50"><img src="{{ asset("frontend/images/apple-pay.png")}}"
                                        alt=""></button>
                                <button type="button" class="pay-btn w-50" id="my-google-pay-button"><img src="{{ asset("frontend/images/google-pay.png")}}"
                                        alt=""></button>

                            </div>

                        </div>

                        <div class="col-12">
                            <div
                                class="d-flex flex-wrap align-items-center justify-content-center justify-content-sm-between gap-3">
                                <img src="{{ asset("frontend/images/visa.png")}}" class="d-inline" alt="">
                                <img src="{{ asset("frontend/images/master-card.png")}}" class="d-inline" alt="">
                                <img src="{{ asset("frontend/images/am-express.png")}}" class="d-inline" alt="">
                                <img src="{{ asset("frontend/images/discover.png")}}" class="d-inline" alt="">
                                <img src="{{ asset("frontend/images/maestro.png")}}" class="d-inline" alt="">

                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label for="" class="mb-2">Name on Card</label>
                                <input type="text" name="name" placeholder="Type name on card..."
                                    required="required">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group mb-0">
                                <label class="mb-2">Card Number</label>
                                <div class="position-relative">
                                    <input type="number" name="name" placeholder="Card Number"
                                        required="required" class=" ps-5">
                                    <img src="{{ asset("frontend/images/card-icon.svg")}}" alt="card icon"
                                        class="position-absolute top-50 start-0 translate-middle-y ms-3"
                                        style="width: 20px; height: 20px;">
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label class="mb-2">Expiry Date</label>
                                <input type="text" name="date" placeholder="MM / YY" required="required">
                            </div>
                        </div>


                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label class="mb-2">CVV</label>
                                <input type="number" name="cvv" placeholder="CVV" required="required">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" value="" id="check1">
                                <label class="form-check-label  " style="color: #000;" for="check1">
                                    By placing order,I agree to <span
                                        class="text-decoration-underline">terms &amp;
                                        conditions</span> and <span
                                        class="text-decoration-underline">privacy
                                        policy</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-12 d-flex ">
                            <button class="submit-btn fw-normal">
                                Complete Order
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!--/ End Form -->
        </div>
    </div>
    <div class="col-lg-6 col-12 mb-4 mb-lg-0 order-1 order-lg-2">
        <div class="accordion custom-accordion rounded-3" id="cartAccordions">
            <div class="accordion-item">
                <h2 class="accordion-header mb-0" id="headingcart">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCart"
                        aria-expanded="true" aria-controls="collapseCart">
                        <div class="cart-details d-flex justify-content-between align-items-start align-items-md-center">
                            <h2>Cart</h2>
                        </div>
                    </button>
                </h2>
                <div id="collapseCart" class="accordion-collapse collapse show d-lg-block" aria-labelledby="headingcart"
                    data-bs-parent="#cartAccordions">
                    <div class="accordion-body">
                        @php
                            $defaultAddress = $shippingAddresses
                                ? $shippingAddresses->firstWhere('is_default', 1)
                                : null;
                        @endphp

                        <div class="form billing-form">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-1 gap-lg-2 ship-select mb-3 mbl-lg-4">
                                    <label for="options" class="shiplabel">Ship to:</label>
                            
                                    <div class="nice-select form-select shipping-select-top shipping_address-update1"
                                         id="selected_shipping_address1"
                                         name="selected_shipping_address"
                                         tabindex="0"
                                         style="width: 200px;">
                                         
                                        <span class="current">
                                            {{ $defaultAddress ? $defaultAddress->nickname . ' (Default)' : 'Select Address' }}
                                        </span>
                            
                                        <ul class="list" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">
                                            <li data-value="" class="option {{ !$defaultAddress ? 'selected focus' : '' }}">
                                                Select Address
                                            </li>
                            
                                            @foreach ($shippingAddresses as $address)
                                                <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                                    class="option {{ $address->is_default == 1 ? 'selected focus' : '' }}">
                                                    {{ $address->nickname }}{{ $address->is_default == 1 ? ' (Default)' : '' }}
                                                </li>
                                            @endforeach
                            
                                            <li data-value="add_new"
                                                class="option text-primary font-weight-bold">
                                                ➕ Add More
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="order-details order-details-container">
                                @foreach(getAllProductFromCart() as $key => $cart)
                                    <div class="cart-product-container delete-row">
                                        <div class="my-2 row gx-1 gx-md-2 order-details mb-2 mb-md-5">
                                            <div class="col-2 col-lg-3 text-center px-1">
                                                <img src="{{ asset($cart->product->featured_image?->getUrl() ?? 'frontend/images/cart-img.png') }}"
                                                    alt="" class="w-100 object-fit-cover">
                                            </div>
                                            <div class="col-8 col-lg-6 d-flex flex-column justify-content-md-center product-detail px-2 px-md-3 px-lg-1 px-xl-4 position-relative">
                                                <h2 class="truncate-2">
                                                    <a href="{{ route('front.product-detail', $cart->product['slug']) }}" target="_blank" style="font-weight: 600">
                                                        {{ $cart->product['name'] }}
                                                    </a>
                                                </h2>
                                                <p class="py-xl-1 d-none d-xl-flex">Selected Address: 
                                                    <span class="fw-bold">{{ $cart->selected_address ?? 'Home' }}</span>
                                                </p>
                                                <div class="radio-stack d-flex justify-content-start mt-1 shipping-div">
                                                    <input type="radio"
                                                        name="dot_{{ $loop->index }}"
                                                        class="shipping-checkbox mr-2 check-active"
                                                        data-cartid="{{ $cart->id }}"
                                                        data-checked="{{ $cart->shipping_address_id ? 'true' : 'false' }}"
                                                        {{ $cart->shipping_address_id ? 'checked' : '' }}>
                                                    <span>Ship to a different address</span>
                                                </div>
        
                                                <div class="cart-row justify-content-start align-items-center gap-1 my-2 shippingAddressDiv"
                                                    id="cart_row_{{ $cart->id }}"
                                                    data-id="{{ $cart->id }}"
                                                    style="display: {{ $cart->shipping_address_id ? 'flex' : 'none' }};">
                                                    <label for="product-select" class="addres-label d-none d-xl-flex">Select Address:</label>
                                                    <div class="nice-select col-4 address-select shipping_address-update" style="width: 200px;">
                                                        <span class="current">
                                                            {{
                                                                $shippingAddresses->where('id', $cart->shipping_address_id)->first()->nickname
                                                                    ?? $shippingAddresses->where('id', getDefaultShipping())->first()->nickname
                                                                    ?? 'Select Address'
                                                            }}
                                                        </span>
                                                        <ul class="list">
                                                            <li data-value="" class="option {{ $cart->shipping_address_id ? '' : 'selected focus' }}">Select Address</li>
                                                            @foreach ($shippingAddresses as $address)
                                                                <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                                                    class="option {{ $address->id == ($cart->shipping_address_id ?? getDefaultShipping()) ? 'selected focus' : '' }}">
                                                                    {{ $address->nickname }}
                                                                </li>
                                                            @endforeach
                                                            <li data-value="add_new" class="option text-primary font-weight-bold">➕ Add More</li>
                                                        </ul>
                                                    </div>
                                                </div>
        
                                                <a href="{{ route('front.cart-delete', encrypt_decrypt('encrypt', $cart->id)) }}"
                                                    class="d-flex justify-content-start align-items-center gap-2 position-absolute bottom-0 not-absolute-lg cart-item-delete">
                                                    <img src="{{ asset('frontend/images/delete.svg') }}" class="delete-img" alt="">
                                                    <span class="remove-btn">Remove</span>
                                                </a>
                                            </div>
        
                                            <div class="col-2 col-lg-3 px-1 d-flex flex-column justify-content-md-center">
                                                <span class="fw-bold quantity d-none d-xl-block">Quantity</span>
                                                <div class="counter d-flex flex-column flex-md-row justify-content-center align-items-center my-1 my-md-2 mx-auto">
                                                    <div class="button minus">
                                                        <button type="button" class="" {{ $cart->quantity <= 1 ? 'disabled' : '' }}
                                                            data-type="minus" data-field="quant[{{ $loop->index }}]">
                                                            <i class="ti-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="quant[{{ $loop->index }}]"
                                                        class="input-number cart-qty-input" data-min="1" data-max="100"
                                                        value="{{ $cart->quantity }}" data-cart-id="{{ $cart->id }}">
                                                    <div class="button plus">
                                                        <button type="button" class="" data-type="plus" data-field="quant[{{ $loop->index }}]">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
        
                                                @if ($cart->amount != $cart->real_amount)
                                                    <div class="total d-flex flex-wrap justify-content-between">
                                                        <span class="d-none d-xl-flex">Original</span>
                                                        <del class="fw-bold text-danger">${{ number_format($cart->real_amount, 2) }}</del>
                                                    </div>
                                                    <div class="total d-flex flex-wrap justify-content-between">
                                                        <span class="d-none d-xl-flex">Discounted</span>
                                                        <p class="fw-bold">${{ number_format($cart->amount, 2) }}</p>
                                                    </div>
                                                @else
                                                    <div class="total d-flex flex-wrap justify-content-between">
                                                        <span class="d-none d-xl-flex">Original</span>
                                                        <p class="fw-bold">${{ number_format($cart->real_amount, 2) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
        
                                <div class="col-12 d-flex justify-content-end">
                                    <form action="{{ route('front.cart')}}">
                                    <button type="submit" class="cart-btn fw-normal">View Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}