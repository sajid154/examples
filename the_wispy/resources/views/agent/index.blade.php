@extends('layouts.agent')


@section('styles')


<style>
.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child>.btn, .input-group-btn:first-child>.btn-group>.btn, .input-group-btn:first-child>.dropdown-toggle, .input-group-btn:last-child>.btn-group:not(:last-child)>.btn, .input-group-btn:last-child>.btn:not(:last-child):not(.dropdown-toggle){width: 85%;}
.input-group>.input-group-append>.btn, .input-group>.input-group-append>.input-group-text, .input-group>.input-group-prepend:first-child>.btn:not(:first-child), .input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child), .input-group>.input-group-prepend:not(:first-child)>.btn, .input-group>.input-group-prepend:not(:first-child)>.input-group-text{margin-top: 0px;margin-left: 10px;}
.mb-0, .my-0 {color: #fff;}
.card {
    background-color: #fff;
    border-radius: 10px;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}
.l-bg-cherry {
    background: linear-gradient(to right, #493240, #5d26c1) !important;
    color: #fff;
}

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}

.card .card-statistic-3 .card-icon-large .fas, .card .card-statistic-3 .card-icon-large .far, .card .card-statistic-3 .card-icon-large .fab, .card .card-statistic-3 .card-icon-large .fal {
    font-size: 110px;
}

.card .card-statistic-3 .card-icon {
    text-align: center;
    line-height: 50px;
    margin-left: 15px;
    color: #000;
    position: absolute;
    right: -5px;
    top: 20px;
    opacity: 0.1;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}

.l-bg-green {
    background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
    color: #fff;
}

.l-bg-orange {
    background: linear-gradient(to right, #f9900e, #ffba56) !important;
    color: #fff;
}

.l-bg-cyan {
    background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
    color: #fff;
}
</style>
@endsection




@section('content')
  <br>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Agent Dashboard</div>

                <div class="panel-body">


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

@if(auth()->user()->status == '1')
@if(auth()->user()->agent_details->status == '1')
                        <!-- This is Agent Dashboard. You must be super privileged to be here ! -->
<div class="input-group col-md-6 mx-auto">

  <input type="text" class="form-control" value="{{ config('app.url') }}?ref_code={{auth()->user()->agent_details->reference_code}}" readonly="readonly" id="copyRefUrl">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="copyRefBtn"><i class="fa fa-copy"></i></button>
  </div>
</div>


<div class="input-group col-md-6 mx-auto">

  <input type="text" class="form-control" value="{{$home_page }}?ref_code={{auth()->user()->agent_details->reference_code}}" readonly="readonly" id="copyHomeUrl">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="copyHomeBtn"><i class="fa fa-copy"></i></button>
  </div>
</div>



<div class="input-group col-md-6 mx-auto">

  <input type="text" class="form-control" value="{{$price_page }}?ref_code={{auth()->user()->agent_details->reference_code}}" readonly="readonly" id="copyPriceUrl">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="copyPriceBtn"><i class="fa fa-copy"></i></button>
  </div>
</div>



<div class="input-group col-md-6 mx-auto">

  <input type="text" class="form-control" value="{{$demo_page }}?ref_code={{auth()->user()->agent_details->reference_code}}" readonly="readonly" id="copyPriceUrl">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" id="copyPriceBtn"><i class="fa fa-copy"></i></button>
  </div>
</div>



<div class="col-md-12" style="margin-top: 20px">
    <div class="row ">
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-cherry">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><!-- <i class="fas fa-shopping-cart"> --></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Total Customers</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                {{ $tCustomer }}
                            </h2>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-blue-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><!-- <i class="fas fa-users"></i> --></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Monthly Customers</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                {{ $cCustomer }}
                            </h2>
                        </div>
                        
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-green-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Total Commission</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">
                                ${{ $earnedCommision }}
                            </h2>
                        </div>
                     
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card l-bg-orange-dark">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Monthly Commission</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8">
                            <h2 class="d-flex align-items-center mb-0">

                                ${{$currentMonthCommision}}
                            </h2>
                        </div>
              
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!--Grid row-->
  <div class="row d-flex justify-content-center mt-5" style="background-color: #181C30; padding: 20px;">

    <!--Grid column-->
    <div class="col-md-12">

      <canvas id="lineChart"></canvas>

    </div>
    <!--Grid column-->

  </div>
  <!--Grid row-->
</div>

    @else

  <div class="alert alert-success">
                            Thanks you! for joining our affiliate program. Your account is under review soon you will contacted.
                        </div>


    @endif


@else


                      <div class="alert alert-warning">
                            Note! due to some reason your account is disabled by TheWispy. For more details please contact support@thewispy.com.
                        </div>




@endif

                </div>
            </div>



        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
const refUrl = document.getElementById('copyRefUrl');

const refBtn = document.getElementById('copyRefBtn');

refBtn.onclick = ()=>{
    refUrl.select();
    document.execCommand('copy');
}


const homeUrl = document.getElementById('copyHomeUrl');

const homeBtn = document.getElementById('copyHomeBtn');


homeBtn.onclick = ()=>{
    homeUrl.select();
    document.execCommand('copy');
}



const priceUrl = document.getElementById('copyPriceUrl');

const priceBtn = document.getElementById('copyPriceBtn');


priceBtn.onclick = ()=>{
    priceUrl.select();
    document.execCommand('copy');
}


var ctxL = document.getElementById("lineChart").getContext('2d');
    var gradientFill = ctxL.createLinearGradient(0, 0, 0, 290);
    gradientFill.addColorStop(0, "rgba(173, 53, 186, 1)");
    gradientFill.addColorStop(1, "rgba(173, 53, 186, 0.1)");
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: [

        @foreach($commisionsStatus as $month)

            "{{ $month->month }}",

        @endforeach
        ],
        datasets: [
          {
            label: "Customer",
            data: [
            
            @foreach($commisionsStatus as $month)

            {{ $month->customers }},

            @endforeach
            

            ],
            backgroundColor: gradientFill,
            borderColor: [
              '#4286f4',
            ],
            borderWidth: 3,
            pointBorderColor: "#fff",
            pointBackgroundColor: "rgba(173, 53, 186, 0.1)",
          },
           {
            label: "Commission",
            data: [
            @foreach($commisionsStatus as $month)

            {{ $month->amount }},

            @endforeach
            ],
            backgroundColor: gradientFill,
            borderColor: [
              '#38ef7d',
            ],
            borderWidth: 3,
            pointBorderColor: "#fff",
            pointBackgroundColor: "rgba(173, 53, 186, 0.1)",
          }
        ]
      }
      ,
      options: {
        responsive: true
      }
    });


</script>


@endsection