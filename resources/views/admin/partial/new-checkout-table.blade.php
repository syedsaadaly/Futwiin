<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
.tooltip .tooltip-arrow {
    display: none !important;
}

@media screen and (max-width: 991px) {
	.select2-container--default .select2-selection--single {
    height: 46px !important;
}




.select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 8px !important;
   
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 8px !important;
}

}




.select2-container{
    width: 100% !important;
}


.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 10px;
    right: 1px;
    width: 20px;
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 10px;
    display: block;
    padding-left: 8px;
    padding-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 0.5px solid rgb(219, 221, 227);
}
.select2-container--default .select2-search--dropdown .select2-search__field:focus{
	outline:none;
	box-shadow: none !important;
}
.select2-container--default .select2-selection--single:focus-visible{
	outline:none !important;
}

.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background-color: #000000;
    color: white;
}

.cstm-dashboard .profile .form-group input:focus{
	outline:none !important
}


.select2-container--default .select2-selection--single .select2-selection__clear {

    margin-top: 8px;
}

.select2-dropdown{
	border: 0.5px solid rgb(219, 221, 227) !important;
}

	.select-billing-state{
		height: 48px;
	}
	.select-billing-state 	.current{
		line-height: 50px;
	}




.select2-container--default .select2-selection--single {
    height: 52px;
    line-height: 50px;
    padding: 0px 8px;
    border-radius: 5px;
    background: transparent;
    border: 1px solid rgb(219, 221, 227);
}

.state-dropdown .select2-container--default .select2-selection--single {
    height: 46px;
}

.state-dropdown .select2-container .select2-selection--single .select2-selection__rendered {
    padding-top: 8px;
}

</style>
<div class="row">
    <div class="col-12">
        <h2 class="mb-4 main-title">Shipping &amp; Payment</h2>
    </div>
    <div class="col-lg-6 col-12 order-2 order-lg-1">
        <div class="checkout-form">
            @php
                $user = Auth::user();
                $customer = $user?->customer;
                $contacts = $customer ? $customer->jobContacts : collect();
                $shippingAddress = session()->get('shipping_address');
            @endphp
            <!-- Form -->
            <form class="form" method="POST" action="{{ route('front.cart.order') }}" id="payment-form" autocomplete="nope3231321">
                @csrf
                <div class="accordion  custom-accordion rounded-3" id="billingAccordion">
                    @if(!auth()->check())
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingBilling">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseBilling" aria-expanded="true"
                                aria-controls="collapseBilling">
                                Shipping Details
                            </button>
                        </h2>
                        <div  id="collapseBilling" class="accordion-collapse collapse show"
                        aria-labelledby="headingBilling" data-bs-parent="#billingAccordion">
                            <div class="accordion-body">
                                <div class="form billing-form address-fedex shipping-guest">
                                    <input type="hidden" name="verify_address" id="verify_address" value="no">
                                    <input type="hidden" name="address_used" value="0">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">First Name<span>*</span></label>
                                                <input type="text" name="shipping_first_name" placeholder="First Name" class="checkout_shipping_name"
                                                {{ !Auth::check() ? 'required' : '' }}   value="{{ old('shipping_first_name', $user->firstname ?? $shippingAddress['customer_name'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Last Name<span>*</span></label>
                                                <input type="text" name="shipping_last_name" placeholder="Last Name" class="checkout_shipping_last_name"
                                                {{ !Auth::check() ? 'required' : '' }}  value="{{ old('shipping_last_name', $user->lastname ?? $shippingAddress['customer_last_name'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Email Address<span>*</span></label>
                                                <input type="email" autocomplete="new-email" id="shipping_email" name="shipping_email" class="checkout_shipping_email validate-email"
                                                    placeholder="Email Address" {{ !Auth::check() ? 'required' : '' }}   value="{{ old('shipping_email', $user->email ?? $shippingAddress['customer_email'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Company Name<span>*</span></label>
                                                <input type="text" name="shipping_company_name" placeholder="Company Name" class="checkout_shipping_company_name"
                                                {{ !Auth::check() ? 'required' : '' }}  value="{{ old('shipping_company_name', $customer->company_name ?? $shippingAddress['customer_company_name'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Phone Number<span>*</span></label>
                                                <input type="text" name="shipping_phone" class="phone-number checkout_shipping_phone" 
                                                    placeholder="Phone Number" {{ !Auth::check() ? 'required' : '' }}  value="{{ old('shipping_phone', $customer->phone ?? $shippingAddress['customer_phone'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Street Address<span>*</span></label>
                                                <input type="text" name="shipping_street_address" class="checkout_shipping_street fe_shipping_street"
                                                    placeholder="Street Address" {{ !Auth::check() ? 'required' : '' }}   value="{{ old('shipping_street_address', $customer->billing_address ?? $shippingAddress['street_address'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">City<span>*</span></label>
                                                <input type="text" name="shipping_city" id="city" class="checkout_shipping_city fe_shipping_city" {{ !Auth::check() ? 'required' : '' }}
                                                    placeholder="City" value="{{ old('shipping_city', $customer->billing_city ?? $shippingAddress['city'] ?? '') }}">
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="shipping_state" id="stateInput" value="">
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">State <span>*</span></label>
                                              
                                                <select  class="w-100 select2 no-nice-select checkout_shipping_state fe_shipping_state" id="shippingStateSelect" name="shipping_state" required>
                                                     <option value="">Select State</option>
                                                    @foreach(getStates() as $state)
                                                        <option value="{{ $state }}" {{ old('billing_state', $customer->billing_state ?? $shippingAddress['state'] ?? '') == $state ? 'selected' : '' }}>
                                                            {{ $state }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12" >
                                            <div class="form-group">
                                                <label class="mb-2">Zip Code<span>*</span></label>
                                                <input type="text" name="shipping_zip_code" placeholder="Zip Code" class="checkout_shipping_zip fe_shipping_zipcode"
                                                {{ !Auth::check() ? 'required' : '' }}   value="{{ old('shipping_zip_code', $customer->billing_zip_code ?? $shippingAddress['zip'] ?? '') }}" oninput="validateZip(this)">
                                                <small id="zip_error" style="color: red; display: none;">Only numbers are allowed.</small>
                                            </div>
                                        </div>
                                        <div class="col-12 fedex_address_response">
                                        </div>
                                    </div>
                                    <div class="form-check my-3 mx-0">
                                        <input class="form-check-input" type="checkbox" value="1" id="toggleBilling" name="billing_details_toggle">
                                        <label class="form-check-label" for="toggleBilling">
                                            Select a different billing address
                                        </label>
                                    </div>
                                </div>
                                <div id="billingSection" class="form billing-form address-fedex billing-guest" style="display: none;border-top: 0px !important;padding-top: 0px !important;">
                                    <h2 class="mb-0 custom-accprdion-button" id="">
                                        Billing Details
                                    </h2>
                                    <input type="hidden" name="verify_address" id="verify_address_billing" value="no">
                                    <input type="hidden" name="address_used" value="0">
                                    <div class="form billing-form">
                                        <div class="row ">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">First Name<span>*</span></label>
                                                    <input type="text" name="first_name" placeholder="First Name" class="billing-required" 
                                                    {{ Auth::check() ? 'required' : '' }}  value="{{ old('first_name', $user->firstname ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">Last Name<span>*</span></label>
                                                    <input type="text" name="last_name" placeholder="Last Name" class="billing-required" 
                                                    {{ Auth::check() ? 'required' : '' }} value="{{ old('last_name', $user->lastname ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">Email Address<span>*</span></label>
                                                    <input type="email" name="email" class="billing-required validate-email" 
                                                        placeholder="Email Address" {{ Auth::check() ? 'required' : '' }}  value="{{ old('email', $user->email ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">Company Name<span>*</span></label>
                                                    <input type="text" name="company_name" placeholder="Company Name" class="billing-required" 
                                                    {{ Auth::check() ? 'required' : '' }} value="{{ old('company_name', $customer->company_name ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">Phone Number<span>*</span></label>
                                                    <input type="text" name="phone" class="billing-required phone-number" 
                                                        placeholder="Phone Number" {{ Auth::check() ? 'required' : '' }} value="{{ old('phone', $customer->phone ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">Street Address<span>*</span></label>
                                                    <input type="text" name="address1" class="billing-required fe_shipping_street" 
                                                        placeholder="Street Address" {{ Auth::check() ? 'required' : '' }}  value="{{ old('address1', $customer->billing_address ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="mb-2">City<span>*</span></label>
                                                    <input type="text" name="city" id="city" class="billing-required fe_shipping_city" {{ Auth::check() ? 'required' : '' }}
                                                        placeholder="City" value="{{ old('city', $customer->billing_city ?? '') }}">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 ">
                                                <div class="form-group ">
                                                    <label class="mb-2">State <span>*</span></label>
                                                
                                                    <select  class="w-100 select2 no-nice-select billing-required fe_shipping_state" name="state"  id="billingState" {{ Auth::check() ? 'required' : '' }} >
                                                        <option value="">Select State</option>
                                                        @foreach(getStates() as $state)
                                                            <option value="{{ $state }}" {{ old('billing_state', $customer->billing_state ?? '') == $state ? 'selected' : '' }}>
                                                                {{ $state }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 ">
                                                <div class="form-group">
                                                    <label class="mb-2">Zip Code<span>*</span></label>
                                                    <input type="text" name="zipcode" placeholder="Zip Code" class="billing-required zipcode-input fe_shipping_zipcode" 
                                                    {{ Auth::check() ? 'required' : '' }}  value="{{ old('zipcode', $customer->billing_zip_code ?? '') }}" oninput="validateZip(this)">
                                                    <small id="zip_error" style="color: red; display: none;">Only numbers are allowed.</small>
                                                </div>
                                            </div>
                                            <div class="col-12 fedex_address_response">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form billing-form" style="border-top: 0px !important;">
                                    <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                                        <button type="button" class="billing-btn fw-normal address-fedex-next-button">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                    @else
                    <input type="hidden" name="address_used" value="0">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0 " id="headingBilling">
                            <button class="accordion-button " type="button" @auth data-bs-toggle="collapse"
                                data-bs-target="#collapseBilling" aria-expanded="true"
                                aria-controls="collapseBilling" @endauth>
                                Billing Details
                            </button>
                        </h2>
                        <div id="collapseBilling" class="accordion-collapse collapse show"
                            aria-labelledby="headingBilling" data-bs-parent="#billingAccordion">
                            <div class="accordion-body">
                                <div class="form billing-form address-fedex billing-address-form">
                                    <input type="hidden" name="verify_address" id="verify_address" value="no">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">First Name<span>*</span></label>
                                                <input type="text" name="first_name" placeholder="First Name" class="billing-required" 
                                                {{ Auth::check() ? 'required' : '' }}  value="{{ old('first_name', $user->firstname ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Last Name<span>*</span></label>
                                                <input type="text" name="last_name" placeholder="Last Name" class="billing-required" 
                                                {{ Auth::check() ? 'required' : '' }} value="{{ old('last_name', $user->lastname ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Email Address<span>*</span></label>
                                                <input type="email" autocomplete="new-email"  name="email" class="billing-required validate-email" 
                                                    placeholder="Email Address" {{ Auth::check() ? 'required' : '' }}  value="{{ old('email', $user->email ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Company Name<span>*</span></label>
                                                <input type="text" name="company_name" placeholder="Company Name" class="billing-required" 
                                                {{ Auth::check() ? 'required' : '' }} value="{{ old('company_name', $customer?->company_name ?? $customer?->getCompanyName() ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Phone Number<span>*</span></label>
                                                <input type="text" name="phone" class="billing-required phone-number" 
                                                    placeholder="Phone Number" {{ Auth::check() ? 'required' : '' }} value="{{ old('phone', $customer->phone ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Street Address<span>*</span></label>
                                                <input type="text" name="address1" class="checkout_shipping_street billing-required" 
                                                    placeholder="Street Address" {{ Auth::check() ? 'required' : '' }}  value="{{ old('address1', $customer->billing_address ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">City<span>*</span></label>
                                                <input type="text" name="city" id="city" class="checkout_shipping_city billing-required" {{ Auth::check() ? 'required' : '' }}
                                                    placeholder="City" value="{{ old('city', $customer->billing_city ?? '') }}">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">State <span>*</span></label>
                                           
                                                <select  class="w-100 select2 no-nice-select checkout_shipping_state" id="billingState" name="state" required>
                                                     <option value="">Select State</option>
                                                    @foreach(getStates() as $state)
                                                        <option value="{{ $state }}" {{ old('billing_state', $customer->billing_state ?? '') == $state ? 'selected' : '' }}>
                                                            {{ $state }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="mb-2">Zip Code<span>*</span></label>
                                                <input type="text" name="zipcode" placeholder="Zip Code   " class="checkout_shipping_zip billing-required zipcode-input" 
                                                {{ Auth::check() ? 'required' : '' }}  value="{{ old('zipcode', $customer->billing_zip_code ?? '') }}" oninput="validateZip(this)">
                                                <small id="zip_error" style="color: red; display: none;">Only numbers are allowed.</small>
                                            </div>
                                        </div>
                                        <div class="col-12 fedex_address_response">
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="is_save_billing" id="saveBilling" style="margin-top: 6px;">
                                                <label class="form-check-label" for="saveBilling">
                                                    Save this address in my profile billing address
                                                </label>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 d-flex justify-content-center justify-content-lg-end">
                                            <button type="button" class="billing-btn fw-normal">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="accordion custom-accordion rounded-3 mt-4" id="shippingAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingShipping">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseShipping" aria-expanded="true"
                                aria-controls="collapseShipping">
                                Shipping Method
                            </button>
                        </h2>
                        <div id="collapseShipping" class="accordion-collapse collapse "
                            aria-labelledby="headingShipping" data-bs-parent="#shippingAccordion" style="">
                            <div class="accordion-body">
                                <div class="form billing-form shipping-form shipping-methods-container-parent">
                                    @include('admin.partial.shipping-partial')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                @php
                  $user = auth::user();
                  $role = $user->getRoleName();
                  $vipUser = App\Models\User::VIPUSER;
                  $noVipUser = App\Models\User::NONVIPUSER;
                @endphp
                @if($role == $vipUser || $role == $noVipUser)
                <div class="accordion custom-accordion rounded-3 mt-4" id="contactAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingContact">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseContact" aria-expanded="true"
                                aria-controls="collapseContact">
                                Primary Contact
                            </button>
                        </h2>
                        <div id="collapseContact" class="accordion-collapse collapse"
                            aria-labelledby="headingContact" data-bs-parent="#contactAccordion">
                            <div class="accordion-body">
                                <div class="form billing-form pt-0">
                                    <div class="row gy-2">
                                        <div class="col-12">
                                            <div class="form-check my-4">
                                                <input class="form-check-input" type="checkbox" value="1" name="is_other_contact" id="toggleContact">
                                                <label class="form-check-label" for="toggleContact">
                                                    Check this box if someone other than you will be the primary contact for this order
                                                </label>
                                            </div>
                                        </div>
                                    
                                        <div class="col-12 contact-select d-none">
                                            <div class="form-group">
                                                <label for="contact" class="mb-2">Select Contact</label>
                                                <select name="contact" id="job-contact">
                                                    <option value="">Choose Primary Contact</option>
                                                    @foreach($contacts as $contact)
                                                        <option value="{{ $contact->id }}">
                                                            {{ $contact->first_name }} {{ $contact->last_name }} ({{ $contact->email }})
                                                        </option>
                                                    @endforeach
                                                    <option value="new_contact" id="addNewContactOption">Add New Contact</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-12 d-flex justify-content-center justify-content-lg-end">
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
                @endif
                @endauth                        
                <div class="accordion custom-accordion rounded-3 mt-4" id="additionalInfoAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header mb-0" id="headingAdditionalInfo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
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
                                                    <span class="optional">(optional)</span></label>
                                                <textarea placeholder="Write your notes here" name="notes" rows="6"
                                                    name="" id=""></textarea>
                                            </div>
                                        </div>
                                        <div
                                            class="col-12 d-flex justify-content-center justify-content-lg-end">
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
                    <input type="hidden" id="state-hidden" value="">
                    <input type="hidden" name="payment_status" id="payment_status" value="unpaid">
                    <input type="hidden" name="card_type" id="card_type">
                    <input type="hidden" name="card_last_four" id="card_last_four">
                    <input type="hidden" name="payment_type" id="payment_type"  value="">
                    <input type="hidden" name="transaction_id" id="transaction_id">
                    <input type="hidden" name="braintree_customer_id" id="braintree_customer_id">
                <div class="form payment-details mt-4">
                    <div class="row payment-system-reload">                        
                        @include('admin.partial.payment-partial')
                    </div>
                    <div class="row gy-1">
                        <div class="col-12">
                            <h2 class="fs-5 mt-3 mb-0">
                                Payment Info
                            </h2>
                            <p class="my-2 my-lg-3">Choose your payment method.</p>
                        </div>
                        @auth
                        <div class="col-12">
                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                <div class="radio-stack">
                                    <input type="radio" name="payment_method" id="purchase_order" value="purchase_order" {{ session('payment_method') == 'purchase_order' ? 'checked' : '' }}>
                                    <span>Purchase Order</span>
                                </div>
                            </div>
                        
                            {{-- <div id="referenceCodeField" class="mt-3 d-none"> --}}
                            <div class="discount-form mt-3 mb-2 d-none" id="referenceCodeField" style="max-width: 300px;">
                                <label for="reference_code" class="form-label">Reference Number:</label>
                                <input type="text" name="reference_number" id="reference_code" placeholder="Enter reference number" >
                            </div>
                        </div>
                        @endauth
                        
                        <div class="col-12">
                            <div class="d-flex justify-content-between col-12 col-lg-11">
                                <div class="radio-stack">
                                    <input type="radio" name="payment_method" id="paypal_payment_method" value="paypal" {{ session('payment_method') == 'paypal' ? 'checked' : '' }}>
                                    <span>Paypal</span>
                                </div>
                            </div>
                            <!-- PayPal specific container -->
                            <div class="payment-method-container paypal-container d-none mt-3">
                                <div id="paypal-button-atlas"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="radio-stack">
                                <input type="radio" name="payment_method" id="credit_card" value="credit_card" {{ (session('payment_method') === null || session('payment_method') == 'credit_card' || session('payment_method') == 'saved_card' || session('payment_method') == 'google_pay') ? 'checked' : '' }}>
                                <span>Credit/Debit Card</span>
                            </div>
                        </div>
                        <div class="col-12 my-3 credit-card-field credit_card-container payment-method-container">
                            <div class="d-flex flex-column flex-sm-row gap-3">
                                <button type="button" class="pay-btn" id="apple-pay-button">
                                    <img src="{{ asset('frontend/images/apple-pay.png') }}" alt="Apple Pay">
                                </button>
                                <button type="button" id="google-pay-button-container">
                                    {{-- <img src="{{ asset('frontend/images/google-pay.png') }}" alt="Google Pay"> --}}
                                </button>
                            </div>
                        </div>
                        <div class="card-selected-text" id="card-selected-text" style="margin-left: 10px; margin-bottom:7px;">

                        </div>
                        <?php
                            $paymentMethods = null;
                            if($braintreeCustomer = getCustomer()){
                                $customerId = $braintreeCustomer->braintree_customer_id ?? null;

                                if ($customerId) {
                                    $gateway = new Braintree\Gateway([
                                        'environment' => config('services.braintree.environment'),
                                        'merchantId' => config('services.braintree.merchant_id'),
                                        'publicKey' => config('services.braintree.public_key'),
                                        'privateKey' => config('services.braintree.private_key'),
                                    ]);
                                    $result = $gateway->customer()->find($customerId);
                                    $paymentMethods = $result->paymentMethods;
                                }
                            }
                        ?>

                        @if ($paymentMethods)
                        <div class="col-12 credit-card-field credit_card-container payment-method-container">
                            <label class="mb-2">Select Saved Card</label>
                            <select id="saved-card-select" class="form-control" name="saved_card_id">
                                @foreach ($paymentMethods as $card)
                                    <option value="{{ $card->token }}" {{ $card->isDefault() ? 'selected' : '' }}>
                                        {{ $card->cardholderName ? ($card->cardholderName . ' -') : '' }} {{ strtoupper($card->cardType) }} {{ $card->maskedNumber }}
                                    </option>
                                @endforeach
                                <option value="add_new">➕ Add New Card</option>
                            </select>
                        </div>
                        @endif
                        <div id="new-card-fields" class="row mt-2 mt-md-4 m-0 px-3 px-md-2 gx-md-2 g-0">
                            <div class="col-12 credit-card-field">

                                <div class="d-flex flex-wrap align-items-center justify-content-around gap-3 payment-cards">
                                    <img src="{{ asset('frontend/images/visa.png') }}" class="d-inline" alt="Visa">
                                    <img src="{{ asset('frontend/images/master-card.png') }}" class="d-inline" alt="MasterCard">
                                    <img src="{{ asset('frontend/images/am-express.png') }}" class="d-inline" alt="AmEx">
                                    <img src="{{ asset('frontend/images/discover.png') }}" class="d-inline" alt="Discover">
                                    <img src="{{ asset('frontend/images/maestro.png') }}" class="d-inline" alt="Maestro">
                                    <img src="{{ asset("frontend/images/card-dinersclub.svg") }}" class="d-inline" alt="">
                                    <img src="{{ asset("frontend/images/card-jcb.svg") }}" class="d-inline" alt="">
                                </div>
                            </div>
                        
                            <div class="col-12 mt-3 credit-card-field">
                                <div class="form-group">
                                    <label for="" class="mb-2">Name On Card</label>
                                    <input type="text" name="cardholder_name" placeholder="Type name on card...">
                                </div>
                            </div>
                        
                            <div class="col-12 credit-card-field">
                                <div class="form-group">
                                    <label class="mb-2">Card Number</label>
                                    <div class="position-relative">
                                        <div id="card-number" class="ps-5 hosted-field"></div>
                                        <img src="{{ asset('frontend/images/card-icon.svg') }}" alt="card icon"
                                            class="position-absolute top-50 start-0 translate-middle-y ms-3"
                                            style="width: 20px; height: 20px;">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-lg-6 col-md-6 col-6 credit-card-field pe-1 pe-md-0">
                                <div class="form-group">
                                    <label class="mb-2">Expiry Date</label>
                                    <div id="expiration-date" class="hosted-field"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 credit-card-field">
                                <div class="form-group">
                                    <label class="mb-2">CVV</label>
                                    <div id="cvv" class="hosted-field"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" value="" id="check1" required>
                                <label class="form-check-label" style="color: #000;" for="check1">
                                    By placing order, I agree to 
                                    <a href="{{ route('front.terms.and.conditions') }}" class="text-decoration-underline" target="_blank">
                                        terms &amp; conditions
                                    </a> and 
                                    <a href="{{ route('front.privacy.policy') }}" class="text-decoration-underline" target="_blank">
                                        privacy policy
                                    </a>
                                </label>
                            </div>
                        </div>
                        @guest
                        <div class="col-12" id="save_details_wrapper">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="save_details" id="saveDetails">
                                <label class="form-check-label" style="color: #000;" for="saveDetails">
                                    Save the detail for future reference
                                </label>
                            </div>
                        </div>                        
                        <div id="passwordFields" style="display: none; transition: all 0.3s ease;">
                            <div class="row mb-4 mb-md-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group position-relative mb-1">
                                        <label class="mb-2">Password <span>*</span></label>
                                        <input type="password" autocomplete="off_password" name="password" id="password" class="form-control pe-4" placeholder="Password">
                                        <span class="toggle-password" toggle="#password">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                    <!-- <small id="passwordError" class="text-danger mt-1" style="display: none;"></small> -->
                                </div>
                        
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group position-relative mb-0">
                                        <label class="mb-2">Confirm Password <span>*</span></label>
                                        <input type="password" autocomplete="off_password_confirmation" name="password_confirmation" id="confirmPassword" class="form-control pe-4" placeholder="Confirm Password">
                                        <span class="toggle-password" toggle="#confirmPassword">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>
                                    <small id="confirmError" class="text-danger mt-1" style="display: none;"></small>
                                </div>
                            </div>
                        </div>
                        

                        <div class="password-box">
									<ul class="password-list">
                                        <li class="eight-character">Must have at least 8 characters</li>
                                        <li class="one-number">Must have at least 1 number</li>
                                        <li class="one-letter">Must have at least 1 letter</li>
                                        <li class="one-character">Must have at least 1 special character [@,#,$,%,etc]</li>
                                    </ul>
                                    <div class="progress-bar">
                                        <div class="progress"></div>
                                    </div>
                                    </div>             
				
                                              
                        @endguest
                        <div class="col-12">
                            <button class="submit-btn fw-normal" id="complete-order-btn">
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
        <div class="accordion  custom-accordion rounded-3" id="cartAccordions">
            <div class="accordion-item">
                <h2 class="accordion-header mb-0" id="headingcart">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseCart">
                        @php
                            $defaultAddress = $shippingAddresses ? $shippingAddresses->firstWhere('is_default', 1) : null;
                        @endphp

                        <div class="cart-details d-flex justify-content-between align-items-start align-items-md-center">
                            <h2>Cart</h2>
                            @if (checkCustomerLogged())
                                <div class="d-lg-flex d-none align-items-center justify-content-end gap-1 gap-lg-2 ship-select">
                                    <label for="options" class="shiplabel">Ship to:</label>
                                    <div class="ship-to nice-select form-select shipping_address-update1"
                                        id="selected_shipping_address1"
                                        name="selected_shipping_address"
                                        tabindex="0" style="z-index: 99;pointer-events: all; width: 150px !important;">

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

                                            <li data-value="add_new" class="option text-primary font-weight-bold">
                                                ➕ Add More
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @else
                            @endif
                        </div>
                    </button>
                </h2>
                <div id="collapseCart" class="accordion-collapse collapse d-lg-block"
                    aria-labelledby="headingBilling" data-bs-parent="#billingAccordion">
                    <div class="accordion-body">
                        @php
                            $defaultAddress = $shippingAddresses ? $shippingAddresses->firstWhere('is_default', 1) : null;
                        @endphp
                    
                        <div class="form billing-form">
                            <div class="col-12">
                                <div class="d-flex justify-content-between d-lg-none align-items-center gap-1 gap-lg-2 ship-select mb-xl-5 mb-3">
                                    <label for="options" class="shiplabel">Ship to:</label>
                                    <div class="ship-to nice-select form-select" tabindex="0">
                                        <span class="current">
                                            {{ $defaultAddress ? $defaultAddress->nickname . ' (Default)' : 'Select Address' }}
                                        </span>
                                        <ul class="list">
                                            <li data-value="" class="option {{ !$defaultAddress ? 'selected focus' : '' }}">Select Address</li>
                                            @foreach ($shippingAddresses as $address)
                                                <li data-value="{{ encrypt_decrypt('encrypt', $address->id) }}"
                                                    class="option {{ $address->is_default == 1 ? 'selected focus' : '' }}">
                                                    {{ $address->nickname }}{{ $address->is_default == 1 ? ' (Default)' : '' }}
                                                </li>
                                            @endforeach
                                            <li data-value="add_new" class="option text-primary font-weight-bold">➕ Add More</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="order-details order-details-container">
                                @include('admin.partial.new-checkout-cart-table')
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
	$(document).ready(function () {
		$('.select2').select2({
			placeholder: "Select State",
			allowClear: true,
			width: '100%',
			minimumResultsForSearch: 1, // Ensures search is always available
			language: {
				noResults: function () {
					return "No states found";
				}
			},
			dropdownCssClass: 'select2-dropdown-in-select', // Custom class for styling
			selectionCssClass: 'select2-selection-in-select' // Custom class for selection area
		});
	});
</script>

<script>
    $(function () {
  const $password = $("#password");
  const $confirmPassword = $("#confirmPassword");
  const $passwordError = $("#passwordError");
  const $confirmError = $("#confirmError");
  const $passwordBox = $(".password-box");
  const $progressBar = $(".progress");
  const $saveDetails = $("#saveDetails");

  $passwordBox.removeClass("show");

  $password.on("focus", function () {
    $passwordBox.addClass("show");
  });

  $password.on("blur", function () {
    if ($password.val().trim() === "" && $confirmPassword.val().trim() === "") {
      $passwordBox.removeClass("show");
    }
  });

  $confirmPassword.on("focus", function () {
    $passwordBox.addClass("show");
  });

  $confirmPassword.on("blur", function () {
    if ($password.val().trim() === "" && $confirmPassword.val().trim() === "") {
      $passwordBox.removeClass("show");
    }
  });

  // Empty password fields by default
  $password.val('');
  $confirmPassword.val('');

  // Reset password box
  $(".eight-character").css("color", "#424646");
  $(".one-number").css("color", "#424646");
  $(".one-letter").css("color", "#424646");
  $(".one-character").css("color", "#424646");
  $progressBar.css("width", "0%");

  function validatePassword() {
    const password = $password.val();
    const confirmPass = $confirmPassword.val();
    let progress = 0;
    let errors = [];

    const $eightCharacterLi = $(".eight-character");
    const $oneNumberLi = $(".one-number");
    const $oneLetterLi = $(".one-letter");
    const $oneCharacterLi = $(".one-character");

    if (password.length >= 8) {
      $eightCharacterLi.css("color", "#65b891");
      $eightCharacterLi.addClass("valid");
      progress += 25;
    } else {
      $eightCharacterLi.css("color", "#424646");
      $eightCharacterLi.removeClass("valid");
      if (password.length > 0) {
        errors.push("Password must be at least 8 characters long.");
      }
    }

    if (/\d/.test(password)) {
      $oneNumberLi.css("color", "#65b891");
      $oneNumberLi.addClass("valid");
      progress += 25;
    } else {
      $oneNumberLi.css("color", "#424646");
      $oneNumberLi.removeClass("valid");
      if (password.length > 0) {
        errors.push("Password must contain at least one number.");
      }
    }

    if (/[a-zA-Z]/.test(password)) {
      $oneLetterLi.css("color", "#65b891");
      $oneLetterLi.addClass("valid");
      progress += 25;
    } else {
      $oneLetterLi.css("color", "#424646");
      $oneLetterLi.removeClass("valid");
      if (password.length > 0) {
        errors.push("Password must contain at least one letter.");
      }
    }

    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
      $oneCharacterLi.css("color", "#65b891");
      $oneCharacterLi.addClass("valid");
      progress += 25;
    } else {
      $oneCharacterLi.css("color", "#424646");
      $oneCharacterLi.removeClass("valid");
      if (password.length > 0) {
        errors.push("Password must contain at least one special character.");
      }
    }

    $progressBar.css("width", progress + "%");

    if (errors.length > 0) {
      $password.addClass("is-invalid");
      if ($passwordError.length > 0) {
        $passwordError.text(errors.join(", "));
        $passwordError.show();
      }
    } else {
      $password.removeClass("is-invalid");
      if ($passwordError.length > 0) {
        $passwordError.text("");
        $passwordError.hide();
      }
    }

    if (confirmPass.length > 0 && password !== confirmPass) {
      $confirmPassword.addClass("is-invalid");
      $confirmError.text("Passwords do not match.");
      $confirmError.show();
    } else {
      $confirmPassword.removeClass("is-invalid");
      $confirmError.text("");
      $confirmError.hide();
    }

    if (!$saveDetails.is(':checked')) {
      $password.val('');
      $confirmPassword.val('');
      validatePassword();
    }
  }

  $password.on("input", validatePassword);
  $confirmPassword.on("input", validatePassword);
  $saveDetails.on("change", function() {
    if (!$(this).is(':checked')) {
      $password.val('');
      $confirmPassword.val('');
      validatePassword();
    }
  });
});

$(document).ready(function () {
    $('.phone-number').inputmask('(999) 999-9999', {
        "clearIncomplete": false,
        "showMaskOnHover": false
    });
});
</script>
@endpush