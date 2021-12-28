@extends('layouts.register')
@section('pageTitle', 'Dashboard for Remote Mobile Monitoring') 
@section('content')
<link href="https://stripe-samples.github.io/developer-office-hours/demo.css" rel="stylesheet" type="text/css">
<style>
.purchase-progress {
    background: #F1F2F2;
    padding: 15px 0;
  overflow:hidden;
  margin-bottom:25px; border-radius:4px;
  
}
.purchase-progress .wrapper {
    width: 570px;
    margin: 0 auto;
}
.purchase-progress .item.active {
    background: #ec008c;
    color: #fff;
}
.purchase-progress .item {
    float: left;
width: 32px;
line-height: 30px;
background: #fff;
border: 2px solid #ec008c;
border-radius: 50%;
text-align: center;
color: #333;
font-size: 17px;
}
.purchase-progress .line-cut {
    float: left;
    width: 235px;
    height: 2px;
    background: #ec008c;
    position: relative;
    top: 15px;
}
.clear:after {
    display: block;
    clear: both;
}
  .form-control[disabled],  fieldset[disabled] .form-control{
    background-color: #337ab7 !important;
  }
  p {
    font-family: 'Roboto', sans-serif !important;
}

</style>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <div class="checkout-new">



            <section class="checkout-back down">
<section class="checkout-img">
  <div class="new-lable-img">
    <img src="{{ asset('uploads/checkout/icon-dashboard-normal.png')}}">
    <div class="arrow-not-active">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>

    </div><div class="checkout-not-active">
    <p>1.<span>Dashboard</span></p>
    </div>

  </div>
  <div class="new-lable-img">
    <img src="{{ asset('uploads/checkout/icon-checkout-active.gif')}}">
    <div class="arrow-active">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
    </div>
    <div class="checkout-active">
    <p>2.<span>Checkout</span></p>
  </div>
  </div>
  <div class="new-lable-img">
    <img src="{{ asset('uploads/checkout/icon-thanks-normal.gif')}}">
    <div class="arrow-not-active">

    </div>
    <div class="checkout-not-active">
    <p>3.<span>Review &amp; Thanks</span></p>
  </div>
  </div>
</section>

</section>


        <div class="container">

@if ((Session::has('error')))
                <div class="alert alert-danger col-md-12">{{
							Session::get('error') }}</div>
            @endif
    <form method="post" action="{{url('/payment-process')}}" id="job-create-form">
        {{ csrf_field() }}
		<div class="checkout-billing-info">
{{--@if ((Session::has('error')))
                    <input type="hidden" name="amount" value="{{Session::get('cost_price') }}" id="amount" class="dis_amount">
        <input type="hidden" abc="aaaaa" name="plan_id" value="{{Session::get('plan_id_sess') }}" id="plan_id">
        <input type="hidden" name="client_id" value="" id="client_id">
                <input type="hidden" name="old_key" value="" id="oldkey">
        @else--}}
					<input type="hidden" name="amount" value="{{ isset($pkginfo[0]->cost_price)?$pkginfo[0]->cost_price:old('amount')}}" id="amount" class="dis_amount">
                <input type="hidden" name="landing_page" value="Billing" />
                <input type="hidden" name="SOLUTIONTYPE" value="Sole" />
                <input type="hidden" name="plan_id" value="{{ isset($pkginfo[0]->id)?$pkginfo[0]->id:old('plan_id')}}" id="plan_id" abc="xyz">
                <input type="hidden" name="client_id" value="{{isset($client_id)?$client_id:old('client_id')}}" id="client_id">
                <input type="hidden" name="old_key" value="{{isset($oldkey)?$oldkey:old('old_key')}}" id="oldkey">
				{{--@endif--}}
				<div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name</label> <input
                                class='form-control' name="name" required type='text'>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Email</label>
                            <input type="email" name="email" class="form-control" value=" {{ Auth::user()->email }}" readonly="readonly"/>
                        </div>
                    </div>
					<div class='form-row'>
					<label class='control-label' style="display:block; width:100%;">Card Information</label>
                <div class="field" id="card-element"></div></div>
				<div class='form-row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Address</label>
                                <input type="text" name="address" required class="form-control" />
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-6 form-group required'>
                                <label class='control-label'>City</label>
                                <input type="text" name="city" required class="form-control"/>
                            </div>
                            <div class='col-xs-6 form-group required'>
                                <label class='control-label'>State</label>
                                <input type="text" name="state" required class="form-control"/>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Country</label>
                                <select id="country" name="country" class="form-control">
								 <option value="United States of America">United States of America</option>
								 <option value="United Kingdom">United Kingdom</option>
                                       <option value="Afganistan">Afghanistan</option>
   <option value="Albania">Albania</option>
   <option value="Algeria">Algeria</option>
   <option value="American Samoa">American Samoa</option>
   <option value="Andorra">Andorra</option>
   <option value="Angola">Angola</option>
   <option value="Anguilla">Anguilla</option>
   <option value="Antigua & Barbuda">Antigua & Barbuda</option>
   <option value="Argentina">Argentina</option>
   <option value="Armenia">Armenia</option>
   <option value="Aruba">Aruba</option>
   <option value="Australia">Australia</option>
   <option value="Austria">Austria</option>
   <option value="Azerbaijan">Azerbaijan</option>
   <option value="Bahamas">Bahamas</option>
   <option value="Bahrain">Bahrain</option>
   <option value="Bangladesh">Bangladesh</option>
   <option value="Barbados">Barbados</option>
   <option value="Belarus">Belarus</option>
   <option value="Belgium">Belgium</option>
   <option value="Belize">Belize</option>
   <option value="Benin">Benin</option>
   <option value="Bermuda">Bermuda</option>
   <option value="Bhutan">Bhutan</option>
   <option value="Bolivia">Bolivia</option>
   <option value="Bonaire">Bonaire</option>
   <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
   <option value="Botswana">Botswana</option>
   <option value="Brazil">Brazil</option>
   <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
   <option value="Brunei">Brunei</option>
   <option value="Bulgaria">Bulgaria</option>
   <option value="Burkina Faso">Burkina Faso</option>
   <option value="Burundi">Burundi</option>
   <option value="Cambodia">Cambodia</option>
   <option value="Cameroon">Cameroon</option>
   <option value="Canada">Canada</option>
   <option value="Canary Islands">Canary Islands</option>
   <option value="Cape Verde">Cape Verde</option>
   <option value="Cayman Islands">Cayman Islands</option>
   <option value="Central African Republic">Central African Republic</option>
   <option value="Chad">Chad</option>
   <option value="Channel Islands">Channel Islands</option>
   <option value="Chile">Chile</option>
   <option value="China">China</option>
   <option value="Christmas Island">Christmas Island</option>
   <option value="Cocos Island">Cocos Island</option>
   <option value="Colombia">Colombia</option>
   <option value="Comoros">Comoros</option>
   <option value="Congo">Congo</option>
   <option value="Cook Islands">Cook Islands</option>
   <option value="Costa Rica">Costa Rica</option>
   <option value="Cote DIvoire">Cote DIvoire</option>
   <option value="Croatia">Croatia</option>
   <option value="Cuba">Cuba</option>
   <option value="Curaco">Curacao</option>
   <option value="Cyprus">Cyprus</option>
   <option value="Czech Republic">Czech Republic</option>
   <option value="Denmark">Denmark</option>
   <option value="Djibouti">Djibouti</option>
   <option value="Dominica">Dominica</option>
   <option value="Dominican Republic">Dominican Republic</option>
   <option value="East Timor">East Timor</option>
   <option value="Ecuador">Ecuador</option>
   <option value="Egypt">Egypt</option>
   <option value="El Salvador">El Salvador</option>
   <option value="Equatorial Guinea">Equatorial Guinea</option>
   <option value="Eritrea">Eritrea</option>
   <option value="Estonia">Estonia</option>
   <option value="Ethiopia">Ethiopia</option>
   <option value="Falkland Islands">Falkland Islands</option>
   <option value="Faroe Islands">Faroe Islands</option>
   <option value="Fiji">Fiji</option>
   <option value="Finland">Finland</option>
   <option value="France">France</option>
   <option value="French Guiana">French Guiana</option>
   <option value="French Polynesia">French Polynesia</option>
   <option value="French Southern Ter">French Southern Ter</option>
   <option value="Gabon">Gabon</option>
   <option value="Gambia">Gambia</option>
   <option value="Georgia">Georgia</option>
   <option value="Germany">Germany</option>
   <option value="Ghana">Ghana</option>
   <option value="Gibraltar">Gibraltar</option>
   <option value="Great Britain">Great Britain</option>
   <option value="Greece">Greece</option>
   <option value="Greenland">Greenland</option>
   <option value="Grenada">Grenada</option>
   <option value="Guadeloupe">Guadeloupe</option>
   <option value="Guam">Guam</option>
   <option value="Guatemala">Guatemala</option>
   <option value="Guinea">Guinea</option>
   <option value="Guyana">Guyana</option>
   <option value="Haiti">Haiti</option>
   <option value="Hawaii">Hawaii</option>
   <option value="Honduras">Honduras</option>
   <option value="Hong Kong">Hong Kong</option>
   <option value="Hungary">Hungary</option>
   <option value="Iceland">Iceland</option>
   <option value="Indonesia">Indonesia</option>
   <option value="India">India</option>
   <option value="Iran">Iran</option>
   <option value="Iraq">Iraq</option>
   <option value="Ireland">Ireland</option>
   <option value="Isle of Man">Isle of Man</option>
   <option value="Israel">Israel</option>
   <option value="Italy">Italy</option>
   <option value="Jamaica">Jamaica</option>
   <option value="Japan">Japan</option>
   <option value="Jordan">Jordan</option>
   <option value="Kazakhstan">Kazakhstan</option>
   <option value="Kenya">Kenya</option>
   <option value="Kiribati">Kiribati</option>
   <option value="Korea North">Korea North</option>
   <option value="Korea Sout">Korea South</option>
   <option value="Kuwait">Kuwait</option>
   <option value="Kyrgyzstan">Kyrgyzstan</option>
   <option value="Laos">Laos</option>
   <option value="Latvia">Latvia</option>
   <option value="Lebanon">Lebanon</option>
   <option value="Lesotho">Lesotho</option>
   <option value="Liberia">Liberia</option>
   <option value="Libya">Libya</option>
   <option value="Liechtenstein">Liechtenstein</option>
   <option value="Lithuania">Lithuania</option>
   <option value="Luxembourg">Luxembourg</option>
   <option value="Macau">Macau</option>
   <option value="Macedonia">Macedonia</option>
   <option value="Madagascar">Madagascar</option>
   <option value="Malaysia">Malaysia</option>
   <option value="Malawi">Malawi</option>
   <option value="Maldives">Maldives</option>
   <option value="Mali">Mali</option>
   <option value="Malta">Malta</option>
   <option value="Marshall Islands">Marshall Islands</option>
   <option value="Martinique">Martinique</option>
   <option value="Mauritania">Mauritania</option>
   <option value="Mauritius">Mauritius</option>
   <option value="Mayotte">Mayotte</option>
   <option value="Mexico">Mexico</option>
   <option value="Midway Islands">Midway Islands</option>
   <option value="Moldova">Moldova</option>
   <option value="Monaco">Monaco</option>
   <option value="Mongolia">Mongolia</option>
   <option value="Montserrat">Montserrat</option>
   <option value="Morocco">Morocco</option>
   <option value="Mozambique">Mozambique</option>
   <option value="Myanmar">Myanmar</option>
   <option value="Nambia">Nambia</option>
   <option value="Nauru">Nauru</option>
   <option value="Nepal">Nepal</option>
   <option value="Netherland Antilles">Netherland Antilles</option>
   <option value="Netherlands">Netherlands (Holland, Europe)</option>
   <option value="Nevis">Nevis</option>
   <option value="New Caledonia">New Caledonia</option>
   <option value="New Zealand">New Zealand</option>
   <option value="Nicaragua">Nicaragua</option>
   <option value="Niger">Niger</option>
   <option value="Nigeria">Nigeria</option>
   <option value="Niue">Niue</option>
   <option value="Norfolk Island">Norfolk Island</option>
   <option value="Norway">Norway</option>
   <option value="Oman">Oman</option>
   <option value="Pakistan">Pakistan</option>
   <option value="Palau Island">Palau Island</option>
   <option value="Palestine">Palestine</option>
   <option value="Panama">Panama</option>
   <option value="Papua New Guinea">Papua New Guinea</option>
   <option value="Paraguay">Paraguay</option>
   <option value="Peru">Peru</option>
   <option value="Phillipines">Philippines</option>
   <option value="Pitcairn Island">Pitcairn Island</option>
   <option value="Poland">Poland</option>
   <option value="Portugal">Portugal</option>
   <option value="Puerto Rico">Puerto Rico</option>
   <option value="Qatar">Qatar</option>
   <option value="Republic of Montenegro">Republic of Montenegro</option>
   <option value="Republic of Serbia">Republic of Serbia</option>
   <option value="Reunion">Reunion</option>
   <option value="Romania">Romania</option>
   <option value="Russia">Russia</option>
   <option value="Rwanda">Rwanda</option>
   <option value="St Barthelemy">St Barthelemy</option>
   <option value="St Eustatius">St Eustatius</option>
   <option value="St Helena">St Helena</option>
   <option value="St Kitts-Nevis">St Kitts-Nevis</option>
   <option value="St Lucia">St Lucia</option>
   <option value="St Maarten">St Maarten</option>
   <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
   <option value="Saipan">Saipan</option>
   <option value="Samoa">Samoa</option>
   <option value="Samoa American">Samoa American</option>
   <option value="San Marino">San Marino</option>
   <option value="Sao Tome & Principe">Sao Tome & Principe</option>
   <option value="Saudi Arabia">Saudi Arabia</option>
   <option value="Senegal">Senegal</option>
   <option value="Seychelles">Seychelles</option>
   <option value="Sierra Leone">Sierra Leone</option>
   <option value="Singapore">Singapore</option>
   <option value="Slovakia">Slovakia</option>
   <option value="Slovenia">Slovenia</option>
   <option value="Solomon Islands">Solomon Islands</option>
   <option value="Somalia">Somalia</option>
   <option value="South Africa">South Africa</option>
   <option value="Spain">Spain</option>
   <option value="Sri Lanka">Sri Lanka</option>
   <option value="Sudan">Sudan</option>
   <option value="Suriname">Suriname</option>
   <option value="Swaziland">Swaziland</option>
   <option value="Sweden">Sweden</option>
   <option value="Switzerland">Switzerland</option>
   <option value="Syria">Syria</option>
   <option value="Tahiti">Tahiti</option>
   <option value="Taiwan">Taiwan</option>
   <option value="Tajikistan">Tajikistan</option>
   <option value="Tanzania">Tanzania</option>
   <option value="Thailand">Thailand</option>
   <option value="Togo">Togo</option>
   <option value="Tokelau">Tokelau</option>
   <option value="Tonga">Tonga</option>
   <option value="Trinidad & Tobago">Trinidad & Tobago</option>
   <option value="Tunisia">Tunisia</option>
   <option value="Turkey">Turkey</option>
   <option value="Turkmenistan">Turkmenistan</option>
   <option value="Turks & Caicos Is">Turks & Caicos Is</option>
   <option value="Tuvalu">Tuvalu</option>
   <option value="Uganda">Uganda</option>
   <option value="Ukraine">Ukraine</option>
   <option value="United Arab Erimates">United Arab Emirates</option>
   <option value="Uraguay">Uruguay</option>
   <option value="Uzbekistan">Uzbekistan</option>
   <option value="Vanuatu">Vanuatu</option>
   <option value="Vatican City State">Vatican City State</option>
   <option value="Venezuela">Venezuela</option>
   <option value="Vietnam">Vietnam</option>
   <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
   <option value="Wake Island">Wake Island</option>
   <option value="Wallis & Futana Is">Wallis & Futana Is</option>
   <option value="Yemen">Yemen</option>
   <option value="Zaire">Zaire</option>
   <option value="Zambia">Zambia</option>
   <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Phone Number</label>
                                <input type="text" required name="phone" class="form-control"/>
                            </div>
                        </div>
				</div>
                <input type="hidden" name="payment_intent" id="payment_intent">
                    <div id="error-messages"></div>
					<div class="checkbox-right-option">
					<div class="purchase-package-info">
                        <div class="purchase-package-img">
                            <img src="https://www.thewispy.com/wp-content/uploads/2020/07/product-img.png" />
                        </div>
                        <div class="purchase-package-title">
                           <h3>
						   @if ((Session::has('error')))
						   {{Session::get('type') }} {{Session::get('title') }}
					   @else
    
      @if( isset($pkginfo[0]->type) && $pkginfo[0]->type == "one_dollar_Deal")
             Starter <span>{{ ''.$pkginfo[0]->title}}</span> <!-- License -->
             @else
             {{ucfirst($pkginfo[0]->type)}} <span>{{$pkginfo[0]->title}}</span> <!-- License -->
             @endif

					   @endif
					   </h3>
                            <p>
							@if ((Session::has('error')))
								{{Session::get('description') }}
					   @else
							{{$pkginfo[0]->description}}
							@endif
							</p>
                            <p class="total-amount"><strong>Total : <span>
							@if ((Session::has('error')))
						${{Session::get('cost_price') }}
					   @else
							${{$pkginfo[0]->cost_price}}
						@endif
						</span></strong></p>
                        </div>
                    </div>


<div class="secure-payment-section new">
<div id="loader" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                </div>                <div class="alert alert-success alert-block" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                </div>                <div class="alert alert-error alert-block" style="background-color:#f4d2d2; display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                </div>
  <section id="do_action">
    <div class="container">
      <div class="heading">
        <p>Choose if you have a coupon code you want to use.</p>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="chose_area">
            <ul class="user_option">
              <li>
                <form action="#" method="post">{{ csrf_field() }}
                  <label>Coupon Code</label>
                  <input class="form-control" type="text" name="coupon_code">
                  <input class="form-control coupon-btn" type="submit" value="Apply" id="applycoupon" class="btn btn-default">
                </form>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">  
          <div class="total_area" style="display: none;margin-top: 30px;">
            <ul>
              
            @if ((Session::has('error')))
                <li>Sub Total <span>$ {{Session::get('cost_price') }}</span></li>
                <li id="coupon_dis"></li>
                <li id="grand_tot"></li>
              @else
                <li>Sub Total <span>$ {{$pkginfo[0]->cost_price}}</span></li>
                <li id="coupon_dis"></li>
                <li id="grand_tot"></li>
            @endif


             
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#do_action-->
  </div>







                    <div class="payment-partner-logo">
                        <img src="https://www.thewispy.com/wp-content/uploads/2020/07/cc1.png" />
                    </div>

                    <div class="secure-payment-section">
                        <img src="{{ asset('uploads/checkout/credit-card.png') }}" />
                        <!-- <h4>100% Secure Transaction<br><span>Buy with confidence</span></h4> -->
                         <h4>100% <span>Secure </span> Transaction</h4>

                      <h5>Buy with <span>confidence</span></h5>
                       <label for="terms" class="term-text">
                            <input type="checkbox" name="terms" required="required" id="terms" />By placing this order I agree to the <a href="https://www.thewispy.com/terms/" target="_blank">Terms of Use</a>, <a href="https://www.thewispy.com/privacy-policy/" target="_blank">Privacy Policy</a> and <a href="https://www.thewispy.com/eula" target="_blank">End User License Agreement (EULA)</a>.
                        </label>
                        <label for="privacy" class="term-text">
                            <input type="checkbox" name="privacy" required="required" id="privacy" />I realize that I will need physical access to the target device in some cases.
                        </label>
                <button type="submit" class="form-control btn btn-primary submit-button pay" id="btn">Pay</button>
				</form>
				<form method="post" action="{{url('charge')}}">
				{{ csrf_field() }}
 
					<input type="hidden" name="amount" value="{{ isset($pkginfo[0]->cost_price)?$pkginfo[0]->cost_price:old('amount')}}" id="amount" class="dis_amount">
                <input type="hidden" name="landing_page" value="Billing" />
                <input type="hidden" name="SOLUTIONTYPE" value="Sole" />
                <input type="hidden" name="plan_id" value="{{ isset($pkginfo[0]->id)?$pkginfo[0]->id:old('plan_id')}}" id="plan_id">
                <input type="hidden" name="client_id" value="{{isset($client_id)?$client_id:old('client_id')}}" id="client_id">
                <input type="hidden" name="old_key" value="{{isset($oldkey)?$oldkey:old('old_key')}}" id="oldkey">
				<div class='form-group pay_with_paypal_btn'><button class='form-control btn btn-primary submit-button new'
                                        type='submit' style="margin-top: 10px;">
                                        <img src="{{ asset('uploads/checkout/887px-PayPal_Logo_Icon_2014.svg.png')}}">
					Pay With PayPal
				</button></div>
			</form>
				</div>
				</div>
				</div>
				</div>
    <script src="https://code.jquery.com/jquery-1.12.3.min.js"
            integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
            crossorigin="anonymous"></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;

                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });

        $(function() {
            var $form = $("#payment-form");

            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
					$('.session_error')
						.addClass('hide');
                } else {
                  $('#Spay_butt').attr('disabled', 'disabled');
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        })
    </script>
	<script src="https://js.stripe.com/v3/"></script>
<script charset="utf-8">


  
    var stripe = Stripe('pk_live_51HyS51I3yE8sshh2jh7ZDZhk5UDWQK9Zu1lSpz7l45R8jlN4hohHPkEyiL63ijqCPLJdEvdpkg0nz71QuZTQ4hLY00XxW6KpG8');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
    var form = document.getElementById('job-create-form');
    var amount = document.getElementById('amount');
    var plan_id = document.getElementById('plan_id');
    var client_id = document.getElementById('client_id');
    var oldkey = document.getElementById('oldkey');
    var paymentIntentInput = document.getElementById('payment_intent');
    var paymentIntentInputsecret = document.getElementById('client_Secret');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
         $('#btn').attr('disabled', 'disabled');
         
        createPaymentIntent().then(function(paymentIntent) {
            paymentIntentInput.value = paymentIntent.id;
            // paymentIntentInputsecret.value = paymentIntent.clientSecret;

            if(paymentIntent.errors) {
                showErrors(paymentIntent.errors);
        console.log(paymentIntent.errors);
            } else {
                errorMessages.innerText = '';
                confirmPaymentIntent(paymentIntent).then(function() {
          console.log(paymentIntent);
          submitForm(paymentIntent);
                });
            }
        });
    });

    function submitForm(paymentIntent) {
        form.submit();
    }

    function confirmPaymentIntent(paymentIntent) {
        return stripe.confirmCardPayment(
            paymentIntent.clientSecret,
            {
                payment_method: {
                    card: cardElement,
                },
            }
        );
}

    var errorMessages = document.getElementById('error-messages');
    function showErrors(errors) {
        
    }

    function createPaymentIntent() {
        return fetch("{{url('/secure-payment')}}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByName('_token')[0].value,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                amount: amount.value,
                plan_id: plan_id.value,
                client_id: client_id.value,
                oldkey: oldkey.value,
            }),
        })
            .then((response) => response.json())
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
   <script type="text/javascript">    $(document).ready(function(){      $('#applycoupon').click(function(e){
        e.preventDefault();
        $('.total_area').hide();
        $('.alert').hide();
        $('#loader').show();
        $('#loader').html("<img src='{{ asset('Loader-1-A.gif') }}' style='position: relative;z-index: 9;/* bottom:77px; */background:transparent;height: 80px;width: 83px;' >");
        var data = $('input[name="coupon_code"]').val();
         var cost_price = "{{ (Session::has('error'))?Session::get('cost_price'):$pkginfo[0]->cost_price }}" ;

        $.ajax({
          url:"{{ url('apply-coupon') }}",
          data:{'coupon_code' : data,'cost_price':cost_price },
          type:"post",
          success: function(data){
            console.log(data);
            $('#loader').hide();
            var cost_price = "{{ (Session::has('error'))?Session::get('cost_price'):$pkginfo[0]->cost_price }}" ;
            console.log(cost_price);
            console.log(data.CouponAmount);
            console.log(parseFloat(data.CouponAmount));
            var res = cost_price - parseFloat(data.CouponAmount);
            var res = res.toFixed(2);  
            console.log(res);
            if(data.flash_message_error){
              $('.alert-error').show();
              $('.alert-success').hide();
              $('.alert-error').html(data.flash_message_error);
              // alert("ddd");
            }else{
              $('.dis_amount').val(res);
              $('.alert-success').show();
                $('.total_area').show();
              $('.alert-error').hide();
              $('#coupon_dis').html("Coupon Discount <span>$ "+data.CouponAmount.toFixed(2)+"</span>");
              $('#grand_tot').html("Grand Total <span>$ "+res+"</span>");
              $('.alert-success').html(data.flash_message_success);            }
          }
        })        })    })   </script>
@endsection
