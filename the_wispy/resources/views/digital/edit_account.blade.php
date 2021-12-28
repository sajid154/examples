@extends('layouts.digital')
@section('pageTitle', 'Degital Marketing User Profile')

@section('styles')

<style type="text/css">
    .affiliate-box {
    /* padding: 0 15px; */
    overflow: hidden;
    border: none;
    min-height: 510px;
    margin-top: 6       0px;
    box-shadow: 0 0 15px 0 rgb(153 153 153 / 40%);
    padding: 24px 36px 17px 34px;
}
.page-header.title {
    margin: 15px 0 12px;
    border-bottom: 1px solid #e5e5e5;
    color: #414141;
    padding: 15px;
    background-color: #ffffff;
}
.portlet {
    margin-bottom: 15px;
    border: 1px solid #e5e5e5;
    background: #ffffff;
}
.portlet .portlet-body {
    background: #ffffff;
    padding: 15px;
}
.affiliate-btn {
    padding: 4px 30px;
    background: #ec008c;
    margin-top: 5px;
    margin-left:10px;
    color: #fff;
    box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
    border: 1px solid #ec008c;
    border-radius: 4px;
}
.affiliate-form-heading{
padding: 5px 15px;
border-bottom: 1px solid #e5e5e5;
background: #bcc7cf;
line-height: 38px;
min-height: 39px;}
.affiliate-form-body {
    margin-bottom: 15px;
    border: 1px solid #e5e5e5;
}
.form-group.row.affiliate {
    margin: 1rem;
}
.col-md-12.affiliate {
    text-align: center;
}
.affiliate-form-body.ending {
    border: none;
    margin-top: 40px;
}
// workaround
.intl-tel-input {
  display: table-cell;
}
.intl-tel-input .selected-flag {
  z-index: 4;
}
.intl-tel-input .country-list {
  z-index: 5;
}
.input-group .intl-tel-input .form-control {
  border-top-left-radius: 4px;
  border-top-right-radius: 0;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 0;
}

.invalid_feedback2{
    display: block;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
}
</style>



@endsection




@section('content')
<section class="container">
    <section class="affiliate-box">
        <div class="page-header title"><h1>The WISPY Marketing system</h1></div>
    
    
     <section class="affiliate-form">
     <section class="affiliate-form-heading"> 
        <h4>Update Your Account</h4>
</section>


    <form method="POST" action="{{ route('market-update') }}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <section class="affiliate-form-body">
            <div class="form-group row affiliate">

                            <div class="col-md-12">
                                <label>Name:</label>
                                <input id="name" type="text" class="form-control " name="name" value="{{ ucwords(auth()->user()->name) }}" placeholder="Name">
                                 @error('name')
                                        <span class="invalid_feedback2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                               
                        </div>

                       <div class="form-group row affiliate">
                            <div class="col-md-12">
                                <label>Password:</label>
                                <input id="password" type="password" class="form-control " name="password" autocomplete="new-password" placeholder="Password">
                                
                                @error('password')
                                    <span class="invalid-feedback2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                              
                        </div> 
                        <div class="form-group row affiliate">
                            <div class="col-md-12">
                                <label>Confirm Password:</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                                @error('password_confirmation')
                                    <span class="invalid-feedback2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        </section>
                        </section>



 

<section class="affiliate-form-body ending">

<div class="col-md-12 affiliate">
                                <button type="submit" class="affiliate-btn">
                                    Update
                                </button>
                            </div>
                       
                        </section>



</form>













                    </section>
</section>
</section>
@endsection



@section('scripts')

<script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });


 const check = document.querySelector('.myCheck');

 const affiliateBtn = document.querySelector('.affiliate-btn');
  

 check.addEventListener('click', function(){
       

        affiliateBtn.removeAttribute('disabled');
         
 });

 </script>


<script>

var phone_input = document.getElementById("myform_phone");

phone_input.addEventListener('input', () => {
  phone_input.setCustomValidity('');
  phone_input.checkValidity();
});

phone_input.addEventListener('invalid', () => {
  if(phone_input.value === '') {
    phone_input.setCustomValidity('Enter phone number!');
  } else {
    phone_input.setCustomValidity('Enter phone number in this format: 123-456-7890');
  }
});
</script>

@endsection