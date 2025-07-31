<!-- Shipping Methods Section -->
<div class="shipping-methods-container">
    @foreach($shippingMethods as $addressId => $addressData)
        <div class="shipping-address-group mb-4 border rounded p-3">
          <h5 class="mb-3" style="color: #21272A;">Shipping to: {{ $addressData['address']['nickname'] ?? 'Selected Address' }}</h5>
            <div class="address-details mb-3">
                <p class="mb-1">{{ $addressData['address']['street'] }}</p>
                <p class="mb-1">{{ $addressData['address']['city'] }}, {{ $addressData['address']['state'] }} {{ $addressData['address']['zip'] }}</p>
            </div>

            <h6 class="mb-2" style="color: #21272A;">Select Shipping Method:</h6>
            <div class="shipping-methods">
              <!-- <div>
                @if(app_setting('customer_pickup_enabled'))
                    <div class="shipping-method-option mb-2">
                        <div class="form-check d-flex justify-content-between align-items-center p-0">
                            <input class="form-check-input shipping-method-radio m-auto" type="radio" name="shipping_method_{{ $addressId }}" id="shipping_{{ $addressId }}_customer_pickup" value="customer_pickup" data-price="0" data-address-id="{{ encrypt_decrypt('encrypt', $addressId) }}" data-shipping-method-id="customer_pickup" {{ $addressData['default_selected'] == 'customer_pickup' ? 'checked' : '' }}>
                            <label class="form-check-label d-flex justify-content-between align-items-center" for="shipping_{{ $addressId }}_customer_pickup" style="margin: 0 auto;">
                                <span>{{ app_setting('customer_pickup_text', 'Customer Pickup') }}</span>
                                <span class="shipping-price" style="color: rgb(27, 27, 27);">${{ number_format(0, 2) }}</span>
                            </label>
                        </div>
                    </div>
                @endif
                </div> -->
                @foreach($addressData['shipping_methods'] as $method)
                    <div class="shipping-method-option mb-2">
                        <div class="form-check d-flex justify-content-between align-items-center p-0">
                            <input 
                                class="form-check-input shipping-method-radio m-auto" 
                                type="radio" 
                                name="shipping_method_{{ $addressId }}" 
                                id="shipping_{{ $addressId }}_{{ $method['id'] }}" 
                                value="{{ $method['id'] }}"
                                data-price="{{ $method['price'] }}"
                                data-address-id="{{ encrypt_decrypt('encrypt', $addressId) }}"
                                data-shipping-method-id="{{ $method['id'] }}" 
                                @if($method['id'] == $addressData['default_selected']) checked @endif
                            >
                            <label class="form-check-label d-flex justify-content-between align-items-center" for="shipping_{{ $addressId }}_{{ $method['id'] }}" style="margin: 0 auto;">
                                <span>{{ $method['name'] }}</span>
                                <span class="shipping-price" style="color: rgb(27, 27, 27);">${{ number_format($method['price'], 2) }}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    @empty($shippingMethods)
        <div class="shipping-method-option mb-2">
          <span>No Shipping Methods Available</span>
        </div>
    @endif
</div>
<div class="col-12 d-flex justify-content-center justify-content-lg-end mt-4">
    <button class="billing-btn fw-normal">
        Next
    </button>
</div>

<style>
.shipping-methods-container {
    max-width: 600px;
    margin: 0 auto;
}
.shipping-methods-container .shipping-address-group {
    background-color: #f8f9fa;
}
.shipping-methods-container .shipping-method-option {
    transition: all 0.3s ease;
}
.shipping-methods-container .shipping-method-option:hover {
    background-color: #f0f0f0;
}
.shipping-methods-container .form-check-label {
    width: 100%;
    padding: 10px;
    margin-bottom: 0;
    cursor: pointer;
}
.shipping-methods-container .shipping-price {
    font-weight: bold;
    color: #0d6efd;
}
</style>
